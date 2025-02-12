<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SplFileInfo;
use File;

class LogsController extends Controller
{
    public $perPage = 500;

    public function index()
    { 

        $files = $this->getLogfiles();

        return view('logs.index')->withFiles($files)->withLog([]);
    }

    public function show(Request $request, $index)
    {
        
        $files = $this->getLogfiles();
        
        $log = collect(file($files[$index]->getPathname(), FILE_IGNORE_NEW_LINES));
        
        $page = intval($request->get('page',1));
        
        $paginator['page'] = $page;
        $paginator['total'] = intval(floor($log->count() / $this->perPage))+1;

        $log=$log->slice(($page-1) * $this->perPage, $this->perPage);

        return view('logs.index')
            ->withFiles($files)
            ->withLog($log)
            ->withP($paginator)
            ->withIndex($index);
        
    }

    protected function getLogFiles()
    {
        $directory = storage_path('logs');

        $logFiles = collect(File::allFiles($directory))
            ->sortByDesc(function (SplFileInfo $file) {
                return $file->getMTime();
            });

        return $logFiles;
    }

}