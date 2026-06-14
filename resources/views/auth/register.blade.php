<x-guest-layout>
    <style>
        .form-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 0.375rem; }
        .form-sub   { font-size: 0.875rem; color: #64748b; margin-bottom: 1.75rem; }
        .form-group { margin-bottom: 1.1rem; }
        .form-label { display: block; font-weight: 600; font-size: 0.82rem; color: #374151; margin-bottom: 0.35rem; }
        .form-input {
            width: 100%; padding: 0.65rem 0.9rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.625rem;
            font-size: 0.875rem; color: #1e293b;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
        }
        .form-input:focus {
            border-color: #0056B3;
            box-shadow: 0 0 0 3px rgba(0,86,179,0.1);
        }
        .form-input.error { border-color: #dc2626; }
        .form-error { color: #dc2626; font-size: 0.76rem; margin-top: 0.25rem; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.875rem; }
        .form-hint { font-size: 0.74rem; color: #94a3b8; margin-top: 0.25rem; }
        .btn-register {
            width: 100%; padding: 0.8rem;
            background: #0056B3; color: white;
            border: none; border-radius: 0.625rem;
            font-size: 0.95rem; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            margin-top: 1.25rem;
        }
        .btn-register:hover { background: #003d80; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(0,86,179,0.3); }
        .login-link { text-align: center; font-size: 0.875rem; color: #64748b; margin-top: 1.25rem; }
        .login-link a { color: #0056B3; font-weight: 600; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }
        .info-box {
            background: #eff6ff; border: 1px solid #bfdbfe;
            border-radius: 0.5rem; padding: 0.65rem 0.875rem;
            font-size: 0.8rem; color: #1d4ed8;
            margin-bottom: 1.25rem;
            display: flex; align-items: flex-start; gap: 0.5rem;
        }
        .password-container { position: relative; }
        .password-toggle {
            position: absolute; right: 0.9rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #64748b;
            padding: 0; display: flex; align-items: center; justify-content: center;
        }
        .password-toggle:hover { color: #1e293b; }
        .form-input-password { padding-right: 2.5rem; }
    </style>

    <div class="form-title">Buat Akun Baru 🎓</div>
    <div class="form-sub">Daftar sebagai mahasiswa untuk mengikuti event kampus Polbeng</div>

    <div class="info-box">
        <svg style="width:16px;height:16px;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            Pendaftaran akun untuk <strong>Mahasiswa Polbeng</strong>. Akun Panitia dibuat oleh Admin.
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="name">Nama Lengkap</label>
            <input id="name" class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                type="text" name="name" value="{{ old('name') }}"
                placeholder="Nama sesuai KTM"
                required autofocus autocomplete="name">
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label" for="nim">NIM</label>
                <input id="nim" class="form-input {{ $errors->has('nim') ? 'error' : '' }}"
                    type="text" name="nim" value="{{ old('nim') }}"
                    placeholder="5302XXXXXXX"
                    maxlength="20">
                <div class="form-hint">Nomor Induk Mahasiswa</div>
                @error('nim')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input id="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                    type="email" name="email" value="{{ old('email') }}"
                    placeholder="nama@gmail.com"
                    required autocomplete="username">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Kata Sandi</label>
            <div class="password-container">
                <input id="password" class="form-input form-input-password {{ $errors->has('password') ? 'error' : '' }}"
                    type="password" name="password"
                    placeholder="Minimal 8 karakter"
                    required autocomplete="new-password">
                <button type="button" class="password-toggle" id="togglePassword" aria-label="Lihat kata sandi">
                    <svg id="eye-icon-pass" style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
            <div class="password-container">
                <input id="password_confirmation" class="form-input form-input-password"
                    type="password" name="password_confirmation"
                    placeholder="Ulangi kata sandi"
                    required autocomplete="new-password">
                <button type="button" class="password-toggle" id="toggleConfirmPassword" aria-label="Lihat konfirmasi kata sandi">
                    <svg id="eye-icon-confirm" style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password_confirmation')
                <div class="form-error">{{ $message }}</div>
            @enderror
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
    <div style="margin-top:1rem;text-align:center;">
        <a href="{{ route('home') }}" style="font-size:0.8rem;color:#94a3b8;text-decoration:none;">
            ← Kembali ke Beranda
        </a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function setupPasswordToggle(toggleId, inputId, iconId) {
                const toggle = document.querySelector(toggleId);
                const input = document.querySelector(inputId);
                const icon = document.querySelector(iconId);

                if (toggle && input && icon) {
                    toggle.addEventListener('click', function () {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                        
                        if (type === 'password') {
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                        } else {
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
                        }
                    });
                }
            }

            setupPasswordToggle('#togglePassword', '#password', '#eye-icon-pass');
            setupPasswordToggle('#toggleConfirmPassword', '#password_confirmation', '#eye-icon-confirm');
        });
    </script>
</x-guest-layout>
