@extends('layouts.app')

@section('title', 'Buat Event Baru')
@section('page-title', 'Buat Event Baru')
@section('page-breadcrumb', '<a href="' . route('panitia.events.index') . '" style="color:#94a3b8;">Event</a> / <span>Buat Baru</span>')

@section('content')

<div style="max-width:720px;">
    <div class="form-card">
        <div class="form-card-header">
            <h3>📝 Form Buat Event</h3>
            <a href="{{ route('panitia.events.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>
        <div class="form-card-body">
            <form method="POST" action="{{ route('panitia.events.store') }}" enctype="multipart/form-data" id="form-create-event">
                @csrf

                <div class="form-group">
                    <label class="form-label">Judul Event <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
                        placeholder="Contoh: Seminar Teknologi Informasi 2025">
                    @error('title') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Event <span style="color:#dc2626;">*</span></label>
                    <textarea name="description" id="description" rows="5"
                        class="form-input {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        placeholder="Deskripsikan event Anda secara lengkap...">{{ old('description') }}</textarea>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Tanggal & Waktu <span style="color:#dc2626;">*</span></label>
                        <input type="datetime-local" name="event_date" id="event_date" value="{{ old('event_date') }}"
                            class="form-input {{ $errors->has('event_date') ? 'is-invalid' : '' }}">
                        @error('event_date') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kuota Peserta <span style="color:#dc2626;">*</span></label>
                        <input type="number" name="quota" id="quota" value="{{ old('quota') }}"
                            class="form-input {{ $errors->has('quota') ? 'is-invalid' : '' }}"
                            placeholder="Contoh: 100" min="1" max="10000">
                        <div class="form-hint">Maksimum jumlah peserta yang dapat diterima</div>
                        @error('quota') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Poster Event <span style="color:#94a3b8;font-weight:400;">(opsional, maks 2MB)</span></label>
                    <input type="file" name="poster" id="poster" accept="image/*"
                        class="form-input" style="padding:0.5rem;">
                    <div class="form-hint">Format: JPG, PNG, GIF. Ukuran: maks 2MB</div>
                    @error('poster') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:0.5rem;padding:0.75rem;margin-bottom:1.5rem;font-size:0.8rem;color:#1d4ed8;display:flex;gap:0.5rem;align-items:flex-start;">
                    <svg style="width:16px;height:16px;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Event yang Anda buat hanya dapat dikelola oleh Anda sendiri. Mahasiswa dapat mendaftar setelah event dibuat.
                </div>

                <div style="display:flex;gap:0.75rem;">
                    <button type="submit" class="btn btn-primary" id="btn-submit-event">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Event
                    </button>
                    <a href="{{ route('panitia.events.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
