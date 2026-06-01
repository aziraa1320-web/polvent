<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLVENT – Platform Manajemen Event Kampus Polbeng</title>
    <meta name="description" content="Platform Manajemen Event resmi Politeknik Negeri Bengkalis. Temukan, daftar, dan ikuti event terbaik kampus.">

    {{-- Tailwind CSS via CDN (ganti dengan Vite jika sudah setup) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts: Plus Jakarta Sans + DM Serif Display --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'polbeng': {
                            50:  '#e6f0fb',
                            100: '#cce1f7',
                            200: '#99c3ef',
                            300: '#66a5e7',
                            400: '#3387df',
                            500: '#0056B3',
                            600: '#0049a3', // primary
                            700: '#003d8f',
                            800: '#00317a',
                            900: '#002466',
                        },
                    },
                    fontFamily: {
                        'display': ['"DM Serif Display"', 'serif'],
                        'body':    ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    backgroundImage: {
                        'hero-pattern': "url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\")",
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'fade-up': 'fadeUp 0.7s ease forwards',
                        'slide-in': 'slideIn 0.6s ease forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-16px)' },
                        },
                        fadeUp: {
                            from: { opacity: 0, transform: 'translateY(28px)' },
                            to:   { opacity: 1, transform: 'translateY(0)' },
                        },
                        slideIn: {
                            from: { opacity: 0, transform: 'translateX(-24px)' },
                            to:   { opacity: 1, transform: 'translateX(0)' },
                        },
                    },
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, .font-display { font-family: 'DM Serif Display', serif; }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Navbar glass effect */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Hero gradient mesh */
        .hero-bg {
            background: linear-gradient(135deg, #0056B3 0%, #003d8f 40%, #001f5c 100%);
        }

        /* Card hover lift */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 86, 179, 0.15);
        }

        /* Animated underline on nav links */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0;
            width: 0; height: 2px;
            background: #0056B3;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        /* Staggered fade-up for sections */
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #ffffff 0%, #a8c8f5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Stat counter box */
        .stat-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.12), rgba(255,255,255,0.05));
            border: 1px solid rgba(255,255,255,0.2);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #0056B3; border-radius: 3px; }

        /* Mobile menu transition */
        #mobile-menu { transition: max-height 0.4s ease, opacity 0.4s ease; overflow: hidden; max-height: 0; opacity: 0; }
        #mobile-menu.open { max-height: 500px; opacity: 1; }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased">

{{-- ================================================================
     NAVBAR
================================================================ --}}
<header id="navbar" class="fixed top-0 left-0 right-0 z-50 navbar-glass shadow-sm border-b border-gray-100 transition-all duration-300">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo Group --}}
            <div class="flex items-center gap-3">
                {{-- Logo Polbeng --}}
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center bg-polbeng-600 shadow-md">
                        {{-- Ganti dengan: <img src="{{ asset('images/logo-polbeng.png') }}" alt="Polbeng" class="w-full h-full object-contain p-1"> --}}
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-xs font-semibold text-polbeng-600 leading-tight">Politeknik Negeri</p>
                        <p class="text-xs font-bold text-polbeng-800 leading-tight">Bengkalis</p>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="w-px h-8 bg-gray-200"></div>

                {{-- Logo Polvent --}}
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-polbeng-500 to-polbeng-700 flex items-center justify-center shadow-md">
                        {{-- Ganti dengan: <img src="{{ asset('images/logo-polvent.png') }}" alt="Polvent" class="w-full h-full object-contain p-1"> --}}
                        <span class="text-white font-bold text-sm font-display">PV</span>
                    </div>
                    <span class="font-display text-xl text-polbeng-700 tracking-tight">POLVENT</span>
                </div>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="#beranda" class="nav-link text-sm font-medium text-gray-700 hover:text-polbeng-600 transition-colors">Beranda</a>
                <a href="#event" class="nav-link text-sm font-medium text-gray-700 hover:text-polbeng-600 transition-colors">Event</a>
                <a href="#tentang" class="nav-link text-sm font-medium text-gray-700 hover:text-polbeng-600 transition-colors">Tentang</a>
                <a href="#kontak" class="nav-link text-sm font-medium text-gray-700 hover:text-polbeng-600 transition-colors">Kontak</a>
            </div>

            {{-- CTA Buttons --}}
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm font-semibold text-polbeng-600 border border-polbeng-600 rounded-lg hover:bg-polbeng-50 transition-all duration-200">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-2 text-sm font-semibold text-white bg-polbeng-600 rounded-lg hover:bg-polbeng-700 shadow-sm shadow-polbeng-200 transition-all duration-200">
                    Daftar
                </a>
            </div>

            {{-- Mobile Hamburger --}}
            <button id="hamburger" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors" aria-label="Toggle menu">
                <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="md:hidden">
            <div class="px-2 pt-2 pb-4 space-y-1 border-t border-gray-100">
                <a href="#beranda" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-polbeng-50 hover:text-polbeng-600 rounded-lg transition-colors">Beranda</a>
                <a href="#event" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-polbeng-50 hover:text-polbeng-600 rounded-lg transition-colors">Event</a>
                <a href="#tentang" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-polbeng-50 hover:text-polbeng-600 rounded-lg transition-colors">Tentang</a>
                <a href="#kontak" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-polbeng-50 hover:text-polbeng-600 rounded-lg transition-colors">Kontak</a>
                <div class="flex gap-3 pt-3 px-2">
                    <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2 text-sm font-semibold text-polbeng-600 border border-polbeng-600 rounded-lg hover:bg-polbeng-50 transition-all">Masuk</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center px-4 py-2 text-sm font-semibold text-white bg-polbeng-600 rounded-lg hover:bg-polbeng-700 transition-all">Daftar</a>
                </div>
            </div>
        </div>
    </nav>
