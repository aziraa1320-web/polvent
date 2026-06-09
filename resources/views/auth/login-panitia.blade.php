<x-guest-layout>
    <style>
        .form-title { font-size: 1.625rem; font-weight: 800; color: #1e293b; margin-bottom: 0.375rem; }
        .form-sub   { font-size: 0.875rem; color: #64748b; margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-weight: 600; font-size: 0.85rem; color: #374151; margin-bottom: 0.4rem; }
        .form-input {
            width: 100%; padding: 0.7rem 0.9rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.625rem;
            font-size: 0.9rem; color: #1e293b;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
        }
        .form-input:focus {
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5,150,105,0.1);
        }
        .form-input.error { border-color: #dc2626; }
        .form-error { color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem; }
        .form-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .remember-label { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #374151; cursor: pointer; }
        .remember-label input { accent-color: #059669; width: 15px; height: 15px; }
        .btn-login {
            width: 100%; padding: 0.8rem;
            background: #059669; color: white;
            border: none; border-radius: 0.625rem;
            font-size: 0.95rem; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        }
        .btn-login:hover { background: #047857; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(5,150,105,0.3); }
        .status-alert {
            background: #d1fae5; border: 1px solid #a7f3d0;
            color: #065f46; padding: 0.75rem 1rem;
            border-radius: 0.5rem; font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }
        .badge {
            display: inline-block; padding: 0.2rem 0.5rem; background: #d1fae5; color: #065f46;
            border-radius: 4px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; margin-bottom: 1rem;
            border: 1px solid #6ee7b7;
        }
    </style>

    <div class="badge">Akses Kepanitiaan</div>
    <div class="form-title">Portal Panitia 📋</div>
    <div class="form-sub">Masuk untuk mengelola event dan menyetujui pendaftar.</div>

    @if(session('status'))
        <div class="status-alert">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('panitia.login') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="email">Email Panitia</label>
            <input id="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                type="email" name="email" value="{{ old('email') }}"
                placeholder="panitia@polbeng.ac.id"
                required autofocus autocomplete="username">
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Kata Sandi</label>
            <input id="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                type="password" name="password"
                placeholder="••••••••"
                required autocomplete="current-password">
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <label class="remember-label">
                <input type="checkbox" name="remember" id="remember_me">
                Ingat Sesi
            </label>
        </div>

        <button type="submit" class="btn-login" id="btn-login">
            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Masuk sebagai Panitia
        </button>
    </form>
</x-guest-layout>
