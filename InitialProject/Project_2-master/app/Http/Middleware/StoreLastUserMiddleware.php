<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreLastUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            session(['last_user' => Auth::user()]);
        }

        return $next($request);
    }
}