</header>


{{-- ================================================================
     HERO SECTION
================================================================ --}}
<section id="beranda" class="hero-bg hero-pattern min-h-screen flex items-center pt-16 relative overflow-hidden">

    {{-- Decorative blobs --}}
    <div class="absolute top-20 right-0 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl transform translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-polbeng-300 opacity-10 rounded-full blur-3xl transform -translate-x-1/3"></div>
    <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-blue-300 opacity-5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- Left Content --}}
            <div class="space-y-8" style="animation: fadeUp 0.8s ease 0.1s both">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full backdrop-blur-sm">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Platform Resmi Politeknik Negeri Bengkalis
                </div>

                {{-- Heading --}}
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl leading-tight">
                    <span class="text-white">Temukan & Ikuti</span><br>
                    <span class="gradient-text italic">Event Terbaik</span><br>
                    <span class="text-white/90 text-3xl sm:text-4xl lg:text-5xl">di Politeknik Negeri Bengkalis</span>
                </h1>

                {{-- Description --}}
                <p class="text-blue-100 text-lg leading-relaxed max-w-lg">
                    POLVENT adalah platform digital kampus untuk mengelola, mendaftarkan, dan memantau seluruh kegiatan event akademik dan non-akademik secara <strong class="text-white">aman</strong> dan <strong class="text-white">terintegrasi</strong>.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4">
                    <a href="#event"
                       class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-polbeng-700 font-semibold rounded-xl shadow-lg hover:bg-blue-50 hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Jelajahi Event
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 px-7 py-3.5 bg-transparent text-white font-semibold border-2 border-white/50 rounded-xl hover:bg-white/10 hover:-translate-y-0.5 transition-all duration-200">
                        Daftar Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                {{-- Quick Stats --}}
                <div class="flex flex-wrap gap-6 pt-2">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-white">25+</p>
                        <p class="text-xs text-blue-200 font-medium">Event Aktif</p>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-white">1.200+</p>
                        <p class="text-xs text-blue-200 font-medium">Mahasiswa</p>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-white">3.500+</p>
                        <p class="text-xs text-blue-200 font-medium">Pendaftaran</p>
                    </div>
                </div>
            </div>

            {{-- Right Illustration --}}
            <div class="relative flex justify-center lg:justify-end" style="animation: fadeUp 0.8s ease 0.3s both">
                <div class="relative">
                    {{-- Main card --}}
                    <div class="relative bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 w-80 shadow-2xl animate-float">
                        {{-- Event card mock --}}
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg mb-4">
                            <div class="h-32 bg-gradient-to-br from-polbeng-400 to-polbeng-700 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="p-4">
                                <span class="text-xs font-semibold text-polbeng-600 bg-polbeng-50 px-2 py-0.5 rounded-full">Seminar</span>
                                <h3 class="text-sm font-bold text-gray-800 mt-2">Seminar Nasional Teknologi 2025</h3>
                                <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    15 Juli 2025
                                </div>
                            </div>
                        </div>

                        {{-- Notification mock --}}
                        <div class="bg-white/90 rounded-xl p-3 flex items-center gap-3 shadow-md">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Pendaftaran Berhasil!</p>
                                <p class="text-xs text-gray-500">Workshop UI/UX Design</p>
                            </div>
                        </div>
                    </div>

                    {{-- Floating badge --}}
                    <div class="absolute -top-4 -right-4 bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg animate-float-slow">
                        🔥 12 Event Baru
                    </div>

                    {{-- Floating users pill --}}
                    <div class="absolute -bottom-5 -left-6 bg-white rounded-xl px-4 py-2 shadow-xl flex items-center gap-2 animate-float-slow">
                        <div class="flex -space-x-2">
                            <div class="w-7 h-7 bg-polbeng-400 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">A</div>
                            <div class="w-7 h-7 bg-purple-400 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">B</div>
                            <div class="w-7 h-7 bg-pink-400 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">C</div>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">+248 bergabung</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Bottom wave --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" fill="white">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z"/>
        </svg>
    </div>
