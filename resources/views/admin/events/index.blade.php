@extends('layouts.app')

@section('title', 'Kelola Event')
@section('page-title', 'Kelola Event')

@section('content')
<div class="table-wrapper">
    <div class="table-header">
        <h3>📅 Daftar Semua Event</h3>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm" id="btn-tambah-event">
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Event
        </a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Event</th>
                <th>Tanggal</th>
                <th>Kuota</th>
                <th>Pendaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
            <tr>
                <td style="color:#94a3b8;">{{ $loop->iteration }}</td>
                <td>
                    <div style="font-weight:600;color:#1e293b;">{{ $event->title }}</div>
                    <div style="font-size:0.75rem;color:#64748b;margin-top:2px;">
                        Oleh: {{ $event->creator->name ?? '-' }}
                    </div>
                </td>
                <td>
                    <div>{{ $event->event_date->format('d M Y') }}</div>
                    <div style="font-size:0.75rem;color:#64748b;">{{ $event->event_date->format('H:i') }} WIB</div>
                </td>
                <td>{{ $event->quota }} orang</td>
                <td>
                    <span style="font-weight:700;color:#0056B3;">{{ $event->registrations_count }}</span>
                    <span style="color:#94a3b8;font-size:0.8rem;">/ {{ $event->quota }}</span>
                </td>
                <td>
                    <div style="display:flex;gap:0.4rem;flex-wrap:wrap;">
                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-secondary btn-sm">Detail</a>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                            onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:#64748b;padding:3rem;">
                    <div style="font-size:2rem;margin-bottom:0.5rem;">📭</div>
                    Belum ada event. <a href="{{ route('admin.events.create') }}" style="color:#0056B3;">Buat sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
        {{ $events->links() }}
    </div>
</div>
@endsection
