<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="POLVENT - Platform resmi manajemen event kampus Politeknik Negeri Bengkalis. Daftar, ikuti, dan kelola event dengan mudah dan aman.">
    <title>POLVENT - Platform Manajemen Event Kampus Polbeng</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        :root { --blue: #0056B3; --dark: #003d80; }
        body { background: #f8fafc; color: #1e293b; }

        /* Navbar */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,86,179,0.1);
            padding: 0 2rem;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 1px 20px rgba(0,86,179,0.08);
        }
        .navbar-brand { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .navbar-logo {
            width: 40px; height: 40px;
            background: var(--blue);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 900; font-size: 1rem;
        }
        .navbar-title { font-weight: 800; font-size: 1.25rem; color: var(--blue); letter-spacing: 0.05em; }
        .navbar-subtitle { font-size: 0.65rem; color: #64748b; display: block; font-weight: 400; }
        .navbar-links { display: flex; align-items: center; gap: 1.5rem; }
        .navbar-links a { text-decoration: none; color: #374151; font-size: 0.9rem; font-weight: 500; transition: color 0.2s; }
        .navbar-links a:hover { color: var(--blue); }
        .navbar-auth { display: flex; align-items: center; gap: 0.75rem; }
        .btn-nav-login {
            padding: 0.5rem 1.25rem; border-radius: 0.5rem;
            font-size: 0.875rem; font-weight: 600;
            color: var(--blue); text-decoration: none;
            border: 1.5px solid var(--blue);
            transition: all 0.2s;
        }
        .btn-nav-login:hover { background: var(--blue); color: white; }
        .btn-nav-register {
            padding: 0.5rem 1.25rem; border-radius: 0.5rem;
            font-size: 0.875rem; font-weight: 600;
            background: var(--blue); color: white; text-decoration: none;
            transition: all 0.2s;
        }
        .btn-nav-register:hover { background: var(--dark); }

        /* Hero */
        .hero {
            padding-top: 64px;
            min-height: 100vh;
            background: linear-gradient(135deg, #0056B3 0%, #003d80 50%, #001f4d 100%);
            display: flex; align-items: center;
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='15'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .hero-container {
            max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;
            display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
            position: relative; z-index: 1;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.9);
            padding: 0.4rem 0.875rem; border-radius: 9999px;
            font-size: 0.8rem; font-weight: 500; margin-bottom: 1.5rem;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .hero h1 {
            font-size: clamp(2rem, 4vw, 3rem); font-weight: 900;
            color: white; line-height: 1.15; margin-bottom: 1.25rem;
        }
        .hero h1 span { color: #93c5fd; }
        .hero p { color: rgba(255,255,255,0.8); font-size: 1.05rem; line-height: 1.7; margin-bottom: 2rem; }
        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-hero-primary {
            padding: 0.875rem 2rem; border-radius: 0.625rem;
            background: white; color: var(--blue);
            font-weight: 700; font-size: 0.95rem; text-decoration: none;
            transition: all 0.2s; box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.25); }
        .btn-hero-secondary {
            padding: 0.875rem 2rem; border-radius: 0.625rem;
            background: rgba(255,255,255,0.15); color: white;
            font-weight: 600; font-size: 0.95rem; text-decoration: none;
            border: 1.5px solid rgba(255,255,255,0.3);
            transition: all 0.2s;
        }
        .btn-hero-secondary:hover { background: rgba(255,255,255,0.25); }
        .hero-visual {
            display: flex; flex-direction: column; gap: 1rem;
        }
        .hero-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 1rem; padding: 1.25rem;
            color: white;
        }
        .hero-card-title { font-weight: 700; font-size: 0.95rem; margin-bottom: 0.25rem; }
        .hero-card-sub { font-size: 0.8rem; color: rgba(255,255,255,0.7); }

        /* Features */
        .features {
            padding: 5rem 2rem;
            background: white;
        }
        .section-container { max-width: 1200px; margin: 0 auto; }
        .section-label {
            font-size: 0.8rem; font-weight: 700; color: var(--blue);
            letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 0.75rem;
        }
        .section-title { font-size: clamp(1.5rem, 3vw, 2.25rem); font-weight: 800; color: #1e293b; margin-bottom: 0.75rem; }
        .section-sub { color: #64748b; font-size: 1rem; max-width: 600px; }
        .features-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem; margin-top: 3rem;
        }
        .feature-card {
            padding: 1.75rem; border-radius: 1rem;
            border: 1.5px solid #f1f5f9;
            transition: all 0.3s;
        }
        .feature-card:hover { border-color: var(--blue); transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,86,179,0.12); }
        .feature-icon {
            width: 52px; height: 52px; border-radius: 0.875rem;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem; font-size: 1.5rem;
        }
        .feature-card h3 { font-weight: 700; font-size: 1rem; color: #1e293b; margin-bottom: 0.5rem; }
        .feature-card p { color: #64748b; font-size: 0.875rem; line-height: 1.6; }

        /* Events section */
        .events-section { padding: 5rem 2rem; background: #f8fafc; }
        .events-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem; margin-top: 2.5rem;
        }
        .event-card {
            background: white; border-radius: 1rem;
            border: 1px solid #e5e7eb; overflow: hidden;
            transition: all 0.3s;
        }
        .event-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.1); }
        .event-card-img {
            height: 160px;
            background: linear-gradient(135deg, var(--blue), var(--dark));
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .event-card-img span { font-size: 3rem; }
        .event-card-body { padding: 1.25rem; }
        .event-date-badge {
            display: inline-flex; align-items: center; gap: 0.35rem;
            background: #e8f0fe; color: var(--blue);
            padding: 0.25rem 0.65rem; border-radius: 9999px;
            font-size: 0.72rem; font-weight: 600; margin-bottom: 0.75rem;
        }
        .event-card-body h3 { font-weight: 700; font-size: 1rem; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.4; }
        .event-card-body p { color: #64748b; font-size: 0.8rem; line-height: 1.5; margin-bottom: 1rem;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .event-card-footer {
            display: flex; align-items: center; justify-content: space-between;
            padding-top: 0.75rem; border-top: 1px solid #f1f5f9;
        }
        .quota-info { font-size: 0.8rem; color: #64748b; }
        .quota-info strong { color: #1e293b; }
        .btn-detail {
            padding: 0.4rem 0.875rem; border-radius: 0.5rem;
            background: var(--blue); color: white;
            font-size: 0.8rem; font-weight: 600; text-decoration: none;
            transition: background 0.2s;
        }
        .btn-detail:hover { background: var(--dark); }

        /* Stats */
        .stats-section {
            background: linear-gradient(135deg, #0056B3, #003d80);
            padding: 4rem 2rem;
        }
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem; max-width: 1000px; margin: 0 auto; text-align: center;
        }
        .stat-item .value { font-size: 3rem; font-weight: 900; color: white; line-height: 1; }
        .stat-item .unit { font-size: 1.5rem; }
        .stat-item .label { color: rgba(255,255,255,0.75); font-size: 0.875rem; margin-top: 0.5rem; }

        /* Footer */
        footer {
            background: #1e293b; color: rgba(255,255,255,0.7);
            padding: 2rem; text-align: center; font-size: 0.875rem;
        }
        footer strong { color: white; }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-container { grid-template-columns: 1fr; gap: 2rem; }
            .hero-visual { display: none; }
            .navbar-links { display: none; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <div style="width: 45px; height: 45px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <img src="{{ asset('images/logo.png') }}" alt="PV Logo" style="width: 100%; height: 100%; object-fit: contain; padding: 2px;">
            </div>
            <div>
                <span class="navbar-title">POLVENT</span>
                <span class="navbar-subtitle">Platform Event Polbeng</span>
            </div>
        </a>
        <div class="navbar-links">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="#events">Event</a>
            <a href="#tentang">Tentang</a>
        </div>
        <div class="navbar-auth">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-nav-register">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-nav-login" id="btn-masuk">Masuk</a>
                <a href="{{ route('register') }}" class="btn-nav-register" id="btn-daftar">Daftar</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div>
                <div class="hero-badge">
                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Aman & Terpercaya
                </div>
                <h1>Temukan & Ikuti<br>Event Terbaik di<br><span>Politeknik Negeri Bengkalis</span></h1>
                <p>POLVENT adalah platform resmi manajemen event kampus Polbeng. Daftar, ikuti, dan kelola event dengan mudah dan aman menggunakan teknologi Laravel terkini.</p>
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn-hero-primary" id="btn-jelajahi">🚀 Jelajahi Event</a>
                    <a href="{{ route('login') }}" class="btn-hero-secondary" id="btn-daftar-sekarang">Daftar Sekarang</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-card">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem;">
                        <span style="font-size:1.5rem;">🛡️</span>
                        <div>
                            <div class="hero-card-title">Keamanan Data</div>
                            <div class="hero-card-sub">SQL Injection, XSS & CSRF Protection</div>
                        </div>
                    </div>
                    <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
                        <span style="background:rgba(255,255,255,0.15);padding:0.2rem 0.5rem;border-radius:4px;font-size:0.7rem;">Eloquent ORM</span>
                        <span style="background:rgba(255,255,255,0.15);padding:0.2rem 0.5rem;border-radius:4px;font-size:0.7rem;">Blade Escaping</span>
                        <span style="background:rgba(255,255,255,0.15);padding:0.2rem 0.5rem;border-radius:4px;font-size:0.7rem;">CSRF Token</span>
                    </div>
                </div>
                <div class="hero-card">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem;">
                        <span style="font-size:1.5rem;">👥</span>
                        <div>
                            <div class="hero-card-title">Role Based Access Control</div>
                            <div class="hero-card-sub">Admin · Panitia · Mahasiswa</div>
                        </div>
                    </div>
                    <div style="background:rgba(255,255,255,0.1);border-radius:0.5rem;padding:0.5rem;font-size:0.75rem;color:rgba(255,255,255,0.8);">
                        Akses halaman sesuai hak peran masing-masing
                    </div>
                </div>
                <div class="hero-card">
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <span style="font-size:1.5rem;">📋</span>
                        <div>
                            <div class="hero-card-title">Audit Trail</div>
                            <div class="hero-card-sub">Setiap aktivitas tercatat otomatis</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="tentang">
        <div class="section-container">
            <div class="section-label">Fitur Unggulan</div>
            <h2 class="section-title">Kenapa Pilih POLVENT?</h2>
            <p class="section-sub">Platform yang dibangun dengan standar keamanan tinggi untuk kebutuhan event kampus Polbeng.</p>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#e8f0fe;">🛡️</div>
                    <h3>Event Terpercaya</h3>
                    <p>Semua event diverifikasi panitia resmi kampus. Data tersimpan aman dengan enkripsi dan proteksi berlapis.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background:#d1fae5;">⚡</div>
                    <h3>Pendaftaran Mudah</h3>
                    <p>Daftar event dalam beberapa klik saja. Sistem antrian cerdas mencegah overbooking dengan transaction lock.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fef3c7;">🔒</div>
                    <h3>Keamanan Data</h3>
                    <p>Data aman dengan SQL Injection prevention, XSS filtering, CSRF protection, dan password bcrypt hashing.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fee2e2;">📊</div>
                    <h3>Informasi Lengkap</h3>
                    <p>Detail event, jadwal, kuota, dan status pendaftaran tersedia real-time. Pantau riwayat event Anda kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="events-section" id="events">
        <div class="section-container">
            <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:0;">
                <div>
                    <div class="section-label">Event Terbaru</div>
                    <h2 class="section-title">Event yang Sedang Dibuka</h2>
                </div>
                <a href="{{ route('login') }}" style="color:var(--blue);font-weight:600;font-size:0.875rem;text-decoration:none;">Lihat Semua Event →</a>
            </div>
            <div class="events-grid">
                @forelse($events as $event)
                    <div class="event-card">
                        <div class="event-card-img">
                            @if($event->poster)
                                <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <span>🎓</span>
                            @endif
                        </div>
                        <div class="event-card-body">
                            <div class="event-date-badge">
                                📅 {{ $event->event_date->format('d M Y') }}
                            </div>
                            <h3>{{ $event->title }}</h3>
                            <p>{{ $event->description }}</p>
                            <div class="event-card-footer">
                                <div class="quota-info">
                                    Kuota: <strong>{{ $event->quota }}</strong>
                                </div>
                                <a href="{{ route('login') }}" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column:1/-1;text-align:center;padding:3rem;color:#64748b;">
                        <div style="font-size:3rem;margin-bottom:1rem;">📅</div>
                        <p>Belum ada event yang tersedia. Pantau terus ya!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="value">{{ $stats['total_events'] }}<span class="unit">+</span></div>
                <div class="label">Event Tersedia</div>
            </div>
            <div class="stat-item">
                <div class="value">{{ $stats['total_mahasiswa'] }}<span class="unit">+</span></div>
                <div class="label">Mahasiswa Aktif</div>
            </div>
            <div class="stat-item">
                <div class="value">{{ $stats['total_pendaftar'] }}<span class="unit">+</span></div>
                <div class="label">Pendaftar</div>
            </div>
            <div class="stat-item">
                <div class="value">{{ $stats['total_panitia'] }}<span class="unit">+</span></div>
                <div class="label">Panitia Aktif</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} <strong>POLVENT</strong> — Platform Manajemen Event Kampus <strong>Politeknik Negeri Bengkalis</strong></p>
        <p style="margin-top:0.5rem;font-size:0.8rem;">Dibangun dengan Laravel 13 · Keamanan Basis Data & Manajemen Identitas</p>
    </footer>
</body>
</html>