</section>


{{-- ================================================================
     FITUR UTAMA
================================================================ --}}
<section class="py-24 bg-white" id="fitur">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <span class="text-polbeng-600 text-sm font-bold uppercase tracking-widest">Mengapa POLVENT?</span>
            <h2 class="font-display text-4xl text-gray-900 mt-3">Fitur Unggulan Platform</h2>
            <p class="text-gray-500 mt-4 max-w-xl mx-auto">Dirancang khusus untuk ekosistem kampus Polbeng dengan memadukan kemudahan akses dan keamanan data tingkat tinggi.</p>
        </div>

        {{-- Feature Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 reveal">

            {{-- Card 1 --}}
            <div class="card-hover bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-2xl p-6 group">
                <div class="w-12 h-12 bg-polbeng-600 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-polbeng-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Event Terpercaya</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Seluruh event diverifikasi oleh admin dan panitia resmi kampus Polbeng.</p>
            </div>

            {{-- Card 2 --}}
            <div class="card-hover bg-gradient-to-br from-green-50 to-white border border-green-100 rounded-2xl p-6 group">
                <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-green-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Pendaftaran Mudah</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Daftar event hanya dalam beberapa klik. Konfirmasi instan, tanpa kertas.</p>
            </div>

            {{-- Card 3 --}}
            <div class="card-hover bg-gradient-to-br from-purple-50 to-white border border-purple-100 rounded-2xl p-6 group">
                <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-purple-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Keamanan Data</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Perlindungan SQL Injection, XSS, CSRF, dan enkripsi password dengan bcrypt.</p>
            </div>

            {{-- Card 4 --}}
            <div class="card-hover bg-gradient-to-br from-orange-50 to-white border border-orange-100 rounded-2xl p-6 group">
                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300 shadow-md shadow-orange-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Informasi Lengkap</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Detail event, kuota, lokasi, dan riwayat keikutsertaan tersedia secara real-time.</p>
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     EVENT TERBARU
================================================================ --}}
<section id="event" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 reveal">
            <div>
                <span class="text-polbeng-600 text-sm font-bold uppercase tracking-widest">Terkini</span>
                <h2 class="font-display text-4xl text-gray-900 mt-2">Event Terbaru</h2>
                <p class="text-gray-500 mt-2">Jangan lewatkan event menarik yang sedang berlangsung.</p>
            </div>
            <a href="{{ route('login') }}" class="mt-4 sm:mt-0 inline-flex items-center gap-1.5 text-sm font-semibold text-polbeng-600 hover:text-polbeng-800 transition-colors">
                Lihat Semua Event
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 reveal">

            {{-- Event Card 1 --}}
            <article class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group">
                <div class="relative h-48 bg-gradient-to-br from-polbeng-500 to-polbeng-800 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-20 h-20 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-2"/>
                        </svg>
                    </div>
                    {{-- Ganti div atas dengan: <img src="{{ asset('images/events/event-1.jpg') }}" alt="..." class="w-full h-full object-cover"> --}}
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-polbeng-700 text-xs font-bold px-2.5 py-1 rounded-full shadow">Seminar</span>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span class="bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">Buka</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 text-base leading-snug group-hover:text-polbeng-700 transition-colors">Seminar Nasional Teknologi Informasi 2025</h3>
                    <div class="space-y-2 mt-3">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Sabtu, 15 Juli 2025 · 08.00 WIB
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Gedung Serba Guna Polbeng
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Kuota: <span class="font-semibold text-polbeng-600">150 Peserta</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-xs text-green-600 font-semibold">98 slot tersisa</span>
                        </div>
                        <a href="{{ route('login') }}" class="text-xs font-bold text-polbeng-600 hover:text-polbeng-800 transition-colors flex items-center gap-1">
                            Daftar <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>

            {{-- Event Card 2 --}}
            <article class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group">
                <div class="relative h-48 bg-gradient-to-br from-purple-500 to-purple-900 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-20 h-20 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m0 0H7m10 0a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2m5 6v6m4-6v6"/>
                        </svg>
                    </div>
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-purple-700 text-xs font-bold px-2.5 py-1 rounded-full shadow">Workshop</span>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span class="bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">Buka</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 text-base leading-snug group-hover:text-polbeng-700 transition-colors">Workshop UI/UX Design untuk Pemula</h3>
                    <div class="space-y-2 mt-3">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Minggu, 20 Juli 2025 · 09.00 WIB
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Lab Komputer Gedung B
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Kuota: <span class="font-semibold text-purple-600">50 Peserta</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                            <span class="text-xs text-yellow-600 font-semibold">12 slot tersisa</span>
                        </div>
                        <a href="{{ route('login') }}" class="text-xs font-bold text-polbeng-600 hover:text-polbeng-800 transition-colors flex items-center gap-1">
                            Daftar <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>

            {{-- Event Card 3 --}}
            <article class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group">
                <div class="relative h-48 bg-gradient-to-br from-orange-400 to-red-600 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-20 h-20 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-orange-700 text-xs font-bold px-2.5 py-1 rounded-full shadow">Kompetisi</span>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">Tutup</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 text-base leading-snug group-hover:text-polbeng-700 transition-colors">Lomba Karya Tulis Ilmiah Mahasiswa 2025</h3>
                    <div class="space-y-2 mt-3">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Senin, 28 Juli 2025 · 07.30 WIB
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Aula Utama Kampus Polbeng
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Kuota: <span class="font-semibold text-red-600">200 Peserta</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            <span class="text-xs text-red-600 font-semibold">Pendaftaran ditutup</span>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold">Selesai</span>
                    </div>
                </div>
            </article>

        </div>
    </div>
