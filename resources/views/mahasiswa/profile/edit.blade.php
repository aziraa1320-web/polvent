@extends('layouts.app')

@section('title', 'Profil Mahasiswa')
@section('page-title', 'Profil Mahasiswa')
@section('page-breadcrumb')
    Mahasiswa / <span>Profil</span>
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
    .field-label-hint { font-size: 0.7rem; color: #94a3b8; font-weight: 400; margin-left: 4px; }
    
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
    
    .field-input-locked {
        width: 100%;
        padding: 0.7rem 0.95rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 0.625rem;
        font-size: 0.875rem;
        color: #94a3b8;
        background: #f1f5f9;
        cursor: not-allowed;
        font-weight: 500;
    }

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
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    
    @media(max-width: 640px) {
        .grid-2 { grid-template-columns: 1fr; }
    }
    
    .success-toast {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        border: 1px solid #6ee7b7;
        border-radius: 0.875rem;
        padding: 1rem 1.25rem;
        margin: 0 auto 1.5rem auto;
        max-width: 680px;
        animation: slideDown 0.35s ease;
    }
    .success-toast-icon {
        width: 38px; height: 38px;
        background: #059669;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .success-toast-icon svg { width: 20px; height: 20px; color: white; }
    .success-toast-title { font-weight: 700; color: #065f46; font-size: 0.9rem; }
    .success-toast-sub   { font-size: 0.78rem; color: #047857; margin-top: 1px; }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .error-banner {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 0.875rem;
        padding: 1rem 1.25rem;
        margin: 0 auto 1.5rem auto;
        max-width: 680px;
        color: #991b1b;
        font-size: 0.875rem;
    }
</style>
@endpush

@section('content')

@if(session('success'))
    <div class="success-toast" id="success-toast">
        <div class="success-toast-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div>
            <div class="success-toast-title">{{ session('success') }}</div>
            <div class="success-toast-sub">Perubahan data Anda telah berhasil disimpan.</div>
        </div>
        <button onclick="document.getElementById('success-toast').remove()"
            style="margin-left:auto;background:none;border:none;cursor:pointer;color:#065f46;padding:0.25rem;">
            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="error-banner">
        <svg style="width:20px;height:20px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <strong>Terdapat kesalahan:</strong> {{ $errors->first() }}
        </div>
    </div>
@endif

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
            <form method="POST" action="{{ route('mahasiswa.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="photo-upload-container">
                    <div class="photo-preview-circle" id="photoPreviewContainer">
                        @if($user->profile_photo)
                            <img src="{{ Storage::url($user->profile_photo) }}" id="photoPreviewImg" alt="Profile">
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

                <div class="grid-2">
                    <div class="field-group">
                        <label class="field-label">Email <span class="field-label-hint">— tidak dapat diubah</span></label>
                        <input type="email" value="{{ $user->email }}" class="field-input-locked" readonly>
                    </div>
                    <div class="field-group">
                        <label class="field-label">NIM <span class="field-label-hint">— tidak dapat diubah</span></label>
                        <input type="text" value="{{ $user->nim ?? '—' }}" class="field-input-locked" readonly>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="name">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                    @error('name') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="phone">Nomor HP</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="field-input {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="Contoh: 08123456789">
                    @error('phone') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="grid-2">
                    <div class="field-group">
                        <label class="field-label" for="jurusan">Jurusan</label>
                        <select id="jurusan" name="jurusan" class="field-input {{ $errors->has('jurusan') ? 'is-invalid' : '' }}">
                            <option value="">-- Pilih Jurusan --</option>
                            <option value="Teknik Informatika" {{ old('jurusan', $user->jurusan) == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                            <option value="Teknik Perkapalan" {{ old('jurusan', $user->jurusan) == 'Teknik Perkapalan' ? 'selected' : '' }}>Teknik Perkapalan</option>
                            <option value="Teknik Mesin" {{ old('jurusan', $user->jurusan) == 'Teknik Mesin' ? 'selected' : '' }}>Teknik Mesin</option>
                            <option value="Teknik Elektro" {{ old('jurusan', $user->jurusan) == 'Teknik Elektro' ? 'selected' : '' }}>Teknik Elektro</option>
                            <option value="Teknik Sipil" {{ old('jurusan', $user->jurusan) == 'Teknik Sipil' ? 'selected' : '' }}>Teknik Sipil</option>
                            <option value="Administrasi Niaga" {{ old('jurusan', $user->jurusan) == 'Administrasi Niaga' ? 'selected' : '' }}>Administrasi Niaga</option>
                            <option value="Jurusan Bahasa" {{ old('jurusan', $user->jurusan) == 'Jurusan Bahasa' ? 'selected' : '' }}>Jurusan Bahasa</option>
                            <option value="Maritim" {{ old('jurusan', $user->jurusan) == 'Maritim' ? 'selected' : '' }}>Maritim</option>
                        </select>
                        @error('jurusan') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="angkatan">Angkatan</label>
                        <select id="angkatan" name="angkatan" class="field-input {{ $errors->has('angkatan') ? 'is-invalid' : '' }}">
                            <option value="">-- Pilih Angkatan --</option>
                            @for($i = 20; $i <= 26; $i++)
                                <option value="AKT {{ $i }}" {{ old('angkatan', $user->angkatan) == "AKT $i" ? 'selected' : '' }}>AKT {{ $i }}</option>
                            @endfor
                        </select>
                        @error('angkatan') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="program_studi">Program Studi</label>
                    <input type="text" id="program_studi" name="program_studi" value="{{ old('program_studi', $user->program_studi) }}" class="field-input {{ $errors->has('program_studi') ? 'is-invalid' : '' }}">
                    @error('program_studi') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-actions">
                    @if(session('success'))
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-primary">
                            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Selesai
                        </a>
                        <a href="{{ route('mahasiswa.profile.edit') }}" class="btn btn-secondary" style="margin-left: auto;">
                            Update Profile Lagi
                        </a>
                    @else
                        <button type="submit" class="btn btn-primary">
                            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="document.getElementById('name').focus();" class="btn btn-secondary" style="margin-left: auto;">
                            Edit Profil
                        </button>
                    @endif
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

    const toast = document.getElementById('success-toast');
    if (toast) {
        setTimeout(() => {
            toast.style.transition = 'opacity 0.5s ease';
            toast.style.opacity   = '0';
            setTimeout(() => toast.remove(), 500);
        }, 5000);
    }
</script>
@endpush
