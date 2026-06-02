<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;

class DashboardController extends Controller
{
    /**
     * Show panitia dashboard with participant statistics.
     */
    public function index()
    {
        $stats = [
            'total_registrations' => Registration::count(),
            'pending'             => Registration::where('status', 'pending')->count(),
            'approved'            => Registration::where('status', 'approved')->count(),
            'rejected'            => Registration::where('status', 'rejected')->count(),
            'total_events'        => Event::count(),
        ];

        $recentRegistrations = Registration::with(['user', 'event'])
            ->latest()
            ->limit(10)
            ->get();

        return view('panitia.dashboard', compact('stats', 'recentRegistrations'));
    }
}
