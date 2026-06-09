@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')
@section('page-title', 'Dashboard')
@section('page-breadcrumb', 'Mahasiswa / <span>Dashboard</span>')

@section('content')

{{-- ===== WELCOME BANNER ===== --}}
<div style="background:linear-gradient(135deg,#0056B3,#003d80);border-radius:1.125rem;padding:1.75rem 2rem;margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
    <div>
        <div style="color:rgba(255,255,255,0.75);font-size:0.8rem;margin-bottom:0.3rem;">Selamat datang kembali 👋</div>
        <div style="color:white;font-size:1.5rem;font-weight:800;margin-bottom:0.25rem;">{{ auth()->user()->name }}</div>
        @if(auth()->user()->nim)
            <div style="color:rgba(255,255,255,0.65);font-size:0.825rem;">NIM: {{ auth()->user()->nim }}</div>
        @endif
    </div>
    <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
        <a href="{{ route('mahasiswa.events.index') }}" class="btn" style="background:white;color:#0056B3;font-size:0.845rem;font-weight:700;">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Lihat Event
        </a>
        <a href="{{ route('mahasiswa.history') }}" class="btn" style="background:rgba(255,255,255,0.15);color:white;border:1.5px solid rgba(255,255,255,0.3);font-size:0.845rem;">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Riwayat Saya
        </a>
    </div>
</div>

{{-- ===== STAT CARDS ===== --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:1.125rem;margin-bottom:1.75rem;">
    <div class="stat-card" style="border-left:4px solid #0056B3;">
        <div class="stat-icon" style="background:#e8f0fe;">
            <svg style="width:22px;height:22px;color:#0056B3;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <div class="stat-value">{{ $stats['total_registered'] }}</div>
        <div class="stat-label">Total Pendaftaran</div>
    </div>

    <div class="stat-card" style="border-left:4px solid #059669;">
        <div class="stat-icon" style="background:#d1fae5;">
            <svg style="width:22px;height:22px;color:#059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['approved'] }}</div>
        <div class="stat-label">Disetujui</div>
    </div>

    <div class="stat-card" style="border-left:4px solid #d97706;">
        <div class="stat-icon" style="background:#fef3c7;">
            <svg style="width:22px;height:22px;color:#d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['pending'] }}</div>
        <div class="stat-label">Menunggu Verifikasi</div>
    </div>

    <div class="stat-card" style="border-left:4px solid #7c3aed;">
        <div class="stat-icon" style="background:#ede9fe;">
            <svg style="width:22px;height:22px;color:#7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['upcoming_events'] }}</div>
        <div class="stat-label">Event Mendatang</div>
    </div>
</div>

{{-- ===== MAIN GRID ===== --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">

    {{-- Event Mendatang --}}
    <div style="grid-column:1/-1;">
        <div class="table-wrapper">
            <div class="table-header">
                <h3>🎯 Event Mendatang</h3>
                <a href="{{ route('mahasiswa.events.index') }}" class="btn btn-primary btn-sm">Lihat Semua Event</a>
            </div>
            @if($upcomingEvents->count())
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.25rem;padding:1.25rem;">
                    @foreach($upcomingEvents as $event)
                        <div class="event-card">
                            <div class="event-card-img">
                                @if($event->poster)
                                    <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}">
                                @else
                                    <span>🎓</span>
                                @endif
                            </div>
                            <div class="event-card-body">
                                <div class="event-date-badge">📅 {{ $event->event_date->format('d M Y') }}</div>
                                <h3>{{ $event->title }}</h3>
                                <p>{{ $event->description }}</p>
                                <div style="margin-bottom:0.75rem;">
                                    <div style="display:flex;justify-content:space-between;font-size:0.72rem;color:#64748b;margin-bottom:0.3rem;">
                                        <span>Kuota tersisa</span>
                                        <span>{{ $event->quota }} orang</span>
                                    </div>
                                </div>
                                <div class="event-card-footer">
                                    <div class="quota-text">{{ $event->quota }} slot tersedia</div>
                                    <a href="{{ route('mahasiswa.events.show', $event) }}" class="btn btn-primary btn-sm">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📅</div>
                    <h3>Belum ada event mendatang</h3>
                    <p>Pantau terus, panitia sedang menyiapkan event seru untuk Anda!</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Riwayat Pendaftaran --}}
    <div style="grid-column:1/-1;">
        <div class="table-wrapper">
            <div class="table-header">
                <h3>📋 Riwayat Pendaftaran Terbaru</h3>
                <a href="{{ route('mahasiswa.history') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
            </div>
            @if($myRegistrations->count())
                <table>
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Tanggal Event</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($myRegistrations as $reg)
                            <tr>
                                <td>
                                    <div style="font-weight:600;color:#1e293b;">{{ $reg->event->title }}</div>
                                </td>
                                <td style="color:#64748b;font-size:0.82rem;">
                                    {{ $reg->event->event_date->format('d M Y') }}
                                </td>
                                <td style="color:#64748b;font-size:0.82rem;">
                                    {{ $reg->created_at->format('d M Y') }}
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $reg->status }}">
                                        {{ $reg->status === 'pending' ? 'Menunggu' : ($reg->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('mahasiswa.events.show', $reg->event) }}" class="btn btn-secondary btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state" style="padding:2.5rem;">
                    <div class="empty-state-icon">📝</div>
                    <h3>Belum ada pendaftaran</h3>
                    <p>Mulai daftar event pertama Anda!</p>
                    <a href="{{ route('mahasiswa.events.index') }}" class="btn btn-primary btn-sm" style="margin-top:1rem;">Jelajahi Event</a>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
