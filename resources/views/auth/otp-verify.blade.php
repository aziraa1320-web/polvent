<x-guest-layout>
    <style>
        .form-title { font-size: 1.625rem; font-weight: 800; color: #1e293b; margin-bottom: 0.375rem; text-align: center; }
        .form-sub   { font-size: 0.875rem; color: #64748b; margin-bottom: 2rem; text-align: center; line-height: 1.5; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-weight: 600; font-size: 0.85rem; color: #374151; margin-bottom: 0.4rem; text-align: center; }
        .form-input {
            width: 100%; padding: 0.7rem 0.9rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.625rem;
            font-size: 1.5rem; color: #1e293b;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
            text-align: center;
            letter-spacing: 0.5rem;
        }
        .form-input:focus {
            border-color: #0056B3;
            box-shadow: 0 0 0 3px rgba(0,86,179,0.1);
        }
        .form-input.error { border-color: #dc2626; }
        .form-error { color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem; text-align: center; }
        .btn-login {
            width: 100%; padding: 0.8rem;
            background: #0056B3; color: white;
            border: none; border-radius: 0.625rem;
            font-size: 0.95rem; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            margin-top: 1.5rem;
        }
        .btn-login:hover { background: #003d80; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(0,86,179,0.3); }
        .form-divider { text-align: center; margin: 1.5rem 0; color: #94a3b8; font-size: 0.82rem; }
        .status-alert {
            background: #d1fae5; border: 1px solid #a7f3d0;
            color: #065f46; padding: 0.75rem 1rem;
            border-radius: 0.5rem; font-size: 0.875rem;
            margin-bottom: 1.25rem;
            text-align: center;
        }
        .resend-btn {
            background: none; border: none; color: #0056B3; font-weight: 600; font-size: 0.875rem;
            cursor: pointer; padding: 0; text-decoration: none; display: inline;
        }
        .resend-btn:hover { text-decoration: underline; }
    </style>

    <div class="form-title">Verifikasi Keamanan</div>
    <div class="form-sub">
        Untuk melindungi akun Anda, kami telah mengirimkan 6 digit kode OTP ke email Anda. Silakan masukkan kode tersebut di bawah ini.
    </div>

    @if(session('status'))
        <div class="status-alert">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="otp">Kode OTP (6 Digit)</label>
            <input id="otp" class="form-input {{ $errors->has('otp') ? 'error' : '' }}"
                type="text" name="otp" value="{{ old('otp') }}"
                placeholder="000000" maxlength="6"
                required autofocus autocomplete="one-time-code">
            @error('otp')
                <div class="form-error">{{ $message }}</div>
            @enderror
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-login">
            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Verifikasi & Masuk
        </button>
    </form>

    <div class="form-divider">— Belum menerima kode? —</div>
    
    <div style="text-align: center;">
        <form method="POST" action="{{ route('otp.resend') }}" style="display: inline;">
            @csrf
            <button type="submit" class="resend-btn">Kirim Ulang OTP</button>
        </form>
    </div>

    <div style="margin-top:1.5rem;text-align:center;">
        <a href="{{ route('login') }}" style="font-size:0.8rem;color:#94a3b8;text-decoration:none;">
            ← Kembali ke halaman Login
        </a>
    </div>
</x-guest-layout>
