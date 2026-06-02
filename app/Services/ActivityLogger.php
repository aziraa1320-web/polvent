<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    /**
     * Log an activity to the activity_logs table.
     *
     * @param  string       $action      Short action name (e.g. CREATE_EVENT)
     * @param  string|null  $description Longer description of the action
     * @param  int|null     $userId      Override user_id (defaults to authenticated user)
     */
    public static function log(string $action, ?string $description = null, ?int $userId = null): void
    {
        ActivityLog::create([
            'user_id'    => $userId ?? Auth::id(),
            'action'     => strtoupper($action),
            'description'=> $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'created_at' => now(),
        ]);
    }
}
