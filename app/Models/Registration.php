<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'status'
    ];

    /**
     * Mahasiswa yang mendaftar
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Event yang didaftarkan
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}