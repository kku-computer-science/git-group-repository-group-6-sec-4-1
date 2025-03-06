<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use App\Events\UserActionEvent;

class LogUserActivity
{
    public function handle($event)
    {
        $ip = request()->ip();
        $timestamp = now();
        $user = null;
        $action = null;
        $details = [];

        if ($event instanceof Login) {
            $action = 'login';
            $user = $event->user;
            $details = ['target' => 'session'];
        } elseif ($event instanceof Logout) {
            $action = 'logout';
            $user = $event->user ?? session('last_user');
            $details = ['target' => 'session'];
        } elseif ($event instanceof UserActionEvent) {
            $action = $event->action; // "insert", "update", "delete"
            $user = $event->user;
            $details = $event->details;
        } else {
            return;
        }

        if (!$user) {
            Log::warning('User activity event triggered but no valid user found.', [
                'event' => get_class($event),
                'ip' => $ip,
                'timestamp' => $timestamp
            ]);
            return;
        }

        $userId = $user->id ?? 'Unknown';
        $email = $user->email ?? 'Unknown';

        Log::channel('activity')->info(json_encode([
            'user_id' => $userId,
            'email' => $email,
            'action' => $action,
            'details' => $details,
            'timestamp' => $timestamp->toDateTimeString(),
            'ip' => $ip,
        ]));
    }
}