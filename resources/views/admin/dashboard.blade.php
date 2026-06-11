@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-breadcrumb')
    Admin / <span>Dashboard</span>
@endsection

@section('content')

{{-- ===== WELCOME BANNER ===== --}}
<div style="background:linear-gradient(135deg,#0f172a,#1e293b,#334155);border-radius:1.125rem;padding:1.75rem 2rem;margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
    <div>
        <div style="color:rgba(255,255,255,0.7);font-size:0.8rem;margin-bottom:0.3rem;">Panel Administrator 🛡️</div>
        <div style="color:white;font-size:1.375rem;font-weight:800;margin-bottom:0.25rem;">{{ auth()->user()->name }}</div>
        <div style="color:rgba(255,255,255,0.65);font-size:0.82rem;">Monitoring seluruh event dan aktivitas di sistem POLVENT</div>
    </div>
    <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
        <a href="{{ route('admin.events.index') }}" class="btn" style="background:white;color:#0f172a;font-size:0.845rem;font-weight:700;">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Kelola Semua Event
        </a>
        <a href="{{ route('admin.activity-logs.index') }}" class="btn" style="background:rgba(255,255,255,0.15);color:white;border:1.5px solid rgba(255,255,255,0.3);font-size:0.845rem;">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            Activity Logs
        </a>
    </div>
</div>

{{-- ===== STAT CARDS ===== --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.125rem;margin-bottom:1.75rem;">
    <div class="stat-card" style="border-left:4px solid #1e293b;">
        <div class="stat-icon" style="background:#f1f5f9;">
            <svg style="width:22px;height:22px;color:#1e293b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['total_events'] }}</div>
        <div class="stat-label">Total Event di Sistem</div>
    </div>

    <div class="stat-card" style="border-left:4px solid #0056B3;">
        <div class="stat-icon" style="background:#e8f0fe;">
            <svg style="width:22px;height:22px;color:#0056B3;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-label">Total Pengguna</div>
    </div>

    <div class="stat-card" style="border-left:4px solid #059669;">
        <div class="stat-icon" style="background:#d1fae5;">
            <svg style="width:22px;height:22px;color:#059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['total_registrations'] }}</div>
        <div class="stat-label">Total Pendaftaran</div>
    </div>
</div>

{{-- ===== ADMIN GRID ===== --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;align-items:start;">

    {{-- Activity Logs Preview --}}
    <div>
        <div class="table-wrapper">
            <div class="table-header">
                <h3>⚡ Aktivitas Sistem Terbaru</h3>
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
                                        <div style="width:24px;height:24px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.6rem;color:#374151;flex-shrink:0;">
                                            {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:600;color:#1e293b;font-size:0.8rem;">{{ $log->user->name }}</div>
                                            <div style="font-size:0.68rem;color:#64748b;">Role: {{ $log->user->role }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $actionColor = match($log->action) {
                                            'create' => '#059669', // green
                                            'update' => '#2563eb', // blue
                                            'delete' => '#dc2626', // red
                                            default => '#64748b',
                                        };
                                        $actionBg = match($log->action) {
                                            'create' => '#d1fae5',
                                            'update' => '#dbeafe',
                                            'delete' => '#fee2e2',
                                            default => '#f1f5f9',
                                        };
                                    @endphp
                                    <div style="margin-bottom:0.2rem;">
                                        <span style="font-size:0.68rem;font-weight:700;padding:0.15rem 0.4rem;border-radius:4px;background:{{ $actionBg }};color:{{ $actionColor }};text-transform:uppercase;">
                                            {{ $log->action }}
                                        </span>
                                    </div>
                                    <div style="font-size:0.82rem;color:#374151;">{{ $log->description }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state" style="padding:2.5rem;">
                    <div class="empty-state-icon" style="font-size:2rem;margin-bottom:0.5rem;">⚡</div>
                    <h3 style="font-size:0.9rem;">Belum ada aktivitas</h3>
                    <p style="font-size:0.8rem;">Sistem belum mencatat aktivitas apapun.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- System Status & Quick Links --}}
    <div style="display:flex;flex-direction:column;gap:1.5rem;">
        
        {{-- Status --}}
        <div class="stat-card" style="padding:1.25rem;">
            <h3 style="font-size:0.9rem;font-weight:700;color:#1e293b;margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem;">
                <svg style="width:16px;height:16px;color:#10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Status Sistem
            </h3>
            <div style="display:flex;flex-direction:column;gap:0.75rem;">
                <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.82rem;padding-bottom:0.5rem;border-bottom:1px solid #f1f5f9;">
                    <span style="color:#64748b;">Versi Laravel</span>
                    <span style="font-weight:600;color:#1e293b;">11.x</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.82rem;padding-bottom:0.5rem;border-bottom:1px solid #f1f5f9;">
                    <span style="color:#64748b;">Database</span>
                    <span style="font-weight:600;color:#10b981;">Connected</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.82rem;">
                    <span style="color:#64748b;">Timezone</span>
                    <span style="font-weight:600;color:#1e293b;">Asia/Jakarta</span>
                </div>
            </div>
        </div>

        {{-- Shortcuts --}}
        <div class="stat-card" style="padding:1.25rem;">
            <h3 style="font-size:0.9rem;font-weight:700;color:#1e293b;margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem;">
                <svg style="width:16px;height:16px;color:#3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Tindakan Cepat
            </h3>
            <div style="display:flex;flex-direction:column;gap:0.5rem;">
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Buat Event Baru</a>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary" style="width:100%;justify-content:center;">Monitoring Event</a>
            </div>
        </div>

    </div>

</div>

@endsection
