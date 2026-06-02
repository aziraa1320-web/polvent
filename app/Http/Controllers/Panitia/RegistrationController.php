<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Display all registrations with optional filtering by event.
     */
    public function index(Request $request): View
    {
        $events = Event::orderBy('title')->get();

        $query = Registration::with(['user', 'event'])->latest();

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $registrations = $query->paginate(15)->withQueryString();

        return view('panitia.registrations.index', compact('registrations', 'events'));
    }

    /**
     * Approve a pending registration.
     * Uses DB::transaction for data integrity.
     */
    public function approve(Registration $registration): RedirectResponse
    {
        DB::transaction(function () use ($registration) {
            $registration->update(['status' => 'approved']);

            ActivityLogger::log(
                'APPROVE_REGISTRATION',
                "Panitia menyetujui pendaftaran ID {$registration->id}: " .
                "{$registration->user->name} → {$registration->event->title}"
            );
        });

        return back()->with('success', 'Pendaftaran berhasil disetujui.');
    }

    /**
     * Reject a pending registration.
     * Uses DB::transaction for data integrity.
     */
    public function reject(Registration $registration): RedirectResponse
    {
        DB::transaction(function () use ($registration) {
            $registration->update(['status' => 'rejected']);

            ActivityLogger::log(
                'REJECT_REGISTRATION',
                "Panitia menolak pendaftaran ID {$registration->id}: " .
                "{$registration->user->name} → {$registration->event->title}"
            );
        });

        return back()->with('success', 'Pendaftaran berhasil ditolak.');
    }
}
