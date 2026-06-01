<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Event;
use App\Models\Registration;
use App\Models\ActivityLog;

#[Fillable([
    'name',
    'email',
    'password',
    'role'
])]
#[Hidden([
    'password',
    'remember_token'
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Event yang dibuat oleh user (Admin/Panitia)
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    /**
     * Pendaftaran event mahasiswa
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Activity log user
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}