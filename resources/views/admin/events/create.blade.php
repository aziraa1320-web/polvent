@extends('layouts.app')

@section('title', 'Buat Event Baru (Admin)')
@section('page-title', 'Buat Event Baru')
@section('page-breadcrumb')
    <a href="{{ route('admin.events.index') }}" style="color:#94a3b8;">Event</a> / <span>Buat Baru</span>
@endsection

@push('styles')
<style>
    .create-form-wrapper {
        max-width: 680px;
        margin: 0 auto;
    }
    .create-form-card {
        background: white;
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #cbd5e1;
        overflow: hidden;
    }
    .create-form-header {
        background: linear-gradient(135deg, #0f172a, #1e293b);
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
        color: rgba(255,255,255,0.7);
        margin-top: 0.25rem;
    }
    .create-form-body {
        padding: 1.75rem;
    }
    .field-group {
        margin-bottom: 1.5rem;
    }
    .field-group:last-child {
        margin-bottom: 0;
    }
    .field-label {
        display: block;
        font-weight: 600;
        font-size: 0.875rem;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    .field-label .required {
        color: #dc2626;
        margin-left: 2px;
    }
    .field-label .optional {
        color: #94a3b8;
        font-weight: 400;
        font-size: 0.78rem;
    }
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
        border-color: #0f172a;
        box-shadow: 0 0 0 3px rgba(15,23,42,0.15);
        background: white;
    }
    .field-input.is-invalid {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220,38,38,0.08);
    }
    .field-input::placeholder {
        color: #94a3b8;
    }
    textarea.field-input {
        resize: vertical;
        min-height: 120px;
    }
    .field-hint {
        font-size: 0.76rem;
        color: #94a3b8;
        margin-top: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .field-error {
        color: #dc2626;
        font-size: 0.78rem;
        margin-top: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .field-divider {
        height: 1px;
        background: #e2e8f0;
        margin: 1.75rem 0;
    }
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
    .field-section-label::after {
        content: '';
        flex: 1;
        height: 1.5px;
        background: #e2e8f0;
    }

    /* Poster upload area */
    .poster-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 0.75rem;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        background: #fafbfc;
        position: relative;
    }
    .poster-upload-area:hover {
        border-color: #0f172a;
        background: #f8fafc;
    }
    .poster-upload-area.has-file {
        border-color: #059669;
        background: #f0fdf4;
    }
    .poster-upload-icon {
        width: 48px;
        height: 48px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        color: #0f172a;
    }
    .poster-upload-text {
        font-size: 0.875rem;
        color: #64748b;
    }
    .poster-upload-text strong {
        color: #0f172a;
    }
    .poster-upload-hint {
        font-size: 0.76rem;
        color: #94a3b8;
        margin-top: 0.35rem;
    }
    .poster-preview {
        display: none;
        margin-top: 1rem;
        border-radius: 0.75rem;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    .poster-preview img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .poster-preview-info {
        padding: 0.5rem 0.75rem;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.78rem;
        color: #64748b;
    }
    .poster-preview-remove {
        color: #dc2626;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.78rem;
        background: none;
        border: none;
        padding: 0;
    }

    /* Info box */
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
    .info-box svg {
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* Submit area */
    .form-actions {
        display: flex;
        gap: 0.75rem;
        padding-top: 0.5rem;
    }

    @media (max-width: 640px) {
        .field-row {
            grid-template-columns: 1fr;
        }
        .create-form-body {
            padding: 1.25rem;
        }
    }
</style>
@endpush

@section('content')

<div class="create-form-wrapper">
    <div class="create-form-card">
        <div class="create-form-header">
            <div>
                <h3>
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Buat Event Baru
                </h3>
                <p>Isi formulir berikut untuk membuat event di sistem</p>
            </div>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm" style="background:rgba(255,255,255,0.15);color:white;border-color:rgba(255,255,255,0.3);">← Kembali</a>
        </div>

        <div class="create-form-body">
            <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" id="form-create-event">
                @csrf

                {{-- Section: Informasi Dasar --}}
                <div class="field-section-label">Informasi Dasar</div>

                <div class="field-group">
                    <label class="field-label" for="title">Judul Event <span class="required">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="field-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
                        placeholder="Contoh: Seminar Teknologi Informasi 2026">
                    @error('title') <div class="field-error">⚠ {{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="description">Deskripsi Event <span class="required">*</span></label>
                    <textarea name="description" id="description" rows="5"
                        class="field-input {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        placeholder="Jelaskan detail event, tujuan, pembicara, dan informasi penting lainnya...">{{ old('description') }}</textarea>
                    <div class="field-hint">Deskripsikan event secara lengkap agar mahasiswa tertarik.</div>
                    @error('description') <div class="field-error">⚠ {{ $message }}</div> @enderror
                </div>

                <div class="field-divider"></div>

                {{-- Section: Jadwal & Kapasitas --}}
                <div class="field-section-label">Jadwal & Kapasitas</div>

                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label" for="event_date">Tanggal & Waktu <span class="required">*</span></label>
                        <input type="datetime-local" name="event_date" id="event_date" value="{{ old('event_date') }}"
                            class="field-input {{ $errors->has('event_date') ? 'is-invalid' : '' }}">
                        @error('event_date') <div class="field-error">⚠ {{ $message }}</div> @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="quota">Kuota Peserta <span class="required">*</span></label>
                        <input type="number" name="quota" id="quota" value="{{ old('quota') }}"
                            class="field-input {{ $errors->has('quota') ? 'is-invalid' : '' }}"
                            placeholder="100" min="1" max="10000">
                        <div class="field-hint">Jumlah maksimum peserta yang dapat diterima</div>
                        @error('quota') <div class="field-error">⚠ {{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="field-divider"></div>

                {{-- Section: Media --}}
                <div class="field-section-label">Media</div>

                <div class="field-group">
                    <label class="field-label">Poster Event <span class="optional">(opsional, maks 2MB)</span></label>
                    <div class="poster-upload-area" id="posterUploadArea" onclick="document.getElementById('poster').click()">
                        <input type="file" name="poster" id="poster" accept="image/*"
                            style="position:absolute;opacity:0;width:0;height:0;" onchange="handlePosterPreview(this)">
                        <div class="poster-upload-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="poster-upload-text"><strong>Klik untuk upload</strong> poster event</div>
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

                {{-- Info Box --}}
                <div class="info-box" style="margin-bottom:1.5rem;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>Event yang dibuat oleh Admin tidak terikat ke Panitia tertentu secara default.</span>
                </div>

                {{-- Submit --}}
                <div class="form-actions">
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
        const input = document.getElementById('poster');
        const preview = document.getElementById('posterPreview');
        const uploadArea = document.getElementById('posterUploadArea');

        input.value = '';
        preview.style.display = 'none';
        uploadArea.classList.remove('has-file');
    }
</script>
@endpush
