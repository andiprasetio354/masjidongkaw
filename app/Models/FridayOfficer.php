<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FridayOfficer extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
        'is_badal' => 'boolean',
    ];
}
