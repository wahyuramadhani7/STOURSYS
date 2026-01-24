<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - Smart Tourism Borobudur</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Premium Admin Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        :root {
            --navy-dark: #0a1929;
            --navy: #001f3f;
            --navy-light: #1e3a5f;
            --orange: #f97316;
            --orange-light: #fb923c;
            --orange-dark: #ea580c;
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body { 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            background-attachment: fixed;
        }
        
        /* Glassmorphism Sidebar */
        .sidebar { 
            background: rgba(10, 25, 41, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(249, 115, 22, 0.1);
            box-shadow: 
                0 0 40px rgba(0, 0, 0, 0.3),
                inset 0 0 100px rgba(249, 115, 22, 0.02);
        }
        
        /* Animated Header */
        .sidebar-header {
            background: linear-gradient(135deg, 
                rgba(249, 115, 22, 0.2) 0%, 
                rgba(251, 146, 60, 0.1) 50%,
                rgba(249, 115, 22, 0.2) 100%);
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
            border-bottom: 2px solid rgba(249, 115, 22, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .logo-text {
            background: linear-gradient(135deg, #f97316 0%, #fbbf24 50%, #f97316 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
            position: relative;
            z-index: 1;
            text-shadow: 0 0 30px rgba(249, 115, 22, 0.3);
        }
        
        @keyframes shimmer {
            to { background-position: 200% center; }
        }
        
        .subtitle {
            color: #cbd5e1;
            font-weight: 500;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }
        
        /* Premium Navigation */
        .sidebar nav {
            padding: 0 12px;
        }
        
        .sidebar a { 
            position: relative;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            margin-bottom: 6px;
            overflow: hidden;
            display: flex;
            align-items: center;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        
        .sidebar a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(180deg, #f97316 0%, #fb923c 100%);
            transform: scaleY(0);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0 4px 4px 0;
        }
        
        .sidebar a.active::before {
            transform: scaleY(1);
        }
        
        .sidebar a.active { 
            background: linear-gradient(90deg, 
                rgba(249, 115, 22, 0.25) 0%, 
                rgba(249, 115, 22, 0.15) 50%,
                rgba(249, 115, 22, 0.05) 100%);
            color: #fff;
            font-weight: 600;
            box-shadow: 
                0 4px 20px rgba(249, 115, 22, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }
        
        .sidebar a.active .nav-icon {
            color: #f97316;
            filter: drop-shadow(0 0 8px rgba(249, 115, 22, 0.5));
        }
        
        .sidebar a:hover:not(.active) { 
            background: rgba(249, 115, 22, 0.1);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.15);
        }
        
        .sidebar a:hover .nav-icon {
            transform: scale(1.1);
            color: #fb923c;
        }
        
        .nav-icon {
            width: 22px;
            height: 22px;
            margin-right: 14px;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        
        /* Premium Header */
        .header-gradient {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(249, 115, 22, 0.1);
            box-shadow: 
                0 4px 30px rgba(0, 0, 0, 0.05),
                0 1px 0 rgba(249, 115, 22, 0.1);
        }
        
        .page-title {
            background: linear-gradient(135deg, #0a1929 0%, #1e3a5f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        /* User Badge Premium */
        .user-badge {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: 
                0 4px 15px rgba(249, 115, 22, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .user-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.2), 
                transparent);
            transition: left 0.5s;
        }
        
        .user-badge:hover::before {
            left: 100%;
        }
        
        .user-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(249, 115, 22, 0.5);
        }
        
        /* Logout Button */
        .logout-section {
            padding: 0 12px;
            margin-top: 20px;
        }
        
        .logout-btn {
            background: linear-gradient(135deg, 
                rgba(239, 68, 68, 0.15) 0%, 
                rgba(220, 38, 38, 0.15) 100%);
            padding: 12px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            font-weight: 600;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .logout-btn:hover {
            background: linear-gradient(135deg, 
                rgba(239, 68, 68, 0.25) 0%, 
                rgba(220, 38, 38, 0.25) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
            border-color: rgba(239, 68, 68, 0.5);
        }
        
        /* Content Area */
        .content-area {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 20px 0 0 0;
        }
        
        /* Animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .sidebar nav li {
            animation: slideInLeft 0.5s ease forwards;
            opacity: 0;
        }
        
        .sidebar nav li:nth-child(1) { animation-delay: 0.1s; }
        .sidebar nav li:nth-child(2) { animation-delay: 0.2s; }
        .sidebar nav li:nth-child(3) { animation-delay: 0.3s; }
        .sidebar nav li:nth-child(4) { animation-delay: 0.4s; }
        .sidebar nav li:nth-child(5) { animation-delay: 0.5s; }
        .sidebar nav li:nth-child(6) { animation-delay: 0.6s; }
        
        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #f97316 0%, #ea580c 100%);
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #fb923c 0%, #f97316 100%);
        }
        
        /* Glow Effects */
        .glow {
            position: relative;
        }
        
        .glow::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.2) 0%, transparent 70%);
            filter: blur(20px);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }
        
        .sidebar a.active.glow::after {
            opacity: 1;
        }
    </style>
</head>
<body class="h-full font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Premium Sidebar -->
        <aside class="sidebar w-64 flex-shrink-0 overflow-y-auto text-white">
            <div class="sidebar-header p-6">
                <h1 class="text-2xl font-bold logo-text">Admin STourSys</h1>
                <p class="subtitle text-sm mt-2">Kawasan Wisata Borobudur</p>
            </div>

            <nav class="mt-8">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'active glow' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.destinasi.index') }}" 
                           class="px-4 py-3 {{ request()->routeIs('admin.destinasi.*') ? 'active glow' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Destinasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.event.index') }}" 
                           class="px-4 py-3 {{ request()->routeIs('admin.event.*') ? 'active glow' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Event
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.panduan.index') }}" 
                           class="px-4 py-3 {{ request()->routeIs('admin.panduan.*') ? 'active glow' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Panduan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.berita.index') }}" 
                           class="px-4 py-3 {{ request()->routeIs('admin.berita.*') ? 'active glow' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            Berita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kontak.index') }}" 
                           class="px-4 py-3 {{ request()->routeIs('admin.kontak.*') ? 'active glow' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Pesan Kontak
                        </a>
                    </li>
                </ul>

                <div class="logout-section">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn text-red-300 hover:text-red-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Premium Header -->
            <header class="header-gradient">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5 flex justify-between items-center">
                    <h1 class="page-title text-2xl font-bold">
                        @yield('title', 'Dashboard')
                    </h1>
                    <div class="flex items-center gap-4">
                        <div class="user-badge">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ Auth::user()->name }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto content-area p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>