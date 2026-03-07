<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'STOURSYS'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --cream:     #faf6f0;
                --cream-mid: #f2ebe0;
                --sand:      #e8dcc8;
                --sand-dark: #d4c4a8;
                --terracota: #c45c2e;
                --brick:     #9c3a1a;
                --gold:      #b8851e;
                --gold-light:#d4a832;
                --moss:      #4a6741;
                --charcoal:  #1c1917;
                --ink:       #0d0b09;
                --warm-white:#fffdf9;
            }

            html, body {
                margin: 0; padding: 0;
                width: 100%; height: 100%;
            }
            body {
                display: flex;
                flex-direction: column;
                font-family: 'DM Sans', sans-serif;
                background: var(--cream);
                color: var(--charcoal);
            }

            .layout-wrapper {
                height: 100vh;
                height: 100dvh;
                display: flex;
                flex-direction: column;
                overscroll-behavior: none;
            }
            .layout-wrapper > header,
            .layout-wrapper > footer,
            .layout-wrapper > nav { flex-shrink: 0; }
            .layout-wrapper > main {
                flex: 1 1 0;
                min-height: 0; margin: 0; padding: 0;
                overflow: hidden;
            }

            /* Mobile: allow a little vertical scroll */
            @media (max-width: 768px) {
                .layout-wrapper {
                    height: auto;
                    min-height: 100vh;
                    min-height: 100dvh;
                    overscroll-behavior: auto;
                }
                .layout-wrapper > main {
                    overflow-y: auto;
                    -webkit-overflow-scrolling: touch;
                    flex: none;
                }
            }

            /* ========================
               HEADER — LIGHT VERSION
               ======================== */
            .site-header {
                background: var(--warm-white);
                position: relative;
                overflow: hidden;
                box-shadow: 0 1px 0 var(--sand), 0 4px 16px rgba(196,92,46,0.07);
            }

            /* warm gradient wash */
            .site-header::after {
                content: '';
                position: absolute; inset: 0;
                background: radial-gradient(ellipse 70% 140% at 50% 100%, rgba(196,92,46,0.06) 0%, transparent 70%);
                pointer-events: none;
            }

            /* terracota + gold bottom accent line */
            .site-header::before {
                content: '';
                position: absolute; bottom: 0; left: 0; right: 0;
                height: 3px;
                background: linear-gradient(to right, var(--terracota), var(--gold-light), var(--moss), var(--gold-light), var(--terracota));
            }

            .site-header-inner {
                max-width: 1440px;
                margin: 0 auto;
                padding: 0.85rem 4rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1.5rem;
                position: relative;
                z-index: 2;
            }

            /* Logos */
            .header-logo {
                flex-shrink: 0;
            }
            .header-logo img {
                height: 3.25rem;
                width: auto;
                object-fit: contain;
                display: block;
            }
            .header-logo-right img {
                height: 3rem;
                border-radius: 0;
                background: transparent;
                padding: 0;
            }

            /* Title center */
            .header-title-wrap {
                flex: 1;
                text-align: center;
                min-width: 0;
            }
            .header-title-row {
                display: flex;
                align-items: baseline;
                justify-content: center;
                gap: 0.6rem;
                flex-wrap: wrap;
            }
            .header-title-main {
                font-family: 'Playfair Display', serif;
                font-size: clamp(1.2rem, 2.5vw, 2rem);
                font-weight: 900;
                color: var(--charcoal);
                letter-spacing: -0.01em;
                line-height: 1.1;
            }
            .header-title-abbr {
                font-family: 'Space Mono', monospace;
                font-size: clamp(0.7rem, 1.4vw, 1rem);
                font-weight: 700;
                color: var(--terracota);
                letter-spacing: 0.08em;
            }

            /* sub-tagline */
            .header-title-sub {
                font-family: 'Space Mono', monospace;
                font-size: 0.6rem;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                color: var(--gold);
                margin-top: 0.3rem;
                display: block;
            }

            /* ========================
               NAVIGATION — WARM MID
               ======================== */
            .site-nav {
                background: var(--cream-mid);
                border-bottom: 1px solid var(--sand-dark);
                position: relative;
            }

            /* subtle bottom gold line */
            .site-nav::after {
                content: '';
                position: absolute; bottom: 0; left: 0; right: 0;
                height: 1px;
                background: linear-gradient(to right, transparent, rgba(184,133,30,0.35), transparent);
            }

            .site-nav-inner {
                max-width: 1440px;
                margin: 0 auto;
                padding: 0 4rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            /* Desktop nav links */
            .nav-links {
                display: flex;
                align-items: center;
                gap: 0;
                flex: 1;
                justify-content: center;
            }

            .nav-link {
                display: flex;
                align-items: center;
                gap: 0.55rem;
                padding: 0.9rem 1.4rem;
                font-family: 'Space Mono', monospace;
                font-size: 0.68rem;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: rgba(28, 25, 23, 0.5);
                text-decoration: none;
                position: relative;
                transition: color 0.3s ease;
                border-right: 1px solid var(--sand);
                white-space: nowrap;
            }
            .nav-link:first-child { border-left: 1px solid var(--sand); }

            /* bottom underline on hover */
            .nav-link::after {
                content: '';
                position: absolute; bottom: 0; left: 0; right: 0;
                height: 2px;
                background: var(--terracota);
                transform: scaleX(0);
                transition: transform 0.3s ease;
            }
            .nav-link:hover { color: var(--charcoal); }
            .nav-link:hover::after,
            .nav-link.active::after { transform: scaleX(1); }
            .nav-link.active { color: var(--terracota); }

            /* nav icon wrap — chamfered */
            .nav-icon {
                width: 1.75rem; height: 1.75rem;
                background: rgba(28,25,23,0.07);
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
                clip-path: polygon(0 0, calc(100% - 4px) 0, 100% 4px, 100% 100%, 4px 100%, 0 calc(100% - 4px));
                transition: background 0.3s ease;
            }
            .nav-link:hover .nav-icon,
            .nav-link.active .nav-icon {
                background: var(--terracota);
            }
            .nav-icon svg { color: rgba(28,25,23,0.4); transition: color 0.3s ease; }
            .nav-link:hover .nav-icon svg,
            .nav-link.active .nav-icon svg { color: #fff; }

            /* Hamburger button */
            .nav-hamburger {
                display: none;
                align-items: center; justify-content: center;
                width: 2.5rem; height: 2.5rem;
                background: rgba(28,25,23,0.08);
                border: 1px solid var(--sand-dark);
                color: var(--charcoal);
                cursor: pointer;
                clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
                transition: background 0.3s ease, color 0.3s ease;
                flex-shrink: 0;
            }
            .nav-hamburger:hover {
                background: var(--terracota);
                color: #fff;
                border-color: var(--terracota);
            }

            /* Mobile dropdown */
            .nav-mobile {
                display: none;
                flex-direction: column;
                background: var(--cream-mid);
                border-top: 1px solid var(--sand);
                padding: 0.5rem 0 1rem;
            }
            .nav-mobile.open { display: flex; }

            .nav-mobile-link {
                display: flex; align-items: center; gap: 0.9rem;
                padding: 0.85rem 2rem;
                font-family: 'Space Mono', monospace;
                font-size: 0.7rem; letter-spacing: 0.15em;
                text-transform: uppercase;
                color: rgba(28,25,23,0.5);
                text-decoration: none;
                border-left: 2px solid transparent;
                transition: all 0.25s ease;
            }
            .nav-mobile-link:hover {
                color: var(--charcoal);
                border-left-color: var(--terracota);
                background: rgba(196,92,46,0.05);
                padding-left: 2.5rem;
            }
            .nav-mobile-icon {
                width: 1.75rem; height: 1.75rem;
                background: rgba(28,25,23,0.07);
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
                clip-path: polygon(0 0, calc(100% - 4px) 0, 100% 4px, 100% 100%, 4px 100%, 0 calc(100% - 4px));
                transition: background 0.3s ease;
            }
            .nav-mobile-link:hover .nav-mobile-icon { background: var(--terracota); }
            .nav-mobile-icon svg { color: rgba(28,25,23,0.45); transition: color 0.3s ease; }
            .nav-mobile-link:hover .nav-mobile-icon svg { color: #fff; }

            /* ========================
               FOOTER — LIGHT VERSION
               ======================== */
            .site-footer {
                background: var(--sand);
                position: relative;
                border-top: 1px solid var(--sand-dark);
            }

            /* top accent stripe */
            .site-footer::before {
                content: '';
                display: block; height: 3px;
                background: linear-gradient(to right, var(--terracota), var(--gold-light), var(--moss));
            }

            .site-footer-inner {
                max-width: 1440px;
                margin: 0 auto;
                padding: 1.25rem 4rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1.5rem;
                flex-wrap: wrap;
            }

            .footer-left {
                display: flex; align-items: center; gap: 1rem;
            }
            .footer-logo-img {
                height: 2.75rem; width: auto;
                object-fit: contain; flex-shrink: 0;
            }
            .footer-text-title {
                font-family: 'Playfair Display', serif;
                font-size: 0.95rem; font-weight: 700;
                color: var(--charcoal);
                line-height: 1.3;
            }
            .footer-text-sub {
                font-family: 'Space Mono', monospace;
                font-size: 0.6rem; letter-spacing: 0.2em;
                text-transform: uppercase;
                color: rgba(28,25,23,0.45);
                margin-top: 0.2rem;
            }

            .footer-divider {
                width: 1px;
                height: 2.5rem;
                background: var(--sand-dark);
                flex-shrink: 0;
            }

            .footer-center {
                flex: 1;
                display: flex;
                justify-content: center;
            }
            .footer-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: var(--cream);
                border: 1px solid var(--sand-dark);
                padding: 0.35rem 0.9rem;
                clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
            }
            .footer-badge-dot {
                width: 6px; height: 6px;
                border-radius: 50%;
                background: var(--moss);
                flex-shrink: 0;
            }
            .footer-badge-text {
                font-family: 'Space Mono', monospace;
                font-size: 0.58rem; letter-spacing: 0.18em;
                text-transform: uppercase;
                color: rgba(28,25,23,0.55);
            }
            .footer-badge-text strong {
                color: var(--terracota);
                font-weight: 700;
            }

            .footer-right {
                font-family: 'Space Mono', monospace;
                font-size: 0.6rem; letter-spacing: 0.15em;
                text-transform: uppercase;
                color: rgba(28,25,23,0.35);
                text-align: right;
            }
            .footer-right span { color: var(--terracota); font-weight: 700; }

            /* ========================
               RESPONSIVE
               ======================== */
            @media (max-width: 1024px) {
                .site-header-inner { padding: 0.85rem 2.5rem; }
                .site-nav-inner    { padding: 0 2.5rem; }
                .site-footer-inner { padding: 1.25rem 2.5rem; }
                .nav-links { display: none; }
                .nav-hamburger { display: flex; }
                .footer-center { display: none; }
            }
            @media (max-width: 600px) {
                .site-header-inner { padding: 0.75rem 1.25rem; }
                .site-nav-inner    { padding: 0 1.25rem; }
                .site-footer-inner { padding: 1rem 1.25rem; flex-direction: column; align-items: flex-start; gap: 0.75rem; }
                .header-logo img   { height: 2.5rem; }
                .header-logo-right img { height: 2.25rem; }
                .footer-right { display: none; }
                .footer-divider { display: none; }
            }
        </style>

        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="layout-wrapper">

            <!-- ===================== HEADER ===================== -->
            <header class="site-header">
                <div class="site-header-inner">

                    <!-- Logo kiri -->
                    <div class="header-logo">
                        <img src="{{ asset('storage/images/candi.png') }}" alt="Logo Candi">
                    </div>

                    <!-- Judul tengah -->
                    <div class="header-title-wrap">
                        <div class="header-title-row">
                            <h1 class="header-title-main">Smart Tourism System</h1>
                            <span class="header-title-abbr">(STOURSYS)</span>
                        </div>
                        <span class="header-title-sub">Kawasan Wisata Borobudur</span>
                    </div>

                    <!-- Logo kanan -->
                    <div class="header-logo header-logo-right">
                        <img src="{{ asset('storage/images/diktilogo.png') }}" alt="Logo Diktisaintek Berdampak">
                    </div>

                </div>
            </header>

            <!-- ===================== NAVIGATION ===================== -->
            <nav class="site-nav">
                <div class="site-nav-inner">

                    <!-- Hamburger (mobile) -->
                    <button id="mobileMenuButton" class="nav-hamburger lg:hidden" aria-label="Toggle Menu">
                        <svg id="hamburgerIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="closeIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Desktop links -->
                    <div class="nav-links">

                        <a href="{{ route('stoursys.index') }}" class="nav-link {{ request()->routeIs('stoursys.*') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            Stoursys
                        </a>

                        <a href="{{ route('destinasi.index') }}" class="nav-link {{ request()->routeIs('destinasi.*') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            Destinasi
                        </a>

                        <a href="{{ route('event.index') }}" class="nav-link {{ request()->routeIs('event.*') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            Event
                        </a>

                        <a href="{{ route('kontak.index') }}" class="nav-link {{ request()->routeIs('kontak.*') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            Kontak
                        </a>

                        <a href="{{ route('panduan.index') }}" class="nav-link {{ request()->routeIs('panduan.*') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </span>
                            Panduan
                        </a>

                        <a href="{{ route('berita.index') }}" class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </span>
                            Berita
                        </a>

                    </div>
                </div>

                <!-- Mobile dropdown -->
                <div id="mobileMenu" class="nav-mobile">
                    <a href="{{ route('stoursys.index') }}" class="nav-mobile-link">
                        <span class="nav-mobile-icon">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        Stoursys
                    </a>
                    <a href="{{ route('destinasi.index') }}" class="nav-mobile-link">
                        <span class="nav-mobile-icon">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        Destinasi
                    </a>
                    <a href="{{ route('event.index') }}" class="nav-mobile-link">
                        <span class="nav-mobile-icon">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        Event
                    </a>
                    <a href="{{ route('kontak.index') }}" class="nav-mobile-link">
                        <span class="nav-mobile-icon">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        Kontak
                    </a>
                    <a href="{{ route('panduan.index') }}" class="nav-mobile-link">
                        <span class="nav-mobile-icon">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </span>
                        Panduan
                    </a>
                    <a href="{{ route('berita.index') }}" class="nav-mobile-link">
                        <span class="nav-mobile-icon">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </span>
                        Berita
                    </a>
                </div>
            </nav>

            <!-- Page Heading (Optional) -->
            @isset($header)
                <div style="background:white; border-bottom:1px solid var(--sand); flex-shrink:0;">
                    <div style="max-width:1440px; margin:0 auto; padding:1.25rem 4rem;">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
                {{ $slot ?? '' }}
            </main>

            <!-- ===================== FOOTER ===================== -->
            <footer class="site-footer">
                <div class="site-footer-inner">

                    <div class="footer-left">
                        <img src="{{ asset('storage/images/logotutwuri.png') }}"
                             alt="Logo Kemendikbud"
                             class="footer-logo-img">
                        <div class="footer-divider"></div>
                        <div>
                            <p class="footer-text-title">Lembaga Pengelola Dana Pendidikan</p>
                            <p class="footer-text-sub">Sistem Informasi Pariwisata · 2026</p>
                        </div>
                    </div>

                    <div class="footer-center">
                        <div class="footer-badge">
                            <span class="footer-badge-dot"></span>
                            <span class="footer-badge-text"><strong>STOURSYS</strong> · Kawasan Borobudur</span>
                        </div>
                    </div>

                    <div class="footer-right">
                        <span>© 2026</span> · Hak Cipta Dilindungi
                    </div>

                </div>
            </footer>

        </div>

        <!-- Mobile Menu JS -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mobileMenuButton = document.getElementById('mobileMenuButton');
                const mobileMenu       = document.getElementById('mobileMenu');
                const hamburgerIcon    = document.getElementById('hamburgerIcon');
                const closeIcon        = document.getElementById('closeIcon');

                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener('click', function () {
                        const isOpen = mobileMenu.classList.contains('open');
                        mobileMenu.classList.toggle('open', !isOpen);
                        hamburgerIcon.classList.toggle('hidden', !isOpen);
                        closeIcon.classList.toggle('hidden', isOpen);
                    });

                    document.addEventListener('click', function (event) {
                        const inside = mobileMenuButton.contains(event.target) || mobileMenu.contains(event.target);
                        if (!inside && mobileMenu.classList.contains('open')) {
                            mobileMenu.classList.remove('open');
                            hamburgerIcon.classList.remove('hidden');
                            closeIcon.classList.add('hidden');
                        }
                    });

                    window.addEventListener('resize', function () {
                        if (window.innerWidth >= 1024 && mobileMenu.classList.contains('open')) {
                            mobileMenu.classList.remove('open');
                            hamburgerIcon.classList.remove('hidden');
                            closeIcon.classList.add('hidden');
                        }
                    });
                }
            });
        </script>

        @stack('scripts')
    </body>
</html>