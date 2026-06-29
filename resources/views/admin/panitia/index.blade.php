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

    /* Phone badge */
    .phone-chip {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: #f0fdf4; color: #166534;
        padding: 0.3rem 0.7rem; border-radius: 9999px;
        font-size: 0.8rem; font-weight: 600;
        border: 1px solid #bbf7d0;
    }
    .phone-missing {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: #fff7ed; color: #9a3412;
        padding: 0.3rem 0.7rem; border-radius: 9999px;
        font-size: 0.75rem; font-weight: 700;
        border: 1px solid #fed7aa;
        animation: pulse-warn 2s infinite;
    }
    @keyframes pulse-warn {
        0%, 100% { box-shadow: 0 0 0 0 rgba(251,146,60,0.4); }
        50%       { box-shadow: 0 0 0 5px rgba(251,146,60,0); }
    }

    /* Warning banner */
    .wa-warning-banner {
        display: flex; align-items: center; gap: 0.75rem;
        background: #fffbeb; border: 1px solid #fcd34d;
        border-radius: 0.75rem; padding: 0.875rem 1.25rem;
        margin: 1rem 1.5rem; font-size: 0.875rem; color: #92400e;
    }
    .wa-warning-banner svg { flex-shrink: 0; color: #f59e0b; }

    /* EMPTY STATE */
    .panitia-empty {
        text-align: center;
        padding: 5rem 2rem;
        color: #94a3b8;
    }
    .panitia-empty svg { margin: 0 auto 1.25rem; display: block; opacity: 0.35; }
    .panitia-empty h3 { font-size: 1.1rem; font-weight: 700; color: #374151; margin-bottom: 0.5rem; }

    /* MODAL */
    .modal-overlay {
        display: none;
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.55);
        z-index: 9999;
        align-items: center; justify-content: center;
        backdrop-filter: blur(3px);
    }
    .modal-overlay.active { display: flex; }
    .modal-box {
        background: white;
        border-radius: 1.25rem;
        width: 100%; max-width: 440px;
        padding: 2rem;
        box-shadow: 0 25px 50px rgba(0,0,0,0.18);
        animation: slideUp 0.22s ease;
        position: relative;
    }
    @keyframes slideUp {
        from { transform: translateY(24px); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }
    .modal-close {
        position: absolute; top: 1rem; right: 1rem;
        background: #f1f5f9; border: none; border-radius: 50%;
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #64748b; transition: all 0.15s;
    }
    .modal-close:hover { background: #e2e8f0; color: #0f172a; }
    .modal-title {
        font-size: 1.15rem; font-weight: 800; color: #0f172a;
        margin-bottom: 0.35rem;
        display: flex; align-items: center; gap: 0.5rem;
    }
    .modal-subtitle { font-size: 0.82rem; color: #64748b; margin-bottom: 1.5rem; line-height: 1.55; }
    .modal-label { display: block; font-weight: 700; font-size: 0.82rem; color: #374151; margin-bottom: 0.45rem; }
    .modal-input {
        width: 100%; padding: 0.7rem 1rem 0.7rem 2.6rem;
        border: 1.5px solid #e2e8f0; border-radius: 0.625rem;
        font-size: 0.9rem; color: #1e293b; background: #f9fafb;
        outline: none; transition: all 0.2s;
    }
    .modal-input:focus { border-color: #22c55e; background: #fff; box-shadow: 0 0 0 3px rgba(34,197,94,0.12); }
    .modal-input-wrap { position: relative; }
    .modal-input-icon {
        position: absolute; left: 0.8rem; top: 50%; transform: translateY(-50%);
        color: #9ca3af; display: flex; align-items: center; pointer-events: none;
    }
    .modal-hint { font-size: 0.75rem; color: #64748b; margin-top: 0.4rem; }
    .modal-error { font-size: 0.78rem; color: #dc2626; margin-top: 0.3rem; font-weight: 500; }
    .modal-actions {
        display: flex; gap: 0.75rem; margin-top: 1.5rem;
    }
    .btn-wa {
        flex: 1; padding: 0.75rem; border: none; border-radius: 0.625rem;
        font-weight: 700; font-size: 0.9rem; cursor: pointer;
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: white; display: flex; align-items: center; justify-content: center;
        gap: 0.4rem; transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(22,163,74,0.3);
    }
    .btn-wa:hover { background: linear-gradient(135deg, #15803d, #166534); transform: translateY(-1px); }
    .btn-cancel {
        padding: 0.75rem 1.25rem; border: 1.5px solid #e2e8f0;
        border-radius: 0.625rem; background: white; color: #64748b;
        font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.15s;
    }
    .btn-cancel:hover { background: #f1f5f9; color: #374151; }

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

        {{-- Flash success --}}
        @if(session('success'))
            <div style="margin:1rem 1.5rem 0; display:flex; align-items:center; gap:0.6rem; background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; padding:0.75rem 1rem; border-radius:0.75rem; font-size:0.875rem;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Warning banner jika ada panitia tanpa nomor WA --}}
        @php $missingPhone = $panitias->whereNull('phone')->count(); @endphp
        @if($missingPhone > 0)
            <div class="wa-warning-banner">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.834-1.964-.834-2.732 0L3.07 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                <span>
                    <strong>Perhatian:</strong> Terdapat <strong>{{ $missingPhone }} akun panitia</strong> yang belum memiliki nomor WhatsApp.
                    Panitia tersebut tidak dapat login via OTP. Klik tombol <strong>"Tambah WA"</strong> di kolom No. WhatsApp untuk melengkapinya.
                </span>
            </div>
        @endif

        @if($panitias->count())
            <div style="overflow-x:auto;">
                <table class="panitia-table">
                    <thead>
                        <tr>
                            <th>Organisasi / Kepanitiaan</th>
                            <th>Email Login</th>
                            <th>No. WhatsApp (OTP)</th>
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
                            <td data-label="No. WA">
                                @if($panitia->phone)
                                    <span class="phone-chip">
                                        <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                                        {{ $panitia->phone }}
                                    </span>
                                @else
                                    <div style="display:flex; align-items:center; gap:0.5rem; flex-wrap:wrap;">
                                        <span class="phone-missing">
                                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Belum ada
                                        </span>
                                        <button type="button"
                                            onclick="openPhoneModal({{ $panitia->id }}, '{{ addslashes($panitia->name) }}')"
                                            style="display:inline-flex; align-items:center; gap:0.3rem; padding:0.25rem 0.65rem; background:#16a34a; color:white; border:none; border-radius:9999px; font-size:0.72rem; font-weight:700; cursor:pointer; transition:all 0.15s;"
                                            onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#16a34a'">
                                            <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                            Tambah WA
                                        </button>
                                    </div>
                                @endif
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
                                <form action="{{ route('admin.panitia.destroy', $panitia) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun panitia ini?');" style="display:inline-block;">
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

{{-- ====== MODAL TAMBAH NO. WA ====== --}}
<div class="modal-overlay" id="phoneModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closePhoneModal()" type="button">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <div class="modal-title">
            <svg width="22" height="22" fill="currentColor" style="color:#16a34a;" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            </svg>
            Tambah No. WhatsApp
        </div>
        <div class="modal-subtitle">
            Menambahkan nomor WA untuk <strong id="modalPanitiaName">—</strong>.<br>
            Nomor ini digunakan untuk menerima kode OTP saat login.
        </div>

        <form id="phoneModalForm" method="POST" action="">
            @csrf
            @method('PATCH')

            <label class="modal-label" for="modal_phone">Nomor WhatsApp</label>
            <div class="modal-input-wrap">
                <span class="modal-input-icon">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    </svg>
                </span>
                <input type="text" id="modal_phone" name="phone"
                    class="modal-input"
                    placeholder="Contoh: 081234567890"
                    autofocus>
            </div>
            <div class="modal-hint">Format: 08xxxxxxx, 628xxxxxxx, atau +628xxxxxxx</div>

            <div class="modal-actions">
                <button type="submit" class="btn-wa">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Nomor WA
                </button>
                <button type="button" class="btn-cancel" onclick="closePhoneModal()">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const phoneModal   = document.getElementById('phoneModal');
    const phoneForm    = document.getElementById('phoneModalForm');
    const modalName    = document.getElementById('modalPanitiaName');
    const phoneInput   = document.getElementById('modal_phone');

    function openPhoneModal(id, name) {
        modalName.textContent = name;
        phoneForm.action = `/admin/panitia/${id}/update-phone`;
        phoneInput.value = '';
        phoneModal.classList.add('active');
        setTimeout(() => phoneInput.focus(), 100);
    }

    function closePhoneModal() {
        phoneModal.classList.remove('active');
    }

    // Tutup modal jika klik di luar box
    phoneModal.addEventListener('click', function(e) {
        if (e.target === phoneModal) closePhoneModal();
    });

    // Tutup dengan Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closePhoneModal();
    });
</script>
@endpush
