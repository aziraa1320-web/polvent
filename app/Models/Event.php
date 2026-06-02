<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'quota',
        'poster',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'event_date' => 'datetime',
        'quota'      => 'integer',
    ];

    /**
     * Relation: creator (admin user).
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relation: all registrations for this event.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Relation: approved registrations.
     */
    public function approvedRegistrations()
    {
        return $this->hasMany(Registration::class)->where('status', 'approved');
    }

    /**
     * Get remaining quota for this event.
     */
    public function getRemainingQuotaAttribute(): int
    {
        return $this->quota - $this->approvedRegistrations()->count();
    }

    /**
     * Check if event still has available quota.
     */
    public function hasQuota(): bool
    {
        return $this->remaining_quota > 0;
    }

    /**
     * Scope: upcoming events.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now())->orderBy('event_date');
    }
}
