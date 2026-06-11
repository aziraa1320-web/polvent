@extends('layouts.app')

@section('title', 'Semua Event')
@section('page-title', 'Kelola Event')
@section('page-breadcrumb')
    Admin / <span>Event</span>
@endsection

@section('content')

<div class="table-wrapper">
    <div class="table-header">
        <h3>📅 Daftar Seluruh Event di Sistem</h3>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Event Baru
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Event</th>
                <th>Panitia/Kreator</th>
                <th>Tanggal</th>
                <th>Kuota & Pendaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                @php $pct = $event->quota > 0 ? min(100, round(($event->approved_registrations_count ?? 0) / $event->quota * 100)) : 0; @endphp
                <tr>
                    <td style="color:#94a3b8;">{{ $loop->iteration + ($events->currentPage() - 1) * $events->perPage() }}</td>
                    <td>
                        <div style="font-weight:600;color:#1e293b;">{{ $event->title }}</div>
                        <div style="font-size:0.75rem;color:#64748b;margin-top:2px;">ID: {{ $event->id }}</div>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.4rem;">
                            <div style="width:24px;height:24px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.6rem;color:#374151;flex-shrink:0;">
                                {{ strtoupper(substr($event->panitia->name ?? $event->creator->name ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:500;color:#374151;font-size:0.8rem;">
                                    {{ $event->panitia->name ?? $event->creator->name ?? 'Admin' }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:500;">{{ $event->event_date->format('d M Y') }}</div>
                        <div style="font-size:0.75rem;color:#64748b;">{{ $event->event_date->format('H:i') }} WIB</div>
                    </td>
                    <td>
                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;margin-bottom:0.25rem;">
                            <span style="font-weight:600;color:#059669;">{{ $event->registrations_count ?? 0 }} daftar</span>
                            <span style="color:#94a3b8;">Max: {{ $event->quota }}</span>
                        </div>
                        <div class="quota-bar" style="width:100%;max-width:140px;">
                            <div class="quota-bar-fill {{ $pct >= 100 ? 'full' : '' }}" style="width:{{ $pct }}%"></div>
                        </div>
                    </td>
                    <td>
                        <div style="display:flex;gap:0.375rem;flex-wrap:wrap;">
                            <a href="{{ route('admin.events.show', $event) }}" class="btn btn-secondary btn-sm" title="Detail">
                                <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning btn-sm" title="Edit">
                                <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                                onsubmit="return confirm('PERINGATAN ADMIN: Yakin ingin menghapus event ini? Semua data pendaftaran akan ikut terhapus!')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state" style="padding:3rem;">
                            <div class="empty-state-icon">📅</div>
                            <h3>Belum ada event</h3>
                            <p>Sistem saat ini belum memiliki event satupun.</p>
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
