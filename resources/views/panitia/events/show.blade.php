@extends('layouts.app')

@section('title', $event->title)
@section('page-title', 'Detail Event Saya')
@section('page-breadcrumb', '<a href="' . route('panitia.events.index') . '" style="color:#94a3b8;">Event</a> / <span>Detail</span>')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
    <h1 style="font-size:1.5rem;font-weight:800;color:#1e293b;">Manajemen Event: {{ $event->title }}</h1>
    <div style="display:flex;gap:0.75rem;">
        <a href="{{ route('panitia.events.edit', $event) }}" class="btn btn-warning">
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            Edit Event
        </a>
        <a href="{{ route('panitia.events.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 3fr;gap:1.5rem;align-items:start;">

    {{-- LEFT: Info & Poster --}}
    <div style="display:flex;flex-direction:column;gap:1.5rem;">
        <div class="form-card">
            @if($event->poster)
                <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}" style="width:100%;object-fit:cover;border-bottom:1px solid #e5e7eb;">
            @else
                <div style="height:150px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;border-bottom:1px solid #e5e7eb;color:#94a3b8;">
                    Tanpa Poster
                </div>
            @endif
            <div style="padding:1.25rem;">
                <div style="margin-bottom:1rem;">
                    <div style="font-size:0.75rem;color:#94a3b8;font-weight:600;text-transform:uppercase;">Tanggal Event</div>
                    <div style="font-weight:600;color:#1e293b;margin-top:0.25rem;">{{ $event->event_date->format('d M Y, H:i') }} WIB</div>
                </div>
                <div style="margin-bottom:1rem;">
                    <div style="font-size:0.75rem;color:#94a3b8;font-weight:600;text-transform:uppercase;">Kuota Event</div>
                    @php $pct = $event->quota > 0 ? min(100, round(($event->approved_registrations_count / $event->quota) * 100)) : 0; @endphp
                    <div style="display:flex;justify-content:space-between;margin-bottom:0.25rem;margin-top:0.25rem;font-size:0.8rem;font-weight:600;color:#1e293b;">
                        <span>{{ $event->approved_registrations_count }} / {{ $event->quota }}</span>
                        <span style="color:#059669;">{{ $pct }}%</span>
                    </div>
                    <div class="quota-bar" style="height:6px;margin:0;">
                        <div class="quota-bar-fill {{ $pct >= 100 ? 'full' : '' }}" style="width:{{ $pct }}%"></div>
                    </div>
                </div>
                <div>
                    <div style="font-size:0.75rem;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-bottom:0.25rem;">Deskripsi Singkat</div>
                    <div style="font-size:0.8rem;color:#4b5563;line-height:1.6;display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;">
                        {{ $event->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT: Participants Table --}}
    <div>
        <div class="table-wrapper">
            <div class="table-header">
                <h3>👥 Daftar Pendaftar Event Ini</h3>
                <div class="status-badge status-approved">
                    Total: {{ $registrations->total() }} Pendaftar
                </div>
            </div>
            
            @if($registrations->count())
                <table>
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $reg)
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
                                                <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                            </form>
                                            <form method="POST" action="{{ route('panitia.registrations.reject', $reg) }}">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
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
                <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
                    {{ $registrations->links() }}
                </div>
            @else
                <div class="empty-state" style="padding:4rem;">
                    <div class="empty-state-icon">👥</div>
                    <h3>Belum ada pendaftar</h3>
                    <p>Pendaftar untuk event ini akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
