<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'POLVENT') }} — Platform Event Polbeng</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f0f4f8; min-height: 100vh; display: flex; }

        .auth-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
            width: 100%;
        }

        /* Left Panel */
        .auth-left {
            background: linear-gradient(145deg, #0056B3 0%, #003d80 55%, #001f4d 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .auth-left::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            top: -100px; left: -100px;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            bottom: -80px; right: -80px;
        }
        .auth-left-content { position: relative; z-index: 1; text-align: center; max-width: 360px; }
        .auth-brand-logo {
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
            height: 110px;
        }
        .auth-brand-logo img.logo-polbeng { height: 100%; width: auto; object-fit: contain; }
        .auth-brand-name {
            font-size: 2rem; font-weight: 900; color: white;
            letter-spacing: 0.1em; margin-bottom: 0.25rem;
        }
        .auth-brand-sub {
            font-size: 0.85rem; color: rgba(255,255,255,0.7);
            font-weight: 400; margin-bottom: 2.5rem;
        }
        .auth-features { display: flex; flex-direction: column; gap: 1rem; text-align: left; }
        .auth-feature-item {
            display: flex; align-items: center; gap: 0.875rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
        }
        .auth-feature-icon {
            width: 38px; height: 38px; flex-shrink: 0;
            background: rgba(255,255,255,0.15);
            border-radius: 0.5rem;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }
        .auth-feature-text .title { font-size: 0.875rem; font-weight: 600; color: white; }
        .auth-feature-text .sub { font-size: 0.75rem; color: rgba(255,255,255,0.65); margin-top: 0.1rem; }

        /* Right Panel */
        .auth-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: #f8fafc;
        }
        .auth-form-container {
            width: 100%;
            max-width: 420px;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .auth-wrapper { grid-template-columns: 1fr; }
            .auth-left { display: none; }
            .auth-right { padding: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <!-- Left branding panel -->
        <div class="auth-left">
            <div class="auth-left-content">
                <div class="auth-brand-logo">
                    <img src="{{ asset('images/logo-polbeng.png') }}" alt="Polbeng Logo" class="logo-polbeng">
                </div>
                <div class="auth-brand-name">POLVENT</div>
                <div class="auth-brand-sub">Platform Manajemen Event<br>Politeknik Negeri Bengkalis</div>

                <div class="auth-features">
                    <div class="auth-feature-item">
                        <div class="auth-feature-icon">🎓</div>
                        <div class="auth-feature-text">
                            <div class="title">Event Kampus Resmi</div>
                            <div class="sub">Semua event dikelola panitia terverifikasi</div>
                        </div>
                    </div>
                    <div class="auth-feature-item">
                        <div class="auth-feature-icon">⚡</div>
                        <div class="auth-feature-text">
                            <div class="title">Pendaftaran Mudah</div>
                            <div class="sub">Daftar event dalam hitungan detik</div>
                        </div>
                    </div>
                    <div class="auth-feature-item">
                        <div class="auth-feature-icon">🔒</div>
                        <div class="auth-feature-text">
                            <div class="title">Data Aman</div>
                            <div class="sub">Proteksi CSRF, XSS & enkripsi password</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right form panel -->
        <div class="auth-right">
            <div class="auth-form-container">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
