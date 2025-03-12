<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => Auth::id(),
            'email' => Auth::user() ? Auth::user()->email : null,
            'timestamp' => now()->toDateTimeString(),
        ]);

        return $response;
    }
}
