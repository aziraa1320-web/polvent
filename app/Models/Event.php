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
        'location',
        'poster',
        'created_by',
        'id_panitia',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'event_date' => 'datetime',
        'quota'      => 'integer',
    ];

    /**
     * Relation: creator (admin user who originally created).
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relation: panitia who owns/manages this event.
     */
    public function panitia()
    {
        return $this->belongsTo(User::class, 'id_panitia');
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
     * Get fill percentage for quota progress bar.
     */
    public function getQuotaPercentageAttribute(): int
    {
        if ($this->quota === 0) return 0;
        $approved = $this->approvedRegistrations()->count();
        return min(100, (int) round(($approved / $this->quota) * 100));
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

    /**
     * Scope: events owned by a specific panitia.
     */
    public function scopeOwnedBy($query, int $userId)
    {
        return $query->where('id_panitia', $userId);
    }
}
