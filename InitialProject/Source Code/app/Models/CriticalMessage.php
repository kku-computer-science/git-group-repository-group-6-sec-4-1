<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriticalMessage extends Model
{
    protected $fillable = [
        'message', 'ip', 'url', 'email', 'user_agent', 'severity', 'timestamp', 'time_ago', 'is_dismissed', 'count', 'action_type'
    ];

    protected $casts = [
        'is_dismissed' => 'boolean',
        'timestamp' => 'datetime',
    ];
}