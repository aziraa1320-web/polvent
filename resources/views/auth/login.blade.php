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
    }
    .form-group { margin-bottom: 1.1rem; }
    .form-label {
        display: block;
        font-weight: 600;
        font-size: 0.85rem;
        color: #374151;
        margin-bottom: 0.4rem;
    }

    /* ========== INPUT WITH ICON ========== */
    .input-wrap {
        position: relative;
    }
    .input-ico {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        display: flex;
        align-items: center;
        pointer-events: none;
    }
    .form-input {
        width: 100%;
        padding: 0.72rem 1rem 0.72rem 2.6rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.6rem;
        font-size: 0.9rem;
        color: #1e293b;
        background: #fafafa;
        outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }
    .form-input:focus {
        border-color: #0056B3;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(0,86,179,0.12);
    }
    /* Eye toggle for password */
    .eye-btn {
        position: absolute;
        right: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #9ca3af;
        display: flex;
        align-items: center;
        padding: 0;
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
        font-size: 0.85rem;
        color: #374151;
        cursor: pointer;
    }
    .remember-label input[type="checkbox"] {
        width: 15px;
        height: 15px;
        accent-color: #0056B3;
        cursor: pointer;
    }
    .forgot-link {
        font-size: 0.83rem;
        color: #0056B3;
        font-weight: 600;
        text-decoration: none;
    }
    .forgot-link:hover { text-decoration: underline; }

    /* ========== SEPARATOR ========== */
    .or-separator {
        text-align: center;
        font-size: 0.82rem;
        color: #9ca3af;
        margin: 0.25rem 0 0.85rem;
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
        border-radius: 0.6rem;
        font-size: 0.9rem;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
        text-decoration: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        margin-bottom: 1.25rem;
    }
    .btn-google:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    /* ========== VERIFIKASI KEAMANAN ========== */
    .security-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
    }
    .recaptcha-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f9f9f9;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        padding: 12px 14px;
        height: 74px;
        cursor: pointer;
        transition: border-color 0.2s;
        margin-bottom: 1.25rem;
        user-select: none;
    }
    .recaptcha-box:hover { border-color: #9ca3af; }
    .recaptcha-left-area {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .rc-checkbox {
        width: 26px;
        height: 26px;
        border: 2px solid #bdbdbd;
        border-radius: 2px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: border-color 0.2s;
    }
    .rc-checkbox.verified { border-color: #4caf50; }
    .rc-label {
        font-size: 14px;
        color: #3c3c3c;
        font-weight: 400;
    }
    .recaptcha-right-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        text-align: center;
    }
    .rc-logo-text {
        font-size: 9px;
        color: #9e9e9e;
        font-weight: 600;
        letter-spacing: 0.04em;
    }
    .rc-links {
        font-size: 8px;
        color: #9e9e9e;
    }
    .rc-links a { color: #757575; text-decoration: none; }
    .rc-links a:hover { text-decoration: underline; }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    .rc-spinner {
        width: 18px;
        height: 18px;
        border: 2.5px solid #e5e7eb;
        border-top-color: #4285F4;
        border-radius: 50%;
        animation: spin 0.75s linear infinite;
    }



    /* ========== SUBMIT BUTTON ========== */
    .btn-submit {
        width: 100%;
        padding: 0.85rem;
        background: #0056B3;
        color: white;
        border: none;
        border-radius: 0.6rem;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        letter-spacing: 0.02em;
        box-shadow: 0 4px 14px rgba(0,86,179,0.3);
    }
    .btn-submit:hover {
        background: #004494;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(0,86,179,0.4);
    }
    .btn-submit:active { transform: translateY(0); }

    /* ========== REGISTER LINK ========== */
    .register-row {
        text-align: center;
        margin-top: 1.1rem;
        font-size: 0.875rem;
        color: #64748b;
    }
    .register-row a {
        color: #0056B3;
        font-weight: 700;
        text-decoration: none;
    }
    .register-row a:hover { text-decoration: underline; }

    /* ========== ALERTS ========== */
    .status-alert {
        background: #d1fae5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
    }
    .error-alert {
        color: #dc2626;
        font-size: 0.85rem;
        text-align: center;
        margin-bottom: 1rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        padding: 0.65rem 1rem;
        border-radius: 0.5rem;
    }
</style>

<div class="form-title">Portal Mahasiswa 👋</div>
<div class="form-sub">Masuk untuk mendaftar event kampus, khusus mahasiswa POLBENG</div>

@if(session('status'))
    <div class="status-alert">{{ session('status') }}</div>
@endif
@if($errors->any())
    <div class="error-alert">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('login') }}" id="login-form">
    @csrf

    {{-- Email --}}
    <div class="form-group">
        <label class="form-label" for="email">Alamat Email</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </span>
            <input id="email" class="form-input" type="email" name="email"
                value="{{ old('email') }}" placeholder="nama@gmail.com" required autofocus>
        </div>
    </div>

    {{-- Password --}}
    <div class="form-group">
        <label class="form-label" for="password">Kata Sandi</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </span>
            <input id="password" class="form-input form-input-pwd" type="password"
                name="password" placeholder="••••••••" required>
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

    {{-- Hidden captcha answer --}}
    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

    {{-- Verifikasi Keamanan Label --}}
    <span class="security-label">Verifikasi Keamanan</span>

    {{-- reCAPTCHA-style Box --}}
    <div class="recaptcha-box" id="rc-box">
        <div class="recaptcha-left-area">
            <div class="rc-checkbox" id="rc-checkbox">
                {{-- states: empty | spinner | checkmark --}}
            </div>
            <span class="rc-label">Saya bukan robot</span>
        </div>
        <div class="recaptcha-right-area">
            {{-- reCAPTCHA Logo (shield + swirl) --}}
            <svg width="32" height="32" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32 4L8 14v18c0 15.46 10.24 29.91 24 33.86C45.76 61.91 56 47.46 56 32V14L32 4z" fill="#4285F4" opacity="0.15"/>
                <path d="M32 4L8 14v18c0 15.46 10.24 29.91 24 33.86C45.76 61.91 56 47.46 56 32V14L32 4z" stroke="#4285F4" stroke-width="3" fill="none"/>
                <path d="M23 32c0-4.97 4.03-9 9-9s9 4.03 9 9" stroke="#4285F4" stroke-width="3" stroke-linecap="round"/>
                <circle cx="32" cy="32" r="4" fill="#34A853"/>
                <path d="M41 32c0 4.97-4.03 9-9 9s-9-4.03-9-9" stroke="#FBBC05" stroke-width="3" stroke-linecap="round"/>
            </svg>
            <div class="rc-logo-text">reCAPTCHA</div>
            <div class="rc-links">
                <a href="#" onclick="event.preventDefault()">Privasi</a> -
                <a href="#" onclick="event.preventDefault()">Persyaratan</a>
            </div>
        </div>
    </div>



    {{-- Submit --}}
    <button type="submit" class="btn-submit" id="submit-btn">
        Masuk Sekarang
    </button>
</form>

<div class="register-row">
    Belum memiliki akun? <a href="{{ route('register') }}">Daftar Gratis</a>
</div>

<script>
(function () {
    let verified = false;

    /* Password toggle */
    const pwdInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePwd');
    const eyeShow = document.getElementById('eye-show');
    const eyeHide = document.getElementById('eye-hide');

    toggleBtn.addEventListener('click', () => {
        const isPassword = pwdInput.type === 'password';
        pwdInput.type = isPassword ? 'text' : 'password';
        eyeShow.style.display = isPassword ? 'none' : 'block';
        eyeHide.style.display = isPassword ? 'block' : 'none';
    });

    /* reCAPTCHA widget */
    const rcBox      = document.getElementById('rc-box');
    const rcCheckbox = document.getElementById('rc-checkbox');
    const answerInput = document.getElementById('g-recaptcha-response');
    const loginForm  = document.getElementById('login-form');

    function setSpinner() {
        rcCheckbox.innerHTML = '<div class="rc-spinner"></div>';
    }
    function setCheckmark() {
        rcCheckbox.classList.add('verified');
        rcCheckbox.innerHTML = `
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#4caf50" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>`;
    }

    rcBox.addEventListener('click', () => {
        if (verified) return;
        setSpinner();
        
        // Simulate network request delay
        setTimeout(() => {
            verified = true;
            answerInput.value = 'verified';
            setCheckmark();
        }, 800);
    });

    loginForm.addEventListener('submit', (e) => {
        if (!verified) {
            e.preventDefault();
            rcBox.style.border = '1.5px solid #dc2626';
            setTimeout(() => { rcBox.style.border = ''; }, 2000);
        }
    });
})();
</script>
</x-guest-layout>
