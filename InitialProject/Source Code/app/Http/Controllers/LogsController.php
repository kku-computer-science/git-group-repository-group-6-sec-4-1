<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Symfony\Component\Finder\SplFileInfo;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class LogsController extends Controller
{
    public $perPage = 500;

    public function index(Request $request)
    {
        $users = User::all();
        $logPath = storage_path('logs/activity.log');
        $userFilter = $request->query('user_id');
        $activitySearch = $request->query('activity_search');

        if (!File::exists($logPath)) {
            $pagedLogs = null;
        } else {
            $logs = array_reverse(explode("\n", File::get($logPath)));
            $parsedLogs = [];
            $usersById = $users->keyBy('id');

            foreach ($logs as $log) {
                if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                    $jsonStart = strpos($log, '{');
                    $message = $jsonStart !== false ? trim(substr($log, 0, $jsonStart)) : $log;
                    $jsonData = $jsonStart !== false ? json_decode(substr($log, $jsonStart), true) : null;

                    $action = 'Unknown';
                    $details = [];

                    if ($jsonData && is_array($jsonData)) {
                        $action = $jsonData['action'] ?? $this->extractActionFromMessage($message);
                        $details = $jsonData['details'] ?? [];
                        if (empty($details) && in_array($action, ['login', 'logout'])) {
                            $details = ['target' => 'session'];
                        }
                    } else {
                        $action = $this->extractActionFromMessage($message);
                        if (in_array($action, ['login', 'logout'])) {
                            $details = ['target' => 'session'];
                        } else {
                            $details = ['raw' => $log];
                        }
                    }

                    $userId = $jsonData['user_id'] ?? 'Unknown';
                    $user = $usersById->get($userId);

                    if ($userFilter && $userId != $userFilter) {
                        continue;
                    }
                    if ($activitySearch && !str_contains(strtolower($log), strtolower($activitySearch))) {
                        continue;
                    }

                    $parsedLogs[] = [
                        'user_id' => $userId,
                        'email' => $jsonData['email'] ?? 'Unknown',
                        'first_name' => $user ? $user->fname_en : 'Unknown',
                        'last_name' => $user ? $user->lname_en : 'Unknown',
                        'action' => $action,
                        'details' => $details,
                        'timestamp' => $jsonData['timestamp'] ?? $this->extractTimestamp($log),
                        'ip' => $jsonData['ip'] ?? 'Unknown',
                    ];
                }
            }

            usort($parsedLogs, fn($a, $b) => strcmp($b['timestamp'], $a['timestamp']));
            $perPage = 20;
            $currentPage = $request->get('page', 1);
            $pagedLogs = new LengthAwarePaginator(
                array_slice($parsedLogs, ($currentPage - 1) * $perPage, $perPage),
                count($parsedLogs),
                $perPage,
                $currentPage,
                ['path' => url('/logs'), 'query' => $request->query()]
            );
        }

        return view('logs.index', [
            'users' => $users,
            'pagedLogs' => $pagedLogs,
            'httpErrorLogs' => null,
            'systemErrorLogs' => null,
            'activeTab' => 'activity'
        ]);
    }

    public function httpLogs(Request $request)
    {
        $users = User::all();
        $files = $this->getLogFiles();
        $latestAccessLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'access'));

        $httpSearch = $request->query('http_search');
        $httpErrorLogs = $this->parseHttpErrors($latestAccessLog);

        if ($httpSearch) {
            $httpErrorLogs = $httpErrorLogs->filter(fn($log) => $this->filterLogs($log, strtolower($httpSearch)))->values();
        }
        $httpErrorLogs = $httpErrorLogs->take(10);

        return view('logs.index', [
            'users' => $users,
            'pagedLogs' => null,
            'httpErrorLogs' => $httpErrorLogs,
            'systemErrorLogs' => null,
            'activeTab' => 'http'
        ]);
    }

    public function systemLogs(Request $request)
    {
        $users = User::all();
        $files = $this->getLogFiles();
        $latestLaravelLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'laravel'));

        $systemSearch = $request->query('system_search');
        $systemErrorLogs = $this->parseSystemErrors($latestLaravelLog);
        if ($systemSearch) {
            $systemErrorLogs = $systemErrorLogs->filter(fn($log) => $this->filterLogs($log, strtolower($systemSearch)))->values();
        }
        $systemErrorLogs = $systemErrorLogs->take(10);

        return view('logs.index', [
            'users' => $users,
            'pagedLogs' => null,
            'httpErrorLogs' => null,
            'systemErrorLogs' => $systemErrorLogs,
            'activeTab' => 'system'
        ]);
    }

    public function show(Request $request)
    {
        $files = $this->getLogFiles();
        $latestAccessLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'access'));
        $latestLaravelLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'laravel'));

        $searchQuery = strtolower($request->input('search', ''));

        $httpLogs = $this->parseHttpErrors($latestAccessLog);
        if ($searchQuery) {
            $httpLogs = $httpLogs->filter(fn($log) => $this->filterLogs($log, $searchQuery));
        }

        $systemLogs = $this->parseSystemErrors($latestLaravelLog);
        if ($searchQuery) {
            $systemLogs = $systemLogs->filter(fn($log) => $this->filterLogs($log, $searchQuery));
        }

        $pageHttp = max(1, intval($request->input('page_http', 1)));
        $pHttp = ['page' => $pageHttp, 'total' => ceil($httpLogs->count() / $this->perPage)];
        $httpErrorLogs = $httpLogs->slice(($pageHttp - 1) * $this->perPage, $this->perPage);

        $pageSystem = max(1, intval($request->input('page_system', 1)));
        $pSystem = ['page' => $pageSystem, 'total' => ceil($systemLogs->count() / $this->perPage)];
        $systemErrorLogs = $systemLogs->slice(($pageSystem - 1) * $this->perPage, $this->perPage);

        return view('logs.index', compact('httpErrorLogs', 'systemErrorLogs', 'pHttp', 'pSystem', 'searchQuery'));
    }

    protected function getLogFiles()
    {
        $directory = storage_path('logs');
        return collect(File::allFiles($directory))
            ->filter(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'access') || str_contains($file->getFilename(), 'laravel'))
            ->sortByDesc(fn(SplFileInfo $file) => $file->getMTime());
    }

    protected function parseHttpErrors($file)
    {
        if (!$file) return collect();
        $rawLog = file($file->getPathname(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
        $parsedLogs = collect($rawLog)->map(function ($line) {
            // Regex ปรับใหม่ให้จับทุกฟิลด์อย่างยืดหยุ่น
            $pattern = '/\[(.*?)\] .*?(?:HTTP Request Error|Login Failed)?\s*{(.*?)}/';
            if (preg_match($pattern, $line, $matches)) {
                $timestamp = $matches[1];
                $jsonData = $matches[2];
    
                // Parse JSON ด้วย json_decode
                $data = json_decode('{' . $jsonData . '}', true);
                if ($data === null) {
                    \Log::warning("Failed to decode JSON in log line: $line");
                    return null;
                }
    
                $status = (int)($data['status'] ?? 0);
                if ($status >= 400) {
                    return (object) [
                        'timestamp' => $timestamp,
                        'ip' => $data['ip'] ?? 'Unknown',
                        'port' => $data['port'] ?? 'N/A',
                        'status' => $status,
                        'method' => $data['method'] ?? 'Unknown',
                        'url' => $data['url'] ?? 'N/A',
                        'user_id' => isset($data['user_id']) && $data['user_id'] !== null ? (int)$data['user_id'] : null,
                        'email' => $data['email'] ?? 'Guest', // ดึง email จาก JSON
                        'first_name' => $data['first_name'] ?? 'Unknown',
                        'last_name' => $data['last_name'] ?? 'Unknown',
                        'message' => $data['message'] ?? "HTTP {$status} - " . ($data['method'] ?? 'Unknown') . " Request"
                    ];
                }
            } else {
                \Log::warning("Failed to parse log line: $line");
            }
            return null;
        })->filter()->values();
    
        \Log::info("Parsed HTTP error logs count: " . $parsedLogs->count());
        return $parsedLogs;
    }


    protected function parseSystemErrors($file)
    {
        if (!$file) return collect();
        $rawLog = file($file->getPathname(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        return collect($rawLog)->map(function ($line) {
            $pattern = '/^\[(.*?)\] \w+\.(ERROR): (.+?)(\s?\{.*\})?$/';
            if (!preg_match($pattern, $line, $matches)) return null;

            return (object) [
                'timestamp' => $matches[1],
                'level' => 'ERROR',
                'message' => $matches[3],
                'ip' => 'N/A',
                'url' => 'N/A',
                'status' => 'N/A'
            ];
        })->filter()->values();
    }

    private function filterLogs($log, $query)
    {
        return str_contains(strtolower($log->timestamp ?? ''), $query) ||
            str_contains(strtolower($log->message ?? ''), $query) ||
            str_contains(strtolower($log->url ?? ''), $query) ||
            str_contains(strtolower($log->ip ?? ''), $query) ||
            str_contains(strtolower($log->status ?? ''), $query) ||
            str_contains(strtolower($log->method ?? ''), $query) ||
            str_contains(strtolower($log->user_id ?? ''), $query) ||
            str_contains(strtolower($log->email ?? ''), $query) ||
            str_contains(strtolower($log->first_name ?? ''), $query) ||
            str_contains(strtolower($log->last_name ?? ''), $query);
    }

    public function getLogSummary()
    {
        $activityLogPath = storage_path('logs/activity.log');
        $files = $this->getLogFiles();
        $latestAccessLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'access'));
        $latestLaravelLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'laravel'));

        $summary = [
            'activity' => ['total' => 0, 'logins' => 0, 'logouts' => 0],
            'http_errors' => 0,
            'system_errors' => 0,
        ];

        // Activity Logs
        if (File::exists($activityLogPath)) {
            $logs = array_reverse(explode("\n", File::get($activityLogPath)));
            foreach ($logs as $log) {
                if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                    $jsonStart = strpos($log, '{');
                    $jsonData = $jsonStart !== false ? json_decode(substr($log, $jsonStart), true) : null;

                    //$summary['activity']['total']++;
                    if ($jsonData && isset($jsonData['action'])) {
                        if ($jsonData['action'] === 'login') {
                            $summary['activity']['logins']++;
                            $summary['activity']['total']++;
                        } elseif ($jsonData['action'] === 'logout') {
                            $summary['activity']['logouts']++;
                            $summary['activity']['total']++;
                        }
                    }
                }
            }
        }

        // HTTP Errors
        $httpErrorLogs = $this->parseHttpErrors($latestAccessLog);
        $summary['http_errors'] = $httpErrorLogs->count();

        // System Errors
        $systemErrorLogs = $this->parseSystemErrors($latestLaravelLog);
        $summary['system_errors'] = $systemErrorLogs->count();

        return $summary;
    }

    private function extractActionFromMessage($message)
    {
        return 'Unknown'; // Placeholder; implement actual logic if needed
    }

    private function extractTimestamp($log)
    {
        preg_match('/^\[(.*?)\]/', $log, $matches);
        return $matches[1] ?? 'Unknown';
            str_contains(strtolower($log->email ?? ''), $query);
    }
    
}
