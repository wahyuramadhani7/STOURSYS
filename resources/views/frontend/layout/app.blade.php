<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Smart Tourism System - STOURSYS'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        :root {
            --cream:      #faf6f0;
            --sand:       #e8dcc8;
            --terracota:  #c45c2e;
            --brick:      #9c3a1a;
            --gold:       #c9952a;
            --moss:       #4a6741;
            --charcoal:   #1c1917;
            --ink:        #0d0b09;
        }

        /* ── Reset & Base ─────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--charcoal);
            margin: 0;
        }

        /* Noise grain overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.55;
        }

        /* ── NAVBAR ───────────────────────────────────── */
        .site-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 500;
            background: rgba(250,246,240,0.94);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1.5px solid var(--sand);
            transition: background 0.3s ease, border-color 0.3s ease;
        }
        .site-nav.scrolled {
            background: rgba(250,246,240,0.98);
            border-color: rgba(196,92,46,0.2);
        }

        .nav-inner {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 4rem;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        /* Logo */
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            text-decoration: none;
            flex-shrink: 0;
        }
        .nav-logo img {
            height: 44px;
            width: auto;
            object-fit: contain;
            filter: sepia(20%) contrast(1.1);
            transition: filter 0.3s ease;
        }
        .nav-logo:hover img {
            filter: sepia(40%) contrast(1.2) saturate(1.3);
        }
        .nav-logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }
        .nav-logo-name {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.45rem;
            color: var(--ink);
            letter-spacing: -0.01em;
        }
        .nav-logo-sub {
            font-family: 'Space Mono', monospace;
            font-size: 0.6rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--terracota);
            margin-top: 3px;
        }

        /* Desktop nav links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-links a {
            display: block;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(13,11,9,0.55);
            text-decoration: none;
            padding: 0.55rem 1.1rem;
            position: relative;
            transition: color 0.25s ease;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0; left: 1.1rem; right: 1.1rem;
            height: 1.5px;
            background: var(--terracota);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        .nav-links a:hover {
            color: var(--terracota);
        }
        .nav-links a:hover::after,
        .nav-links a.active::after {
            transform: scaleX(1);
        }
        .nav-links a.active {
            color: var(--terracota);
            font-weight: 700;
        }

        /* Home pill — tetap beda supaya standout */
        .nav-home-pill {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 0.55rem 1.25rem;
            background: var(--ink);
            color: var(--cream) !important;
            clip-path: polygon(0 0, calc(100% - 7px) 0, 100% 7px, 100% 100%, 7px 100%, 0 calc(100% - 7px));
            transition: background 0.25s ease;
        }
        .nav-home-pill:hover {
            background: var(--terracota) !important;
        }
        .nav-home-pill.active {
            background: var(--terracota) !important;
        }
        .nav-home-pill::after { display: none !important; }

        /* Hamburger button */
        .nav-hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            color: var(--ink);
            flex-direction: column;
            gap: 5px;
            align-items: flex-end;
        }
        .nav-hamburger span {
            display: block;
            height: 1.5px;
            background: currentColor;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .nav-hamburger span:nth-child(1) { width: 26px; }
        .nav-hamburger span:nth-child(2) { width: 18px; }
        .nav-hamburger span:nth-child(3) { width: 22px; }
        .nav-hamburger.open span:nth-child(1) { width: 22px; transform: translateY(6.5px) rotate(45deg); }
        .nav-hamburger.open span:nth-child(2) { opacity: 0; width: 0; }
        .nav-hamburger.open span:nth-child(3) { width: 22px; transform: translateY(-6.5px) rotate(-45deg); }

        /* Mobile drawer */
        .mobile-drawer {
            display: none;
            position: fixed;
            top: 72px; left: 0; right: 0;
            background: rgba(250,246,240,0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1.5px solid var(--sand);
            padding: 2rem 4rem 2.5rem;
            z-index: 499;
            transform: translateY(-8px);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .mobile-drawer.open {
            display: block;
            transform: translateY(0);
            opacity: 1;
        }
        .mobile-drawer a {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.78rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(13,11,9,0.55);
            text-decoration: none;
            padding: 1rem 0;
            border-bottom: 1px solid var(--sand);
            transition: color 0.25s ease, padding-left 0.25s ease;
        }
        .mobile-drawer a:last-child { border-bottom: none; }
        .mobile-drawer a:hover,
        .mobile-drawer a.active {
            color: var(--terracota);
            padding-left: 0.5rem;
        }
        .mobile-drawer a .m-num {
            font-size: 0.6rem;
            color: var(--gold);
            width: 1.5rem;
            flex-shrink: 0;
        }

        /* ── MAIN ─────────────────────────────────────── */
        main {
            padding-top: 72px;
            min-height: 100vh;
        }

        /* ── FOOTER ───────────────────────────────────── */
        .site-footer {
            background: var(--ink);
            color: var(--cream);
            position: relative;
            overflow: hidden;
        }

        /* Decorative top border */
        .footer-rule {
            height: 3px;
            background: linear-gradient(90deg,
                var(--terracota) 0%,
                var(--gold) 35%,
                var(--moss) 65%,
                var(--terracota) 100%
            );
        }

        /* Background decorative text */
        .footer-bg-text {
            position: absolute;
            bottom: -1.5rem;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'Playfair Display', serif;
            font-size: 9rem;
            font-weight: 900;
            color: rgba(255,255,255,0.03);
            white-space: nowrap;
            user-select: none;
            pointer-events: none;
            letter-spacing: -0.02em;
        }

        .footer-inner {
            max-width: 1440px;
            margin: 0 auto;
            padding: 4rem 4rem 2.5rem;
            position: relative;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr 1fr;
            gap: 3rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(250,246,240,0.08);
            margin-bottom: 2.5rem;
        }

        /* Footer brand column */
        .footer-brand {}
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }
        .footer-logo img {
            height: 40px;
            width: auto;
            object-fit: contain;
            filter: brightness(0) invert(1) opacity(0.7);
        }
        .footer-logo-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--cream);
        }
        .footer-logo-sub {
            font-family: 'Space Mono', monospace;
            font-size: 0.58rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            display: block;
            margin-top: 2px;
        }
        .footer-tagline {
            font-size: 0.9rem;
            color: rgba(250,246,240,0.45);
            line-height: 1.8;
            max-width: 28ch;
            margin-bottom: 2rem;
        }

        /* Institusi badge */
        .footer-institusi {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            padding: 0.9rem 1.2rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
        }
        .footer-institusi img {
            height: 32px;
            width: auto;
            object-fit: contain;
            filter: brightness(0) invert(1) opacity(0.6);
        }
        .footer-institusi-text {}
        .footer-institusi-name {
            font-family: 'Space Mono', monospace;
            font-size: 0.6rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(250,246,240,0.7);
            display: block;
        }
        .footer-institusi-desc {
            font-size: 0.75rem;
            color: rgba(250,246,240,0.35);
            margin-top: 2px;
        }

        /* Footer nav columns */
        .footer-col-title {
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .footer-col-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(201,149,42,0.3);
        }
        .footer-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .footer-nav-list a {
            font-size: 0.88rem;
            color: rgba(250,246,240,0.45);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: color 0.25s ease, gap 0.25s ease;
        }
        .footer-nav-list a::before {
            content: '';
            display: block;
            width: 0.8rem;
            height: 1px;
            background: var(--terracota);
            flex-shrink: 0;
            transition: width 0.25s ease;
        }
        .footer-nav-list a:hover {
            color: var(--cream);
            gap: 0.9rem;
        }
        .footer-nav-list a:hover::before { width: 1.2rem; }

        /* Footer bottom bar */
        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .footer-copy {
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            color: rgba(250,246,240,0.28);
        }
        .footer-copy span {
            color: rgba(250,246,240,0.55);
        }
        .footer-badge {
            font-family: 'Space Mono', monospace;
            font-size: 0.6rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            opacity: 0.6;
        }

        /* ── RESPONSIVE ───────────────────────────────── */
        @media (max-width: 1024px) {
            .nav-inner { padding: 0 2.5rem; }
            .nav-links { display: none; }
            .nav-hamburger { display: flex; }
            .mobile-drawer { padding: 1.5rem 2.5rem 2rem; }

            .footer-inner { padding: 3rem 2.5rem 2rem; }
            .footer-top {
                grid-template-columns: 1fr 1fr;
                gap: 2.5rem;
            }
        }

        @media (max-width: 600px) {
            .nav-inner { padding: 0 1.5rem; }
            .nav-logo-text { display: none; }
            .mobile-drawer { padding: 1.25rem 1.5rem 1.75rem; }

            .footer-inner { padding: 2.5rem 1.5rem 1.5rem; }
            .footer-top {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .footer-bottom { flex-direction: column; align-items: flex-start; gap: 0.5rem; }
            .footer-bg-text { font-size: 5rem; }
        }
    </style>
</head>

<body>

<!-- ══════════════════════════════════════════════
     NAVBAR
══════════════════════════════════════════════ -->
<header class="site-nav" id="siteNav">
    <div class="nav-inner">

        <!-- Logo -->
        <a href="/" class="nav-logo">
            <img src="{{ asset('storage/images/candi.png') }}" alt="STOURSYS">
            <div class="nav-logo-text">
                <span class="nav-logo-name">STOURSYS</span>
                <span class="nav-logo-sub">Smart Tourism System</span>
            </div>
        </a>

        <!-- Desktop links -->
        <nav>
            <ul class="nav-links">
                <li>
                    <a href="/"
                       class="nav-home-pill {{ request()->is('/') ? 'active' : '' }}">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>
                </li>
                @php
                    $navItems = [
                        ['route' => 'stoursys.index',  'label' => 'Stoursys'],
                        ['route' => 'destinasi.index', 'label' => 'Destinasi'],
                        ['route' => 'event.index',     'label' => 'Event'],
                        ['route' => 'berita.index',    'label' => 'Berita'],
                        ['route' => 'panduan.index',   'label' => 'Panduan'],
                        ['route' => 'kontak.index',    'label' => 'Kontak'],
                    ];
                @endphp
                @foreach($navItems as $nav)
                    <li>
                        <a href="{{ route($nav['route']) }}"
                           class="{{ request()->routeIs(str_replace('.index','.*',$nav['route'])) ? 'active' : '' }}">
                            {{ $nav['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Hamburger -->
        <button class="nav-hamburger" id="navHamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<!-- Mobile drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    @php $mobileNum = 1; @endphp
    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
        <span class="m-num">00</span> Home
    </a>
    @foreach($navItems as $nav)
        <a href="{{ route($nav['route']) }}"
           class="{{ request()->routeIs(str_replace('.index','.*',$nav['route'])) ? 'active' : '' }}">
            <span class="m-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
            {{ $nav['label'] }}
        </a>
    @endforeach
</div>


<!-- ══════════════════════════════════════════════
     MAIN CONTENT
══════════════════════════════════════════════ -->
<main>
    @yield('content')
</main>


<!-- ══════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════ -->
<footer class="site-footer">
    <div class="footer-rule"></div>

    <div class="footer-inner">
        <span class="footer-bg-text" aria-hidden="true">STOURSYS</span>

        <div class="footer-top">

            <!-- Brand column -->
            <div class="footer-brand">
                <a href="/" class="footer-logo">
                    <img src="{{ asset('storage/images/candi.png') }}" alt="STOURSYS">
                    <div>
                        <div class="footer-logo-name">STOURSYS</div>
                        <span class="footer-logo-sub">Smart Tourism System</span>
                    </div>
                </a>
                <p class="footer-tagline">
                    Platform pariwisata cerdas kawasan Candi Borobudur — menghubungkan traveler dengan keajaiban budaya Jawa.
                </p>
                <div class="footer-institusi">
                    <img src="{{ asset('storage/images/logotutwuri.png') }}" alt="LPDP">
                    <div class="footer-institusi-text">
                        <span class="footer-institusi-name">Lembaga Pengelola Dana Pendidikan</span>
                        <span class="footer-institusi-desc">Kementerian Keuangan Republik Indonesia</span>
                    </div>
                </div>
            </div>

            <!-- Jelajahi -->
            <div>
                <p class="footer-col-title">Jelajahi</p>
                <ul class="footer-nav-list">
                    <li><a href="{{ route('destinasi.index') }}">Destinasi Wisata</a></li>
                    <li><a href="{{ route('event.index') }}">Event & Pertunjukan</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita Terkini</a></li>
                    <li><a href="{{ route('panduan.index') }}">Panduan Wisata</a></li>
                </ul>
            </div>

            <!-- Tentang -->
            <div>
                <p class="footer-col-title">Tentang</p>
                <ul class="footer-nav-list">
                    <li><a href="{{ route('stoursys.index') }}">Tentang Stoursys</a></li>
                    <li><a href="{{ route('kontak.index') }}">Hubungi Kami</a></li>
                </ul>
            </div>

            <!-- Kategori -->
            <div>
                <p class="footer-col-title">Kategori</p>
                <ul class="footer-nav-list">
                    <li><a href="{{ route('destinasi.index', ['kategori' => 'candi']) }}">Candi</a></li>
                    <li><a href="{{ route('destinasi.index', ['kategori' => 'alam']) }}">Wisata Alam</a></li>
                    <li><a href="{{ route('destinasi.index', ['kategori' => 'budaya']) }}">Kesenian & Budaya</a></li>
                    <li><a href="{{ route('destinasi.index', ['kategori' => 'kuliner']) }}">Kuliner</a></li>
                    <li><a href="{{ route('destinasi.index', ['kategori' => 'desa_wisata']) }}">Desa Wisata</a></li>
                    <li><a href="{{ route('destinasi.index', ['kategori' => 'religi']) }}">Religi</a></li>
                </ul>
            </div>

        </div>

        <!-- Bottom bar -->
        <div class="footer-bottom">
            <p class="footer-copy">
                © {{ date('Y') }} <span>STOURSYS</span> — All rights reserved
            </p>
            <p class="footer-badge">Kawasan Wisata Borobudur · Warisan Dunia UNESCO</p>
        </div>
    </div>
</footer>


<!-- ══════════════════════════════════════════════
     SCRIPTS
══════════════════════════════════════════════ -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const nav       = document.getElementById('siteNav');
    const hamburger = document.getElementById('navHamburger');
    const drawer    = document.getElementById('mobileDrawer');

    // Scroll class
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });

    // Hamburger toggle
    hamburger?.addEventListener('click', () => {
        const isOpen = hamburger.classList.toggle('open');
        if (isOpen) {
            drawer.classList.add('open');
            // Force reflow for transition
            drawer.style.display = 'block';
            requestAnimationFrame(() => {
                drawer.style.opacity  = '1';
                drawer.style.transform = 'translateY(0)';
            });
        } else {
            drawer.classList.remove('open');
        }
    });

    // Close drawer on outside click
    document.addEventListener('click', e => {
        if (!hamburger.contains(e.target) && !drawer.contains(e.target)) {
            hamburger.classList.remove('open');
            drawer.classList.remove('open');
        }
    });
});
</script>

@stack('scripts')
</body>
</html>