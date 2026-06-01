<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'ip_address',
        'user_agent'
    ];

    /**
     * User yang melakukan aktivitas
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}