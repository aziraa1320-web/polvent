<x-guest-layout>
<style>
    .form-title { font-size: 1.6rem; font-weight: 800; color: #1e293b; margin-bottom: 0.3rem; }
    .form-sub   { font-size: 0.875rem; color: #64748b; margin-bottom: 1.5rem; line-height: 1.6; }
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; font-weight: 600; font-size: 0.82rem; color: #374151; margin-bottom: 0.35rem; letter-spacing: 0.01em; }

    /* Input + icon */
    .input-wrap { position: relative; }
    .input-ico {
        position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%);
        color: #9ca3af; display: flex; align-items: center; pointer-events: none;
        transition: color 0.2s;
    }
    .input-ico svg { width: 16px; height: 16px; }
    .input-wrap:focus-within .input-ico { color: #0056B3; }

    .form-input {
        width: 100%; padding: 0.68rem 1rem 0.68rem 2.4rem;
        border: 1.5px solid #e2e8f0; border-radius: 0.625rem;
        font-size: 0.875rem; color: #1e293b; background: #f9fafb;
        outline: none; transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .form-input:focus { border-color: #0056B3; background: white; box-shadow: 0 0 0 3px rgba(0,86,179,0.09); }
    .form-input.error { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.07); }
    .form-error { color: #dc2626; font-size: 0.76rem; margin-top: 0.25rem; display: flex; align-items: center; gap: 0.3rem; }

    /* Two-column grid */
    .form-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 0.875rem;
    }
    @media (max-width: 480px) { .form-grid { grid-template-columns: 1fr; } }

    .form-hint { font-size: 0.73rem; color: #94a3b8; margin-top: 0.25rem; }

    /* Password toggle */
    .pwd-toggle {
        position: absolute; right: 0.875rem; top: 50%; transform: translateY(-50%);
        background: none; border: none; cursor: pointer; color: #9ca3af;
        padding: 0.25rem; display: flex; align-items: center; border-radius: 0.25rem;
        transition: color 0.2s;
    }
    .pwd-toggle:hover { color: #374151; }
    .form-input-pwd { padding-right: 2.75rem; }

    /* Info box */
    .info-box {
        background: #eff6ff; border: 1px solid #bfdbfe;
        border-radius: 0.625rem; padding: 0.7rem 0.875rem;
        font-size: 0.8rem; color: #1d4ed8; margin-bottom: 1.25rem;
        display: flex; align-items: flex-start; gap: 0.5rem;
    }
    .info-box svg { width: 15px; height: 15px; flex-shrink: 0; margin-top: 1px; }

    /* Error banner */
    .error-banner {
        background: #fef2f2; border: 1px solid #fecaca;
        border-radius: 0.625rem; padding: 0.75rem 1rem;
        margin-bottom: 1.25rem; color: #991b1b; font-size: 0.875rem;
        display: flex; align-items: center; gap: 0.6rem;
    }

    /* Submit */
    .btn-register {
        width: 100%; padding: 0.875rem;
        background: linear-gradient(135deg, #0056B3 0%, #003d80 100%);
        color: white; border: none; border-radius: 0.625rem;
        font-size: 0.95rem; font-weight: 700;
        cursor: pointer; transition: all 0.2s;
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        margin-top: 1.25rem;
        box-shadow: 0 4px 14px rgba(0,86,179,0.28);
        letter-spacing: 0.02em;
    }
    .btn-register:hover {
        background: linear-gradient(135deg, #004494 0%, #001f4d 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(0,86,179,0.38);
    }
    .btn-register:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    .login-link { text-align: center; font-size: 0.875rem; color: #64748b; margin-top: 1.25rem; }
    .login-link a { color: #0056B3; font-weight: 600; text-decoration: none; }
    .login-link a:hover { text-decoration: underline; }

    /* Password strength indicator */
    .pwd-strength-bar {
        height: 3px; background: #e5e7eb; border-radius: 9999px;
        margin-top: 0.4rem; overflow: hidden;
    }
    .pwd-strength-fill {
        height: 100%; border-radius: 9999px;
        transition: width 0.3s, background 0.3s;
        width: 0%;
    }
    .pwd-strength-text { font-size: 0.72rem; margin-top: 0.25rem; font-weight: 500; }

    @keyframes spin { to { transform: rotate(360deg); } }
</style>

<div class="form-title">Buat Akun Baru 🎓</div>
<div class="form-sub">Daftar sebagai mahasiswa POLBENG untuk mengikuti berbagai event kampus</div>

<div class="info-box">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div>
        Pendaftaran akun khusus untuk <strong>Mahasiswa Polbeng</strong>. Akun Panitia hanya dibuat oleh Admin.
    </div>
</div>

@if($errors->any())
    <div class="error-banner">
        <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('register') }}" id="register-form">
    @csrf

    {{-- Nama Lengkap --}}
    <div class="form-group">
        <label class="form-label" for="name">Nama Lengkap</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </span>
            <input id="name" class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                   type="text" name="name" value="{{ old('name') }}"
                   placeholder="Nama sesuai KTM"
                   required autofocus autocomplete="name">
        </div>
        @error('name') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    {{-- NIM + Email --}}
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label" for="nim">NIM</label>
            <div class="input-wrap">
                <span class="input-ico">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                    </svg>
                </span>
                <input id="nim" class="form-input {{ $errors->has('nim') ? 'error' : '' }}"
                       type="text" name="nim" value="{{ old('nim') }}"
                       placeholder="5302XXXXXXX" maxlength="20">
            </div>
            <div class="form-hint">Nomor Induk Mahasiswa</div>
            @error('nim') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <div class="input-wrap">
                <span class="input-ico">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
                <input id="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                       type="email" name="email" value="{{ old('email') }}"
                       placeholder="nama@gmail.com"
                       required autocomplete="username">
            </div>
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>
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
            <input id="password" class="form-input form-input-pwd {{ $errors->has('password') ? 'error' : '' }}"
                   type="password" name="password"
                   placeholder="Minimal 8 karakter"
                   required autocomplete="new-password"
                   oninput="checkStrength(this.value)">
            <button type="button" class="pwd-toggle" id="togglePassword" aria-label="Lihat kata sandi">
                <svg id="eye-pass" style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </div>
        {{-- Strength bar --}}
        <div class="pwd-strength-bar">
            <div class="pwd-strength-fill" id="strength-fill"></div>
        </div>
        <div class="pwd-strength-text" id="strength-text" style="color:#94a3b8;"></div>
        @error('password') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    {{-- Konfirmasi Password --}}
    <div class="form-group">
        <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
        <div class="input-wrap">
            <span class="input-ico">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </span>
            <input id="password_confirmation" class="form-input form-input-pwd"
                   type="password" name="password_confirmation"
                   placeholder="Ulangi kata sandi"
                   required autocomplete="new-password">
            <button type="button" class="pwd-toggle" id="toggleConfirmPassword" aria-label="Lihat konfirmasi kata sandi">
                <svg id="eye-confirm" style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </div>
        @error('password_confirmation') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn-register" id="btn-register">
        <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
        Buat Akun Mahasiswa
    </button>
</form>

<div class="login-link">
    Sudah punya akun? <a href="{{ route('login') }}" id="link-masuk">Masuk sekarang</a>
</div>
<div style="margin-top:0.875rem;text-align:center;">
    <a href="{{ route('home') }}" style="font-size:0.78rem;color:#94a3b8;text-decoration:none;">
        ← Kembali ke Beranda
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    /* ===== PASSWORD TOGGLE ===== */
    function setupToggle(btnId, inputId, iconId) {
        const btn   = document.getElementById(btnId);
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (!btn || !input) return;
        let visible = false;
        btn.addEventListener('click', function () {
            visible = !visible;
            input.type = visible ? 'text' : 'password';
            icon.innerHTML = visible
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        });
    }
    setupToggle('togglePassword',        'password',              'eye-pass');
    setupToggle('toggleConfirmPassword', 'password_confirmation', 'eye-confirm');

    /* ===== LOADING STATE ===== */
    document.getElementById('register-form').addEventListener('submit', function () {
        const btn = document.getElementById('btn-register');
        btn.disabled = true;
        btn.innerHTML = `<svg style="width:18px;height:18px;animation:spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Memproses...`;
    });
});

/* ===== PASSWORD STRENGTH ===== */
function checkStrength(val) {
    const fill  = document.getElementById('strength-fill');
    const label = document.getElementById('strength-text');
    if (!fill) return;
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { pct: '0%',   color: '#e5e7eb', text: '',              textColor: '#94a3b8' },
        { pct: '25%',  color: '#dc2626', text: 'Sangat Lemah',  textColor: '#dc2626' },
        { pct: '50%',  color: '#f97316', text: 'Lemah',         textColor: '#f97316' },
        { pct: '75%',  color: '#eab308', text: 'Sedang',        textColor: '#ca8a04' },
        { pct: '100%', color: '#16a34a', text: 'Kuat',          textColor: '#16a34a' },
    ];
    const lvl = val.length === 0 ? levels[0] : levels[score] || levels[4];
    fill.style.width      = lvl.pct;
    fill.style.background = lvl.color;
    label.textContent     = lvl.text;
    label.style.color     = lvl.textColor;
}
</script>
</x-guest-layout>
