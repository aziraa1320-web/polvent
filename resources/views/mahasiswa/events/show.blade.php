@extends('layouts.app')

@section('title', $event->title)
@section('page-title', 'Detail Event')
@section('page-breadcrumb', '<a href="' . route('mahasiswa.events.index') . '" style="color:#94a3b8;">Event</a> / <span>' . e($event->title) . '</span>')

@section('content')

<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;align-items:start;">

    {{-- ===== LEFT: Event Info ===== --}}
    <div>
        {{-- Poster / Banner --}}
        <div style="border-radius:1rem;overflow:hidden;margin-bottom:1.5rem;box-shadow:0 4px 20px rgba(0,0,0,0.08);">
            @if($event->poster)
                <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}"
                    style="width:100%;max-height:360px;object-fit:cover;">
            @else
                <div style="height:220px;background:linear-gradient(135deg,#0056B3,#001f4d);display:flex;align-items:center;justify-content:center;">
                    <span style="font-size:5rem;">🎓</span>
                </div>
            @endif
        </div>

        {{-- Event Details --}}
        <div class="table-wrapper" style="margin-bottom:1.5rem;">
            <div class="table-header">
                <h3>📋 Detail Event</h3>
                <div class="event-date-badge">📅 {{ $event->event_date->format('d M Y, H:i') }} WIB</div>
            </div>
            <div style="padding:1.5rem;">
                <h1 style="font-size:1.5rem;font-weight:800;color:#1e293b;margin-bottom:1.25rem;line-height:1.3;">{{ $event->title }}</h1>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem;">
                    <div style="background:#f8fafc;border-radius:0.75rem;padding:1rem;">
                        <div style="font-size:0.72rem;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.3rem;">Tanggal & Waktu</div>
                        <div style="font-weight:700;color:#1e293b;">{{ $event->event_date->format('d M Y') }}</div>
                        <div style="font-size:0.82rem;color:#64748b;">{{ $event->event_date->format('H:i') }} WIB</div>
                    </div>
                    <div style="background:#f8fafc;border-radius:0.75rem;padding:1rem;">
                        <div style="font-size:0.72rem;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.3rem;">Kuota Peserta</div>
                        <div style="font-weight:700;color:#1e293b;">{{ $event->quota }} orang</div>
                        <div style="font-size:0.82rem;color:#64748b;">{{ $event->approved_registrations_count }} sudah disetujui</div>
                    </div>
                </div>

                <div style="margin-bottom:1.5rem;">
                    <div style="font-size:0.8rem;font-weight:700;color:#374151;margin-bottom:0.625rem;">Deskripsi Event</div>
                    <div style="color:#4b5563;font-size:0.9rem;line-height:1.8;white-space:pre-line;">{{ $event->description }}</div>
                </div>

                {{-- Quota Bar --}}
                @php
                    $pct = $event->quota > 0 ? min(100, round(($event->approved_registrations_count / $event->quota) * 100)) : 0;
                @endphp
                <div>
                    <div style="display:flex;justify-content:space-between;font-size:0.78rem;color:#64748b;margin-bottom:0.4rem;">
                        <span>Kuota terisi</span>
                        <span>{{ $event->approved_registrations_count }} / {{ $event->quota }}</span>
                    </div>
                    <div class="quota-bar" style="height:8px;">
                        <div class="quota-bar-fill {{ $pct >= 100 ? 'full' : '' }}" style="width:{{ $pct }}%"></div>
                    </div>
                    <div style="font-size:0.75rem;color:#94a3b8;margin-top:0.4rem;">{{ $event->quota - $event->approved_registrations_count }} slot tersisa</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== RIGHT: Registration Panel ===== --}}
    <div>
        <div class="table-wrapper" style="position:sticky;top:80px;">
            <div class="table-header">
                <h3>📝 Pendaftaran</h3>
            </div>
            <div style="padding:1.5rem;">

                @if($userRegistration)
                    {{-- Already registered --}}
                    <div style="text-align:center;padding:1rem 0;">
                        <div style="font-size:2.5rem;margin-bottom:0.875rem;">
                            {{ $userRegistration->status === 'approved' ? '✅' : ($userRegistration->status === 'rejected' ? '❌' : '⏳') }}
                        </div>
                        <div style="font-weight:700;color:#1e293b;margin-bottom:0.375rem;">Status Pendaftaran Anda</div>
                        <span class="status-badge status-{{ $userRegistration->status }}" style="font-size:0.845rem;padding:0.4rem 1rem;">
                            {{ $userRegistration->status === 'pending' ? 'Menunggu Verifikasi' : ($userRegistration->status === 'approved' ? 'Disetujui ✓' : 'Ditolak') }}
                        </span>
                        <div style="font-size:0.78rem;color:#94a3b8;margin-top:1rem;">
                            Didaftarkan: {{ $userRegistration->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    @if($userRegistration->status === 'approved')
                        <div style="background:#d1fae5;border:1px solid #a7f3d0;border-radius:0.625rem;padding:0.875rem;font-size:0.82rem;color:#065f46;margin-top:1rem;">
                            🎉 Selamat! Pendaftaran Anda telah disetujui. Hadir tepat waktu ya!
                        </div>
                    @elseif($userRegistration->status === 'pending')
                        <div style="background:#fef3c7;border:1px solid #fde68a;border-radius:0.625rem;padding:0.875rem;font-size:0.82rem;color:#92400e;margin-top:1rem;">
                            ⏳ Pendaftaran sedang diproses oleh panitia. Mohon tunggu konfirmasi.
                        </div>
                    @endif

                @elseif($event->approved_registrations_count >= $event->quota)
                    {{-- Full --}}
                    <div style="text-align:center;padding:1rem 0;">
                        <div style="font-size:2.5rem;margin-bottom:0.875rem;">😔</div>
                        <div style="font-weight:700;color:#1e293b;margin-bottom:0.5rem;">Kuota Penuh</div>
                        <div style="font-size:0.845rem;color:#64748b;">Maaf, kuota pendaftaran event ini sudah habis.</div>
                    </div>

                @else
                    {{-- Register form --}}
                    <div style="margin-bottom:1.25rem;">
                        <div style="font-size:0.82rem;color:#64748b;line-height:1.6;">
                            Daftarkan diri Anda ke event ini. Pendaftaran perlu diverifikasi oleh panitia.
                        </div>
                    </div>

                    <div style="background:#f8fafc;border-radius:0.75rem;padding:0.875rem;margin-bottom:1.25rem;">
                        <div style="font-size:0.75rem;color:#64748b;margin-bottom:0.25rem;">Nama Pendaftar</div>
                        <div style="font-weight:700;color:#1e293b;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                        @if(auth()->user()->nim)
                            <div style="font-size:0.78rem;color:#64748b;">NIM: {{ auth()->user()->nim }}</div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('mahasiswa.events.register') }}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:0.75rem;" id="btn-daftar-event"
                            onclick="return confirm('Konfirmasi pendaftaran event: {{ $event->title }}?')">
                            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Daftar Event Ini
                        </button>
                    </form>
                @endif

                <div style="margin-top:1.25rem;padding-top:1.25rem;border-top:1px solid #f1f5f9;">
                    <a href="{{ route('mahasiswa.events.index') }}" class="btn btn-secondary" style="width:100%;justify-content:center;font-size:0.82rem;">
                        ← Kembali ke Daftar Event
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
