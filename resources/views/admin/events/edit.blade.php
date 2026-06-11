@extends('layouts.app')

@section('title', 'Edit Event (Admin)')
@section('page-title', 'Edit Event')
@section('page-breadcrumb')
    <a href="{{ route('admin.events.index') }}" style="color:#94a3b8;">Event</a> / <span>Edit</span>
@endsection

@section('content')

<div style="max-width:720px;">
    <div class="form-card">
        <div class="form-card-header">
            <h3>✏️ Edit Event (Admin): <span style="color:#0056B3;">{{ $event->title }}</span></h3>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>
        <div class="form-card-body">
            <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-group">
                    <label class="form-label">Judul Event <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}"
                        class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}">
                    @error('title') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Event <span style="color:#dc2626;">*</span></label>
                    <textarea name="description" rows="5"
                        class="form-input {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $event->description) }}</textarea>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Tanggal & Waktu <span style="color:#dc2626;">*</span></label>
                        <input type="datetime-local" name="event_date"
                            value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}"
                            class="form-input {{ $errors->has('event_date') ? 'is-invalid' : '' }}">
                        @error('event_date') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kuota Peserta <span style="color:#dc2626;">*</span></label>
                        <input type="number" name="quota"
                            value="{{ old('quota', $event->quota) }}"
                            class="form-input {{ $errors->has('quota') ? 'is-invalid' : '' }}"
                            min="1" max="10000">
                        <div class="form-hint">Saat ini {{ $event->registrations()->count() }} peserta sudah mendaftar</div>
                        @error('quota') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Poster Event <span style="color:#94a3b8;font-weight:400;">(kosongkan jika tidak ingin mengubah)</span></label>
                    @if($event->poster)
                        <div style="margin-bottom:0.625rem;display:flex;align-items:center;gap:0.75rem;">
                            <img src="{{ Storage::url($event->poster) }}" alt="Poster"
                                style="width:80px;height:50px;object-fit:cover;border-radius:0.5rem;border:1px solid #e5e7eb;">
                        </div>
                    @endif
                    <input type="file" name="poster" accept="image/*" class="form-input" style="padding:0.5rem;">
                    @error('poster') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div style="display:flex;gap:0.75rem;">
                    <button type="submit" class="btn btn-primary">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
