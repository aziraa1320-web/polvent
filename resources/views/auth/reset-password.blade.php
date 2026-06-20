<x-guest-layout>
<style>
    .form-title { font-size: 1.75rem; font-weight: 800; color: #1a1a2e; margin-bottom: 0.3rem; }
    .form-sub { font-size: 0.875rem; color: #64748b; margin-bottom: 1.75rem; line-height: 1.6; }
    .form-group { margin-bottom: 1.1rem; }
    .form-label { display: block; font-weight: 600; font-size: 0.82rem; color: #374151; margin-bottom: 0.4rem; letter-spacing: 0.01em; }
    
    .input-wrap { position: relative; }
    .input-ico { position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #9ca3af; display: flex; align-items: center; pointer-events: none; }
    .input-ico svg { width: 16px; height: 16px; }
    .form-input {
        width: 100%; padding: 0.72rem 1rem 0.72rem 2.5rem; border: 1.5px solid #e5e7eb; border-radius: 0.625rem; font-size: 0.875rem; color: #1e293b; background: #f9fafb; outline: none; transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }
    .form-input:focus { border-color: #0056B3; background: #fff; box-shadow: 0 0 0 3px rgba(0,86,179,0.10); }
    .form-input.is-invalid { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.08); }
    
    .btn-submit {
        width: 100%; padding: 0.875rem; background: linear-gradient(135deg, #0056B3 0%, #003d80 100%); color: white; border: none; border-radius: 0.625rem; font-size: 0.95rem; font-weight: 700; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(0,86,179,0.28); display: flex; align-items: center; justify-content: center; gap: 0.5rem;
    }
    .btn-submit:hover { background: linear-gradient(135deg, #004494 0%, #001f4d 100%); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,86,179,0.38); }
    
    .error-alert { display: flex; align-items: center; gap: 0.6rem; color: #991b1b; font-size: 0.85rem; margin-bottom: 1rem; background: #fef2f2; border: 1px solid #fecaca; padding: 0.75rem 1rem; border-radius: 0.625rem; }
    .form-error-inline { color: #dc2626; font-size: 0.78rem; margin-top: 0.25rem; }
</style>

<div class="form-title">Buat Sandi Baru 🔐</div>
<div class="form-sub">Silakan buat kata sandi baru untuk akun Anda. Pastikan kata sandi aman dan mudah diingat.</div>

@if($errors->any())
    <div class="error-alert">
        <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="form-group">
        <label class="form-label" for="email">Alamat Email</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </span>
            <input id="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus readonly style="background:#f1f5f9; color:#64748b;">
        </div>
        @error('email') <div class="form-error-inline">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="password">Kata Sandi Baru</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </span>
            <input id="password" class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
        </div>
        @error('password') <div class="form-error-inline">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="password_confirmation">Konfirmasi Sandi</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
            <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru" required autocomplete="new-password">
        </div>
    </div>

    <button type="submit" class="btn-submit" style="margin-top: 1.5rem;">
        Simpan Sandi Baru
    </button>
</form>
</x-guest-layout>
