<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';

    protected $fillable = [
        'ip_address',
        'user_agent',
        'visited_date',
        'last_activity',
    ];

    protected $casts = [
        'visited_date' => 'date',
        'last_activity' => 'datetime',
    ];
}
