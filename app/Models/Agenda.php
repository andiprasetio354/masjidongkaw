<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date_time' => 'datetime',
        'end_time' => 'datetime',
        'is_pinned' => 'boolean',
    ];
}
