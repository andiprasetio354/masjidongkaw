<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'buzzer_active' => 'boolean',
        'tv_display_enabled' => 'boolean',
        'auto_dim_salat' => 'boolean',
    ];
}
