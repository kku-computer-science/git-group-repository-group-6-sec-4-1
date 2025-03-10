<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use App\Models\Education;
use App\Models\User;
use App\Models\Paper;
use App\Models\CriticalMessage;
use App\Models\Expertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProfileuserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
{
    $users = User::all();
    $user = Auth::user();

    // Initialize summary data with defaults
    $summaryData = [
        'total' => 0,
        'top5' => [],
        'granularity' => 'hourly',
    ];
    $totalUsers = 0;
    $totalPapers = 0;
    $topActiveUsers = [];
    $totalPapersFetched = 0;
    $loginStats = ['success' => 0, 'fail' => 0];
    $usersOnline = 0;
    $notifications = [];

    // Fetch all required data
    $totalUsers = User::count();
    $totalPapers = Paper::count();
    $topActiveUsers = $this->getTopActiveUsers();
    $totalPapersFetched = $this->getTotalPapersFetched();
    $loginStats = $this->getLoginStats();
    $usersOnline = $this->getUsersOnline();

    // Set granularity and date range for HTTP errors and notifications
    $granularity = $request->input('granularity', 'hourly');
    if ($granularity === 'hourly') {
        $startDate = Carbon::today()->startOfDay();
        $endDate = Carbon::today()->endOfDay();
    } elseif ($granularity === 'daily') {
        $startDate = Carbon::today()->subDays(6)->startOfDay();
        $endDate = Carbon::today()->endOfDay();
    } elseif ($granularity === 'weekly') {
        $startDate = Carbon::today()->startOfWeek(); // Monday of this week
        $endDate = Carbon::today()->endOfWeek();     // Sunday of the current week
    } else { // monthly
        $startDate = Carbon::today()->subMonths(11)->startOfMonth();
        $endDate = Carbon::today()->endOfMonth();
    }

    Log::info('Date Range for Weekly', [
        'startDate' => $startDate->toDateTimeString(),
        'endDate' => $endDate->toDateTimeString(),
    ]);

    // Fetch HTTP error stats and merge into summaryData
    $httpErrorStats = $this->getHttpErrorStats($granularity, $startDate, $endDate);
    $summaryData = array_merge($summaryData, $httpErrorStats);
    $summaryData['granularity'] = $granularity;

    // Fetch critical notifications
    $notifications = $this->getCriticalNotifications($startDate, $endDate);

    Log::info('Summary Data', ['summaryData' => $summaryData]);
    Log::info('Notifications', ['notifications' => $notifications]);

    // Activity Logs Processing
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
            ['path' => url('/dashboard'), 'query' => $request->query()]
        );
    }

    return view('dashboards.users.index', [
        'users' => $users,
        'pagedLogs' => $pagedLogs,
        'httpErrorLogs' => null,
        'systemErrorLogs' => null,
        'activeTab' => 'activity',
        'summaryData' => $summaryData,
        'dailyBreakdown' => $httpErrorStats['dailyBreakdown'] ?? [],
        'totalUsers' => $totalUsers,
        'totalPapers' => $totalPapers,
        'topActiveUsers' => $topActiveUsers,
        'totalPapersFetched' => $totalPapersFetched,
        'loginStats' => $loginStats,
        'usersOnline' => $usersOnline,
        'notifications' => $notifications,
        'defaultStartDate' => $startDate->toDateString(), // Pass as a variable
        'defaultEndDate' => $endDate->toDateString(),    // Pass as a variable
    ]);
}

