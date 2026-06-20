@extends('layouts.app')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')
@section('page-breadcrumb')
    <a href="{{ route('panitia.events.index') }}" style="color:#94a3b8;">Event</a> / <span>Edit</span>
@endsection

@push('styles')
<style>
    .create-form-wrapper { max-width: 680px; margin: 0 auto; }
    .create-form-card {
        background: white;
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #cbd5e1;
        overflow: hidden;
    }
    .create-form-header {
        background: linear-gradient(135deg, #d97706, #b45309);
        padding: 1.5rem 1.75rem;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .create-form-header h3 {
        font-size: 1.1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .create-form-header p {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.75);
        margin-top: 0.25rem;
        font-weight: 400;
    }
    .create-form-body { padding: 1.75rem; }
    .field-group { margin-bottom: 1.5rem; }
    .field-group:last-child { margin-bottom: 0; }
    .field-label {
        display: block;
        font-weight: 600;
        font-size: 0.875rem;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    .field-label .required { color: #dc2626; margin-left: 2px; }
    .field-label .optional { color: #94a3b8; font-weight: 400; font-size: 0.78rem; }
    .field-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid #cbd5e1;
        border-radius: 0.625rem;
        font-size: 0.875rem;
        color: #1e293b;
        outline: none;
        transition: all 0.25s ease;
        background: #f8fafc;
    }
    .field-input:focus {
        border-color: #d97706;
        box-shadow: 0 0 0 3px rgba(217,119,6,0.15);
        background: white;
    }
    .field-input.is-invalid {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220,38,38,0.08);
    }
    .field-input::placeholder { color: #94a3b8; }
    textarea.field-input { resize: vertical; min-height: 120px; }
    select.field-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.25em 1.25em;
        padding-right: 2.5rem;
    }
    .field-hint { font-size: 0.76rem; color: #94a3b8; margin-top: 0.35rem; display: flex; align-items: center; gap: 0.3rem; }
    .field-error { color: #dc2626; font-size: 0.78rem; margin-top: 0.35rem; display: flex; align-items: center; gap: 0.3rem; }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .field-divider { height: 1px; background: #e2e8f0; margin: 1.75rem 0; }
    .field-section-label {
        font-size: 0.75rem;
        font-weight: 800;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .field-section-label::after { content: ''; flex: 1; height: 1.5px; background: #e2e8f0; }

    /* Poster area */
    .poster-current {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.875rem 1rem;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        margin-bottom: 0.75rem;
    }
    .poster-current img {
        width: 80px;
        height: 56px;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
    }
    .poster-current-info {
        flex: 1;
    }
    .poster-current-info strong {
        display: block;
        font-size: 0.845rem;
        color: #1e293b;
        font-weight: 600;
    }
    .poster-current-info span {
        font-size: 0.75rem;
        color: #64748b;
    }

    .poster-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 0.75rem;
        padding: 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        background: #fafbfc;
        position: relative;
    }
    .poster-upload-area:hover { border-color: #d97706; background: #fffbeb; }
    .poster-upload-area.has-file { border-color: #059669; background: #f0fdf4; }
    .poster-upload-text { font-size: 0.845rem; color: #64748b; }
    .poster-upload-text strong { color: #d97706; }
    .poster-upload-hint { font-size: 0.76rem; color: #94a3b8; margin-top: 0.25rem; }
    .poster-preview { display: none; margin-top: 0.75rem; border-radius: 0.75rem; overflow: hidden; border: 1px solid #e5e7eb; }
    .poster-preview img { width: 100%; height: 180px; object-fit: cover; }
    .poster-preview-info { padding: 0.5rem 0.75rem; background: #f8fafc; display: flex; align-items: center; justify-content: space-between; font-size: 0.78rem; color: #64748b; }
    .poster-preview-remove { color: #dc2626; cursor: pointer; font-weight: 600; font-size: 0.78rem; background: none; border: none; padding: 0; }

    .info-box {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 0.75rem;
        padding: 0.875rem 1rem;
        font-size: 0.82rem;
        color: #92400e;
        display: flex;
        gap: 0.625rem;
        align-items: flex-start;
        line-height: 1.5;
    }
    .form-actions { display: flex; gap: 0.75rem; padding-top: 0.5rem; }

    @media (max-width: 640px) {
        .field-row { grid-template-columns: 1fr; }
        .create-form-body { padding: 1.25rem; }
    }
</style>
@endpush

@section('content')

<div class="create-form-wrapper">
    <div class="create-form-card">
        <div class="create-form-header">
            <div>
                <h3>
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit Event
                </h3>
                <p>{{ $event->title }}</p>
            </div>
            <a href="{{ route('panitia.events.index') }}" class="btn btn-secondary btn-sm"
               style="background:rgba(255,255,255,0.15);color:white;border-color:rgba(255,255,255,0.3);">← Kembali</a>
        </div>

        <div class="create-form-body">
            <form method="POST" action="{{ route('panitia.events.update', $event) }}" enctype="multipart/form-data" id="form-edit-event">
                @csrf @method('PUT')

                <div class="field-section-label">Informasi Dasar</div>

                <div class="field-group">
                    <label class="field-label" for="title">Judul Event <span class="required">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}"
                        class="field-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
                        placeholder="Judul event">
                    @error('title') <div class="field-error">⚠ {{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="description">Deskripsi Event <span class="required">*</span></label>
                    <textarea name="description" id="description" rows="5"
                        class="field-input {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        placeholder="Deskripsi detail event...">{{ old('description', $event->description) }}</textarea>
                    @error('description') <div class="field-error">⚠ {{ $message }}</div> @enderror
                </div>

                <div class="field-divider"></div>

                <div class="field-section-label">Jadwal & Kapasitas</div>

                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label" for="event_date">Tanggal & Waktu <span class="required">*</span></label>
                        <input type="datetime-local" name="event_date" id="event_date"
                            value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}"
                            class="field-input {{ $errors->has('event_date') ? 'is-invalid' : '' }}">
                        @error('event_date') <div class="field-error">⚠ {{ $message }}</div> @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="quota">Kuota Peserta <span class="required">*</span></label>
                        <input type="number" name="quota" id="quota"
                            value="{{ old('quota', $event->quota) }}"
                            class="field-input {{ $errors->has('quota') ? 'is-invalid' : '' }}"
                            min="1" max="10000">
                        <div class="field-hint">
                            {{ $event->registrations()->count() }} peserta telah mendaftar
                        </div>
                        @error('quota') <div class="field-error">⚠ {{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label" for="location">Lokasi Event <span class="optional">(opsional)</span></label>
                        <select name="location" id="location" class="field-input {{ $errors->has('location') ? 'is-invalid' : '' }}">
                            <option value="">— Pilih Lokasi —</option>
                            <option value="Aula Teknik Informatika" {{ old('location', $event->location) == 'Aula Teknik Informatika' ? 'selected' : '' }}>Aula Teknik Informatika</option>
                            <option value="Aula Bahasa" {{ old('location', $event->location) == 'Aula Bahasa' ? 'selected' : '' }}>Aula Bahasa</option>
                            <option value="Aula ADM" {{ old('location', $event->location) == 'Aula ADM' ? 'selected' : '' }}>Aula ADM</option>
                        </select>
                        <div class="field-hint">Pilih lokasi agar sistem mengecek ketersediaan jadwal</div>
                        @error('location') <div class="field-error">⚠ {{ $message }}</div> @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="organizer">Penyelenggara <span class="optional">(opsional)</span></label>
                        <input type="text" name="organizer" id="organizer" value="{{ old('organizer', $event->organizer) }}"
                            class="field-input {{ $errors->has('organizer') ? 'is-invalid' : '' }}"
                            placeholder="Contoh: Polbeng / HMJ TI">
                        <div class="field-hint">Default: Nama Kepanitiaan Anda</div>
                        @error('organizer') <div class="field-error">⚠ {{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="field-divider"></div>

                <div class="field-section-label">Media</div>

                <div class="field-group">
                    <label class="field-label">Poster Event <span class="optional">(kosongkan jika tidak ingin mengubah)</span></label>

                    @if($event->poster)
                        <div class="poster-current">
                            <img src="{{ Storage::url($event->poster) }}" alt="Poster saat ini">
                            <div class="poster-current-info">
                                <strong>Poster Saat Ini</strong>
                                <span>Upload file baru di bawah untuk mengganti poster</span>
                            </div>
                        </div>
                    @endif

                    <div class="poster-upload-area" id="posterUploadArea" onclick="document.getElementById('poster').click()">
                        <input type="file" name="poster" id="poster" accept="image/*"
                            style="position:absolute;opacity:0;width:0;height:0;" onchange="handlePosterPreview(this)">
                        <div class="poster-upload-text">
                            <strong>Klik untuk upload</strong> poster baru
                        </div>
                        <div class="poster-upload-hint">Format: JPG, PNG, WebP · Maksimal 2MB</div>
                    </div>
                    <div class="poster-preview" id="posterPreview">
                        <img id="posterPreviewImg" src="" alt="Preview">
                        <div class="poster-preview-info">
                            <span id="posterFileName">-</span>
                            <button type="button" class="poster-preview-remove" onclick="removePoster()">✕ Hapus</button>
                        </div>
                    </div>
                    @error('poster') <div class="field-error">⚠ {{ $message }}</div> @enderror
                </div>

                <div class="field-divider"></div>

                <div class="info-box" style="margin-bottom:1.5rem;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Perubahan akan langsung diterapkan. Kuota tidak bisa dikurangi di bawah jumlah peserta yang sudah disetujui.</span>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-warning" id="btn-update-event">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('panitia.events.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function handlePosterPreview(input) {
        const preview = document.getElementById('posterPreview');
        const previewImg = document.getElementById('posterPreviewImg');
        const fileName = document.getElementById('posterFileName');
        const uploadArea = document.getElementById('posterUploadArea');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                fileName.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                preview.style.display = 'block';
                uploadArea.classList.add('has-file');
            };
            reader.readAsDataURL(file);
        }
    }

    function removePoster() {
        document.getElementById('poster').value = '';
        document.getElementById('posterPreview').style.display = 'none';
        document.getElementById('posterUploadArea').classList.remove('has-file');
    }
</script>
@endpush
