@extends('layouts.app')

@section('title', 'Edit Panitia')
@section('page-title', 'Edit Data Panitia')
@section('page-breadcrumb')
    Admin / <a href="{{ route('admin.panitia.index') }}" style="color:#64748b;text-decoration:none;">Kelola Panitia</a> / <span>Edit</span>
@endsection

@push('styles')
<style>
    .create-card {
        background: white;
        border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        max-width: 800px;
        margin: 0 auto;
        overflow: hidden;
    }
    .create-card-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #f1f5f9;
        background: linear-gradient(to right, #f8fafc, #ffffff);
    }
    .create-card-header h3 {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin: 0;
    }
    .create-card-body {
        padding: 2rem;
    }

    .info-alert {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        background: #fdf8ea;
        border-left: 4px solid #f59e0b;
        padding: 1.25rem;
        border-radius: 0.75rem;
        margin-bottom: 2rem;
    }
    .info-alert svg { color: #f59e0b; flex-shrink: 0; margin-top: 0.1rem; }
    .info-alert p { color: #92400e; font-size: 0.9rem; line-height: 1.5; margin: 0; }

    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 0.5rem;
    }
    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1.5px solid #cbd5e1;
        border-radius: 0.75rem;
        font-family: inherit;
        font-size: 0.95rem;
        color: #1e293b;
        transition: all 0.2s;
        background: #f8fafc;
    }
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    .form-hint {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .form-error {
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 0.4rem;
        font-weight: 500;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 2.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
    }

    @media (max-width: 640px) {
        .form-grid-2 { grid-template-columns: 1fr; gap: 0; }
        .create-card-body { padding: 1.5rem; }
    }
</style>
@endpush

@section('content')

<div class="create-card">
    <div class="create-card-header">
        <h3>
            <svg width="22" height="22" fill="none" stroke="#f59e0b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit Data Panitia: {{ $panitium->name }}
        </h3>
    </div>
    <div class="create-card-body">
        
        <div class="info-alert">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>
                <p>Ubah nama organisasi atau email resmi di bawah ini. Jika Anda tidak ingin mengubah kata sandi, biarkan kolom password kosong.</p>
            </div>
        </div>

        <form action="{{ route('admin.panitia.update', $panitium) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Nama Organisasi / Kepanitiaan <span style="color:red;">*</span></label>
                <input type="text" id="name" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name', $panitium->name) }}" required autofocus>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Resmi Organisasi <span style="color:red;">*</span></label>
                <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email', $panitium->email) }}" required>
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-grid-2">
                <div class="form-group relative">
                    <label for="password" class="form-label">Ganti Kata Sandi (Opsional)</label>
                    <div style="position:relative;">
                        <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" placeholder="Biarkan kosong jika tidak diubah" style="padding-right: 2.5rem;">
                        <button type="button" class="toggle-pwd" onclick="togglePassword('password', this)" style="position:absolute; right:0.75rem; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#64748b;">
                            <svg class="eye-show" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg class="eye-hide" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group relative">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                    <div style="position:relative;">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi baru" style="padding-right: 2.5rem;">
                        <button type="button" class="toggle-pwd" onclick="togglePassword('password_confirmation', this)" style="position:absolute; right:0.75rem; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#64748b;">
                            <svg class="eye-show" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg class="eye-hide" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary" style="padding:0.875rem 2rem; font-size:0.95rem; display:flex; align-items:center; gap:0.5rem; justify-content:center; background:#0056B3;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.panitia.index') }}" class="btn btn-secondary" style="padding:0.875rem 2rem; font-size:0.95rem;">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const eyeShow = btn.querySelector('.eye-show');
        const eyeHide = btn.querySelector('.eye-hide');
        if (input.type === 'password') {
            input.type = 'text';
            eyeShow.style.display = 'none';
            eyeHide.style.display = 'block';
        } else {
            input.type = 'password';
            eyeShow.style.display = 'block';
            eyeHide.style.display = 'none';
        }
    }
</script>
@endpush
