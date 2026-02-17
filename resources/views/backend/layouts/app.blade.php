<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - Smart Tourism Borobudur</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg:            #f4f3f0;
            --surface:       #ffffff;
            --border:        #ebe8e2;
            --border-2:      #d6d2ca;
            --text-1:        #18170f;
            --text-2:        #65625b;
            --text-3:        #a8a49c;
            --accent:        #c45c18;
            --accent-light:  #e86f2a;
            --accent-bg:     #fef3eb;
            --accent-border: #f5d5b8;
            --red:           #b83232;
            --red-bg:        #fef6f5;
            --red-border:    #f2c4c0;
            --radius:        10px;
            --radius-sm:     7px;
            --sidebar-w:     268px;
            --header-h:      62px;
            --shadow-sm:     0 1px 3px rgba(0,0,0,.05), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md:     0 6px 24px rgba(0,0,0,.09), 0 1px 4px rgba(0,0,0,.04);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body { height: 100%; }

        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text-1);
            -webkit-font-smoothing: antialiased;
        }

        /* ─── Layout Shell ─────────────────────────────── */
        .shell {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* ─── Sidebar ──────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            /* No overflow-y so footer is always visible; inner nav scrolls */
            overflow: hidden;
            transition: transform .3s cubic-bezier(.4,0,.2,1);
        }

        /* ── Brand ─────────────────────────────────────── */
        .brand {
            flex-shrink: 0;
            padding: 26px 22px 22px;
            border-bottom: 1px solid var(--border);
        }

        .brand-mark {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 5px;
        }

        .brand-icon {
            width: 32px;
            height: 32px;
            background: var(--accent);
            border-radius: 9px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon svg {
            width: 16px;
            height: 16px;
            stroke: white;
            stroke-width: 2;
            fill: none;
        }

        .brand-name {
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--text-1);
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 0.7rem;
            color: var(--text-3);
            letter-spacing: 0.6px;
            text-transform: uppercase;
            font-weight: 500;
            padding-left: 43px;
        }

        /* ── Scrollable Nav Area ──────────────────────── */
        .nav-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: var(--border-2) transparent;
            padding: 8px 0;
        }

        .nav-scroll::-webkit-scrollbar { width: 4px; }
        .nav-scroll::-webkit-scrollbar-thumb { background: var(--border-2); border-radius: 4px; }

        /* ── Nav Group ────────────────────────────────── */
        .nav-group {
            padding: 16px 16px 0;
        }

        .nav-group + .nav-group {
            margin-top: 4px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .nav-group-label {
            font-size: 0.675rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-3);
            padding: 0 12px;
            margin-bottom: 8px;
            display: block;
        }

        .nav-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 3px;
            padding-bottom: 16px;
        }

        /* ── Nav Link ─────────────────────────────────── */
        .nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-2);
            text-decoration: none;
            transition: background .18s, color .18s;
            white-space: nowrap;
            overflow: hidden;
        }

        .nav-icon-wrap {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: var(--bg);
            transition: background .18s;
        }

        .nav-icon-wrap svg {
            width: 16px;
            height: 16px;
            stroke: var(--text-3);
            stroke-width: 2;
            fill: none;
            transition: stroke .18s;
        }

        .nav-label-text {
            flex: 1;
            line-height: 1;
        }

        .nav-link:hover {
            background: var(--bg);
            color: var(--text-1);
        }

        .nav-link:hover .nav-icon-wrap {
            background: #ede9e3;
        }

        .nav-link:hover .nav-icon-wrap svg {
            stroke: var(--text-2);
        }

        /* Active state */
        .nav-link.active {
            background: var(--accent-bg);
            color: var(--accent);
            font-weight: 600;
        }

        .nav-link.active .nav-icon-wrap {
            background: var(--accent-border);
        }

        .nav-link.active .nav-icon-wrap svg {
            stroke: var(--accent);
        }

        /* Left accent bar */
        .nav-link.active::after {
            content: '';
            position: absolute;
            left: 0;
            top: 18%;
            height: 64%;
            width: 3px;
            background: var(--accent);
            border-radius: 0 3px 3px 0;
        }

        /* Badge */
        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: white;
            font-size: 0.67rem;
            font-weight: 700;
            font-family: 'DM Mono', monospace;
            min-width: 20px;
            text-align: center;
            padding: 2px 6px;
            border-radius: 999px;
            line-height: 1.5;
            flex-shrink: 0;
        }

        /* ── Sidebar Footer ───────────────────────────── */
        .sidebar-footer {
            flex-shrink: 0;
            padding: 16px;
            border-top: 1px solid var(--border);
        }

        /* User mini-card in footer */
        .user-mini {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            background: var(--bg);
            border: 1px solid var(--border);
            margin-bottom: 10px;
        }

        .user-mini-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--accent-bg);
            border: 1.5px solid var(--accent-border);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-mini-avatar svg {
            width: 14px;
            height: 14px;
            stroke: var(--accent);
            stroke-width: 2;
            fill: none;
        }

        .user-mini-info { flex: 1; min-width: 0; }

        .user-mini-name {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text-1);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-mini-role {
            font-size: 0.69rem;
            color: var(--text-3);
            margin-top: 1px;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--red-border);
            background: var(--red-bg);
            color: var(--red);
            font-size: 0.8125rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: background .15s, border-color .15s, box-shadow .15s;
        }

        .logout-btn svg { width: 15px; height: 15px; flex-shrink: 0; }

        .logout-btn:hover {
            background: #fdecea;
            border-color: #dda0a0;
            box-shadow: 0 2px 8px rgba(184,50,50,.1);
        }

        /* ─── Main Area ────────────────────────────────── */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Header */
        .topbar {
            height: var(--header-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            flex-shrink: 0;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .hamburger {
            display: none;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: transparent;
            cursor: pointer;
            transition: background .15s;
        }

        .hamburger:hover { background: var(--bg); }
        .hamburger svg { width: 16px; height: 16px; color: var(--text-2); }

        .page-heading {
            font-size: 1.0625rem;
            font-weight: 600;
            color: var(--text-1);
            letter-spacing: -0.2px;
        }

        .breadcrumb-trail {
            font-size: 0.775rem;
            color: var(--text-3);
            margin-top: 1px;
        }

        /* Content */
        .content-wrap {
            flex: 1;
            overflow-y: auto;
            padding: 28px;
        }

        /* ─── Overlay (mobile) ─────────────────────────── */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(24,23,15,.45);
            backdrop-filter: blur(3px);
            z-index: 998;
            opacity: 0;
            transition: opacity .3s ease;
        }

        .overlay.visible { opacity: 1; }

        /* ─── Mobile ───────────────────────────────────── */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                z-index: 999;
                transform: translateX(-100%);
                box-shadow: var(--shadow-md);
            }

            .sidebar.open { transform: translateX(0); }

            .overlay { display: block; }
            .hamburger { display: flex; }

            .topbar { padding: 0 16px; }
            .content-wrap { padding: 20px 16px; }
        }

        /* ─── Selection ────────────────────────────────── */
        ::selection { background: var(--accent); color: white; }
    </style>
