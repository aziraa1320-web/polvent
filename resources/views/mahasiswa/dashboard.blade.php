@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')
@section('page-title', 'Dashboard')
@section('page-breadcrumb')
    Mahasiswa / <span>Dashboard</span>
@endsection

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #0f285c 0%, #1e3a8a 60%, #1d4ed8 100%);
        border-radius: 1.25rem;
        padding: 2rem 2.25rem;
        margin-bottom: 1.75rem;
        position: relative;
        overflow: hidden;
    }
    .welcome-card::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 180px; height: 180px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -60px; right: 80px;
        width: 240px; height: 240px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }
    .welcome-greeting { color: rgba(255,255,255,0.7); font-size: 0.875rem; margin-bottom: 0.25rem; }
    .welcome-name { color: white; font-size: 1.625rem; font-weight: 800; margin-bottom: 0.2rem; letter-spacing: -0.3px; }
    .welcome-nim { color: rgba(255,255,255,0.6); font-size: 0.8rem; }
    .welcome-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; position: relative; z-index: 2; }
    .btn-white { background: white; color: #0f285c; padding: 0.6rem 1.25rem; border-radius: 0.625rem; font-weight: 700; font-size: 0.845rem; display: flex; align-items: center; gap: 0.4rem; transition: all 0.2s; }
    .btn-white:hover { background: #f1f5f9; transform: translateY(-1px); }
    .btn-ghost { background: rgba(255,255,255,0.12); color: white; border: 1.5px solid rgba(255,255,255,0.25); padding: 0.6rem 1.25rem; border-radius: 0.625rem; font-weight: 600; font-size: 0.845rem; display: flex; align-items: center; gap: 0.4rem; transition: all 0.2s; }
    .btn-ghost:hover { background: rgba(255,255,255,0.2); }

    /* Stats */
    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.125rem; margin-bottom: 1.75rem; }
    .stat-modern {
        background: white; border-radius: 1rem; padding: 1.375rem 1.5rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;
        display: flex; align-items: center; gap: 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-modern:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.07); }
    .stat-icon-box { width: 50px; height: 50px; border-radius: 0.875rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .stat-info .val { font-size: 1.75rem; font-weight: 800; color: #0f172a; line-height: 1; }
    .stat-info .lbl { font-size: 0.78rem; color: #64748b; margin-top: 0.3rem; font-weight: 500; }

    /* Quick Access */
    .quick-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
    .quick-card {
        background: white; border-radius: 1rem; padding: 1.375rem 1.25rem;
        border: 1.5px solid #f1f5f9; text-align: center;
        text-decoration: none; transition: all 0.25s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.03);
    }
    .quick-card:hover { border-color: #0f285c; background: #f8faff; transform: translateY(-3px); box-shadow: 0 8px 20px rgba(15,40,92,0.08); }
    .quick-card-icon { width: 48px; height: 48px; border-radius: 0.875rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.875rem; }
    .quick-card-label { font-weight: 700; font-size: 0.875rem; color: #1e293b; }
    .quick-card-sub { font-size: 0.75rem; color: #94a3b8; margin-top: 0.2rem; }

    /* Content cards */
    .content-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
    .card-section { background: white; border-radius: 1rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 4px rgba(0,0,0,0.03); overflow: hidden; }
    .card-section-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between; }
    .card-section-header h3 { font-size: 0.975rem; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 0.5rem; }
    .card-section-body { padding: 1.25rem 1.5rem; }

    /* Event mini cards */
    .event-mini-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem; }
    .event-mini-card { background: #f8fafc; border-radius: 0.875rem; overflow: hidden; border: 1px solid #f1f5f9; transition: all 0.2s; }
    .event-mini-card:hover { border-color: #0f285c; box-shadow: 0 6px 16px rgba(15,40,92,0.08); transform: translateY(-2px); }
    .event-mini-thumb { height: 120px; background: linear-gradient(135deg, #0f285c, #1d4ed8); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.5); position: relative; overflow: hidden; }
    .event-mini-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .event-mini-body { padding: 0.875rem 1rem; }
    .event-mini-date { font-size: 0.72rem; color: #1d4ed8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem; }
    .event-mini-title { font-size: 0.875rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.3; }
    .event-mini-footer { display: flex; align-items: center; justify-content: space-between; }
    .quota-pill { font-size: 0.7rem; color: #059669; font-weight: 600; background: #d1fae5; padding: 0.15rem 0.5rem; border-radius: 99px; }

    @media (max-width: 768px) {
        .stats-row { grid-template-columns: repeat(2, 1fr); }
        .quick-grid { grid-template-columns: repeat(3, 1fr); }
    }
</style>
@endpush

@section('content')

{{-- WELCOME BANNER --}}
<div class="welcome-card">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1.25rem;position:relative;z-index:2;">
        <div>
            <div class="welcome-greeting">👋 Selamat datang kembali</div>
            <div class="welcome-name">{{ auth()->user()->name }}</div>
            @if(auth()->user()->nim)
                <div class="welcome-nim">NIM: {{ auth()->user()->nim }}</div>
            @endif
        </div>
        <div class="welcome-actions">
            <a href="{{ route('mahasiswa.events.index') }}" class="btn-white">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Lihat Event
            </a>
            <a href="{{ route('mahasiswa.history') }}" class="btn-ghost">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Riwayat
            </a>
        </div>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="stats-row">
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#eff6ff;">
            <svg width="22" height="22" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <div class="stat-info">
            <div class="val">{{ $stats['total_registered'] }}</div>
            <div class="lbl">Total Pendaftaran</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#d1fae5;">
            <svg width="22" height="22" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <div class="val">{{ $stats['approved'] }}</div>
            <div class="lbl">Disetujui</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#fef3c7;">
            <svg width="22" height="22" fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <div class="val">{{ $stats['pending'] }}</div>
            <div class="lbl">Menunggu</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#ede9fe;">
            <svg width="22" height="22" fill="none" stroke="#7c3aed" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-info">
            <div class="val">{{ $stats['upcoming_events'] }}</div>
            <div class="lbl">Event Mendatang</div>
        </div>
    </div>
</div>

{{-- QUICK ACCESS --}}
<div class="quick-grid">
    <a href="{{ route('mahasiswa.events.index') }}" class="quick-card">
        <div class="quick-card-icon" style="background:#eff6ff;">
            <svg width="22" height="22" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="quick-card-label">Daftar Event</div>
        <div class="quick-card-sub">Cari & daftar event</div>
    </a>
    <a href="{{ route('mahasiswa.history') }}" class="quick-card">
        <div class="quick-card-icon" style="background:#d1fae5;">
            <svg width="22" height="22" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="quick-card-label">Riwayat Saya</div>
        <div class="quick-card-sub">Lihat pendaftaranmu</div>
    </a>
    <a href="{{ route('home') }}" class="quick-card">
        <div class="quick-card-icon" style="background:#fef3c7;">
            <svg width="22" height="22" fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        </div>
        <div class="quick-card-label">Beranda</div>
        <div class="quick-card-sub">Ke halaman utama</div>
    </a>
</div>

{{-- CONTENT --}}
<div class="content-grid">
    {{-- Event Mendatang --}}
    <div class="card-section">
        <div class="card-section-header">
            <h3>
                <svg width="18" height="18" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Event Mendatang
            </h3>
            <a href="{{ route('mahasiswa.events.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
        </div>
        <div class="card-section-body">
            @if($upcomingEvents->count())
                <div class="event-mini-grid">
                    @foreach($upcomingEvents as $event)
                        <div class="event-mini-card">
                            <div class="event-mini-thumb">
                                @if($event->poster)
                                    <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}">
                                @else
                                    <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @endif
                            </div>
                            <div class="event-mini-body">
                                <div class="event-mini-date">{{ $event->event_date->format('d M Y') }}</div>
                                <div class="event-mini-title">{{ $event->title }}</div>
                                <div class="event-mini-footer">
                                    <span class="quota-pill">{{ $event->quota }} slot</span>
                                    <a href="{{ route('mahasiswa.events.show', $event) }}" class="btn btn-primary btn-sm">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" style="padding:2rem 0;">
                    <div class="empty-state-icon">📅</div>
                    <h3>Belum ada event mendatang</h3>
                    <p>Panitia sedang menyiapkan event seru untuk Anda!</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Riwayat --}}
    <div class="card-section">
        <div class="card-section-header">
            <h3>
                <svg width="18" height="18" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Riwayat Pendaftaran Terbaru
            </h3>
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
                                <div style="font-weight:600;color:#1e293b;font-size:0.875rem;">{{ $reg->event->title }}</div>
                            </td>
                            <td style="color:#64748b;font-size:0.82rem;">{{ $reg->event->event_date->format('d M Y') }}</td>
                            <td style="color:#64748b;font-size:0.82rem;">{{ $reg->created_at->format('d M Y') }}</td>
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

@endsection
