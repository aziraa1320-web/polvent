<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="POLVENT - Platform Manajemen Event Kampus Politeknik Negeri Bengkalis">
    <title>@yield('title', 'POLVENT') - Platform Event Polbeng</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }
        :root {
            --polbeng-blue: #0056B3;
            --polbeng-dark: #003d80;
            --polbeng-light: #e8f0fe;
            --sidebar-width: 260px;
        }
        body { background: #f0f4f8; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #0056B3 0%, #003d80 100%);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 20px rgba(0,86,179,0.2);
        }
        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .sidebar-brand .brand-text {
            color: white;
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: 0.05em;
        }
        .sidebar-brand .brand-sub {
            color: rgba(255,255,255,0.7);
            font-size: 0.65rem;
            font-weight: 400;
            display: block;
            letter-spacing: 0.03em;
        }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .nav-section-label {
            color: rgba(255,255,255,0.5);
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.75rem 1.5rem 0.25rem;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0;
            margin: 0.1rem 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        .nav-item:hover, .nav-item.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }
        .nav-item.active {
            background: rgba(255,255,255,0.2);
            box-shadow: inset 3px 0 0 rgba(255,255,255,0.8);
        }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
        }
        .topbar-title { font-weight: 700; font-size: 1.1rem; color: #1e293b; }
        .topbar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .user-avatar {
            width: 36px; height: 36px;
            background: var(--polbeng-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.875rem;
        }
        .user-info .name { font-weight: 600; font-size: 0.875rem; color: #1e293b; }
        .user-info .role {
            font-size: 0.7rem;
            color: #64748b;
            text-transform: capitalize;
        }

        /* Role badge */
        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.03em;
        }
        .role-badge.admin    { background: #fef3c7; color: #d97706; }
        .role-badge.panitia  { background: #dbeafe; color: #1d4ed8; }
        .role-badge.mahasiswa{ background: #d1fae5; color: #059669; }

        /* Cards */
        .stat-card {
            background: white;
            border-radius: 0.875rem;
            padding: 1.5rem;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .stat-card .stat-icon {
            width: 48px; height: 48px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .stat-card .stat-value { font-size: 2rem; font-weight: 800; color: #1e293b; line-height: 1; }
        .stat-card .stat-label { font-size: 0.8rem; color: #64748b; margin-top: 0.25rem; }

        /* Tables */
        .table-wrapper {
            background: white;
            border-radius: 0.875rem;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }
        .table-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .table-header h3 { font-weight: 700; font-size: 1rem; color: #1e293b; }
        table { width: 100%; border-collapse: collapse; }
        table th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: #f8fafc;
            border-bottom: 1px solid #f1f5f9;
        }
        table td {
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f8fafc;
            vertical-align: middle;
        }
        table tr:last-child td { border-bottom: none; }
        table tr:hover td { background: #f8fafc; }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
        }
        .btn-primary   { background: var(--polbeng-blue); color: white; }
        .btn-primary:hover { background: var(--polbeng-dark); color: white; }
        .btn-success   { background: #059669; color: white; }
        .btn-success:hover { background: #047857; color: white; }
        .btn-danger    { background: #dc2626; color: white; }
        .btn-danger:hover  { background: #b91c1c; color: white; }
        .btn-warning   { background: #d97706; color: white; }
        .btn-warning:hover { background: #b45309; color: white; }
        .btn-secondary { background: #f1f5f9; color: #374151; border: 1px solid #e5e7eb; }
        .btn-secondary:hover { background: #e5e7eb; color: #374151; }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.8rem; }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.72rem;
            font-weight: 600;
        }
        .status-pending  { background: #fef3c7; color: #d97706; }
        .status-approved { background: #d1fae5; color: #059669; }
        .status-rejected { background: #fee2e2; color: #dc2626; }

        /* Alerts */
        .alert {
            padding: 0.875rem 1rem;
            border-radius: 0.625rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        /* Page content area */
        .page-content { padding: 1.5rem; flex: 1; }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div style="width:45px;height:45px;background:white;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;box-shadow:0 2px 4px rgba(0,0,0,0.1);">
                <img src="{{ asset('images/logo.png') }}" alt="PV Logo" style="width:100%;height:100%;object-fit:contain;padding:2px;">
            </div>
            <div>
                <span class="brand-text">POLVENT</span>
                <span class="brand-sub">Platform Event Polbeng</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            @if(auth()->user()->isAdmin())
                <div class="nav-section-label">Admin Panel</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.events.index') }}" class="nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Kelola Event
                </a>
                <a href="{{ route('admin.activity-logs.index') }}" class="nav-item {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Activity Log
                </a>
            @elseif(auth()->user()->isPanitia())
                <div class="nav-section-label">Panitia Panel</div>
                <a href="{{ route('panitia.dashboard') }}" class="nav-item {{ request()->routeIs('panitia.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('panitia.registrations.index') }}" class="nav-item {{ request()->routeIs('panitia.registrations.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Peserta Event
                </a>
            @else
                <div class="nav-section-label">Mahasiswa</div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('mahasiswa.events.index') }}" class="nav-item {{ request()->routeIs('mahasiswa.events.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Daftar Event
                </a>
                <a href="{{ route('mahasiswa.history') }}" class="nav-item {{ request()->routeIs('mahasiswa.history') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Riwayat Saya
                </a>
            @endif
        </nav>

        <!-- Sidebar footer -->
        <div style="padding:1rem;border-top:1px solid rgba(255,255,255,0.15);">
            <div style="display:flex;align-items:center;gap:0.75rem;padding:0.5rem;border-radius:0.5rem;background:rgba(255,255,255,0.1);">
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div style="flex:1;min-width:0;">
                    <div style="color:white;font-size:0.8rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
                    <div style="color:rgba(255,255,255,0.6);font-size:0.7rem;">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:0.5rem;">
                @csrf
                <button type="submit" class="btn btn-secondary" style="width:100%;justify-content:center;font-size:0.8rem;padding:0.5rem;">
                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main content -->
    <div class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:1rem;">
                <button onclick="document.getElementById('sidebar').classList.toggle('open')"
                    style="display:none;background:none;border:none;cursor:pointer;padding:0.25rem;"
                    id="menuBtn">
                    <svg style="width:24px;height:24px;color:#374151;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
            </div>
            <div class="topbar-user">
                <span class="role-badge {{ auth()->user()->role }}">{{ ucfirst(auth()->user()->role) }}</span>
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            </div>
        </header>

        <!-- Alerts -->
        <div style="padding:1rem 1.5rem 0;">
            @if(session('success'))
                <div class="alert alert-success">
                    <svg style="width:18px;height:18px;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <svg style="width:18px;height:18px;flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- Page content -->
        <main class="page-content">
            @yield('content')
        </main>
    </div>

    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('menuBtn');
        if (window.innerWidth <= 768) {
            menuBtn.style.display = 'block';
        }
        window.addEventListener('resize', () => {
            menuBtn.style.display = window.innerWidth <= 768 ? 'block' : 'none';
        });

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
