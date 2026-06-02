<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard with system statistics.
     */
    public function index()
    {
        $stats = [
            'total_events'        => Event::count(),
            'total_users'         => User::where('role', 'mahasiswa')->count(),
            'total_registrations' => Registration::count(),
            'pending_registrations' => Registration::where('status', 'pending')->count(),
            'upcoming_events'     => Event::upcoming()->count(),
            'total_panitia'       => User::where('role', 'panitia')->count(),
        ];

        $recentEvents = Event::with('creator')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentEvents'));
    }
}