</section>


{{-- ================================================================
     STATISTIK SISTEM
================================================================ --}}
<section class="py-24 hero-bg hero-pattern relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-1/4 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-polbeng-300 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="text-blue-200 text-sm font-bold uppercase tracking-widest">Angka Bicara</span>
            <h2 class="font-display text-4xl text-white mt-3">Statistik POLVENT</h2>
            <p class="text-blue-200 mt-3">Dipercaya oleh ribuan mahasiswa dan seluruh civitas akademika Polbeng.</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 reveal">
            <div class="stat-card rounded-2xl p-6 text-center backdrop-blur-sm">
                <div class="text-4xl font-bold font-display text-white mb-1">25+</div>
                <div class="text-blue-200 text-sm font-medium">Total Event</div>
                <div class="mt-3 text-blue-300 text-xs">Diselenggarakan sejak 2024</div>
            </div>
            <div class="stat-card rounded-2xl p-6 text-center backdrop-blur-sm">
                <div class="text-4xl font-bold font-display text-white mb-1">1.200+</div>
                <div class="text-blue-200 text-sm font-medium">Mahasiswa Aktif</div>
                <div class="mt-3 text-blue-300 text-xs">Terdaftar di platform</div>
            </div>
            <div class="stat-card rounded-2xl p-6 text-center backdrop-blur-sm">
                <div class="text-4xl font-bold font-display text-white mb-1">3.500+</div>
                <div class="text-blue-200 text-sm font-medium">Pendaftaran</div>
                <div class="mt-3 text-blue-300 text-xs">Diproses secara digital</div>
            </div>
            <div class="stat-card rounded-2xl p-6 text-center backdrop-blur-sm">
                <div class="text-4xl font-bold font-display text-white mb-1">15+</div>
                <div class="text-blue-200 text-sm font-medium">Panitia Aktif</div>
                <div class="mt-3 text-blue-300 text-xs">Mengelola event kampus</div>
            </div>
        </div>
    </div>
