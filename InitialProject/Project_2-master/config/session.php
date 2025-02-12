<?php

use Illuminate\Support\Str;

return [

    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path('framework/sessions'),

    'connection' => env('SESSION_CONNECTION', null),

    'table' => 'sessions',

    'store' => env('SESSION_STORE', null),

    'lottery' => [2, 100],

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    'path' => '/',

   'domain' => env('SESSION_DOMAIN'),
'secure' => env('SESSION_SECURE_COOKIE', false),

    
    'driver' => env('SESSION_DRIVER', 'file'),
'lifetime' => env('SESSION_LIFETIME', 120),
'cookie' => env('SESSION_COOKIE', 'laravel_session'),
'domain' => env('SESSION_DOMAIN', null),
'secure' => env('SESSION_SECURE_COOKIE', false), // Set to true if using HTTPS
'http_only' => true,
'same_site' => 'lax',

];
