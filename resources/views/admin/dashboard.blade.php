@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-breadcrumb')
    Admin / <span>Dashboard</span>
@endsection

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #334155 100%);
        border-radius: 1.25rem;
        padding: 2rem 2.25rem;
        margin-bottom: 1.75rem;
        position: relative;
        overflow: hidden;
    }
    .welcome-card::before { content:''; position:absolute; top:-50px; right:-50px; width:200px; height:200px; background:rgba(255,255,255,0.04); border-radius:50%; }
    .welcome-card::after  { content:''; position:absolute; bottom:-70px; right:60px; width:260px; height:260px; background:rgba(255,255,255,0.02); border-radius:50%; }

    .welcome-role { display:inline-flex; align-items:center; gap:0.4rem; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15); border-radius:99px; padding:0.3rem 0.75rem; font-size:0.75rem; color:rgba(255,255,255,0.8); font-weight:600; margin-bottom:0.875rem; }
    .welcome-name { color:white; font-size:1.625rem; font-weight:800; margin-bottom:0.2rem; }
    .welcome-sub { color:rgba(255,255,255,0.6); font-size:0.82rem; }
    .btn-white { background:white; color:#0f172a; padding:0.6rem 1.25rem; border-radius:0.625rem; font-weight:700; font-size:0.845rem; display:flex; align-items:center; gap:0.4rem; transition:all 0.2s; }
    .btn-white:hover { background:#f1f5f9; transform:translateY(-1px); }
    .btn-ghost { background:rgba(255,255,255,0.1); color:white; border:1.5px solid rgba(255,255,255,0.2); padding:0.6rem 1.25rem; border-radius:0.625rem; font-weight:600; font-size:0.845rem; display:flex; align-items:center; gap:0.4rem; transition:all 0.2s; }
    .btn-ghost:hover { background:rgba(255,255,255,0.18); }

    .stats-row { display:grid; grid-template-columns:repeat(3,1fr); gap:1.25rem; margin-bottom:1.75rem; }
    .stat-modern { background:white; border-radius:1rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,0.04); border:1px solid #f1f5f9; display:flex; align-items:center; gap:1.125rem; transition:transform 0.2s, box-shadow 0.2s; }
    .stat-modern:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(0,0,0,0.07); }
    .stat-icon-box { width:52px; height:52px; border-radius:0.875rem; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .stat-val { font-size:2rem; font-weight:800; color:#0f172a; line-height:1; margin-bottom:0.25rem; }
    .stat-lbl { font-size:0.8rem; color:#64748b; font-weight:500; }
    .stat-trend { font-size:0.72rem; color:#059669; margin-top:0.2rem; font-weight:600; }

    .admin-main-grid { display:grid; grid-template-columns:2fr 1fr; gap:1.5rem; align-items:start; }

    .card-section { background:white; border-radius:1rem; border:1px solid #f1f5f9; box-shadow:0 1px 4px rgba(0,0,0,0.03); overflow:hidden; }
    .card-section-header { padding:1.25rem 1.5rem; border-bottom:1px solid #f8fafc; display:flex; align-items:center; justify-content:space-between; }
    .card-section-header h3 { font-size:0.975rem; font-weight:700; color:#1e293b; display:flex; align-items:center; gap:0.5rem; }

    /* Shortcut cards */
    .shortcut-row { display:flex; flex-direction:column; gap:0.75rem; }
    .shortcut-link { display:flex; align-items:center; gap:0.875rem; padding:1rem 1.125rem; background:#f8fafc; border-radius:0.875rem; text-decoration:none; border:1.5px solid #f1f5f9; transition:all 0.2s; }
    .shortcut-link:hover { background:white; border-color:#0f172a; box-shadow:0 4px 12px rgba(0,0,0,0.06); transform:translateX(4px); }
    .shortcut-icon { width:40px; height:40px; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .shortcut-text .title { font-weight:700; font-size:0.875rem; color:#1e293b; }
    .shortcut-text .sub { font-size:0.72rem; color:#94a3b8; margin-top:0.1rem; }

    /* Status card */
    .status-card { background:white; border-radius:1rem; border:1px solid #f1f5f9; box-shadow:0 1px 4px rgba(0,0,0,0.03); padding:1.375rem; margin-top:1.5rem; }
    .status-row { display:flex; justify-content:space-between; align-items:center; padding:0.625rem 0; border-bottom:1px solid #f8fafc; font-size:0.845rem; }
    .status-row:last-child { border-bottom:none; padding-bottom:0; }
    .status-key { color:#64748b; }
    .status-val { font-weight:600; color:#1e293b; }
    .status-val.ok { color:#059669; }

    @media (max-width: 900px) {
        .admin-main-grid { grid-template-columns: 1fr; }
        .stats-row { grid-template-columns: repeat(3, 1fr); }
    }
</style>
@endpush

@section('content')

{{-- WELCOME BANNER --}}
<div class="welcome-card">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1.25rem;position:relative;z-index:2;">
        <div>
            <div class="welcome-role">🛡️ Administrator</div>
            <div class="welcome-name">{{ auth()->user()->name }}</div>
            <div class="welcome-sub">Monitoring seluruh event dan aktivitas di sistem POLVENT</div>
        </div>
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
            <a href="{{ route('admin.events.create') }}" class="btn-white">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Event
            </a>
            <a href="{{ route('admin.activity-logs.index') }}" class="btn-ghost">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Activity Logs
            </a>
        </div>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="stats-row">
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#f1f5f9;">
            <svg width="24" height="24" fill="none" stroke="#334155" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <div class="stat-val">{{ $stats['total_events'] }}</div>
            <div class="stat-lbl">Total Event</div>
            <div class="stat-trend">↑ di sistem</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#eff6ff;">
            <svg width="24" height="24" fill="none" stroke="#0056B3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <div>
            <div class="stat-val">{{ $stats['total_users'] }}</div>
            <div class="stat-lbl">Total Pengguna</div>
            <div class="stat-trend">↑ terdaftar</div>
        </div>
    </div>
    <div class="stat-modern">
        <div class="stat-icon-box" style="background:#d1fae5;">
            <svg width="24" height="24" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-val">{{ $stats['total_registrations'] }}</div>
            <div class="stat-lbl">Total Pendaftaran</div>
            <div class="stat-trend">↑ keseluruhan</div>
        </div>
    </div>
</div>

{{-- MAIN GRID --}}
<div class="admin-main-grid">

    {{-- Activity Log Table --}}
    <div class="card-section">
        <div class="card-section-header">
            <h3>
                <svg width="18" height="18" fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Aktivitas Sistem Terbaru
            </h3>
            <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-secondary btn-sm">Lihat Semua Log</a>
        </div>

        @if($recentActivities->count())
            <table>
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentActivities as $log)
                        <tr>
                            <td style="font-size:0.8rem;color:#64748b;white-space:nowrap;">
                                {{ $log->created_at->diffForHumans() }}
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:0.5rem;">
                                    <div style="width:28px;height:28px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.65rem;color:#374151;flex-shrink:0;">
                                        {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:600;color:#1e293b;font-size:0.82rem;">{{ $log->user->name }}</div>
                                        <div style="font-size:0.68rem;color:#64748b;">{{ ucfirst($log->user->role) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $ac = $log->action;
                                    [$ac_color, $ac_bg] = match(true) {
                                        str_contains($ac, 'create') || str_contains($ac, 'approve') => ['#059669', '#d1fae5'],
                                        str_contains($ac, 'update') => ['#2563eb', '#dbeafe'],
                                        str_contains($ac, 'delete') || str_contains($ac, 'reject') => ['#dc2626', '#fee2e2'],
                                        str_contains($ac, 'login') => ['#0f766e', '#ccfbf1'],
                                        default => ['#64748b', '#f1f5f9'],
                                    };
                                @endphp
                                <div style="margin-bottom:0.25rem;">
                                    <span style="font-size:0.68rem;font-weight:700;padding:0.2rem 0.5rem;border-radius:4px;background:{{ $ac_bg }};color:{{ $ac_color }};text-transform:uppercase;">{{ $log->action }}</span>
                                </div>
                                <div style="font-size:0.82rem;color:#374151;">{{ $log->description }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state" style="padding:2.5rem;">
                <div class="empty-state-icon">⚡</div>
                <h3>Belum ada aktivitas</h3>
                <p>Sistem belum mencatat aktivitas apapun.</p>
            </div>
        @endif
    </div>

    {{-- Sidebar --}}
    <div>
        {{-- Shortcuts --}}
        <div class="card-section">
            <div class="card-section-header">
                <h3>
                    <svg width="16" height="16" fill="none" stroke="#3b82f6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Tindakan Cepat
                </h3>
            </div>
            <div style="padding:1.125rem;">
                <div class="shortcut-row">
                    <a href="{{ route('admin.events.create') }}" class="shortcut-link">
                        <div class="shortcut-icon" style="background:#d1fae5;">
                            <svg width="18" height="18" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <div class="shortcut-text">
                            <div class="title">Buat Event Baru</div>
                            <div class="sub">Tambah event ke sistem</div>
                        </div>
                        <svg style="margin-left:auto;color:#cbd5e1;" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="shortcut-link">
                        <div class="shortcut-icon" style="background:#dbeafe;">
                            <svg width="18" height="18" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="shortcut-text">
                            <div class="title">Monitoring Event</div>
                            <div class="sub">Lihat semua event</div>
                        </div>
                        <svg style="margin-left:auto;color:#cbd5e1;" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('admin.login-history.index') }}" class="shortcut-link">
                        <div class="shortcut-icon" style="background:#fef3c7;">
                            <svg width="18" height="18" fill="none" stroke="#d97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <div class="shortcut-text">
                            <div class="title">Login History</div>
                            <div class="sub">Log keamanan sistem</div>
                        </div>
                        <svg style="margin-left:auto;color:#cbd5e1;" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- System Status --}}
        <div class="status-card">
            <h3 style="font-size:0.9rem;font-weight:700;color:#1e293b;margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem;">
                <svg style="color:#10b981;" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Status Sistem
            </h3>
            <div class="status-row">
                <span class="status-key">Versi Laravel</span>
                <span class="status-val">11.x</span>
            </div>
            <div class="status-row">
                <span class="status-key">Database</span>
                <span class="status-val ok">● Connected</span>
            </div>
            <div class="status-row">
                <span class="status-key">Timezone</span>
                <span class="status-val">Asia/Jakarta</span>
            </div>
            <div class="status-row">
                <span class="status-key">Server</span>
                <span class="status-val ok">● Online</span>
            </div>
        </div>
    </div>

</div>

@endsection
