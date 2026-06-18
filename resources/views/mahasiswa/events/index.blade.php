@extends('layouts.app')

@section('title', 'Daftar Event')
@section('page-title', 'Daftar Event')
@section('page-breadcrumb')
    Mahasiswa / <span>Event</span>
@endsection

@section('content')

<div class="page-header">
    <h1>Event Kampus Polbeng</h1>
    <p>Temukan dan daftarkan diri ke event kampus yang menarik minat Anda</p>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:1.375rem;">
    @forelse($events as $event)
        @php
            $isRegistered = in_array($event->id, $registeredEventIds);
            $pct = $event->quota > 0 ? min(100, round(($event->approved_registrations_count / $event->quota) * 100)) : 0;
            $isFull = $event->approved_registrations_count >= $event->quota;
        @endphp
        <div class="event-card">
            <div class="event-card-img">
                @if($event->poster)
                    <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}">
                @else
                    <span>🎓</span>
                @endif
                @if($isFull)
                    <div style="position:absolute;top:0.75rem;right:0.75rem;background:#dc2626;color:white;font-size:0.68rem;font-weight:700;padding:0.25rem 0.6rem;border-radius:9999px;">PENUH</div>
                @elseif($isRegistered)
                    <div style="position:absolute;top:0.75rem;right:0.75rem;background:#059669;color:white;font-size:0.68rem;font-weight:700;padding:0.25rem 0.6rem;border-radius:9999px;">TERDAFTAR</div>
                @endif
            </div>
            <div class="event-card-body">
                <div class="event-date-badge">📅 {{ $event->event_date->format('d M Y, H:i') }} WIB</div>
                <h3>{{ $event->title }}</h3>
                <p>{{ $event->description }}</p>

                <div style="margin-bottom:0.875rem;">
                    <div style="display:flex;justify-content:space-between;font-size:0.72rem;color:#64748b;margin-bottom:0.375rem;">
                        <span>{{ $event->approved_registrations_count }} / {{ $event->quota }} peserta</span>
                        <span>{{ $pct }}% terisi</span>
                    </div>
                    <div class="quota-bar">
                        <div class="quota-bar-fill {{ $isFull ? 'full' : '' }}" style="width:{{ $pct }}%"></div>
                    </div>
                </div>

                <div class="event-card-footer">
                    <a href="{{ route('mahasiswa.events.show', $event) }}" class="btn btn-secondary btn-sm">
                        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Detail
                    </a>

                    @if($isRegistered)
                        <span class="status-badge status-approved">✓ Sudah Daftar</span>
                    @elseif($isFull)
                        <span style="font-size:0.78rem;color:#dc2626;font-weight:600;">Kuota Penuh</span>
                    @else
                        <a href="{{ route('mahasiswa.events.show', $event) }}#btn-daftar-event" class="btn btn-primary btn-sm">
                            <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Daftar
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div style="grid-column:1/-1;">
            <div class="empty-state" style="padding:4rem;">
                <div class="empty-state-icon">📅</div>
                <h3>Belum ada event tersedia</h3>
                <p>Panitia sedang menyiapkan event seru. Pantau terus POLVENT!</p>
            </div>
        </div>
    @endforelse
</div>

@if($events->hasPages())
    <div style="margin-top:1.5rem;">{{ $events->links() }}</div>
@endif

@endsection