private function getCriticalNotifications($startDate, $endDate)
{
    $notifications = [];
    $activityLogPath = storage_path('logs/activity.log');
    $accessLogPath = storage_path('logs/access.log');

    // Parse activity.log for login attempts
    if (File::exists($activityLogPath)) {
        $logs = array_reverse(explode("\n", File::get($activityLogPath)));
        foreach ($logs as $log) {
            if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                $jsonStart = strpos($log, '{');
                if ($jsonStart !== false) {
                    $jsonStr = substr($log, $jsonStart);
                    $jsonData = json_decode($jsonStr, true);
                    if ($jsonData && isset($jsonData['action']) && in_array($jsonData['action'], ['login', 'login_failed'])) {
                        $timestampStr = $this->extractTimestamp($log);
                        $timestamp = Carbon::parse($timestampStr);
                        if ($timestamp->between($startDate, $endDate)) {
                            $email = $jsonData['email'] ?? 'Unknown';
                            $ip = $jsonData['ip'] ?? 'Unknown';
                            $userAgent = $jsonData['user_agent'] ?? 'Unknown';
                            $action = $jsonData['action'] === 'login_failed' ? 'Failed Login Attempt' : 'Successful Login';
                            $timeAgo = $timestamp->diffForHumans();

                            $message = "$action by email: $email from IP: $ip (User Agent: $userAgent)";
                            $this->storeCriticalMessage($message, $ip, null, $email, $userAgent, $jsonData['action'] === 'login_failed' ? 'high' : 'medium', $timestamp, $timeAgo);
                        }
                    }
                }
            }
        }
    }

    // Parse laravel.log for HTTP errors with URLs and IPs
    if (File::exists($accessLogPath)) {
        $logs = array_reverse(explode("\n", File::get($accessLogPath)));
        $ipFrequency = [];
        foreach ($logs as $log) {
            if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                $jsonStart = strpos($log, '{');
                if ($jsonStart !== false) {
                    $jsonStr = substr($log, $jsonStart);
                    $jsonData = json_decode($jsonStr, true);
                    if ($jsonData && isset($jsonData['status']) && $jsonData['status'] >= 400) {
                        $timestampStr = $this->extractTimestamp($log);
                        $timestamp = Carbon::parse($timestampStr);
                        if ($timestamp->between($startDate, $endDate)) {
                            $ip = $jsonData['ip'] ?? 'Unknown';
                            $url = $jsonData['url'] ?? 'Unknown URL';
                            $userAgent = $jsonData['user_agent'] ?? 'Unknown';
                            $status = $jsonData['status'];
                            $timeAgo = $timestamp->diffForHumans();

                            $ipFrequency[$ip] = ($ipFrequency[$ip] ?? 0) + 1;
                            $isBruteForce = $ipFrequency[$ip] > 5;

                            $message = "HTTP $status Error from IP: $ip requesting $url (User Agent: $userAgent)" . ($isBruteForce ? ' - Possible Brute Force Attack' : '');
                            $this->storeCriticalMessage($message, $ip, $url, null, $userAgent, $status >= 500 ? 'high' : 'medium', $timestamp, $timeAgo);
                        }
                    }
                }
            }
        }
    }

    // Fetch from database
    return CriticalMessage::where('is_dismissed', false)
        ->orderBy('timestamp', 'desc')
        ->limit(5)
        ->get()
        ->toArray();
}

private function storeCriticalMessage($message, $ip, $url, $email, $userAgent, $severity, $timestamp, $timeAgo)
{
    CriticalMessage::updateOrCreate(
        [
            'message' => $message,
            'timestamp' => $timestamp,
        ],
        [
            'ip' => $ip,
            'url' => $url,
            'email' => $email,
            'user_agent' => $userAgent,
            'severity' => $severity,
            'time_ago' => $timeAgo,
        ]
    );
}

