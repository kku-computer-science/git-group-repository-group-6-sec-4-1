<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class LogUserActivity
{
    /**
     * Create the event listener.
     * @param  mixed  $event
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $ip = request()->ip();
        $timestamp = now();
        
        if ($event instanceof Login) {
            $action = 'logged in';
            $user = $event->user;
        } elseif ($event instanceof Logout) {
            $action = 'logged out';
            $user = $event->user ?? session('last_user'); // ใช้ค่า user จาก session ถ้ามี
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

        Log::channel('activity')->info("User {$userId} ({$email}) has {$action}.", [
            'user_id' => $userId,
            'email' => $email,
            'timestamp' => $timestamp,
            'ip' => $ip,
        ]);
    }
}
