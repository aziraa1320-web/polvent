@extends('layouts.app')

@section('title', $event->title)
@section('page-title', 'Detail Event')
@section('page-breadcrumb')
    <a href="{{ route('mahasiswa.events.index') }}" style="color:#94a3b8;">Event</a> / <span>{{ $event->title }}</span>
@endsection

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
                    @php
                        $hasProfile = $user->jurusan || $user->program_studi || $user->angkatan;
                    @endphp

                    @if(!$hasProfile)
                        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:0.625rem;padding:0.75rem 1rem;margin-bottom:1rem;display:flex;align-items:flex-start;gap:0.5rem;">
                            <svg style="width:16px;height:16px;color:#d97706;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div style="font-size:0.78rem;color:#92400e;line-height:1.5;">
                                Lengkapi <a href="{{ route('mahasiswa.profile.edit') }}" style="color:#d97706;font-weight:700;text-decoration:underline;">profil Anda</a> agar data terpenuhi otomatis saat mendaftar event.
                            </div>
                        </div>
                    @else
                        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:0.625rem;padding:0.75rem 1rem;margin-bottom:1rem;display:flex;align-items:flex-start;gap:0.5rem;">
                            <svg style="width:16px;height:16px;color:#16a34a;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div style="font-size:0.78rem;color:#166534;line-height:1.5;">
                                Data diisi otomatis dari <strong>profil Anda</strong>. Periksa dan sesuaikan jika diperlukan.
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('mahasiswa.events.register') }}" id="form-daftar-event">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">

                        <div class="form-group">
                            <label class="form-label">
                                Nama Lengkap <span style="color:#dc2626;">*</span>
                            </label>
                            <div style="position:relative;">
                                <span style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;display:flex;align-items:center;">
                                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </span>
                                <input type="text" name="nama_lengkap"
                                       class="form-input @error('nama_lengkap') is-invalid @enderror"
                                       style="padding-left:2.2rem;"
                                       value="{{ old('nama_lengkap', auth()->user()->name) }}"
                                       placeholder="Nama sesuai KTM" required>
                            </div>
                            @error('nama_lengkap') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                NIM <span style="color:#dc2626;">*</span>
                            </label>
                            <div style="position:relative;">
                                <span style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;display:flex;align-items:center;">
                                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/></svg>
                                </span>
                                <input type="text" name="nim"
                                       class="form-input @error('nim') is-invalid @enderror"
                                       style="padding-left:2.2rem;"
                                       value="{{ old('nim', auth()->user()->nim) }}"
                                       placeholder="Nomor Induk Mahasiswa" required>
                            </div>
                            @error('nim') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Jurusan <span style="color:#dc2626;">*</span>
                            </label>
                            <div style="position:relative;">
                                <span style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;display:flex;align-items:center;">
                                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </span>
                                <input type="text" name="jurusan"
                                       class="form-input @error('jurusan') is-invalid @enderror"
                                       style="padding-left:2.2rem;"
                                       value="{{ old('jurusan', auth()->user()->jurusan) }}"
                                       placeholder="Contoh: Teknik Informatika" required>
                            </div>
                            @error('jurusan') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Program Studi <span style="color:#dc2626;">*</span>
                            </label>
                            <div style="position:relative;">
                                <span style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;display:flex;align-items:center;">
                                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                </span>
                                <input type="text" name="program_studi"
                                       class="form-input @error('program_studi') is-invalid @enderror"
                                       style="padding-left:2.2rem;"
                                       value="{{ old('program_studi', auth()->user()->program_studi) }}"
                                       placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                            </div>
                            @error('program_studi') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group" style="margin-bottom:1.25rem;">
                            <label class="form-label">
                                Angkatan <span style="color:#dc2626;">*</span>
                            </label>
                            <div style="position:relative;">
                                <span style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;display:flex;align-items:center;">
                                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </span>
                                <input type="number" name="angkatan"
                                       class="form-input @error('angkatan') is-invalid @enderror"
                                       style="padding-left:2.2rem;"
                                       value="{{ old('angkatan', auth()->user()->angkatan) }}"
                                       placeholder="Contoh: 2023"
                                       min="2000" max="{{ date('Y') + 1 }}" required>
                            </div>
                            @error('angkatan') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary"
                                style="width:100%;justify-content:center;padding:0.75rem;font-size:0.9rem;"
                                id="btn-daftar-event">
                            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Kirim Pendaftaran
                        </button>
                    </form>

                    @push('scripts')
                    <script>
                    document.getElementById('form-daftar-event').addEventListener('submit', function(e) {
                        if (!confirm('Apakah Anda yakin data yang diisi sudah benar?')) {
                            e.preventDefault();
                            return;
                        }
                        const btn = document.getElementById('btn-daftar-event');
                        btn.disabled = true;
                        btn.innerHTML = `<svg style="width:18px;height:18px;animation:spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Mengirim...`;
                    });
                    </script>
                    @endpush
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
