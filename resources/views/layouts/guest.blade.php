<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'POLVENT') }} — Platform Event Polbeng</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            min-height: 100vh; 
            display: flex; 
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Blurred Campus Background */
        body::before {
            content: '';
            position: fixed;
            inset: -30px;
            background: url('{{ asset("images/bg-kampus.jpg") }}') center/cover no-repeat;
            filter: blur(10px);
            z-index: -2;
            transform: scale(1.08);
        }
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(5, 15, 40, 0.55);
            z-index: -1;
        }

        .auth-wrapper {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            width: 100%;
            max-width: 1050px;
            min-height: 600px;
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4), 0 0 40px rgba(0,0,0, 0.2);
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
        .auth-left-content { position: relative; z-index: 1; text-align: center; max-width: 380px; }
        .auth-brand-logo {
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
            height: 110px;
            background: white;
            width: 110px;
            border-radius: 50%;
            padding: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .auth-brand-logo img.logo-polbeng { height: 100%; width: auto; object-fit: contain; }
        .auth-brand-name {
            font-size: 2.2rem; font-weight: 900; color: white;
            letter-spacing: 0.05em; margin-bottom: 0.25rem;
        }
        .auth-brand-sub {
            font-size: 0.9rem; color: rgba(255,255,255,0.8);
            font-weight: 400; margin-bottom: 2.5rem;
        }
        .auth-features { display: flex; flex-direction: column; gap: 1rem; text-align: left; }
        .auth-feature-item {
            display: flex; align-items: center; gap: 1rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 0.75rem;
            padding: 1rem;
            backdrop-filter: blur(4px);
        }
        .auth-feature-icon {
            width: 42px; height: 42px; flex-shrink: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 0.5rem;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .auth-feature-text .title { font-size: 0.95rem; font-weight: 600; color: white; }
        .auth-feature-text .sub { font-size: 0.8rem; color: rgba(255,255,255,0.7); margin-top: 0.15rem; }

        /* Right Panel */
        .auth-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            background: white;
        }
        .auth-form-container {
            width: 100%;
            max-width: 400px;
        }

        /* Mobile */
        @media (max-width: 860px) {
            .auth-wrapper { grid-template-columns: 1fr; border-radius: 1rem; }
            .auth-left { display: none; }
            .auth-right { padding: 2rem; }
            body { padding: 1rem; }
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
                    @if(request()->is('admin*'))
                        <!-- Fitur untuk Admin -->
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">🛡️</div>
                            <div class="auth-feature-text">
                                <div class="title">Keamanan Terpusat</div>
                                <div class="sub">Pantau dan amankan aktivitas platform</div>
                            </div>
                        </div>
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">👥</div>
                            <div class="auth-feature-text">
                                <div class="title">Manajemen Pengguna</div>
                                <div class="sub">Kelola data mahasiswa & hak akses</div>
                            </div>
                        </div>
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">📈</div>
                            <div class="auth-feature-text">
                                <div class="title">Laporan Sistem</div>
                                <div class="sub">Akses log dan statistik keseluruhan</div>
                            </div>
                        </div>
                    @elseif(request()->is('panitia*'))
                        <!-- Fitur untuk Panitia -->
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">🛠️</div>
                            <div class="auth-feature-text">
                                <div class="title">Kelola Event Efisien</div>
                                <div class="sub">Buat & atur kegiatan dengan terstruktur</div>
                            </div>
                        </div>
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">📊</div>
                            <div class="auth-feature-text">
                                <div class="title">Pantau Pendaftar</div>
                                <div class="sub">Lihat statistik peserta secara real-time</div>
                            </div>
                        </div>
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">🚀</div>
                            <div class="auth-feature-text">
                                <div class="title">Publikasi Maksimal</div>
                                <div class="sub">Jangkau seluruh mahasiswa Polbeng</div>
                            </div>
                        </div>
                    @else
                        <!-- Fitur untuk Mahasiswa -->
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">🎓</div>
                            <div class="auth-feature-text">
                                <div class="title">Eksplorasi Event Kampus</div>
                                <div class="sub">Temukan berbagai kegiatan seru di Polbeng</div>
                            </div>
                        </div>
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">⚡</div>
                            <div class="auth-feature-text">
                                <div class="title">Pendaftaran Praktis</div>
                                <div class="sub">Daftar event incaranmu dalam satu klik</div>
                            </div>
                        </div>
                        <div class="auth-feature-item">
                            <div class="auth-feature-icon">📜</div>
                            <div class="auth-feature-text">
                                <div class="title">Portofolio Digital</div>
                                <div class="sub">Kumpulkan sertifikat dari setiap partisipasi</div>
                            </div>
                        </div>
                    @endif
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
