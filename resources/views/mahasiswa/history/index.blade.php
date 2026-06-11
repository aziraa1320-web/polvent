@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran')
@section('page-title', 'Riwayat Pendaftaran')
@section('page-breadcrumb')
    Mahasiswa / <span>Riwayat</span>
@endsection

@section('content')

<div class="page-header">
    <h1>Riwayat Pendaftaran Event</h1>
    <p>Semua event yang pernah Anda daftarkan</p>
</div>

<div class="table-wrapper">
    <div class="table-header">
        <h3>📋 Semua Pendaftaran</h3>
        <a href="{{ route('mahasiswa.events.index') }}" class="btn btn-primary btn-sm">
            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Daftar Event Baru
        </a>
    </div>

    @if($registrations->count())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Event</th>
                    <th>Tanggal Event</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $reg)
                    <tr>
                        <td style="color:#94a3b8;">{{ $loop->iteration + ($registrations->currentPage() - 1) * $registrations->perPage() }}</td>
                        <td>
                            <div style="font-weight:600;color:#1e293b;">{{ $reg->event->title }}</div>
                            <div style="font-size:0.75rem;color:#64748b;margin-top:2px;">Kuota: {{ $reg->event->quota }} orang</div>
                        </td>
                        <td>
                            <div>{{ $reg->event->event_date->format('d M Y') }}</div>
                            <div style="font-size:0.75rem;color:#64748b;">{{ $reg->event->event_date->format('H:i') }} WIB</div>
                        </td>
                        <td style="color:#64748b;font-size:0.82rem;">
                            {{ $reg->created_at->format('d M Y') }}<br>
                            <span style="font-size:0.72rem;">{{ $reg->created_at->format('H:i') }} WIB</span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $reg->status }}">
                                {{ $reg->status === 'pending' ? 'Menunggu' : ($reg->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('mahasiswa.events.show', $reg->event) }}" class="btn btn-secondary btn-sm">
                                <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
            {{ $registrations->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📝</div>
            <h3>Belum ada riwayat pendaftaran</h3>
            <p>Mulai daftar event kampus pertama Anda sekarang!</p>
            <a href="{{ route('mahasiswa.events.index') }}" class="btn btn-primary btn-sm" style="margin-top:1rem;">
                Jelajahi Event
            </a>
        </div>
    @endif
</div>

@endsection
