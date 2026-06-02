<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterEventRequest;
use App\Models\Event;
use App\Models\Registration;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display all upcoming events for mahasiswa.
     */
    public function index(): View
    {
        $events = Event::upcoming()
            ->withCount(['registrations', 'approvedRegistrations'])
            ->paginate(9);

        // Get IDs of events the current user has registered for
        $registeredEventIds = Registration::where('user_id', auth()->id())
            ->pluck('event_id')
            ->toArray();

        return view('mahasiswa.events.index', compact('events', 'registeredEventIds'));
    }

    /**
     * Display a specific event detail.
     */
    public function show(Event $event): View
    {
        $event->loadCount(['registrations', 'approvedRegistrations']);

        $userRegistration = Registration::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->first();

        return view('mahasiswa.events.show', compact('event', 'userRegistration'));
    }

    /**
     * Register current user to an event.
     * Uses lockForUpdate() to prevent race condition when quota is limited.
     */
    public function register(RegisterEventRequest $request): RedirectResponse
    {
        $result = DB::transaction(function () use ($request) {
            // Lock the event row to prevent race conditions
            $event = Event::lockForUpdate()->findOrFail($request->event_id);

            // Check if user already registered
            $existing = Registration::where('user_id', auth()->id())
                ->where('event_id', $event->id)
                ->exists();

            if ($existing) {
                return 'already_registered';
            }

            // Check quota using approved count inside transaction
            $approvedCount = Registration::where('event_id', $event->id)
                ->where('status', 'approved')
                ->count();

            if ($approvedCount >= $event->quota) {
                return 'quota_full';
            }

            $registration = Registration::create([
                'user_id'  => auth()->id(),
                'event_id' => $event->id,
                'status'   => 'pending',
            ]);

            ActivityLogger::log(
                'REGISTER_EVENT',
                "Mahasiswa mendaftar event: [{$event->id}] {$event->title}"
            );

            return 'success';
        });

        return match ($result) {
            'already_registered' => back()->with('error', 'Anda sudah mendaftar event ini.'),
            'quota_full'         => back()->with('error', 'Kuota event sudah penuh.'),
            default              => back()->with('success', 'Pendaftaran berhasil! Menunggu verifikasi panitia.'),
        };
    }

    /**
     * Display mahasiswa's event registration history.
     */
    public function history(): View
    {
        $registrations = Registration::with('event')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('mahasiswa.history.index', compact('registrations'));
    }
}
