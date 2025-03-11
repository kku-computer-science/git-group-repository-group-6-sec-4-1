<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriticalMessage extends Model
{
    protected $fillable = [
        'unique_key', 'message', 'ip', 'url', 'email', 'user_agent', 'severity', 'timestamp', 'time_ago', 'count', 'is_dismissed'
    ];

    protected $casts = [
        'is_dismissed' => 'boolean',
        'timestamp' => 'datetime',
    ];
}