public function dismissNotification($id)
{
    try {
        $notification = CriticalMessage::find($id);

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
        }

        $notification->update(['is_dismissed' => true]);

        return response()->json(['success' => true, 'message' => 'Notification dismissed']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}


    public function filterNotifications(Request $request)
    {
        $notifications = CriticalMessage::where('ip', 'like', '%' . $request->ip . '%')
            ->where('url', 'like', '%' . $request->url . '%')
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->get();

        return response()->json($notifications);
    }

private function getHttpErrorStats($granularity, $startDate, $endDate)
{
    $logPath = storage_path('logs/access.log'); // Changed to laravel.log
    $stats = [];
    $dailyBreakdown = [];

    if (File::exists($logPath)) {
        $logs = array_reverse(explode("\n", File::get($logPath)));
        Log::info('Access Log Lines', ['count' => count($logs)]);
        foreach ($logs as $log) {
            if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                Log::info('Processing Log Line', ['log' => $log]);
                $jsonStart = strpos($log, '{');
                if ($jsonStart !== false) {
                    $jsonStr = substr($log, $jsonStart);
                    $jsonData = json_decode($jsonStr, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        Log::error('JSON Decode Error', ['log' => $log, 'error' => json_last_error_msg()]);
                        continue;
                    }
                    if ($jsonData && isset($jsonData['status']) && $jsonData['status'] >= 400) {
                        Log::info('HTTP Error Found', ['status' => $jsonData['status'], 'date' => $this->extractTimestamp($log)]);
                        $timestampStr = $this->extractTimestamp($log);
                        if (!$timestampStr) {
                            Log::warning('Failed to extract timestamp', ['log' => $log]);
                            continue;
                        }
                        try {
                            $timestamp = Carbon::parse($timestampStr);
                            Log::info('Parsed Timestamp', ['timestamp' => $timestamp->toDateTimeString()]);
                        } catch (\Exception $e) {
                            Log::error('Timestamp Parse Error', ['log' => $log, 'error' => $e->getMessage()]);
                            continue;
                        }
                        if ($timestamp->between($startDate, $endDate)) {
                            Log::info('Timestamp in Range', ['timestamp' => $timestamp->toDateTimeString(), 'start' => $startDate->toDateTimeString(), 'end' => $endDate->toDateTimeString()]);
                            $key = $this->getIntervalKey($timestamp, $granularity, $startDate);
                            Log::info('Interval Key', ['key' => $key]);
                            if ($granularity === 'weekly') {
                                $dailyKey = $timestamp->format('Y-m-d');
                                Log::info('Daily Key', ['dailyKey' => $dailyKey]);
                                $dailyBreakdown[$key][$dailyKey][$jsonData['status']] = ($dailyBreakdown[$key][$dailyKey][$jsonData['status']] ?? 0) + 1;
                                $stats[$key][$jsonData['status']] = ($stats[$key][$jsonData['status']] ?? 0) + 1;
                            } else {
                                $stats[$key][$jsonData['status']] = ($stats[$key][$jsonData['status']] ?? 0) + 1;
                            }
                        } else {
                            Log::info('Timestamp Out of Range', ['timestamp' => $timestamp->toDateTimeString(), 'start' => $startDate->toDateTimeString(), 'end' => $endDate->toDateTimeString()]);
                        }
                    }
                }
            }
        }
    } else {
        Log::error('Access Log File Not Found', ['path' => $logPath]);
    }

    $total = array_sum(array_map(function ($errors) {
        return array_sum($errors);
    }, $stats));

    // Sort dailyBreakdown by date keys
    foreach ($dailyBreakdown as $weekKey => &$days) {
        ksort($days); // Sort by date key (e.g., 2025-03-10, 2025-03-11, ...)
    }
    unset($days); // Unset reference to avoid issues

    return [
        'total' => $total,
        'top5' => $stats,
        'dailyBreakdown' => $dailyBreakdown,
        'granularity' => $granularity,
    ];
}

