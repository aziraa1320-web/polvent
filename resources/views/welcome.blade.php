<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="POLVENT - Platform resmi manajemen event kampus Politeknik Negeri Bengkalis.">
    <title>POLVENT — Portal Event Politeknik Negeri Bengkalis</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --navy: #0f285c; /* Biru Dongker Khas Polvent */
            --navy-light: #1e3a8a;
            --blue: #2563eb;
            --blue-hover: #1d4ed8;
            --emerald: #059669;
            --text-main: #334155;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-light); color: var(--text-main); overflow-x: hidden; }
        h1, h2, h3, h4, .font-outfit { font-family: 'Outfit', sans-serif; }
        a { text-decoration: none; }

        /* ======= NAVBAR (GLASSMORPHISM) ======= */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.4);
            height: 72px; padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .navbar-brand { display: flex; align-items: center; gap: 0.8rem; }
        .navbar-logo { 
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 4px; height: 44px;
        }
        .navbar-logo img { height: 100%; width: auto; object-fit: contain; }
        .navbar-logo img.logo-polvent { height: 200%; width: auto; }
        
        .navbar-links { display: flex; gap: 2.5rem; }
        .navbar-links a { color: var(--text-main); font-size: 0.9rem; font-weight: 600; transition: color 0.2s; }
        .navbar-links a:hover { color: var(--blue); }

        .navbar-auth { display: flex; gap: 1rem; align-items: center; }
        .btn-nav-login { font-weight: 600; color: var(--navy); font-size: 0.9rem; transition: color 0.2s; }
        .btn-nav-login:hover { color: var(--blue); }
        .btn-nav-register {
            background: var(--navy); color: white; padding: 0.5rem 1.25rem;
            border-radius: 8px; font-weight: 600; font-size: 0.9rem;
            transition: all 0.3s; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        }
        .btn-nav-register:hover { background: var(--blue); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3); }

        /* ======= HERO SECTION (CAMPUS BG + GLASS) ======= */
        .hero {
            position: relative;
            min-height: 100vh;
            padding-top: 72px;
            display: flex; align-items: center;
            /* Background image with neutral dark gradient overlay (Tanpa tint biru) */
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.4) 100%), 
                        url('{{ asset("images/bg-kampus.jpg") }}') center/cover no-repeat fixed;
            overflow: hidden;
        }
        .hero-container {
            max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;
            display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
            width: 100%; position: relative; z-index: 2;
        }
        
        .hero-content { color: white; }
        .hero-badge {
            display: inline-block; padding: 0.4rem 1rem; border-radius: 50px;
            background: rgba(37, 99, 235, 0.2); border: 1px solid rgba(37, 99, 235, 0.4);
            color: #60a5fa; font-size: 0.8rem; font-weight: 600; margin-bottom: 1.5rem;
            backdrop-filter: blur(8px);
        }
        .hero h1 { font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 900; line-height: 1.1; margin-bottom: 1.5rem; }
        .hero h1 span { color: #3b82f6; text-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
        .hero p { font-size: 1.1rem; color: #cbd5e1; line-height: 1.6; margin-bottom: 2.5rem; max-width: 90%; }
        
        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-primary {
            background: var(--blue); color: white; padding: 0.875rem 2rem;
            border-radius: 12px; font-weight: 700; font-size: 1rem;
            display: flex; align-items: center; gap: 0.5rem;
            transition: all 0.3s; box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
        }
        .btn-primary:hover { background: var(--blue-hover); transform: translateY(-3px); box-shadow: 0 12px 28px rgba(37, 99, 235, 0.5); }
        
        .btn-secondary-glass {
            background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2);
            color: white; padding: 0.875rem 2rem; border-radius: 12px;
            font-weight: 600; font-size: 1rem; backdrop-filter: blur(10px);
            transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;
        }
        .btn-secondary-glass:hover { background: rgba(255, 255, 255, 0.2); transform: translateY(-3px); }

        /* GLASS CARDS IN HERO */
        .hero-visual { display: flex; flex-direction: column; gap: 1rem; }
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--blue);
            border-radius: 16px; padding: 1.25rem 1.5rem;
            display: flex; align-items: flex-start; gap: 1rem;
            color: white; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover { transform: translateX(-5px) scale(1.02); border-color: rgba(255,255,255,0.3); border-left-color: #60a5fa; background: rgba(255,255,255,0.12); box-shadow: 0 10px 30px rgba(0,0,0,0.25); }
        
        .gc-icon { 
            width: 48px; height: 48px; border-radius: 12px; 
            background: rgba(255, 255, 255, 0.1); display: flex; align-items: center; justify-content: center; 
            font-size: 1.5rem; flex-shrink: 0;
        }
        .gc-content h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 0.25rem; }
        .gc-content p { font-size: 0.8rem; color: #94a3b8; line-height: 1.4; margin: 0; }

        /* ======= STATS FLOATING ======= */
        .stats-wrapper { margin-top: -60px; position: relative; z-index: 10; padding: 0 2rem; max-width: 1200px; margin-left: auto; margin-right: auto; }
        .stats-container {
            background: white; border-radius: 20px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            display: grid; grid-template-columns: repeat(4, 1fr);
            padding: 2.5rem 2rem; gap: 2rem; border: 1px solid #f1f5f9;
        }
        .stat-box { text-align: center; position: relative; }
        .stat-box:not(:last-child)::after {
            content: ''; position: absolute; right: -1rem; top: 10%; height: 80%;
            width: 1px; background: #e2e8f0;
        }
        .stat-num { font-size: 3rem; font-weight: 900; font-family: 'Outfit'; color: var(--navy); line-height: 1; margin-bottom: 0.5rem; }
        .stat-num span { color: var(--blue); }
        .stat-label { font-size: 0.85rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }

        /* ======= EVENTS SECTION ======= */
        .section-padding { padding: 6rem 2rem; max-width: 1200px; margin: 0 auto; }
        .section-header { margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end; }
        .section-title { font-size: 2.5rem; font-weight: 800; color: var(--navy); margin-bottom: 0.5rem; }
        .section-subtitle { color: var(--text-muted); font-size: 1.1rem; }
        .link-all { color: var(--blue); font-weight: 600; display: flex; align-items: center; gap: 0.5rem; transition: gap 0.3s; }
        .link-all:hover { gap: 0.75rem; }

        .events-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; }
        .event-card {
            background: white; border-radius: 20px; overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex; flex-direction: column;
        }
        .event-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1); border-color: #cbd5e1; }
        
        .ec-image { height: 200px; position: relative; background: var(--navy-light); overflow: hidden; }
        .ec-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .event-card:hover .ec-image img { transform: scale(1.05); }
        .ec-date {
            position: absolute; top: 1rem; right: 1rem;
            background: rgba(255,255,255,0.9); backdrop-filter: blur(4px);
            padding: 0.5rem 0.75rem; border-radius: 12px;
            text-align: center; font-weight: 800; color: var(--navy);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .ec-date .day { font-size: 1.25rem; line-height: 1; }
        .ec-date .month { font-size: 0.7rem; text-transform: uppercase; color: var(--blue); }

        .ec-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
        .ec-title { font-size: 1.25rem; font-weight: 700; color: var(--navy); margin-bottom: 0.75rem; line-height: 1.3; }
        .ec-desc { color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        
        .ec-footer { margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #f1f5f9; }
        .ec-quota { font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.4rem; }
        .ec-quota strong { color: var(--emerald); font-size: 0.95rem; }
        .btn-card { background: var(--bg-light); color: var(--navy); padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; }
        .btn-card:hover { background: var(--navy); color: white; }

        /* ======= FEATURES SECTION ======= */
        .features-wrap { background: var(--navy); color: white; padding: 6rem 0; }
        .feat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem; margin-top: 4rem; }
        .feat-item { padding: 2rem; background: rgba(255,255,255,0.03); border-radius: 24px; border: 1px solid rgba(255,255,255,0.05); transition: transform 0.3s; }
        .feat-item:hover { transform: translateY(-5px); background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); }
        .feat-icon { width: 64px; height: 64px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin-bottom: 1.5rem; }
        .feat-item h3 { font-size: 1.25rem; margin-bottom: 1rem; font-family: 'Outfit'; }
        .feat-item p { color: #94a3b8; font-size: 0.95rem; line-height: 1.6; }

        /* ======= FOOTER ======= */
        footer { background: #ffffff; color: #64748b; padding: 5rem 2rem 2rem; border-top: 1px solid #e2e8f0; }
        .footer-grid { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 4rem; margin-bottom: 4rem; }
        .footer-brand h2 { color: var(--navy); font-size: 1.75rem; font-weight: 800; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; font-family: 'Outfit'; }
        .footer-brand p { font-size: 0.95rem; line-height: 1.6; max-width: 350px; color: #64748b; }
        .footer-title { color: var(--navy); font-weight: 700; font-family: 'Outfit'; font-size: 1.1rem; margin-bottom: 1.5rem; }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 0.8rem; }
        .footer-links a { color: #64748b; transition: color 0.2s; font-size: 0.9rem; }
        .footer-links a:hover { color: var(--blue); }
        .footer-bottom { max-width: 1200px; margin: 0 auto; text-align: center; padding-top: 2rem; border-top: 1px solid #e2e8f0; font-size: 0.85rem; color: #94a3b8; }

        /* ======= RESPONSIVE ======= */
        @media (max-width: 1024px) {
            .hero-container { grid-template-columns: 1fr; gap: 3rem; text-align: center; }
            .hero h1 { font-size: 2.8rem; }
            .hero p { margin: 0 auto 2.5rem; }
            .hero-actions { justify-content: center; }
            .hero-visual { display: none; }
            .stats-container { grid-template-columns: repeat(2, 1fr); gap: 2rem 0; padding: 2rem; }
            .stat-box:nth-child(2)::after { display: none; }
            .feat-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .navbar-links { display: none; }
            .section-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .stats-container { grid-template-columns: 1fr; gap: 2rem 0; }
            .stat-box::after { display: none; }
            .feat-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; gap: 2.5rem; }
            #about > div { grid-template-columns: 1fr !important; gap: 2rem !important; }
            #about img { display: none; } /* Hide the big logo on small screens to save space */
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <div class="navbar-logo">
                <!-- Gunakan dua logo berdampingan -->
                <img src="{{ asset('images/logo-polbeng.png') }}" alt="Polbeng Logo">
                <img src="{{ asset('images/logo-polvent.png') }}" alt="Polvent Logo" class="logo-polvent">
            </div>
            <!-- Teks POLVENT dihapus sesuai permintaan -->
        </a>

        <div class="navbar-links">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="#events">Daftar Event</a>
            <a href="#features">Keunggulan</a>
            <a href="#about">Tentang Kami</a>
        </div>

        <div class="navbar-auth">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn-nav-register">Buka Dashboard</a>
                @elseif(auth()->user()->role === 'panitia')
                    <a href="{{ route('panitia.dashboard') }}" class="btn-nav-register">Buka Dashboard</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn-nav-register">Buka Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-nav-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn-nav-register">Daftar Sekarang</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline-block;vertical-align:text-bottom;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    Platform Resmi Kampus
                </div>
                <h1>Portal Manajemen <br><span>Event Polbeng</span></h1>
                <p>Temukan, daftar, dan kelola partisipasi Anda dalam berbagai event kampus Politeknik Negeri Bengkalis secara digital dengan mudah, cepat, dan aman.</p>
                
                <div class="hero-actions">
                    <a href="#events" class="btn-primary">
                        Jelajahi Event
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="btn-secondary-glass">
                            Buat Akun Mahasiswa
                        </a>
                    @endguest
                </div>
            </div>

            <div class="hero-visual">
                <div class="glass-card">
                    <div class="gc-icon" style="color: #60a5fa;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="gc-content">
                        <h4>Manajemen Event Terpusat</h4>
                        <p>Kelola dan temukan seluruh kegiatan kampus dalam satu wadah terpadu.</p>
                    </div>
                </div>
                <div class="glass-card">
                    <div class="gc-icon" style="color: #34d399;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="gc-content">
                        <h4>Pendaftaran Tanpa Ribet</h4>
                        <p>Daftar event dengan satu klik, tanpa perlu mengisi formulir berulang kali.</p>
                    </div>
                </div>
                <div class="glass-card">
                    <div class="gc-icon" style="color: #fbbf24;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="gc-content">
                        <h4>Informasi Resmi & Valid</h4>
                        <p>Semua event telah diverifikasi dan disetujui langsung oleh institusi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <div class="stats-wrapper">
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total_events'] }}<span>+</span></div>
                <div class="stat-label">Event Tersedia</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total_mahasiswa'] }}<span>+</span></div>
                <div class="stat-label">Mahasiswa</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total_pendaftar'] }}<span>+</span></div>
                <div class="stat-label">Pendaftaran</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total_panitia'] }}<span>+</span></div>
                <div class="stat-label">Panitia Aktif</div>
            </div>
        </div>
    </div>

    <!-- UPCOMING EVENTS -->
    <section class="section-padding" id="events">
        <div class="section-header">
            <div>
                <h2 class="section-title">Event Kampus Terbaru</h2>
                <p class="section-subtitle">Jangan lewatkan kesempatan untuk mengembangkan diri Anda.</p>
            </div>
            <a href="{{ route('login') }}" class="link-all">
                Lihat Semua Event
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="events-grid">
            @forelse($events as $event)
                <div class="event-card">
                    <div class="ec-image">
                        @if($event->poster)
                            <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--blue),var(--navy));color:white;">
                                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="ec-date">
                            <div class="day">{{ $event->event_date->format('d') }}</div>
                            <div class="month">{{ $event->event_date->format('M') }}</div>
                        </div>
                    </div>
                    <div class="ec-body">
                        <h3 class="ec-title">{{ $event->title }}</h3>
                        <p class="ec-desc">{{ $event->description }}</p>
                        <div class="ec-footer">
                            <div class="ec-quota">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                Sisa Kuota: <strong>{{ $event->quota }}</strong>
                            </div>
                            <a href="{{ route('login') }}" class="btn-card">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column:1/-1;text-align:center;padding:4rem;background:white;border-radius:24px;border:1px dashed #cbd5e1;">
                    <div style="margin-bottom:1rem;color:#94a3b8;display:flex;justify-content:center;">
                        <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-outfit" style="font-size:1.5rem;color:var(--navy);margin-bottom:0.5rem;">Belum ada event dibuka</h3>
                    <p style="color:var(--text-muted);">Silakan cek kembali secara berkala untuk event terbaru.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- FEATURES / KEUNGGULAN -->
    <section class="features-wrap" id="features">
        <div class="section-padding" style="padding-top:0;padding-bottom:0;">
            <div style="text-align:center;max-width:700px;margin:0 auto;">
                <h2 class="section-title" style="color:white;">Kenapa Memilih POLVENT?</h2>
                <p style="color:#94a3b8;font-size:1.1rem;margin-top:1rem;">Platform digitalisasi manajemen event yang dirancang khusus menyesuaikan kebutuhan administrasi dan kegiatan mahasiswa Polbeng.</p>
            </div>

            <div class="feat-grid">
                <div class="feat-item">
                    <div class="feat-icon" style="background:rgba(59, 130, 246, 0.2);color:#60a5fa;">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3>Tepat Sasaran</h3>
                    <p>Semua informasi event berasal dari sumber resmi dan dikurasi oleh panitia serta disetujui langsung oleh pihak admin institusi.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon" style="background:rgba(16, 185, 129, 0.2);color:#34d399;">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3>Real-Time Processing</h3>
                    <p>Sistem pendaftaran yang sangat responsif. Anda akan langsung tahu status penerimaan dan antrian kuota dalam hitungan detik.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon" style="background:rgba(245, 158, 11, 0.2);color:#fbbf24;">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3>Privasi & Keamanan</h3>
                    <p>Data pribadi mahasiswa dilindungi secara ketat. Tidak ada data yang dibagikan tanpa izin, semua aktivitas tercatat aman di Log Sistem.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT US / TENTANG KAMI -->
    <section class="section-padding" id="about" style="background: white; border-top: 1px solid #f1f5f9; padding-bottom: 6rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; max-width: 1100px; margin: 0 auto;">
            <div>
                <h2 class="section-title">Tentang POLVENT</h2>
                <div style="width: 60px; height: 5px; background: var(--blue); border-radius: 4px; margin-bottom: 1.5rem;"></div>
                <p style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.7; margin-bottom: 1.5rem;">
                    POLVENT (Politeknik Event) adalah platform manajemen event resmi yang dikembangkan untuk memfasilitasi seluruh kegiatan mahasiswa di lingkungan Politeknik Negeri Bengkalis.
                </p>
                <p style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.7;">
                    Kami hadir untuk menjembatani antara panitia penyelenggara dan peserta event, memastikan alur informasi kegiatan kampus tersampaikan secara efektif, efisien, dan transparan.
                </p>
                <div style="margin-top: 2.5rem; display: flex; gap: 1.5rem;">
                    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 16px; border: 1px solid #e2e8f0; flex: 1;">
                        <h4 style="color: var(--navy); font-weight: 800; font-family: 'Outfit'; margin-bottom: 0.5rem; font-size: 1.1rem;">Visi Kami</h4>
                        <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.5;">Mendigitalisasi dan mempermudah administrasi seluruh kegiatan kemahasiswaan.</p>
                    </div>
                    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 16px; border: 1px solid #e2e8f0; flex: 1;">
                        <h4 style="color: var(--navy); font-weight: 800; font-family: 'Outfit'; margin-bottom: 0.5rem; font-size: 1.1rem;">Misi Kami</h4>
                        <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.5;">Menyediakan platform yang aman, real-time, dan mudah diakses semua mahasiswa.</p>
                    </div>
                </div>
            </div>
            <div style="position: relative; display: flex; justify-content: center; align-items: center; padding: 2rem;">
                <div style="position: absolute; top: 0; right: 20px; width: 120px; height: 120px; background: var(--blue); opacity: 0.08; border-radius: 50%;"></div>
                <div style="position: absolute; bottom: 0; left: 20px; width: 180px; height: 180px; background: var(--navy); opacity: 0.05; border-radius: 50%;"></div>
                <img src="{{ asset('images/logo-polvent.png') }}" alt="Tentang POLVENT" style="width: 100%; max-width: 320px; display: block; filter: drop-shadow(0 20px 30px rgba(15, 40, 92, 0.15)); position: relative; z-index: 2;">
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem;height:48px;">
                    <img src="{{ asset('images/logo-polbeng.png') }}" alt="Polbeng" style="height:100%;width:auto;object-fit:contain;">
                    <img src="{{ asset('images/logo-polvent.png') }}" alt="Polvent" style="height:200%;width:auto;object-fit:contain;">
                </div>
                <p>Pusat informasi dan pendaftaran event kampus Politeknik Negeri Bengkalis terintegrasi. Mudah, cepat, dan aman.</p>
            </div>
            <div>
                <h4 class="footer-title">Jelajahi</h4>
                <ul class="footer-links">
                    <li><a href="#events">Daftar Event</a></li>
                    <li><a href="#features">Keunggulan Platform</a></li>
                    <li><a href="{{ route('login') }}">Portal Mahasiswa</a></li>
                    <li><a href="{{ route('panitia.login') }}">Akses Panitia</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Hubungi Kami</h4>
                <ul class="footer-links">
                    <li style="display:flex;align-items:center;gap:0.5rem;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Sungai Alam, Bengkalis
                    </li>
                    <li style="display:flex;align-items:center;gap:0.5rem;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        info@polbeng.ac.id
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} Platform POLVENT - Politeknik Negeri Bengkalis. All rights reserved.
        </div>
    </footer>

</body>
</html>