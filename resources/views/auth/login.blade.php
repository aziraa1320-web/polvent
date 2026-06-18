<x-guest-layout>
<style>
    /* ========== FORM GLOBAL ========== */
    .form-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: 0.3rem;
    }
    .form-sub {
        font-size: 0.875rem;
        color: #64748b;
        margin-bottom: 1.75rem;
        line-height: 1.6;
    }
    .form-group { margin-bottom: 1.1rem; }
    .form-label {
        display: block;
        font-weight: 600;
        font-size: 0.82rem;
        color: #374151;
        margin-bottom: 0.4rem;
        letter-spacing: 0.01em;
    }

    /* ========== INPUT WITH ICON ========== */
    .input-wrap { position: relative; }
    .input-ico {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        display: flex;
        align-items: center;
        pointer-events: none;
        transition: color 0.2s;
    }
    .input-ico svg { width: 16px; height: 16px; }
    .form-input {
        width: 100%;
        padding: 0.72rem 1rem 0.72rem 2.5rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.625rem;
        font-size: 0.875rem;
        color: #1e293b;
        background: #f9fafb;
        outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }
    .form-input:focus {
        border-color: #0056B3;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(0,86,179,0.10);
    }
    .form-input:focus ~ .input-ico,
    .input-wrap:focus-within .input-ico { color: #0056B3; }
    .form-input.is-invalid { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.08); }

    /* Eye toggle */
    .eye-btn {
        position: absolute;
        right: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #9ca3af;
        display: flex;
        align-items: center;
        padding: 0.25rem;
        border-radius: 0.25rem;
        transition: color 0.2s;
    }
    .eye-btn:hover { color: #374151; }
    .form-input-pwd { padding-right: 2.75rem; }

    /* ========== REMEMBER / FORGOT ROW ========== */
    .form-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }
    .remember-label {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.82rem;
        color: #374151;
        cursor: pointer;
    }
    .remember-label input[type="checkbox"] {
        width: 15px; height: 15px;
        accent-color: #0056B3;
        cursor: pointer;
    }
    .forgot-link {
        font-size: 0.82rem;
        color: #0056B3;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .forgot-link:hover { color: #003d80; text-decoration: underline; }

    /* ========== RECAPTCHA ========== */
    .security-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
    }
    .recaptcha-container { margin-bottom: 1.25rem; }
    .recaptcha-error { color: #dc2626; font-size: 0.78rem; margin-top: 0.35rem; }

    /* ========== SUBMIT BUTTON ========== */
    .btn-submit {
        width: 100%;
        padding: 0.875rem;
        background: linear-gradient(135deg, #0056B3 0%, #003d80 100%);
        color: white;
        border: none;
        border-radius: 0.625rem;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        letter-spacing: 0.02em;
        box-shadow: 0 4px 14px rgba(0,86,179,0.28);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .btn-submit:hover {
        background: linear-gradient(135deg, #004494 0%, #001f4d 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(0,86,179,0.38);
    }
    .btn-submit:active { transform: translateY(0); box-shadow: none; }
    .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    /* ========== DIVIDER ========== */
    .or-divider {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 1.25rem 0;
        color: #cbd5e1;
        font-size: 0.78rem;
    }
    .or-divider::before,
    .or-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    /* ========== GOOGLE BUTTON ========== */
    .btn-google {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
        padding: 0.72rem 1rem;
        background: #fff;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.625rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-google:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        color: #1e293b;
    }

    /* ========== REGISTER LINK ========== */
    .register-row {
        text-align: center;
        margin-top: 1.25rem;
        font-size: 0.875rem;
        color: #64748b;
    }
    .register-row a {
        color: #0056B3;
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s;
    }
    .register-row a:hover { color: #003d80; text-decoration: underline; }

    /* ========== ALERTS ========== */
    .status-alert {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        background: #d1fae5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        padding: 0.75rem 1rem;
        border-radius: 0.625rem;
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
    }
    .error-alert {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        color: #991b1b;
        font-size: 0.85rem;
        margin-bottom: 1rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        padding: 0.75rem 1rem;
        border-radius: 0.625rem;
    }
    .form-error-inline { color: #dc2626; font-size: 0.78rem; margin-top: 0.25rem; }

    @keyframes spin { to { transform: rotate(360deg); } }
</style>

<div class="form-title">Selamat Datang 👋</div>
<div class="form-sub">Masuk untuk mendaftar event kampus, khusus mahasiswa POLBENG</div>

@if(session('status'))
    <div class="status-alert">
        <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('status') }}
    </div>
@endif
@if($errors->any())
    <div class="error-alert">
        <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}" id="login-form">
    @csrf

    {{-- Email --}}
    <div class="form-group">
        <label class="form-label" for="email">Alamat Email</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </span>
            <input id="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   type="email" name="email"
                   value="{{ old('email') }}"
                   placeholder="nama@gmail.com"
                   required autofocus autocomplete="username">
        </div>
        @error('email') <div class="form-error-inline">{{ $message }}</div> @enderror
    </div>

    {{-- Password --}}
    <div class="form-group">
        <label class="form-label" for="password">Kata Sandi</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </span>
            <input id="password" class="form-input form-input-pwd {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   type="password" name="password"
                   placeholder="••••••••" required autocomplete="current-password">
            <button type="button" class="eye-btn" id="togglePwd" aria-label="Lihat kata sandi">
                <svg id="eye-show" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <svg id="eye-hide" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                </svg>
            </button>
        </div>
        @error('password') <div class="form-error-inline">{{ $message }}</div> @enderror
    </div>

    {{-- Ingat Saya + Lupa Sandi --}}
    <div class="form-row">
        <label class="remember-label">
            <input type="checkbox" name="remember" id="remember_me"> Ingat Saya
        </label>
        @if(Route::has('password.request'))
            <a class="forgot-link" href="{{ route('password.request') }}">Lupa Sandi?</a>
        @endif
    </div>

    {{-- Google reCAPTCHA v2 --}}
    <span class="security-label">Verifikasi Keamanan</span>
    <div class="recaptcha-container">
        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
        @error('g-recaptcha-response')
            <div class="recaptcha-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn-submit" id="submit-btn">
        <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
        </svg>
        Masuk Sekarang
    </button>
</form>

<div class="register-row">
    Belum memiliki akun? <a href="{{ route('register') }}" id="link-daftar">Daftar Gratis</a>
</div>

{{-- Google reCAPTCHA Script --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
(function () {
    /* Password toggle */
    const pwdInput  = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePwd');
    const eyeShow   = document.getElementById('eye-show');
    const eyeHide   = document.getElementById('eye-hide');

    toggleBtn.addEventListener('click', () => {
        const isPwd = pwdInput.type === 'password';
        pwdInput.type        = isPwd ? 'text' : 'password';
        eyeShow.style.display = isPwd ? 'none'  : 'block';
        eyeHide.style.display = isPwd ? 'block' : 'none';
    });

    /* Loading state on submit */
    document.getElementById('login-form').addEventListener('submit', function () {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = `
            <svg style="width:18px;height:18px;animation:spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Memproses...`;
    });
})();
</script>
</x-guest-layout>
