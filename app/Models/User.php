<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'title',
        'phone',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isDakwah(): bool
    {
        return $this->role === 'dakwah';
    }

    public function isKeuangan(): bool
    {
        return $this->role === 'keuangan';
    }

    public function canAccessContent(): bool
    {
        return in_array($this->role, ['superadmin', 'dakwah']);
    }

    public function canAccessFinance(): bool
    {
        return in_array($this->role, ['superadmin', 'keuangan']);
    }
}
