<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="POLVENT - Platform Manajemen Event Kampus Politeknik Negeri Bengkalis">
    <title>@yield('title', 'POLVENT') — Platform Event Polbeng</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }
        :root {
            --polbeng-blue: #0056B3;
            --polbeng-dark: #003d80;
            --polbeng-light: #e8f0fe;
            --sidebar-width: 265px;
        }
        body { background: #f0f4f8; }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #0056B3 0%, #003d80 60%, #001f4d 100%);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 24px rgba(0,86,179,0.18);
        }
        .sidebar-brand {
            padding: 1.25rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .sidebar-brand .brand-text {
            color: white;
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: 0.06em;
        }
        .sidebar-brand .brand-sub {
            color: rgba(255,255,255,0.6);
            font-size: 0.62rem;
            font-weight: 400;
            display: block;
            letter-spacing: 0.02em;
        }
        .sidebar-nav { padding: 0.875rem 0; flex: 1; overflow-y: auto; }
        .nav-section-label {
            color: rgba(255,255,255,0.4);
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.875rem 1.25rem 0.375rem;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1rem;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.845rem;
            font-weight: 500;
            margin: 0.1rem 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            position: relative;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.12);
            color: white;
        }
        .nav-item.active {
            background: rgba(255,255,255,0.18);
            color: white;
            font-weight: 600;
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 60%;
            background: white;
            border-radius: 0 2px 2px 0;
        }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
        .nav-badge {
            margin-left: auto;
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.15rem 0.45rem;
            border-radius: 9999px;
        }

        /* ===================== MAIN ===================== */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #f8fafc;
        }

        /* ===================== TOPBAR ===================== */
        .topbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 1.5rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 6px rgba(0,0,0,0.06);
        }
        .topbar-left { display: flex; align-items: center; gap: 0.875rem; }
        .topbar-title { font-weight: 700; font-size: 1rem; color: #1e293b; }
        .breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: #94a3b8; margin-top: 1px; }
        .breadcrumb span { color: #1e293b; font-weight: 500; }
        .topbar-right { display: flex; align-items: center; gap: 0.875rem; }
        .user-avatar {
            width: 36px; height: 36px;
            background: var(--polbeng-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
        }
        .user-info .name { font-weight: 600; font-size: 0.845rem; color: #1e293b; line-height: 1.2; }
        .user-info .sub  { font-size: 0.7rem; color: #64748b; }

        /* ===================== ROLE BADGE ===================== */
        .role-badge {
            display: inline-flex; align-items: center;
            padding: 0.2rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.7rem; font-weight: 600;
        }
        .role-badge.admin    { background: #fef3c7; color: #d97706; }
        .role-badge.panitia  { background: #dbeafe; color: #1d4ed8; }
        .role-badge.mahasiswa{ background: #d1fae5; color: #059669; }

        /* ===================== CARDS ===================== */
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.375rem;
            box-shadow: 0 1px 6px rgba(0,0,0,0.05);
            border: 1px solid #f1f5f9;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(0,0,0,0.09); }
        .stat-card .stat-icon {
            width: 48px; height: 48px;
            border-radius: 0.875rem;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1rem;
        }
        .stat-card .stat-value { font-size: 2rem; font-weight: 800; color: #1e293b; line-height: 1; }
        .stat-card .stat-label { font-size: 0.8rem; color: #64748b; margin-top: 0.3rem; }
        .stat-card .stat-trend { font-size: 0.75rem; color: #059669; margin-top: 0.5rem; font-weight: 500; }

        /* ===================== TABLES ===================== */
        .table-wrapper {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 6px rgba(0,0,0,0.05);
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }
        .table-header {
            padding: 1.125rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .table-header h3 { font-weight: 700; font-size: 0.975rem; color: #1e293b; }
        table { width: 100%; border-collapse: collapse; }
        table th {
            padding: 0.75rem 1.25rem;
            text-align: left;
            font-size: 0.72rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            background: #f8fafc;
            border-bottom: 1px solid #f1f5f9;
        }
        table td {
            padding: 0.875rem 1.25rem;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f8fafc;
            vertical-align: middle;
        }
        table tr:last-child td { border-bottom: none; }
        table tr:hover td { background: #fafbff; }

        /* ===================== BUTTONS ===================== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.845rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            white-space: nowrap;
        }
        .btn-primary   { background: var(--polbeng-blue); color: white; }
        .btn-primary:hover { background: var(--polbeng-dark); color: white; transform: translateY(-1px); }
        .btn-success   { background: #059669; color: white; }
        .btn-success:hover { background: #047857; color: white; }
        .btn-danger    { background: #dc2626; color: white; }
        .btn-danger:hover  { background: #b91c1c; color: white; }
        .btn-warning   { background: #d97706; color: white; }
        .btn-warning:hover { background: #b45309; color: white; }
        .btn-secondary { background: #f1f5f9; color: #374151; border: 1px solid #e5e7eb; }
        .btn-secondary:hover { background: #e5e7eb; color: #374151; }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.78rem; }
        .btn-icon { width: 32px; height: 32px; padding: 0; justify-content: center; border-radius: 0.45rem; }

        /* ===================== STATUS BADGES ===================== */
        .status-badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.72rem; font-weight: 600;
        }
        .status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; }
        .status-pending  { background: #fef3c7; color: #d97706; }
        .status-approved { background: #d1fae5; color: #059669; }
        .status-rejected { background: #fee2e2; color: #dc2626; }

        /* ===================== ALERTS ===================== */
        .alert {
            padding: 0.875rem 1rem;
            border-radius: 0.625rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: flex-start;
            gap: 0.625rem;
        }
        .alert svg { flex-shrink: 0; margin-top: 1px; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        /* ===================== FORM STYLES ===================== */
        .form-card { background: white; border-radius: 1rem; box-shadow: 0 1px 6px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; overflow: hidden; }
        .form-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; }
        .form-card-header h3 { font-weight: 700; font-size: 0.975rem; color: #1e293b; }
        .form-card-body { padding: 1.5rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-weight: 600; font-size: 0.845rem; color: #374151; margin-bottom: 0.4rem; }
        .form-input {
            width: 100%; padding: 0.65rem 0.875rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 0.875rem; color: #1e293b;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
        }
        .form-input:focus { border-color: #0056B3; box-shadow: 0 0 0 3px rgba(0,86,179,0.1); }
        .form-input.is-invalid { border-color: #dc2626; }
        .form-error { color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem; }
        .form-hint { font-size: 0.76rem; color: #94a3b8; margin-top: 0.25rem; }
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        /* ===================== EVENT CARDS ===================== */
        .event-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.25s;
        }
        .event-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.1); border-color: #bfdbfe; }
        .event-card-img {
            height: 150px;
            background: linear-gradient(135deg, #0056B3, #003d80);
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }
        .event-card-img img { width: 100%; height: 100%; object-fit: cover; }
        .event-card-img span { font-size: 2.5rem; }
        .event-card-body { padding: 1.125rem; }
        .event-date-badge {
            display: inline-flex; align-items: center; gap: 0.35rem;
            background: #eff6ff; color: #1d4ed8;
            padding: 0.25rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.7rem; font-weight: 600;
            margin-bottom: 0.625rem;
        }
        .event-card-body h3 { font-weight: 700; font-size: 0.95rem; color: #1e293b; margin-bottom: 0.4rem; line-height: 1.35; }
        .event-card-body p  { color: #64748b; font-size: 0.8rem; line-height: 1.5; margin-bottom: 0.875rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .quota-bar { height: 4px; background: #f1f5f9; border-radius: 9999px; margin-bottom: 0.5rem; overflow: hidden; }
        .quota-bar-fill { height: 100%; background: #0056B3; border-radius: 9999px; transition: width 0.5s; }
        .quota-bar-fill.full { background: #dc2626; }
        .event-card-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 0.75rem; border-top: 1px solid #f1f5f9; }
        .quota-text { font-size: 0.78rem; color: #64748b; }
        .quota-text strong { color: #1e293b; }

        /* ===================== SIDEBAR FOOTER ===================== */
        .sidebar-footer {
            padding: 0.875rem;
            border-top: 1px solid rgba(255,255,255,0.12);
        }
        .sidebar-user-card {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.625rem 0.75rem;
            border-radius: 0.625rem;
            background: rgba(255,255,255,0.1);
            margin-bottom: 0.625rem;
        }
        .sidebar-user-card .name { color: white; font-size: 0.8rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-card .role { color: rgba(255,255,255,0.55); font-size: 0.68rem; }

        /* ===================== PAGE CONTENT ===================== */
        .page-content { padding: 1.5rem; flex: 1; }
        .page-header { margin-bottom: 1.5rem; }
        .page-header h1 { font-size: 1.375rem; font-weight: 800; color: #1e293b; }
        .page-header p  { color: #64748b; font-size: 0.875rem; margin-top: 0.25rem; }

        /* ===================== EMPTY STATE ===================== */
        .empty-state { text-align: center; padding: 3.5rem 1.5rem; }
        .empty-state-icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.6; }
        .empty-state h3 { font-weight: 700; color: #374151; margin-bottom: 0.5rem; }
        .empty-state p  { color: #94a3b8; font-size: 0.875rem; }

        /* ===================== MOBILE ===================== */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .form-grid-2 { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- =================== SIDEBAR =================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo-polvent.png') }}" alt="Polvent" style="width:56px;height:56px;object-fit:contain;flex-shrink:0;filter: brightness(0) invert(1);">
            <div>
                <span class="brand-text">POLVENT</span>
                <span class="brand-sub">Platform Event Polbeng</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            {{-- ========== PUBLIC NAV ========== --}}
            <div class="nav-section-label">Halaman Utama</div>
            
            <a href="{{ url('/') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <a href="{{ url('/#events') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Daftar Event
            </a>
            <a href="{{ url('/#features') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                Keunggulan
            </a>
            <a href="{{ url('/#about') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Tentang Kami
            </a>

            {{-- ========== ADMIN NAV ========== --}}
            @if(auth()->user()->isAdmin())
                <div class="nav-section-label">Admin Panel</div>

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.events.index') }}"
                   class="nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Kelola Event
                </a>

                <a href="{{ route('admin.panitia.index') }}"
                   class="nav-item {{ request()->routeIs('admin.panitia.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Kelola Panitia
                </a>

                <a href="{{ route('admin.activity-logs.index') }}"
                   class="nav-item {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Activity Log
                </a>

                <a href="{{ route('admin.login-history.index') }}"
                   class="nav-item {{ request()->routeIs('admin.login-history.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Login History
                </a>

            {{-- ========== PANITIA NAV ========== --}}
            @elseif(auth()->user()->isPanitia())
                <div class="nav-section-label">Panitia Panel</div>

                <a href="{{ route('panitia.dashboard') }}"
                   class="nav-item {{ request()->routeIs('panitia.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('panitia.events.index') }}"
                   class="nav-item {{ request()->routeIs('panitia.events.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Event Saya
                </a>

                <a href="{{ route('panitia.registrations.index') }}"
                   class="nav-item {{ request()->routeIs('panitia.registrations.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Kelola Peserta
                </a>

            {{-- ========== MAHASISWA NAV ========== --}}
            @else
                <div class="nav-section-label">Mahasiswa</div>

                <a href="{{ route('mahasiswa.dashboard') }}"
                   class="nav-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('mahasiswa.events.index') }}"
                   class="nav-item {{ request()->routeIs('mahasiswa.events.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Daftar Event
                </a>

                <a href="{{ route('mahasiswa.history') }}"
                   class="nav-item {{ request()->routeIs('mahasiswa.history') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Riwayat Saya
                </a>
            @endif
        </nav>

        <!-- Sidebar user footer -->
        <div class="sidebar-footer">
            <div class="sidebar-user-card">
                <div class="user-avatar" style="width:34px;height:34px;font-size:0.8rem;flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div style="flex:1;min-width:0;">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <div class="role">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-secondary" style="width:100%;justify-content:center;font-size:0.8rem;padding:0.5rem;gap:0.4rem;">
                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- =================== MAIN =================== -->
    <div class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <button onclick="document.getElementById('sidebar').classList.toggle('open')"
                    id="menuBtn"
                    style="display:none;background:none;border:none;cursor:pointer;padding:0.25rem;color:#374151;">
                    <svg style="width:22px;height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                    @hasSection('page-breadcrumb')
                        <div class="breadcrumb">@yield('page-breadcrumb')</div>
                    @endif
                </div>
            </div>
            <div class="topbar-right">
                <span class="role-badge {{ auth()->user()->role }}">{{ ucfirst(auth()->user()->role) }}</span>
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div class="user-info" style="display:none;" id="topbarUserInfo">
                        <div class="name">{{ auth()->user()->name }}</div>
                        <div class="sub">{{ auth()->user()->email }}</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Alerts -->
        <div style="padding:1rem 1.5rem 0;">
            @if(session('success'))
                <div class="alert alert-success">
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="page-content">
            @yield('content')
        </main>
    </div>

    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('menuBtn');
        function checkMobile() {
            menuBtn.style.display = window.innerWidth <= 768 ? 'block' : 'none';
            if (window.innerWidth >= 992) {
                document.getElementById('topbarUserInfo').style.display = 'flex';
            }
        }
        checkMobile();
        window.addEventListener('resize', checkMobile);

        // Close sidebar on outside click (mobile)
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && e.target !== menuBtn) {
                sidebar.classList.remove('open');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
