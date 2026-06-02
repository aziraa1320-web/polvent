@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem;margin-bottom:1.5rem;">
    <!-- Stat Cards -->
    <div class="stat-card">
        <div class="stat-icon" style="background:#e8f0fe;">
            <svg style="width:24px;height:24px;color:#0056B3;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div class="stat-value">{{ $stats['total_events'] }}</div>
        <div class="stat-label">Total Event</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#d1fae5;">
            <svg style="width:24px;height:24px;color:#059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-label">Total Mahasiswa</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fef3c7;">
            <svg style="width:24px;height:24px;color:#d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <div class="stat-value">{{ $stats['total_registrations'] }}</div>
        <div class="stat-label">Total Pendaftar</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fee2e2;">
            <svg style="width:24px;height:24px;color:#dc2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="stat-value">{{ $stats['pending_registrations'] }}</div>
        <div class="stat-label">Pendaftar Pending</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#ede9fe;">
            <svg style="width:24px;height:24px;color:#7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
        </div>
        <div class="stat-value">{{ $stats['upcoming_events'] }}</div>
        <div class="stat-label">Event Mendatang</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#e0f2fe;">
            <svg style="width:24px;height:24px;color:#0284c7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div class="stat-value">{{ $stats['total_panitia'] }}</div>
        <div class="stat-label">Total Panitia</div>
    </div>
</div>

<!-- Recent Events Table -->
<div class="table-wrapper">
    <div class="table-header">
        <h3>📅 Event Terbaru</h3>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Event
        </a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Judul Event</th>
                <th>Tanggal</th>
                <th>Kuota</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentEvents as $event)
            <tr>
                <td>
                    <div style="font-weight:600;color:#1e293b;">{{ $event->title }}</div>
                </td>
                <td>{{ $event->event_date->format('d M Y, H:i') }}</td>
                <td>{{ $event->quota }} orang</td>
                <td>{{ $event->creator->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-secondary btn-sm">Detail</a>
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:#64748b;padding:2rem;">Belum ada event.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