</head>
<body>

<div class="shell">

    <!-- Overlay (mobile) -->
    <div class="overlay" id="overlay"></div>

    <!-- ── Sidebar ── -->
    <aside class="sidebar" id="sidebar">

        <!-- Brand -->
        <div class="brand">
            <div class="brand-mark">
                <div class="brand-icon">
                    <svg viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="brand-name">STourSys Admin</span>
            </div>
            <p class="brand-sub">Kawasan Wisata Borobudur</p>
        </div>

        <!-- Scrollable Nav -->
        <div class="nav-scroll">

            <!-- Group 1: Overview -->
            <div class="nav-group">
                <span class="nav-group-label">Overview</span>
                <ul class="nav-list">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span class="nav-icon-wrap">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </span>
                            <span class="nav-label-text">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Group 2: Konten -->
            <div class="nav-group">
                <span class="nav-group-label">Manajemen Konten</span>
                <ul class="nav-list">
                    <li>
                        <a href="{{ route('admin.destinasi.index') }}"
                           class="nav-link {{ request()->routeIs('admin.destinasi.*') ? 'active' : '' }}">
                            <span class="nav-icon-wrap">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            <span class="nav-label-text">Destinasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.event.index') }}"
                           class="nav-link {{ request()->routeIs('admin.event.*') ? 'active' : '' }}">
                            <span class="nav-icon-wrap">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <span class="nav-label-text">Event</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.panduan.index') }}"
                           class="nav-link {{ request()->routeIs('admin.panduan.*') ? 'active' : '' }}">
                            <span class="nav-icon-wrap">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </span>
                            <span class="nav-label-text">Panduan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.berita.index') }}"
                           class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <span class="nav-icon-wrap">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </span>
                            <span class="nav-label-text">Berita</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Group 3: Komunikasi -->
            <div class="nav-group">
                <span class="nav-group-label">Komunikasi</span>
                <ul class="nav-list">
                    <li>
                        <a href="{{ route('admin.kontak.index') }}"
                           class="nav-link {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
                            <span class="nav-icon-wrap">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <span class="nav-label-text">Pesan Kontak</span>
                            @if(\App\Models\PesanKontak::where('status', 'baru')->count() > 0)
                                <span class="nav-badge">{{ \App\Models\PesanKontak::where('status', 'baru')->count() }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

        </div><!-- /nav-scroll -->

        <!-- Footer: user card + logout -->
        <div class="sidebar-footer">
            <div class="user-mini">
                <div class="user-mini-avatar">
                    <svg viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="user-mini-info">
                    <div class="user-mini-name">{{ Auth::user()->name }}</div>
                    <div class="user-mini-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>

    </aside>

    <!-- ── Main ── -->
    <div class="main">

        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger" id="toggleSidebar" aria-label="Toggle menu">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <h1 class="page-heading">@yield('title', 'Dashboard')</h1>
                    @hasSection('breadcrumb')
                        <div class="breadcrumb-trail">@yield('breadcrumb')</div>
                    @endif
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="content-wrap">
            @yield('content')
        </main>

    </div>
</div>

@stack('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar   = document.getElementById('sidebar');
        const overlay   = document.getElementById('overlay');

        if (!toggleBtn || !sidebar) return;

        function open() {
            sidebar.classList.add('open');
            overlay.classList.add('visible');
        }

        function close() {
            sidebar.classList.remove('open');
            overlay.classList.remove('visible');
        }

        toggleBtn.addEventListener('click', () =>
            sidebar.classList.contains('open') ? close() : open()
        );

        overlay.addEventListener('click', close);

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') close();
        });
    });
</script>

</body>
</html>