</section>


{{-- ================================================================
     TENTANG POLVENT
================================================================ --}}
<section id="tentang" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Left --}}
            <div class="reveal">
                <span class="text-polbeng-600 text-sm font-bold uppercase tracking-widest">Tentang Kami</span>
                <h2 class="font-display text-4xl text-gray-900 mt-3 leading-tight">Platform Event Kampus yang <em>Aman</em> & Terintegrasi</h2>
                <p class="text-gray-500 mt-5 leading-relaxed">
                    POLVENT (Platform Manajemen Event Kampus Polbeng) adalah sistem informasi berbasis web yang dikembangkan untuk mendigitalisasi seluruh siklus manajemen event di lingkungan Politeknik Negeri Bengkalis.
                </p>
                <p class="text-gray-500 mt-4 leading-relaxed">
                    Dibangun di atas framework Laravel dengan penerapan keamanan berlapis — mulai dari RBAC, Audit Trail, perlindungan SQL Injection dan XSS, hingga enkripsi password — platform ini memastikan data mahasiswa dan panitia terlindungi sepenuhnya.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-polbeng-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-polbeng-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="text-sm text-gray-600">Role Based Access Control (RBAC) untuk Admin, Panitia, dan Mahasiswa</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-polbeng-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-polbeng-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="text-sm text-gray-600">Audit Trail lengkap untuk seluruh aktivitas CRUD sistem</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-polbeng-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-polbeng-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="text-sm text-gray-600">Pencegahan race condition dengan database locking (lockForUpdate)</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-polbeng-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-polbeng-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="text-sm text-gray-600">Perlindungan CSRF, XSS, dan SQL Injection secara otomatis</p>
                    </div>
                </div>
            </div>

            {{-- Right: Tech Stack Visual --}}
            <div class="reveal">
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Teknologi yang Digunakan</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl p-4 border border-gray-100 flex items-center gap-3 shadow-sm">
                            <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-500" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 17c0 3.6-3.1 6.5-7 6.5s-7-2.9-7-6.5c0-2.2 1.3-4.2 3.3-5.4L12 3l5.3 3.7c1.9 1.1 3.2 3.1 3.2 5.3H23v1h.5zM12 5.3L8.3 7.8C7 8.8 6 10.3 6 12h12c0-1.7-1-3.2-2.3-4.2L12 5.3z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">Laravel 13</p>
                                <p class="text-xs text-gray-400">PHP Framework</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-gray-100 flex items-center gap-3 shadow-sm">
                            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">Tailwind CSS</p>
                                <p class="text-xs text-gray-400">Utility-first CSS</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-gray-100 flex items-center gap-3 shadow-sm">
                            <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm-.081 2.5l7.974 4.605v9.184l-7.974 4.604L4.025 16.29V7.105L11.92 2.5zm0 1.147L4.77 7.71v8.578l7.147 4.127 7.148-4.127V7.71L11.92 3.647zM12 7a5 5 0 100 10A5 5 0 0012 7zm0 1.5a3.5 3.5 0 110 7 3.5 3.5 0 010-7z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">MySQL</p>
                                <p class="text-xs text-gray-400">Database</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-gray-100 flex items-center gap-3 shadow-sm">
                            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">Breeze Auth</p>
                                <p class="text-xs text-gray-400">Authentication</p>
                            </div>
                        </div>
                    </div>

                    {{-- Security badge --}}
                    <div class="mt-6 bg-polbeng-600 rounded-xl p-4 flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <p class="text-white text-sm font-bold">Keamanan Berlapis</p>
                            <p class="text-blue-200 text-xs mt-0.5">RBAC · Audit Trail · CSRF · XSS · SQL Injection Prevention</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ================================================================
     KONTAK / CTA SECTION
