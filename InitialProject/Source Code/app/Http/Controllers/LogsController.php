<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Symfony\Component\Finder\SplFileInfo;

class LogsController extends Controller
{
    public $perPage = 500;

    public function index()
    {
        $files = $this->getLogFiles();
        $latestAccessLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'access'));
        $latestLaravelLog = $files->first(fn(SplFileInfo $file) => str_contains($file->getFilename(), 'laravel'));

        return view('logs.index', [
            'httpErrorLogs' => $this->parseHttpErrors($latestAccessLog),
            'systemErrorLogs' => $this->parseSystemErrors($latestLaravelLog),
            'pHttp' => null,
            'pSystem' => null,
            'searchQuery' => null
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

    return collect($rawLog)->map(function ($line) {
        $pattern = '/\[(.*?)\] .*?"ip":"([\d\.]+)".*?"status":(\d+).*?"method":"(\w+)".*?"url":"([^"]+)"/';

        if (!preg_match($pattern, $line, $matches)) return null;

        if ((int)$matches[3] >= 400) { // Filter only HTTP errors (>= 400)
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
}
