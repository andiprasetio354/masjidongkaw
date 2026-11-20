<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MosqueProfile extends Model
{
    protected $guarded = [];

    protected $casts = [
        'missions' => 'array',
        'feature_toggles' => 'array',
    ];
}
