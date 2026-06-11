@extends('layouts.app')

@section('title', 'Event Saya')
@section('page-title', 'Event Saya')
@section('page-breadcrumb')
    Panitia / <span>Event</span>
@endsection

@section('content')

<div class="table-wrapper">
    <div class="table-header">
        <h3>📅 Daftar Event yang Saya Kelola</h3>
        <a href="{{ route('panitia.events.create') }}" class="btn btn-primary btn-sm" id="btn-tambah-event">
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Event Baru
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
                <th>Disetujui</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                @php $pct = $event->quota > 0 ? min(100, round(($event->approved_registrations_count / $event->quota) * 100)) : 0; @endphp
                <tr>
                    <td style="color:#94a3b8;">{{ $loop->iteration + ($events->currentPage() - 1) * $events->perPage() }}</td>
                    <td>
                        <div style="font-weight:600;color:#1e293b;">{{ $event->title }}</div>
                        <div style="margin-top:4px;">
                            <div class="quota-bar" style="width:120px;">
                                <div class="quota-bar-fill {{ $pct >= 100 ? 'full' : '' }}" style="width:{{ $pct }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:500;">{{ $event->event_date->format('d M Y') }}</div>
                        <div style="font-size:0.75rem;color:#64748b;">{{ $event->event_date->format('H:i') }} WIB</div>
                    </td>
                    <td>{{ $event->quota }} orang</td>
                    <td>
                        <span style="font-weight:700;color:#1d4ed8;">{{ $event->registrations_count }}</span>
                    </td>
                    <td>
                        <span style="font-weight:700;color:#059669;">{{ $event->approved_registrations_count }}</span>
                        <span style="color:#94a3b8;font-size:0.78rem;"> / {{ $event->quota }}</span>
                    </td>
                    <td>
                        <div style="display:flex;gap:0.375rem;flex-wrap:wrap;">
                            <a href="{{ route('panitia.events.show', $event) }}" class="btn btn-secondary btn-sm">Detail</a>
                            <a href="{{ route('panitia.events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{ route('panitia.events.destroy', $event) }}"
                                onsubmit="return confirm('Yakin ingin menghapus event ini? Semua pendaftaran akan ikut terhapus!')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state" style="padding:3rem;">
                            <div class="empty-state-icon">📅</div>
                            <h3>Belum ada event</h3>
                            <p>Mulai buat event pertama Anda untuk mahasiswa Polbeng</p>
                            <a href="{{ route('panitia.events.create') }}" class="btn btn-primary btn-sm" style="margin-top:1rem;">
                                Buat Event Sekarang
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($events->hasPages())
        <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">{{ $events->links() }}</div>
    @endif
</div>

@endsection
