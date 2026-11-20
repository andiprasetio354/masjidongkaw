<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerSchedule extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];
}
