<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display events owned by the authenticated panitia.
     */
    public function index(): View
    {
        $events = Event::ownedBy(auth()->id())
            ->withCount(['registrations', 'approvedRegistrations'])
            ->latest()
            ->paginate(10);

        return view('panitia.events.index', compact('events'));
    }

    /**
     * Show form to create a new event.
     */
    public function create(): View
    {
        return view('panitia.events.create');
    }

    /**
     * Store a newly created event owned by this panitia.
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $data                = $request->validated();
            $data['created_by']  = auth()->id();
            $data['id_panitia']  = auth()->id();

            if ($request->hasFile('poster')) {
                $data['poster'] = $request->file('poster')->store('posters', 'public');
            }

            $event = Event::create($data);

            ActivityLogger::log(
                'CREATE_EVENT',
                "Panitia membuat event baru: [{$event->id}] {$event->title}"
            );
        });

        return redirect()->route('panitia.events.index')
            ->with('success', 'Event berhasil dibuat!');
    }

    /**
     * Show a specific event (must be owned by this panitia).
     */
    public function show(Event $event): View
    {
        $this->authorizeOwnership($event);

        $event->loadCount(['registrations', 'approvedRegistrations']);
        $registrations = $event->registrations()->with('user')->latest()->paginate(15);

        return view('panitia.events.show', compact('event', 'registrations'));
    }

    /**
     * Show edit form for a specific event.
     */
    public function edit(Event $event): View
    {
        $this->authorizeOwnership($event);

        return view('panitia.events.edit', compact('event'));
    }

    /**
     * Update a specific event owned by this panitia.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $this->authorizeOwnership($event);

        DB::transaction(function () use ($request, $event) {
            $data = $request->validated();

            if ($request->hasFile('poster')) {
                if ($event->poster) {
                    Storage::disk('public')->delete($event->poster);
                }
                $data['poster'] = $request->file('poster')->store('posters', 'public');
            }

            $event->update($data);

            ActivityLogger::log(
                'UPDATE_EVENT',
                "Panitia mengupdate event: [{$event->id}] {$event->title}"
            );
        });

        return redirect()->route('panitia.events.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Delete a specific event owned by this panitia.
     */
    public function destroy(Event $event): RedirectResponse
    {
        $this->authorizeOwnership($event);

        DB::transaction(function () use ($event) {
            $title = $event->title;
            $id    = $event->id;

            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }

            $event->delete();

            ActivityLogger::log(
                'DELETE_EVENT',
                "Panitia menghapus event: [{$id}] {$title}"
            );
        });

        return redirect()->route('panitia.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }

    /**
     * Ensure the authenticated panitia owns this event.
     */
    private function authorizeOwnership(Event $event): void
    {
        if ($event->id_panitia !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke event ini.');
        }
    }
}
