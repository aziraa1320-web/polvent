<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;

class DashboardController extends Controller
{
    /**
     * Show mahasiswa dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        $myRegistrations = Registration::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        $stats = [
            'total_registered' => Registration::where('user_id', $user->id)->count(),
            'approved'         => Registration::where('user_id', $user->id)->where('status', 'approved')->count(),
            'pending'          => Registration::where('user_id', $user->id)->where('status', 'pending')->count(),
            'upcoming_events'  => Event::upcoming()->count(),
        ];

        $upcomingEvents = Event::upcoming()->limit(6)->get();

        return view('mahasiswa.dashboard', compact('stats', 'myRegistrations', 'upcomingEvents'));
    }
}
