<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - Smart Tourism Borobudur</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Modern Clean Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        :root {
            --orange-50: #fff7ed;
            --orange-100: #ffedd5;
            --orange-200: #fed7aa;
            --orange-300: #fdba74;
            --orange-400: #fb923c;
            --orange-500: #f97316;
            --orange-600: #ea580c;
            --orange-700: #c2410c;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }
        
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        
        body { 
            background: linear-gradient(135deg, #fafbfc 0%, #f5f7fa 100%);
            background-attachment: fixed;
        }
        
        /* Sidebar */
        .sidebar { 
            background: linear-gradient(180deg, #ffffff 0%, #fefefe 100%);
            border-right: 1px solid #e5e7eb;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.02), 0 4px 20px rgba(0,0,0,0.03);
            position: relative;
            transition: all 0.3s ease;
        }
        
        .sidebar::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 2px; height: 100%;
            background: linear-gradient(180deg, transparent 0%, rgba(249,115,22,0.3) 30%, rgba(249,115,22,0.5) 50%, rgba(249,115,22,0.3) 70%, transparent 100%);
            animation: slideGlow 4s ease-in-out infinite;
        }
        
        @keyframes slideGlow {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.9; }
        }
        
        /* Sidebar Header */
        .sidebar-header {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 50%, #f97316 100%);
            background-size: 200% 200%;
            animation: gradientMove 10s ease infinite;
            padding: 2.5rem 1.5rem 2rem;
            position: relative;
            overflow: hidden;
        }
        
        @keyframes gradientMove {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .logo-text {
            color: white;
            text-shadow: 0 2px 12px rgba(0,0,0,0.25);
            font-weight: 800;
            letter-spacing: -0.6px;
        }
        
        .subtitle {
            color: rgba(255,255,255,0.92);
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-top: 0.35rem;
        }
        
        /* Navigation */
        .sidebar nav {
            padding: 2.5rem 1.25rem 1.5rem;
            flex: 1;
        }
        
        .sidebar nav ul {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }
        
        .sidebar a {
            position: relative;
            display: flex;
            align-items: center;
            padding: 1.05rem 1.2rem;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--gray-600);
            transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }
        
        .sidebar a::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 4px; height: 0;
            background: linear-gradient(180deg, #f97316, #fb923c);
            transition: height 0.35s ease;
            border-radius: 0 4px 4px 0;
        }
        
        .sidebar a.active::before {
            height: 75%;
        }
        
        .sidebar a.active {
            background: linear-gradient(135deg, rgba(249,115,22,0.09) 0%, rgba(251,146,60,0.06) 100%);
            color: #ea580c;
            font-weight: 600;
            border-color: rgba(249,115,22,0.18);
        }
        
        .sidebar a:hover:not(.active) {
            background: rgba(249,115,22,0.05);
            color: #ea580c;
            transform: translateX(5px);
            border-color: rgba(249,115,22,0.12);
        }
        
        .nav-icon {
            width: 22px;
            height: 22px;
            margin-right: 14px;
            stroke-width: 2;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }
        
        .sidebar a:hover .nav-icon {
            transform: scale(1.12);
            color: #fb923c;
        }
        
        .nav-badge {
            position: absolute;
            top: 10px;
            right: 12px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 999px;
            box-shadow: 0 2px 6px rgba(239,68,68,0.35);
            animation: pulse 2.2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }
        
        /* Logout */
        .logout-section {
            padding: 1.5rem 1.25rem 2.25rem;
            margin-top: auto;
        }
        
        .logout-btn {
            width: 100%;
            padding: 1rem 1.25rem;
            border-radius: 12px;
            background: linear-gradient(135deg, #ffffff, #fef2f2);
            border: 2px solid #fecaca;
            color: #dc2626;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border-color: #ef4444;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239,68,68,0.18);
        }
        
        /* Header Bar */
        .header-bar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 40;
        }
        
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-800);
            letter-spacing: -0.4px;
        }
        
        .user-badge {
            background: linear-gradient(135deg, #f97316, #fb923c);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 14px rgba(249,115,22,0.28);
            transition: all 0.3s ease;
        }
        
        .user-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(249,115,22,0.35);
        }
        
        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                inset: 0  auto 0 0;
                width: 280px;
                max-width: 85vw;
                z-index: 9999;
                transform: translateX(-100%);
                transition: transform 0.35s cubic-bezier(0.32, 0.72, 0, 1);
                box-shadow: 6px 0 25px -5px rgba(0,0,0,0.25);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            /* Overlay */
            body.sidebar-open::before {
                content: '';
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.45);
                backdrop-filter: blur(4px);
                z-index: 9998;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.35s ease, visibility 0.35s ease;
            }
            
            body.sidebar-open::before {
                opacity: 1;
                visibility: visible;
            }
            
            /* Hamburger visible only on mobile */
            .hamburger-btn {
                display: flex;
            }
        }
        
        @media (min-width: 769px) {
            .hamburger-btn {
                display: none;
            }
        }
        
        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(#fb923c, #f97316);
            border-radius: 10px;
        }
        
        ::selection {
            background: #f97316;
            color: white;
        }
    </style>
</head>
<body class="h-full antialiased">

    <div class="flex h-screen overflow-hidden bg-gray-50">

        <!-- Sidebar -->
        <aside class="sidebar w-64 md:w-72 flex-shrink-0 overflow-y-auto flex flex-col">
            <div class="sidebar-header">
                <h1 class="text-3xl logo-text">Admin STourSys</h1>
                <p class="subtitle">Kawasan Wisata Borobudur</p>
            </div>

            <nav>
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <!-- sisanya sama seperti sebelumnya -->
                    <li>
                        <a href="{{ route('admin.destinasi.index') }}" class="{{ request()->routeIs('admin.destinasi.*') ? 'active' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Destinasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.event.index') }}" class="{{ request()->routeIs('admin.event.*') ? 'active' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Event
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.panduan.index') }}" class="{{ request()->routeIs('admin.panduan.*') ? 'active' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Panduan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            Berita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kontak.index') }}" class="relative {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Pesan Kontak
                            @if(\App\Models\PesanKontak::where('status', 'baru')->count() > 0)
                                <span class="nav-badge">{{ \App\Models\PesanKontak::where('status', 'baru')->count() }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="logout-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="header-bar">
                <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                    <!-- Hamburger + Title -->
                    <div class="flex items-center gap-4">
                        <button id="toggleSidebar" class="hamburger-btn p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-orange-400">
                            <svg class="w-7 h-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <div>
                            <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                            @hasSection('breadcrumb')
                                <div class="breadcrumb mt-1 text-sm text-gray-500">
                                    @yield('breadcrumb')
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- User Badge -->
                    <div class="user-badge">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- JavaScript untuk toggle sidebar -->
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn   = document.getElementById('toggleSidebar');
            const sidebar     = document.querySelector('.sidebar');
            const body        = document.body;

            if (!toggleBtn || !sidebar) return;

            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                body.classList.toggle('sidebar-open');
            });

            // Klik di luar → tutup
            document.addEventListener('click', (e) => {
                if (!sidebar.contains(e.target) && 
                    !toggleBtn.contains(e.target) && 
                    sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    body.classList.remove('sidebar-open');
                }
            });

            // Escape key → tutup
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    body.classList.remove('sidebar-open');
                }
            });
        });
    </script>

</body>
</html>