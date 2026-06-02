@extends('layouts.app')

@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event Baru')

@section('content')
<div style="max-width:700px;">
    <div class="table-wrapper">
        <div class="table-header">
            <h3>📝 Form Tambah Event</h3>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>
        <div style="padding:1.5rem;">
            <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" id="form-create-event">
                @csrf

                <!-- Title -->
                <div style="margin-bottom:1.25rem;">
                    <label style="display:block;font-weight:600;font-size:0.875rem;color:#374151;margin-bottom:0.4rem;">
                        Judul Event <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        placeholder="Contoh: Seminar Keamanan Siber 2025"
                        style="width:100%;padding:0.625rem 0.875rem;border:1.5px solid {{ $errors->has('title') ? '#dc2626' : '#e5e7eb' }};border-radius:0.5rem;font-size:0.875rem;outline:none;transition:border 0.2s;"
                        onfocus="this.style.borderColor='#0056B3'" onblur="this.style.borderColor='{{ $errors->has('title') ? '#dc2626' : '#e5e7eb' }}'">
                    @error('title')
                        <div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div style="margin-bottom:1.25rem;">
                    <label style="display:block;font-weight:600;font-size:0.875rem;color:#374151;margin-bottom:0.4rem;">
                        Deskripsi <span style="color:#dc2626;">*</span>
                    </label>
                    <textarea name="description" id="description" rows="4"
                        placeholder="Deskripsi lengkap tentang event ini..."
                        style="width:100%;padding:0.625rem 0.875rem;border:1.5px solid {{ $errors->has('description') ? '#dc2626' : '#e5e7eb' }};border-radius:0.5rem;font-size:0.875rem;outline:none;resize:vertical;transition:border 0.2s;"
                        onfocus="this.style.borderColor='#0056B3'" onblur="this.style.borderColor='{{ $errors->has('description') ? '#dc2626' : '#e5e7eb' }}'">{{ old('description') }}</textarea>
                    @error('description')
                        <div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Event Date & Quota -->
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.25rem;">
                    <div>
                        <label style="display:block;font-weight:600;font-size:0.875rem;color:#374151;margin-bottom:0.4rem;">
                            Tanggal & Waktu <span style="color:#dc2626;">*</span>
                        </label>
                        <input type="datetime-local" name="event_date" id="event_date" value="{{ old('event_date') }}"
                            style="width:100%;padding:0.625rem 0.875rem;border:1.5px solid {{ $errors->has('event_date') ? '#dc2626' : '#e5e7eb' }};border-radius:0.5rem;font-size:0.875rem;outline:none;"
                            onfocus="this.style.borderColor='#0056B3'" onblur="this.style.borderColor='#e5e7eb'">
                        @error('event_date')
                            <div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:0.875rem;color:#374151;margin-bottom:0.4rem;">
                            Kuota Peserta <span style="color:#dc2626;">*</span>
                        </label>
                        <input type="number" name="quota" id="quota" value="{{ old('quota') }}"
                            placeholder="100" min="1"
                            style="width:100%;padding:0.625rem 0.875rem;border:1.5px solid {{ $errors->has('quota') ? '#dc2626' : '#e5e7eb' }};border-radius:0.5rem;font-size:0.875rem;outline:none;"
                            onfocus="this.style.borderColor='#0056B3'" onblur="this.style.borderColor='#e5e7eb'">
                        @error('quota')
                            <div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Poster -->
                <div style="margin-bottom:1.5rem;">
                    <label style="display:block;font-weight:600;font-size:0.875rem;color:#374151;margin-bottom:0.4rem;">
                        Poster Event <span style="color:#94a3b8;font-weight:400;">(opsional, maks 2MB)</span>
                    </label>
                    <input type="file" name="poster" id="poster" accept="image/*"
                        style="width:100%;padding:0.5rem;border:1.5px dashed #e5e7eb;border-radius:0.5rem;font-size:0.875rem;">
                    @error('poster')
                        <div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Security notice -->
                <div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:0.5rem;padding:0.75rem;margin-bottom:1.5rem;font-size:0.8rem;color:#0369a1;">
                    🔒 Data divalidasi server-side. SQL Injection & XSS dicegah secara otomatis via Eloquent ORM & Blade escaping.
                </div>

                <div style="display:flex;gap:0.75rem;">
                    <button type="submit" class="btn btn-primary" id="btn-submit-event">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Event
                    </button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
