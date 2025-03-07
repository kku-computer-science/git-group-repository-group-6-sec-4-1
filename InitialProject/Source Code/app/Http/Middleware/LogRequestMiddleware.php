<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Log the request
        Log::channel('access')->info('', [
            'ip' => $request->ip(), 
            'port' => $request->getPort(),
            'status' => $response->getStatusCode(),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
        ]);

        return $response;
    }
}
