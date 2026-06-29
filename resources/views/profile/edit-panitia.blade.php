@extends('layouts.app')

@section('title', 'Edit Profil Panitia')
@section('page-title', 'Edit Profil')
@section('page-breadcrumb')
    Panitia / <span>Edit Profil</span>
@endsection

@push('styles')
<style>
    .profile-form-wrapper { max-width: 680px; margin: 0 auto; }
    .profile-form-card {
        background: white;
        border-radius: 1.25rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }
    .profile-form-header {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        padding: 1.5rem 1.75rem;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .profile-form-header h3 {
        font-size: 1.1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .profile-form-header p {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.7);
        margin-top: 0.25rem;
    }
    .profile-form-body { padding: 2rem 1.75rem; }
    
    .field-group { margin-bottom: 1.5rem; }
    .field-label { display: block; font-weight: 600; font-size: 0.875rem; color: #1e293b; margin-bottom: 0.5rem; }
    .field-label .required { color: #dc2626; margin-left: 2px; }
    .field-input {
        width: 100%;
        padding: 0.7rem 0.95rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 0.625rem;
        font-size: 0.875rem;
        color: #1e293b;
        outline: none;
        transition: all 0.25s ease;
        background: #fafbfc;
    }
    .field-input:focus { border-color: #0f172a; box-shadow: 0 0 0 3px rgba(15,23,42,0.1); background: white; }
    .field-input.is-invalid { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.08); }
    .field-error { color: #dc2626; font-size: 0.78rem; margin-top: 0.35rem; }
    
    .photo-upload-container {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px dashed #e2e8f0;
    }
    .photo-preview-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        flex-shrink: 0;
    }
    .photo-preview-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .photo-preview-circle svg {
        width: 40px;
        height: 40px;
        color: #94a3b8;
    }
    .photo-upload-actions {
        flex: 1;
    }
    
    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.845rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: 1.5px solid #0f172a;
        background: transparent;
        color: #0f172a;
    }
    .btn-outline:hover { background: #f8fafc; }
    .photo-hint { font-size: 0.75rem; color: #64748b; margin-top: 0.5rem; }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px dashed #e2e8f0;
    }
</style>
@endpush

@section('content')
<div class="profile-form-wrapper">
    <div class="profile-form-card">
        <div class="profile-form-header">
            <div>
                <h3>
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Informasi Profil
                </h3>
                <p>Perbarui informasi akun dan foto profil Anda</p>
            </div>
        </div>

        <div class="profile-form-body">
            <form method="POST" action="{{ route('panitia.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="photo-upload-container">
                    <div class="photo-preview-circle" id="photoPreviewContainer">
                        @if($user->profile_photo)
                            <img src="{{ $user->profile_photo_url }}" id="photoPreviewImg" alt="Profile" onerror="this.style.display='none'; document.getElementById('photoPreviewPlaceholder').style.display='block';">
                            <svg id="photoPreviewPlaceholder" style="display:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        @else
                            <img src="" id="photoPreviewImg" style="display:none;" alt="Profile">
                            <svg id="photoPreviewPlaceholder" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        @endif
                    </div>
                    <div class="photo-upload-actions">
                        <label class="btn-outline" for="profile_photo">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            Unggah Foto Baru
                        </label>
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display:none;" onchange="previewPhoto(this)">
                        <div class="photo-hint">Format: JPG, PNG, atau WebP. Maksimal ukuran 2MB.</div>
                        @error('profile_photo') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="name">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                    @error('name') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="email">Alamat Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}" required>
                    @error('email') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="phone">
                        No. WhatsApp
                        <span style="font-size:0.75rem;font-weight:500;color:#059669;margin-left:0.4rem;">⚡ Digunakan untuk OTP login</span>
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="field-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                        placeholder="Contoh: 081234567890">
                    <div style="font-size:0.75rem;color:#64748b;margin-top:0.35rem;">
                        Format: 08xxxxxxx atau +628xxxxxxx. Pastikan nomor aktif WhatsApp agar bisa menerima kode OTP.
                    </div>
                    @error('phone') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('panitia.dashboard') }}" class="btn btn-secondary" style="margin-left: auto;">
                        Selesai / Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photoPreviewImg').src = e.target.result;
                document.getElementById('photoPreviewImg').style.display = 'block';
                const placeholder = document.getElementById('photoPreviewPlaceholder');
                if(placeholder) placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
