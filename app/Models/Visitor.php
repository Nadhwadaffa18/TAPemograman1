<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_visited',
        'referrer',
        'country',
        'city',
        'device',
        'browser',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}
