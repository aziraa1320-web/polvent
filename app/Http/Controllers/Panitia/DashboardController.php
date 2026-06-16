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
        $panitiaId = auth()->id();

        // Scope Registrations
        $registrationsQuery = Registration::whereHas('event', function ($query) use ($panitiaId) {
            $query->where('id_panitia', $panitiaId);
        });

        $stats = [
            'total_registrations' => (clone $registrationsQuery)->count(),
            'pending'             => (clone $registrationsQuery)->where('status', 'pending')->count(),
            'approved'            => (clone $registrationsQuery)->where('status', 'approved')->count(),
            'rejected'            => (clone $registrationsQuery)->where('status', 'rejected')->count(),
            'total_events'        => Event::where('id_panitia', $panitiaId)->count(),
        ];

        $recentRegistrations = (clone $registrationsQuery)
            ->with(['user', 'event'])
            ->latest()
            ->limit(10)
            ->get();

        return view('panitia.dashboard', compact('stats', 'recentRegistrations'));
    }
}
