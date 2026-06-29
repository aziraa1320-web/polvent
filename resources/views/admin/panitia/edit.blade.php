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

            <div class="form-group">
                <label for="phone" class="form-label">No. WhatsApp Panitia</label>
                <div class="input-wrap" style="position:relative;">
                    <span style="position:absolute;left:0.9rem;top:50%;transform:translateY(-50%);color:#9ca3af;display:flex;align-items:center;pointer-events:none;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.126.556 4.123 1.526 5.853L.057 23.215a.75.75 0 00.921.921l5.362-1.469A11.946 11.946 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.75a9.703 9.703 0 01-4.952-1.354l-.355-.211-3.682 1.008 1.008-3.682-.211-.355A9.703 9.703 0 012.25 12C2.25 6.615 6.615 2.25 12 2.25S21.75 6.615 21.75 12 17.385 21.75 12 21.75z"/></svg>
                    </span>
                    <input type="text" id="phone" name="phone" class="form-input @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $panitium->phone) }}" placeholder="Contoh: 081234567890"
                        style="padding-left:2.5rem;">
                </div>
                <div class="form-hint">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Nomor ini digunakan untuk OTP login. Format: 08xxx atau +628xxx. Kosongkan jika tidak ingin mengubah.
                </div>
                @error('phone') <div class="form-error">{{ $message }}</div> @enderror
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
