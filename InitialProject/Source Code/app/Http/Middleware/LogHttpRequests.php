<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogHttpRequests
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // บันทึก Logs เฉพาะ HTTP Errors (status >= 400)
        if ($response->status() >= 400) {
            $user = Auth::user();
            Log::channel('access')->info('HTTP Request Error', [
                'ip' => $request->ip(),
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'status' => $response->status(),
                'user_id' => $user ? $user->id : null,
                'email' => $user ? $user->email : 'Guest',
                'first_name' => $user ? $user->fname_en : null,
                'last_name' => $user ? $user->lname_en : null,
                'timestamp' => now()->toDateTimeString(),
            ]);
        }

        return $response;
    }
}