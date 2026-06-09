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
    </style>

    <div class="form-title">Buat Akun Baru 🎓</div>
    <div class="form-sub">Daftar sebagai mahasiswa untuk mengikuti event kampus Polbeng</div>

    <div class="info-box">
        <svg style="width:16px;height:16px;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Pendaftaran akun untuk <strong>Mahasiswa Polbeng</strong>. Akun Panitia dibuat oleh Admin.
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
                    placeholder="email@polbeng.ac.id"
                    required autocomplete="username">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Kata Sandi</label>
            <input id="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                type="password" name="password"
                placeholder="Minimal 8 karakter"
                required autocomplete="new-password">
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" class="form-input"
                type="password" name="password_confirmation"
                placeholder="Ulangi kata sandi"
                required autocomplete="new-password">
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
</x-guest-layout>
