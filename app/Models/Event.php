<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Registration;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'quota',
        'poster',
        'created_by'
    ];

    /**
     * User yang membuat event
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Seluruh pendaftaran pada event
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}