================================================================ --}}
<section id="kontak" class="py-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <span class="text-polbeng-600 text-sm font-bold uppercase tracking-widest">Bergabung Sekarang</span>
        <h2 class="font-display text-4xl text-gray-900 mt-3">Siap Mengikuti Event Kampus?</h2>
        <p class="text-gray-500 mt-4 max-w-xl mx-auto leading-relaxed">
            Buat akun gratis dan mulai temukan event-event menarik di Politeknik Negeri Bengkalis. Daftarkan dirimu sekarang!
        </p>
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <a href="{{ route('register') }}"
               class="px-8 py-4 bg-polbeng-600 text-white font-semibold rounded-xl hover:bg-polbeng-700 shadow-lg shadow-polbeng-200 hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Buat Akun Gratis
            </a>
            <a href="mailto:polvent@polbeng.ac.id"
               class="px-8 py-4 bg-white text-polbeng-700 font-semibold border border-polbeng-200 rounded-xl hover:bg-polbeng-50 hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Hubungi Kami
            </a>
        </div>

        {{-- Contact Info --}}
        <div class="mt-12 flex flex-wrap justify-center gap-8 text-sm text-gray-500">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-polbeng-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                polvent@polbeng.ac.id
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-polbeng-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Bengkalis, Riau
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-polbeng-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                polbeng.ac.id
            </div>
        </div>
    </div>
</section>


{{-- ================================================================
     FOOTER
================================================================ --}}
<footer class="bg-gray-900 text-gray-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-3 gap-10 mb-10">

            {{-- Brand --}}
            <div class="col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-polbeng-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                    </div>
                    <div class="w-px h-7 bg-gray-700"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-polbeng-700 flex items-center justify-center">
                            <span class="text-white font-bold text-xs font-display">PV</span>
                        </div>
                        <span class="font-display text-lg text-white">POLVENT</span>
                    </div>
                </div>
                <p class="text-sm leading-relaxed">Platform Manajemen Event Kampus Politeknik Negeri Bengkalis yang aman, modern, dan terintegrasi.</p>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="text-white text-sm font-semibold mb-4">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="#beranda" class="text-sm hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="#event" class="text-sm hover:text-white transition-colors">Event</a></li>
                    <li><a href="#tentang" class="text-sm hover:text-white transition-colors">Tentang POLVENT</a></li>
                    <li><a href="#kontak" class="text-sm hover:text-white transition-colors">Kontak</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-white text-sm font-semibold mb-4">Kontak</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-2 text-sm">
                        <svg class="w-4 h-4 text-polbeng-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Jl. Bathin Alam, Sungai Alam, Bengkalis, Riau 28711
                    </li>
                    <li class="flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        polvent@polbeng.ac.id
                    </li>
                    <li class="flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-polbeng-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        polbeng.ac.id
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-sm">© {{ date('Y') }} POLVENT – Politeknik Negeri Bengkalis. Hak cipta dilindungi.</p>
            <p class="text-xs text-gray-600">Dikembangkan untuk Mata Kuliah Keamanan Basis Data & Manajemen Identitas</p>
        </div>
    </div>
</footer>


{{-- ================================================================
     JAVASCRIPT
================================================================ --}}
<script>
    // --- Mobile Menu Toggle ---
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
    });

    // Close mobile menu on link click
    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
        });
    });

    // --- Navbar scroll shadow ---
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }
    });

    // --- Scroll Reveal Animation ---
    const revealElements = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, i * 100);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    revealElements.forEach(el => observer.observe(el));

    // --- Active nav link on scroll ---
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 80;
            if (window.scrollY >= sectionTop) {
                current = section.getAttribute('id');
            }
        });
        navLinks.forEach(link => {
            link.classList.remove('text-polbeng-600');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('text-polbeng-600');
            }
        });
    });
</script>

</body>
</html>