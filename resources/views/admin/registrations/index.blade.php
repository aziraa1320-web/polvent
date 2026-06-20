@extends('layouts.app')

@section('title', 'Kelola Peserta')
@section('page-title', 'Kelola Peserta')
@section('page-breadcrumb')
    Panitia / <span>Registrasi</span>
@endsection

@section('content')

<div class="page-header">
    <h1>Monitoring Pendaftaran Mahasiswa</h1>
    <p>Kelola dan pantau seluruh pendaftaran mahasiswa pada semua event di sistem</p>
</div>

<div class="table-wrapper">
    <div class="table-header">
        <h3>👥 Semua Pendaftaran Event</h3>
        
        <form method="GET" action="{{ route('admin.registrations.index') }}" style="display:flex;gap:0.5rem;align-items:center;">
            <select name="event_id" class="form-input" style="padding:0.4rem 0.75rem;width:auto;" onchange="this.form.submit()">
                <option value="">Semua Event</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>{{ $event->title }}</option>
                @endforeach
            </select>
            <select name="status" class="form-input" style="padding:0.4rem 0.75rem;width:auto;" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </form>
    </div>

    @if($registrations->count())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mahasiswa</th>
                    <th>Event</th>
                    <th>Waktu Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $reg)
                    <tr>
                        <td style="color:#94a3b8;">{{ $loop->iteration + ($registrations->currentPage() - 1) * $registrations->perPage() }}</td>
                        <td>
                            <div style="font-weight:600;color:#1e293b;">{{ $reg->user->name }}</div>
                            @if($reg->user->nim)
                                <div style="font-size:0.75rem;color:#64748b;">NIM: {{ $reg->user->nim }}</div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.events.show', $reg->event) }}" style="font-weight:500;color:#1d4ed8;text-decoration:none;">{{ $reg->event->title }}</a>
                            <div style="font-size:0.75rem;color:#64748b;">Kuota: {{ $reg->event->approvedRegistrations()->count() }}/{{ $reg->event->quota }}</div>
                        </td>
                        <td style="font-size:0.82rem;color:#64748b;">
                            {{ $reg->created_at->format('d M Y') }}<br>
                            <span style="font-size:0.72rem;">{{ $reg->created_at->format('H:i') }} WIB</span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $reg->status }}">
                                {{ $reg->status === 'pending' ? 'Menunggu' : ($reg->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex;gap:0.4rem;flex-wrap:wrap;">
                                @if($reg->status === 'pending')
                                    <form method="POST" action="{{ route('admin.registrations.approve', $reg) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" title="Setujui">✓ Setuju</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.registrations.reject', $reg) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Tolak">✗ Tolak</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.registrations.destroy', $reg) }}" onsubmit="return confirm('Yakin ingin menghapus pendaftaran {{ $reg->user->name }} dari event {{ $reg->event->title }}?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:1px solid #fca5a5;" title="Hapus Pendaftaran">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
            {{ $registrations->links() }}
        </div>
    @else
        <div class="empty-state" style="padding:4rem;">
            <div class="empty-state-icon">👥</div>
            <h3>Tidak ada data</h3>
            @if(request('status') || request('event_id'))
                <p>Belum ada pendaftaran dengan filter ini</p>
                <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary btn-sm" style="margin-top:1rem;">Reset Filter</a>
            @else
                <p>Belum ada mahasiswa yang mendaftar ke event manapun.</p>
            @endif
        </div>
    @endif
</div>

@endsection
