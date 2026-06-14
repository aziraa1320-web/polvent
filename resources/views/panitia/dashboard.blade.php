@extends('layouts.app')

@section('title', 'Dashboard Panitia')
@section('page-title', 'Dashboard')
@section('page-breadcrumb')
    Panitia / <span>Dashboard</span>
@endsection

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 50%, #3b82f6 100%);
        border-radius: 1.25rem;
        padding: 2rem 2.25rem;
        margin-bottom: 1.75rem;
        position: relative;
        overflow: hidden;
    }
    .welcome-card::before { content:''; position:absolute; top:-50px; right:-50px; width:200px; height:200px; background:rgba(255,255,255,0.06); border-radius:50%; }
    .welcome-card::after  { content:''; position:absolute; bottom:-70px; right:60px; width:260px; height:260px; background:rgba(255,255,255,0.03); border-radius:50%; }
    .welcome-greeting { color:rgba(255,255,255,0.75); font-size:0.875rem; margin-bottom:0.25rem; }
    .welcome-name { color:white; font-size:1.625rem; font-weight:800; margin-bottom:0.2rem; }
    .welcome-sub { color:rgba(255,255,255,0.65); font-size:0.82rem; }
    .btn-white { background:white; color:#1d4ed8; padding:0.6rem 1.25rem; border-radius:0.625rem; font-weight:700; font-size:0.845rem; display:flex; align-items:center; gap:0.4rem; transition:all 0.2s; }
    .btn-white:hover { background:#eff6ff; transform:translateY(-1px); }
    .btn-ghost { background:rgba(255,255,255,0.12); color:white; border:1.5px solid rgba(255,255,255,0.25); padding:0.6rem 1.25rem; border-radius:0.625rem; font-weight:600; font-size:0.845rem; display:flex; align-items:center; gap:0.4rem; transition:all 0.2s; }
    .btn-ghost:hover { background:rgba(255,255,255,0.22); }

    .stats-row { display:grid; grid-template-columns:repeat(5,1fr); gap:1rem; margin-bottom:1.75rem; }
    .stat-modern { background:white; border-radius:1rem; padding:1.25rem; box-shadow:0 1px 4px rgba(0,0,0,0.04); border:1px solid #f1f5f9; display:flex; flex-direction:column; gap:0.75rem; transition:transform 0.2s, box-shadow 0.2s; }
    .stat-modern:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(0,0,0,0.07); }
    .stat-icon-box { width:44px; height:44px; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; }
    .stat-val { font-size:1.75rem; font-weight:800; color:#0f172a; line-height:1; }
    .stat-lbl { font-size:0.78rem; color:#64748b; font-weight:500; }

    .quick-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-bottom:1.75rem; }
    .quick-card { background:white; border-radius:1rem; padding:1.375rem 1.25rem; border:1.5px solid #f1f5f9; text-align:center; text-decoration:none; transition:all 0.25s; box-shadow:0 1px 4px rgba(0,0,0,0.03); }
    .quick-card:hover { border-color:#1d4ed8; background:#eff6ff; transform:translateY(-3px); box-shadow:0 8px 20px rgba(29,78,216,0.1); }
    .quick-icon { width:48px; height:48px; border-radius:0.875rem; display:flex; align-items:center; justify-content:center; margin:0 auto 0.875rem; }
    .quick-label { font-weight:700; font-size:0.875rem; color:#1e293b; }
    .quick-sub { font-size:0.75rem; color:#94a3b8; margin-top:0.2rem; }

    .content-grid { display:grid; grid-template-columns:1fr; gap:1.5rem; }
    .card-section { background:white; border-radius:1rem; border:1px solid #f1f5f9; box-shadow:0 1px 4px rgba(0,0,0,0.03); overflow:hidden; }
    .card-section-header { padding:1.25rem 1.5rem; border-bottom:1px solid #f8fafc; display:flex; align-items:center; justify-content:space-between; }
    .card-section-header h3 { font-size:0.975rem; font-weight:700; color:#1e293b; display:flex; align-items:center; gap:0.5rem; }

    @media (max-width: 900px) {
        .stats-row { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 640px) {
        .stats-row { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush

@section('content')

{{-- WELCOME BANNER --}}
<div class="welcome-card">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1.25rem;position:relative;z-index:2;">
        <div>
            <div class="welcome-greeting">📋 Panel Panitia</div>
            <div class="welcome-name">{{ auth()->user()->name }}</div>
            <div class="welcome-sub">Kelola event dan verifikasi peserta Anda</div>
        </div>
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
            <a href="{{ route('panitia.events.create') }}" class="btn-white">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Event
            </a>
            <a href="{{ route('panitia.registrations.index') }}" class="btn-ghost">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Kelola Peserta
            </a>
        </div>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="stats-row">
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#dbeafe;">
            <svg width="20" height="20" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <div class="stat-val">{{ $stats['total_events'] }}</div>
            <div class="stat-lbl">Event Saya</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#d1fae5;">
            <svg width="20" height="20" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-val">{{ $stats['approved'] }}</div>
            <div class="stat-lbl">Disetujui</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#fef3c7;">
            <svg width="20" height="20" fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-val">{{ $stats['pending'] }}</div>
            <div class="stat-lbl">Perlu Verifikasi</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#fee2e2;">
            <svg width="20" height="20" fill="none" stroke="#dc2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </div>
        <div>
            <div class="stat-val">{{ $stats['rejected'] }}</div>
            <div class="stat-lbl">Ditolak</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#ede9fe;">
            <svg width="20" height="20" fill="none" stroke="#7c3aed" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div>
            <div class="stat-val">{{ $stats['total_registrations'] }}</div>
            <div class="stat-lbl">Total Pendaftar</div>
        </div>
    </div>
</div>

{{-- QUICK ACCESS --}}
<div class="quick-grid">
    <a href="{{ route('panitia.events.create') }}" class="quick-card">
        <div class="quick-icon" style="background:#dbeafe;">
            <svg width="22" height="22" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        </div>
        <div class="quick-label">Buat Event</div>
        <div class="quick-sub">Tambah event baru</div>
    </a>
    <a href="{{ route('panitia.events.index') }}" class="quick-card">
        <div class="quick-icon" style="background:#d1fae5;">
            <svg width="22" height="22" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="quick-label">Kelola Event</div>
        <div class="quick-sub">Lihat event saya</div>
    </a>
    <a href="{{ route('panitia.registrations.index') }}" class="quick-card">
        <div class="quick-icon" style="background:#fef3c7;">
            <svg width="22" height="22" fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="quick-label">Verifikasi Peserta</div>
        <div class="quick-sub">{{ $stats['pending'] }} menunggu</div>
    </a>
</div>

{{-- RECENT REGISTRATIONS --}}
<div class="content-grid">
    <div class="card-section">
        <div class="card-section-header">
            <h3>
                <svg width="18" height="18" fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Peserta Terbaru — Perlu Verifikasi
            </h3>
            <a href="{{ route('panitia.registrations.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
        </div>

        @if($recentRegistrations->count())
            <table>
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Event</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentRegistrations as $reg)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:0.625rem;">
                                    <div style="width:34px;height:34px;background:#dbeafe;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.8rem;color:#1d4ed8;flex-shrink:0;">
                                        {{ strtoupper(substr($reg->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:600;color:#1e293b;font-size:0.875rem;">{{ $reg->user->name }}</div>
                                        @if($reg->user->nim)
                                            <div style="font-size:0.72rem;color:#64748b;">NIM: {{ $reg->user->nim }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:500;color:#374151;font-size:0.845rem;">{{ $reg->event->title }}</div>
                                <div style="font-size:0.72rem;color:#64748b;">{{ $reg->event->event_date->format('d M Y') }}</div>
                            </td>
                            <td style="font-size:0.82rem;color:#64748b;">{{ $reg->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <span class="status-badge status-{{ $reg->status }}">
                                    {{ $reg->status === 'pending' ? 'Menunggu' : ($reg->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                                </span>
                            </td>
                            <td>
                                @if($reg->status === 'pending')
                                    <div style="display:flex;gap:0.4rem;">
                                        <form method="POST" action="{{ route('panitia.registrations.approve', $reg) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm" title="Setujui">✓ Setujui</button>
                                        </form>
                                        <form method="POST" action="{{ route('panitia.registrations.reject', $reg) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Tolak">✗ Tolak</button>
                                        </form>
                                    </div>
                                @else
                                    <span style="font-size:0.78rem;color:#94a3b8;">Sudah diproses</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state" style="padding:2.5rem;">
                <div class="empty-state-icon">👥</div>
                <h3>Belum ada pendaftar</h3>
                <p>Peserta yang mendaftar event Anda akan muncul di sini</p>
            </div>
        @endif
    </div>
</div>

@endsection
