@extends('layouts.app')

@section('title', 'Kelola Panitia')
@section('page-title', 'Manajemen Panitia')
@section('page-breadcrumb')
    Admin / <span>Kelola Panitia</span>
@endsection

@section('content')

<div class="card-section" style="margin-bottom:1.5rem;">
    <div class="card-section-header">
        <h3>
            <svg width="18" height="18" fill="none" stroke="#0056B3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Daftar Akun Panitia (UKM/HMJ)
        </h3>
        <a href="{{ route('admin.panitia.create') }}" class="btn btn-primary btn-sm">
            + Tambah Panitia
        </a>
    </div>

    @if($panitias->count())
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Nama Organisasi/Kepanitiaan</th>
                        <th>Email Login</th>
                        <th>Status Verifikasi</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($panitias as $panitia)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <div class="user-avatar" style="width:36px;height:36px;flex-shrink:0;background:#eff6ff;color:#0056B3;">
                                        {{ strtoupper(substr($panitia->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:700;color:#1e293b;">{{ $panitia->name }}</div>
                                        <div style="font-size:0.75rem;color:#64748b;">Ditambahkan: {{ $panitia->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-weight:500;">{{ $panitia->email }}</td>
                            <td>
                                @if($panitia->is_otp_verified)
                                    <span class="status-badge status-approved">Terverifikasi</span>
                                @else
                                    <span class="status-badge status-pending">Belum Verifikasi</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <form action="{{ route('admin.panitia.destroy', $panitia) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun panitia ini? Seluruh data event miliknya juga dapat terpengaruh.');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Panitia">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
        <div class="empty-state">
            <div class="empty-state-icon">👥</div>
            <h3>Belum ada Panitia</h3>
            <p>Anda belum menambahkan akun panitia (UKM/HMJ) apapun.</p>
            <a href="{{ route('admin.panitia.create') }}" class="btn btn-primary" style="margin-top:1rem;">Tambah Panitia Sekarang</a>
        </div>
    @endif
</div>

@endsection