private function getIntervalKey($timestamp, $granularity, $startDate = null)
{
    switch ($granularity) {
        case 'hourly':
        case 'daily':
            return $timestamp->format('Y-m-d H:00:00');
        case 'weekly':
            // Use the $startDate to ensure all logs in the range use the same week key
            return 'Week ' . $startDate->weekOfYear . ' (' . $startDate->format('Y-m-d') . ')';
        case 'monthly':
            return $timestamp->format('Y-m-d');
        default:
            return $timestamp->format('Y-m-d H:00:00');
    }
}

    protected function getTotalPapersFetched()
    {
        $logPath = storage_path('logs/activity.log');
        if (!File::exists($logPath)) {
            return 0;
        }

        $logs = array_reverse(explode("\n", File::get($logPath)));
        $totalFetched = 0;

        foreach ($logs as $log) {
            if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                $jsonStart = strpos($log, '{');
                $jsonData = $jsonStart !== false ? json_decode(substr($log, $jsonStart), true) : null;

                if ($jsonData && isset($jsonData['action']) && $jsonData['action'] === 'call_paper') {
                    $totalFetched += 1;
                }
            }
        }

        return $totalFetched;
    }

    protected function getTopActiveUsers()
    {
        $logPath = storage_path('logs/activity.log');
        if (!File::exists($logPath)) {
            return [];
        }

        $logs = array_reverse(explode("\n", File::get($logPath)));
        $userActivityCount = [];
        $userEmails = User::pluck('email', 'id')->toArray();

        foreach ($logs as $log) {
            if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                $jsonStart = strpos($log, '{');
                $jsonData = $jsonStart !== false ? json_decode(substr($log, $jsonStart), true) : null;

                if ($jsonData && isset($jsonData['user_id']) && $jsonData['user_id'] !== 'Unknown') {
                    $userId = $jsonData['user_id'];
                    $userActivityCount[$userId] = ($userActivityCount[$userId] ?? 0) + 1;
                }
            }
        }

        arsort($userActivityCount);
        $top10 = array_slice($userActivityCount, 0, 10, true);

        $result = [];
        foreach ($top10 as $userId => $count) {
            $result[] = [
                'user_id' => $userId,
                'email' => $userEmails[$userId] ?? 'Unknown',
                'total_activity' => $count,
            ];
        }

        return $result;
    }

    public function userActivityDetail(Request $request, $userId)
    {
        $logPath = storage_path('logs/activity.log');
        $user = User::findOrFail($userId);
        $activities = [];

        if (File::exists($logPath)) {
            $logs = array_reverse(explode("\n", File::get($logPath)));
            foreach ($logs as $log) {
                if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                    $jsonStart = strpos($log, '{');
                    $jsonData = $jsonStart !== false ? json_decode(substr($log, $jsonStart), true) : null;

                    if ($jsonData && isset($jsonData['user_id']) && $jsonData['user_id'] == $userId) {
                        $timestamp = $jsonData['timestamp'] ?? substr($log, 1, 19);
                        $action = $jsonData['action'] ?? 'Unknown';

                        if (is_array($timestamp)) $timestamp = json_encode($timestamp);
                        if (is_array($action)) $action = json_encode($action);

                        $activities[] = [
                            'timestamp' => $timestamp,
                            'action' => $action,
                            'details' => $jsonData['details'] ?? [],
                        ];
                    }
                }
            }
        }

        return view('dashboards.users.activity_detail', [
            'user' => $user,
            'activities' => $activities,
        ]);
    }

    public function httpLogs(Request $request)
    {
        $users = User::all();
        $user = Auth::user();

        $files = $this->getLogFiles();
        $latestAccessLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'access'));

        $httpSearch = $request->query('http_search');
        $httpErrorLogs = $this->parseHttpErrors($latestAccessLog);
        if ($httpSearch) {
            $httpErrorLogs = $httpErrorLogs->filter(fn($log) => $this->filterLogs($log, strtolower($httpSearch)))->values();
        }
        $httpErrorLogs = $httpErrorLogs->take(10);

        return view('dashboards.users.index', [
            'users' => $users,
            'pagedLogs' => null,
            'httpErrorLogs' => $httpErrorLogs,
            'systemErrorLogs' => null,
            'activeTab' => 'http',
        ]);
    }

    public function systemLogs(Request $request)
    {
        $users = User::all();
        $user = Auth::user();

        $files = $this->getLogFiles();
        $latestLaravelLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'laravel'));

        $systemSearch = $request->query('system_search');
        $systemErrorLogs = $this->parseSystemErrors($latestLaravelLog);
        if ($systemSearch) {
            $systemErrorLogs = $systemErrorLogs->filter(fn($log) => $this->filterLogs($log, strtolower($systemSearch)))->values();
        }
        $systemErrorLogs = $systemErrorLogs->take(10);

        return view('dashboards.users.index', [
            'users' => $users,
            'pagedLogs' => null,
            'httpErrorLogs' => null,
            'systemErrorLogs' => $systemErrorLogs,
            'activeTab' => 'system',
        ]);
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

        return collect($rawLog)->map(function ($line) {
            $pattern = '/\[(.*?)\] .*?"ip":"([\d\.]+)".*?"status":(\d+).*?"method":"(\w+)".*?"url":"([^"]+)"/';
            if (!preg_match($pattern, $line, $matches)) return null;

            if ((int)$matches[3] >= 400) {
                return (object) [
                    'timestamp' => $matches[1],
                    'ip' => $matches[2],
                    'status' => $matches[3],
                    'method' => $matches[4],
                    'url' => $matches[5],
                    'message' => "HTTP {$matches[3]} - {$matches[4]} Request"
                ];
            }
            return null;
        })->filter()->values();
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
            str_contains(strtolower($log->method ?? ''), $query);
    }

    public function profile()
    {
        return view('dashboards.users.profile');
    }

    public function settings()
    {
        return view('dashboards.users.settings');
    }

    public function updateInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname_en' => 'required',
            'lname_en' => 'required',
            'fname_th' => 'required',
            'lname_th' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $id = Auth::user()->id;
            $user = User::find($id);

            if ($request->title_name_en == "Mr.") {
                $title_name_th = 'นาย';
            } elseif ($request->title_name_en == "Miss") {
                $title_name_th = 'นางสาว';
            } elseif ($request->title_name_en == "Mrs.") {
                $title_name_th = 'นาง';
            }
            $pos_eng = '';
            $pos_thai = '';
            $doctoral = null;
            if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('student')) {
                $request->academic_ranks_en = null;
                $request->academic_ranks_th = null;
                $pos_eng = null;
                $pos_thai = null;
            } else {
                if ($request->academic_ranks_en == "Professor") {
                    $pos_en = 'Prof.';
                    $pos_th = 'ศ.';
                } elseif ($request->academic_ranks_en == "Associate Professo") {
                    $pos_en = 'Assoc. Prof.';
                    $pos_th = 'รศ.';
                } elseif ($request->academic_ranks_en == "Assistant Professor") {
                    $pos_en = 'Asst. Prof.';
                    $pos_th = 'ผศ.';
                } elseif ($request->academic_ranks_en == "Lecturer") {
                    $pos_en = 'Lecturer';
                    $pos_th = 'อ.';
                }
                if ($request->has('pos')) {
                    $pos_eng = $pos_en;
                    $pos_thai = $pos_th;
                } else {
                    if ($pos_en == "Lecturer") {
                        $pos_eng = $pos_en;
                        $pos_thai = $pos_th . 'ดร.';
                        $doctoral = 'Ph.D.';
                    } else {
                        $pos_eng = $pos_en . ' Dr.';
                        $pos_thai = $pos_th . 'ดร.';
                        $doctoral = 'Ph.D.';
                    }
                }
            }

            $before = $user->only(['fname_en', 'lname_en', 'email', 'title_name_en', 'academic_ranks_en', 'position_en', 'title_name_th', 'doctoral_degree', 'fname_th', 'lname_th']);
            $query = $user->update([
                'fname_en' => $request->fname_en,
                'lname_en' => $request->lname_en,
                'fname_th' => $request->fname_th,
                'lname_th' => $request->lname_th,
                'email' => $request->email,
                'academic_ranks_en' => $request->academic_ranks_en,
                'academic_ranks_th' => $request->academic_ranks_th,
                'position_en' => $pos_eng,
                'position_th' => $pos_thai,
                'title_name_en' => $request->title_name_en,
                'title_name_th' => $title_name_th,
                'doctoral_degree' => $doctoral,
            ]);

            if (!$query) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            } else {
                $after = $user->only(['fname_en', 'lname_en', 'email', 'title_name_en', 'academic_ranks_en', 'position_en', 'title_name_th', 'doctoral_degree', 'fname_th', 'lname_th']);
                $excludedFields = [];

                $changes = [];
                foreach ($before as $key => $value) {
                    if (!in_array($key, $excludedFields) && isset($after[$key]) && $this->compareValues($value, $after[$key])) {
                        $changes['before'][$key] = $value;
                        $changes['after'][$key] = $after[$key];
                    }
                }
                if (!empty($changes)) {
                    event(new UserActionEvent(
                        Auth::user(),
                        'update',
                        ['target' => 'profile', 'changes' => $changes]
                    ));
                }
                return response()->json(['status' => 1, 'msg' => 'success']);
            }
        }
    }

    private function compareValues($value1, $value2)
    {
        if (is_string($value1) && is_string($value2)) {
            return mb_strtolower(trim($value1), 'UTF-8') !== mb_strtolower(trim($value2), 'UTF-8');
        }
        return $value1 !== $value2;
    }

    public function updatePicture(Request $request)
    {
        $path = 'images/imag_user/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        } else {
            $user = User::find(Auth::user()->id);
            $oldPicture = $user->picture;

            if ($oldPicture != '' && File::exists(public_path($path . $oldPicture))) {
                File::delete(public_path($path . $oldPicture));
                event(new UserActionEvent(
                    Auth::user(),
                    'delete',
                    ['target' => 'old_picture', 'filename' => $oldPicture]
                ));
            }

            $before = ['picture' => $oldPicture];
            $update = $user->update(['picture' => $new_name]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.']);
            } else {
                $after = ['picture' => $new_name];
                $excludedFields = [];
                $changes = [];
                foreach ($before as $key => $value) {
                    if (!in_array($key, $excludedFields) && $this->compareValues($value, $after[$key] ?? null)) {
                        $changes['before'][$key] = $value;
                        $changes['after'][$key] = $after[$key];
                    }
                }
                if (!empty($changes)) {
                    event(new UserActionEvent(
                        Auth::user(),
                        'update',
                        ['target' => 'picture', 'changes' => $changes]
                    ));
                }
                return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpassword' => 'required|min:8|max:30',
            'cnewpassword' => 'required|same:newpassword'
        ], [
            'oldpassword.required' => 'Enter your current password',
            'oldpassword.min' => 'Old password must have at least 8 characters',
            'oldpassword.max' => 'Old password must not be greater than 30 characters',
            'newpassword.required' => 'Enter new password',
            'newpassword.min' => 'New password must have at least 8 characters',
            'newpassword.max' => 'New password must not be greater than 30 characters',
            'cnewpassword.required' => 'Re-enter your new password',
            'cnewpassword.same' => 'New password and Confirm new password must match'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $user = User::find(Auth::user()->id);
            $update = $user->update(['password' => Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            } else {
                event(new UserActionEvent(
                    Auth::user(),
                    'update',
                    ['target' => 'password', 'message' => 'Password has been changed']
                ));
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }

    public function logs(Request $request)
    {
        $logPath = storage_path('logs/activity.log');
        $userFilter = $request->query('user_id');
        $search = $request->query('search');

        if (!File::exists($logPath)) {
            return view('logs.index', ['pagedLogs' => null, 'users' => User::all()]);
        }

        $logs = array_reverse(explode("\n", File::get($logPath)));
        $parsedLogs = [];
        $users = User::all()->keyBy('id');

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
                $user = $users->get($userId);

                if ($userFilter && $userId != $userFilter) {
                    continue;
                }
                if ($search && !str_contains(strtolower($log), strtolower($search))) {
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

        return view('logs.index', [
            'pagedLogs' => $pagedLogs,
            'users' => User::all(),
        ]);
    }

    private function extractActionFromMessage($message)
    {
        if (preg_match('/has (login|logout)/i', $message, $matches)) {
            return strtolower($matches[1]);
        }
        return 'Unknown';
    }

    private function extractTimestamp($logLine)
    {
        if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/', $logLine, $matches)) {
            return $matches[1];
        }
        return null;
    }

    protected function getLoginStats()
    {
        $logPath = storage_path('logs/activity.log');
        $logPath1 = storage_path('logs/access.log');
        $stats = ['success' => 0, 'fail' => 0];
        $seenEntries = [];

        if (!File::exists($logPath)) {
            Log::warning('activity.log file not found');
            $logs = [];
        } else {
            $logs = array_reverse(explode("\n", File::get($logPath)));
        }

        if (!File::exists($logPath1)) {
            Log::warning('access.log file not found');
            $logs1 = [];
        } else {
            $logs1 = array_reverse(explode("\n", File::get($logPath1)));
        }

        foreach ($logs as $log) {
            if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                $jsonStart = strpos($log, '{');
                if ($jsonStart === false) {
                    Log::warning('No JSON found in activity.log entry', ['log' => $log]);
                    continue;
                }

                $jsonString = substr($log, $jsonStart);
                $jsonData = json_decode($jsonString, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning('Failed to parse JSON in activity.log', ['log' => $log, 'error' => json_last_error_msg()]);
                    continue;
                }

                if ($jsonData && isset($jsonData['action']) && $jsonData['action'] === 'login') {
                    preg_match('/^\[(.*?)\]/', $log, $matches);
                    $timestamp = $matches[1] ?? '';
                    $key = $timestamp . '-' . ($jsonData['url'] ?? '');

                    if (!isset($seenEntries[$key])) {
                        $stats['success']++;
                        $seenEntries[$key] = true;
                    }
                }
            }
        }

        foreach ($logs1 as $log) {
            if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                $jsonStart = strpos($log, '{');
                if ($jsonStart === false) {
                    Log::warning('No JSON found in access.log entry', ['log' => $log]);
                    continue;
                }

                $jsonString = substr($log, $jsonStart);
                $jsonData = json_decode($jsonString, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning('Failed to parse JSON in access.log', ['log' => $log, 'error' => json_last_error_msg()]);
                    continue;
                }

                if ($jsonData && isset($jsonData['status']) && $jsonData['status'] === 401) {
                    preg_match('/^\[(.*?)\]/', $log, $matches);
                    $timestamp = $matches[1] ?? '';
                    $key = $timestamp . '-' . ($jsonData['url'] ?? '');

                    if (!isset($seenEntries[$key])) {
                        $stats['fail']++;
                        $seenEntries[$key] = true;
                    }
                }
            }
        }

        Log::info('Login stats calculated', ['stats' => $stats]);
        return $stats;
    }

    protected function getUsersOnline()
    {
        $users = User::where('last_activity', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->count();
        return Cache::remember('users_online', 60, function () use ($users) {
            return $users;
        });
    }
}
