<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'notify_on_donation' => 'boolean',
        'notify_daily_recap' => 'boolean',
        'admin_chat_ids' => 'array',
        'last_ping_at' => 'datetime',
    ];
}
