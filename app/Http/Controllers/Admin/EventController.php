<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index(): View
    {
        $events = Event::with('creator')
            ->withCount('registrations')
            ->latest()
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create(): View
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event.
     * Uses DB::transaction to ensure data integrity.
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['created_by'] = auth()->id();

            // Handle poster upload
            if ($request->hasFile('poster')) {
                $data['poster'] = $request->file('poster')->store('posters', 'public');
            }

            $event = Event::create($data);

            ActivityLogger::log(
                'CREATE_EVENT',
                "Admin membuat event baru: [{$event->id}] {$event->title}"
            );
        });

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dibuat!');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event): View
    {
        $event->loadCount(['registrations', 'approvedRegistrations']);
        $registrations = $event->registrations()->with('user')->latest()->paginate(15);

        return view('admin.events.show', compact('event', 'registrations'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event.
     * Uses DB::transaction to ensure data integrity.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        DB::transaction(function () use ($request, $event) {
            $data = $request->validated();

            // Handle poster upload — delete old if exists
            if ($request->hasFile('poster')) {
                if ($event->poster) {
                    Storage::disk('public')->delete($event->poster);
                }
                $data['poster'] = $request->file('poster')->store('posters', 'public');
            }

            $event->update($data);

            ActivityLogger::log(
                'UPDATE_EVENT',
                "Admin mengupdate event: [{$event->id}] {$event->title}"
            );
        });

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified event.
     * Uses DB::transaction to ensure data integrity.
     */
    public function destroy(Event $event): RedirectResponse
    {
        DB::transaction(function () use ($event) {
            $title = $event->title;
            $id    = $event->id;

            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }

            $event->delete();

            ActivityLogger::log(
                'DELETE_EVENT',
                "Admin menghapus event: [{$id}] {$title}"
            );
        });

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }
}
