@extends('layouts.app')

@section('title', 'Dashboard Panitia')
@section('page-title', 'Dashboard Panitia')
@section('page-breadcrumb')
    Panitia / <span>Dashboard</span>
@endsection

@section('content')

{{-- ===== WELCOME BANNER ===== --}}
<div style="background:linear-gradient(135deg,#1d4ed8,#1e40af,#1e3a8a);border-radius:1.125rem;padding:1.75rem 2rem;margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
    <div>
        <div style="color:rgba(255,255,255,0.7);font-size:0.8rem;margin-bottom:0.3rem;">Panel Panitia 📋</div>
        <div style="color:white;font-size:1.375rem;font-weight:800;margin-bottom:0.25rem;">{{ auth()->user()->name }}</div>
        <div style="color:rgba(255,255,255,0.65);font-size:0.82rem;">Kelola event dan verifikasi peserta Anda</div>
    </div>
    <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
        <a href="{{ route('panitia.events.create') }}" class="btn" style="background:white;color:#1d4ed8;font-size:0.845rem;font-weight:700;">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Event Baru
        </a>
        <a href="{{ route('panitia.registrations.index') }}" class="btn" style="background:rgba(255,255,255,0.15);color:white;border:1.5px solid rgba(255,255,255,0.3);font-size:0.845rem;">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Kelola Peserta
        </a>
    </div>
</div>

{{-- ===== STAT CARDS ===== --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1.125rem;margin-bottom:1.75rem;">
    <div class="stat-card" style="border-left:4px solid #1d4ed8;">
        <div class="stat-icon" style="background:#dbeafe;">
            <svg style="width:22px;height:22px;color:#1d4ed8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['total_events'] }}</div>
        <div class="stat-label">Event Saya</div>
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
        <div class="stat-label">Perlu Diverifikasi</div>
    </div>

    <div class="stat-card" style="border-left:4px solid #dc2626;">
        <div class="stat-icon" style="background:#fee2e2;">
            <svg style="width:22px;height:22px;color:#dc2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </div>
        <div class="stat-value">{{ $stats['rejected'] }}</div>
        <div class="stat-label">Ditolak</div>
    </div>

    <div class="stat-card" style="border-left:4px solid #7c3aed;">
        <div class="stat-icon" style="background:#ede9fe;">
            <svg style="width:22px;height:22px;color:#7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['total_registrations'] }}</div>
        <div class="stat-label">Total Pendaftar</div>
    </div>
</div>

{{-- ===== SHORTCUT CARDS ===== --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.75rem;">
    <a href="{{ route('panitia.events.create') }}" style="text-decoration:none;">
        <div style="background:white;border:1.5px dashed #bfdbfe;border-radius:1rem;padding:1.25rem;text-align:center;transition:all 0.2s;" onmouseover="this.style.borderColor='#1d4ed8';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#bfdbfe';this.style.background='white'">
            <div style="font-size:1.75rem;margin-bottom:0.5rem;">➕</div>
            <div style="font-weight:700;font-size:0.875rem;color:#1e293b;">Buat Event Baru</div>
        </div>
    </a>
    <a href="{{ route('panitia.events.index') }}" style="text-decoration:none;">
        <div style="background:white;border:1.5px dashed #bfdbfe;border-radius:1rem;padding:1.25rem;text-align:center;transition:all 0.2s;" onmouseover="this.style.borderColor='#1d4ed8';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#bfdbfe';this.style.background='white'">
            <div style="font-size:1.75rem;margin-bottom:0.5rem;">📅</div>
            <div style="font-weight:700;font-size:0.875rem;color:#1e293b;">Kelola Event</div>
        </div>
    </a>
    <a href="{{ route('panitia.registrations.index') }}" style="text-decoration:none;">
        <div style="background:white;border:1.5px dashed #bfdbfe;border-radius:1rem;padding:1.25rem;text-align:center;transition:all 0.2s;" onmouseover="this.style.borderColor='#1d4ed8';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#bfdbfe';this.style.background='white'">
            <div style="font-size:1.75rem;margin-bottom:0.5rem;">👥</div>
            <div style="font-weight:700;font-size:0.875rem;color:#1e293b;">Kelola Peserta</div>
        </div>
    </a>
</div>

{{-- ===== RECENT REGISTRATIONS ===== --}}
<div class="table-wrapper">
    <div class="table-header">
        <h3>👥 Peserta Terbaru — Perlu Verifikasi</h3>
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
                                <div style="width:32px;height:32px;background:#e8f0fe;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.78rem;color:#0056B3;flex-shrink:0;">
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
                                        <button type="submit" class="btn btn-success btn-sm" title="Setujui">✓</button>
                                    </form>
                                    <form method="POST" action="{{ route('panitia.registrations.reject', $reg) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Tolak">✗</button>
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

@endsection
