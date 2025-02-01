<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = false;

    protected $dates = [
        'created_at_time',
        'contracted_at',
        'deadline'
    ];

    protected $casts = [
        'created_at_time' => 'datetime',
        'contracted_at' => 'datetime',
        'deadline' => 'datetime'
    ];

}
