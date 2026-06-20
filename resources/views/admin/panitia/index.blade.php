@extends('layouts.app')

@section('title', 'Kelola Panitia')
@section('page-title', 'Manajemen Panitia')
@section('page-breadcrumb')
    Admin / <span>Kelola Panitia</span>
@endsection

@push('styles')
<style>
    .panitia-wrapper { }
    .panitia-card {
        background: white;
        border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .panitia-card-header {
        padding: 1.375rem 1.75rem;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.875rem;
        background: linear-gradient(135deg, #f8fafc 0%, #fff 100%);
    }
    .panitia-card-header h3 {
        font-size: 1rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Proper Table Styling */
    .panitia-table { width: 100%; border-collapse: collapse; }
    .panitia-table thead tr {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
    }
    .panitia-table thead th {
        padding: 0.875rem 1.25rem;
        text-align: left;
        font-size: 0.72rem;
        font-weight: 800;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        white-space: nowrap;
    }
    .panitia-table tbody tr {
        border-bottom: 1px solid #e8edf2;
        transition: background 0.15s;
    }
    .panitia-table tbody tr:last-child { border-bottom: none; }
    .panitia-table tbody tr:hover { background: #f8fafc; }
    .panitia-table tbody td {
        padding: 1rem 1.25rem;
        font-size: 0.875rem;
        color: #334155;
        vertical-align: middle;
    }

    .org-avatar-wrap { display: flex; align-items: center; gap: 0.875rem; }
    .org-avatar {
        width: 42px; height: 42px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e2e8f0;
        flex-shrink: 0;
    }
    .org-avatar-init {
        width: 42px; height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0056B3, #1d4ed8);
        color: white;
        font-weight: 800;
        font-size: 1rem;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        border: 2px solid #dbeafe;
    }
    .org-name { font-weight: 700; color: #0f172a; font-size: 0.9rem; }
    .org-date { font-size: 0.72rem; color: #94a3b8; margin-top: 0.1rem; }

    .email-chip {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: #f1f5f9; color: #374151;
        padding: 0.3rem 0.75rem; border-radius: 9999px;
        font-size: 0.8rem; font-weight: 500;
        border: 1px solid #e2e8f0;
    }

    /* EMPTY STATE */
    .panitia-empty {
        text-align: center;
        padding: 5rem 2rem;
        color: #94a3b8;
    }
    .panitia-empty svg { margin: 0 auto 1.25rem; display: block; opacity: 0.35; }
    .panitia-empty h3 { font-size: 1.1rem; font-weight: 700; color: #374151; margin-bottom: 0.5rem; }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .panitia-table thead { display: none; }
        .panitia-table tbody tr {
            display: block;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        .panitia-table tbody td {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.375rem 0;
            border: none;
        }
        .panitia-table tbody td::before {
            content: attr(data-label);
            font-size: 0.72rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            flex-shrink: 0;
            margin-right: 0.75rem;
        }
        .panitia-table tbody td:first-child { padding-top: 0; }
        .panitia-table tbody td:last-child { justify-content: flex-end; }
    }
</style>
@endpush

@section('content')
<div class="panitia-wrapper">
    <div class="panitia-card">
        <div class="panitia-card-header">
            <h3>
                <svg width="20" height="20" fill="none" stroke="#0056B3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Daftar Akun Panitia (UKM/HMJ)
            </h3>
            <a href="{{ route('admin.panitia.create') }}" class="btn btn-primary btn-sm">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Panitia
            </a>
        </div>

        @if($panitias->count())
            <div style="overflow-x:auto;">
                <table class="panitia-table">
                    <thead>
                        <tr>
                            <th>Organisasi / Kepanitiaan</th>
                            <th>Email Login</th>
                            <th>Status</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($panitias as $panitia)
                        <tr>
                            <td data-label="Organisasi">
                                <div class="org-avatar-wrap">
                                    @if($panitia->profile_photo)
                                        <img src="{{ $panitia->profile_photo_url }}" alt="{{ $panitia->name }}" class="org-avatar" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="org-avatar-init" style="display:none;">{{ strtoupper(substr($panitia->name, 0, 1)) }}</div>
                                    @else
                                        <div class="org-avatar-init">{{ strtoupper(substr($panitia->name, 0, 1)) }}</div>
                                    @endif
                                    <div>
                                        <div class="org-name">{{ $panitia->name }}</div>
                                        <div class="org-date">
                                            <svg style="display:inline;vertical-align:middle;" width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            Ditambahkan: {{ $panitia->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Email">
                                <span class="email-chip">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    {{ $panitia->email }}
                                </span>
                            </td>
                            <td data-label="Status">
                                @if($panitia->is_otp_verified)
                                    <span class="status-badge status-approved">Terverifikasi</span>
                                @else
                                    <span class="status-badge status-pending">Belum Verifikasi</span>
                                @endif
                            </td>
                            <td data-label="Aksi" style="text-align:right; display:flex; gap:0.5rem; justify-content:flex-end;">
                                <a href="{{ route('admin.panitia.edit', $panitia) }}" class="btn btn-sm" style="background:#f59e0b; border-color:#f59e0b; color:white; padding: 0.25rem 0.6rem; font-size: 0.75rem;">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline-block; vertical-align:middle; margin-top:-2px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.panitia.destroy', $panitia) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun panitia ini? Seluruh data event miliknya juga dapat terpengaruh.');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.25rem 0.6rem; font-size: 0.75rem;">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline-block; vertical-align:middle; margin-top:-2px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="panitia-empty">
                <svg width="64" height="64" fill="none" stroke="#94a3b8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <h3>Belum ada Panitia</h3>
                <p>Anda belum menambahkan akun panitia (UKM/HMJ) apapun.</p>
                <a href="{{ route('admin.panitia.create') }}" class="btn btn-primary" style="margin-top:1.25rem; display:inline-flex;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Panitia Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
