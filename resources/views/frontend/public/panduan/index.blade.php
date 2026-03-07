@extends('frontend.layout.app')

@section('title', 'Panduan - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
:root {
    --cream:    #faf6f0;
    --sand:     #e8dcc8;
    --terracota:#c45c2e;
    --brick:    #9c3a1a;
    --gold:     #c9952a;
    --moss:     #4a6741;
    --charcoal: #1c1917;
    --ink:      #0d0b09;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { background: var(--cream); font-family: 'DM Sans', sans-serif; color: var(--charcoal); }

/* ========================
   NOISE TEXTURE OVERLAY
   ======================== */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 9999;
    opacity: 0.6;
}

/* ========================
   HERO
   ======================== */
.hero {
    position: relative;
    min-height: 60vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    overflow: hidden;
    background: var(--ink);
}
.hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 80% at 60% 50%, rgba(196,92,46,0.18) 0%, transparent 70%);
    pointer-events: none;
}
.hero-left {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 7rem 5rem 7rem 7rem;
    position: relative;
    z-index: 2;
}
.hero-eyebrow {
    font-family: 'Space Mono', monospace;
    font-size: 0.72rem;
    letter-spacing: 0.35em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}
.hero-eyebrow::before {
    content: '';
    display: block;
    width: 3rem;
    height: 1px;
    background: var(--gold);
}
.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(3rem, 5vw, 5.5rem);
    font-weight: 900;
    color: var(--cream);
    line-height: 0.95;
    margin-bottom: 2rem;
}
.hero-title em {
    font-style: italic;
    color: var(--terracota);
}
.hero-desc {
    font-size: 1.05rem;
    color: rgba(250,246,240,0.6);
    line-height: 1.8;
    max-width: 36ch;
}
.hero-right {
    position: relative;
    overflow: hidden;
}
.hero-right img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.45;
    filter: sepia(30%) contrast(1.1);
}
.hero-right::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, var(--ink) 0%, transparent 40%);
    z-index: 1;
}
.hero-num {
    position: absolute;
    bottom: 3rem;
    right: 3rem;
    font-family: 'Playfair Display', serif;
    font-size: 10rem;
    font-weight: 900;
    color: rgba(250,246,240,0.06);
    line-height: 1;
    z-index: 2;
    user-select: none;
    pointer-events: none;
}
.hero-vertical {
    position: absolute;
    right: 2rem;
    top: 50%;
    transform: translateY(-50%) rotate(90deg);
    transform-origin: center;
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 0.4em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.3);
    z-index: 3;
    white-space: nowrap;
}

/* ========================
   MARQUEE STRIP
   ======================== */
.marquee-strip {
    background: var(--terracota);
    padding: 0.9rem 0;
    overflow: hidden;
}
.marquee-track {
    display: flex;
    animation: marquee 28s linear infinite;
    width: max-content;
}
.marquee-item {
    font-family: 'Space Mono', monospace;
    font-size: 0.72rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.9);
    padding: 0 3rem;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}
.marquee-dot {
    width: 4px;
    height: 4px;
    background: rgba(250,246,240,0.5);
    border-radius: 50%;
    flex-shrink: 0;
}
@keyframes marquee {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* ========================
   CONTAINER & SECTION
   ======================== */
.container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
}

.panduan-section {
    padding: 7rem 0;
    background: var(--cream);
}

/* ========================
   SECTION HEADER
   ======================== */
.section-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--terracota);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.section-label::before {
    content: '';
    display: block;
    width: 2rem;
    height: 1px;
    background: var(--terracota);
}
.section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.2rem, 3.5vw, 3.5rem);
    font-weight: 900;
    color: var(--ink);
    line-height: 1.05;
}
.section-title em {
    font-style: italic;
    color: var(--terracota);
}

.panduan-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 2rem;
    flex-wrap: wrap;
    border-bottom: 1px solid var(--sand);
    padding-bottom: 3rem;
    margin-bottom: 3.5rem;
}

.dest-count {
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
    color: rgba(28,25,23,0.45);
    margin-top: 0.75rem;
    letter-spacing: 0.1em;
}

/* ========================
   FILTER ROW
   ======================== */
.filter-row {
    display: flex;
    gap: 1rem;
    margin-bottom: 3rem;
    flex-wrap: wrap;
    align-items: flex-end;
}

/* Dropdown */
.filter-select-wrap {
    position: relative;
    min-width: 200px;
}
.filter-select {
    width: 100%;
    height: 52px;
    background: white;
    border: 1.5px solid var(--sand);
    padding: 0 3rem 0 1.25rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.72rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--ink);
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
    transition: border-color 0.3s ease;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
}
.filter-select:focus { border-color: var(--terracota); }
.filter-select-icon {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: rgba(28,25,23,0.4);
}

/* Search */
.search-wrap {
    position: relative;
    flex: 1;
    min-width: 260px;
}
.search-wrap input {
    width: 100%;
    height: 52px;
    background: white;
    border: 1.5px solid var(--sand);
    padding: 0 9rem 0 1.5rem;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    color: var(--ink);
    outline: none;
    transition: border-color 0.3s ease;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
}
.search-wrap input:focus { border-color: var(--terracota); }
.search-wrap input::placeholder { color: rgba(28,25,23,0.35); }
.search-actions {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    display: flex;
}
.search-btn {
    height: 100%;
    padding: 0 1.5rem;
    background: var(--terracota);
    color: var(--cream);
    border: none;
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    cursor: pointer;
    transition: background 0.3s ease;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 0 100%);
}
.search-btn:hover { background: var(--brick); }
.reset-btn {
    display: flex;
    align-items: center;
    padding: 0 1rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.45);
    text-decoration: none;
    transition: color 0.3s ease;
    border-left: 1px solid var(--sand);
    background: white;
}
.reset-btn:hover { color: var(--terracota); }

/* Result info */
.filter-result-info {
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.1em;
    color: rgba(28,25,23,0.5);
    margin-bottom: 2rem;
}
.filter-result-info strong { color: var(--terracota); }

/* ========================
   KATEGORI BADGE COLORS
   ======================== */
.badge {
    display: inline-block;
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    padding: 0.35rem 0.9rem;
    clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
    flex-shrink: 0;
}
.badge-hotel      { background: var(--moss);      color: var(--cream); }
.badge-pemerintahan { background: #2d5a8e;         color: var(--cream); }
.badge-rumah_sakit { background: #b93535;          color: var(--cream); }
.badge-darurat    { background: var(--terracota);  color: var(--cream); }
.badge-lainnya    { background: var(--charcoal);   color: var(--cream); }

/* ========================
   PANDUAN LIST
   ======================== */
.panduan-list {
    border: 1.5px solid var(--sand);
}

.panduan-card {
    display: flex;
    align-items: stretch;
    gap: 0;
    background: white;
    border-bottom: 1.5px solid var(--sand);
    text-decoration: none;
    overflow: hidden;
    transition: background 0.3s ease;
    position: relative;
}
.panduan-card:last-child { border-bottom: none; }
.panduan-card:hover { background: var(--cream); }

/* Left accent bar */
.panduan-card::before {
    content: '';
    display: block;
    width: 4px;
    flex-shrink: 0;
    background: var(--sand);
    transition: background 0.3s ease;
}
.panduan-card:hover::before { background: var(--terracota); }

/* Image */
.panduan-card-img {
    flex-shrink: 0;
    width: 200px;
    position: relative;
    overflow: hidden;
    background: var(--charcoal);
}
.panduan-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.7s ease, filter 0.7s ease;
}
.panduan-card:hover .panduan-card-img img {
    transform: scale(1.07);
    filter: sepia(20%) contrast(1.1);
}
.panduan-card-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, transparent 60%, rgba(13,11,9,0.3) 100%);
}
.panduan-no-img {
    width: 100%;
    height: 100%;
    min-height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--charcoal), #2c2420);
    opacity: 0.6;
}

/* Body */
.panduan-card-body {
    flex: 1;
    padding: 2rem 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-left: 1.5px solid var(--sand);
}

.panduan-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1.5rem;
    margin-bottom: 0.9rem;
    flex-wrap: wrap;
}

.panduan-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    transition: color 0.3s ease;
}
.panduan-card:hover .panduan-card-title { color: var(--terracota); }

.panduan-card-desc {
    font-size: 0.9rem;
    color: rgba(28,25,23,0.6);
    line-height: 1.75;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.panduan-card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 1.75rem;
}
.panduan-meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: rgba(28,25,23,0.55);
}
.panduan-meta-item svg { color: var(--gold); flex-shrink: 0; }

.panduan-card-link {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--terracota);
    transition: gap 0.3s ease;
}
.panduan-card-link-line {
    height: 1px;
    width: 1.5rem;
    background: currentColor;
    transition: width 0.3s ease;
}
.panduan-card:hover .panduan-card-link-line { width: 3rem; }

/* ========================
   EMPTY STATE
   ======================== */
.empty-state {
    padding: 8rem 2rem;
    text-align: center;
    border: 1.5px solid var(--sand);
    background: white;
}
.empty-icon {
    font-size: 6rem;
    margin-bottom: 2rem;
    opacity: 0.3;
}
.empty-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--ink);
    margin-bottom: 1rem;
}
.empty-desc {
    color: rgba(28,25,23,0.5);
    font-size: 1rem;
    margin-bottom: 2.5rem;
    max-width: 40ch;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.8;
}
.empty-cta {
    display: inline-block;
    padding: 1rem 2.5rem;
    background: var(--terracota);
    color: var(--cream);
    font-family: 'Space Mono', monospace;
    font-size: 0.72rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
    transition: background 0.3s ease;
}
.empty-cta:hover { background: var(--brick); }

/* ========================
   PAGINATION
   ======================== */
.pagination-wrap {
    margin-top: 4rem;
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
}

/* ========================
   RESPONSIVE
   ======================== */
@media (max-width: 900px) {
    .hero { grid-template-columns: 1fr; min-height: auto; }
    .hero-left { padding: 5rem 2.5rem 4rem; }
    .hero-right { height: 45vw; min-height: 240px; }
    .hero-right::before { background: linear-gradient(to top, var(--ink) 0%, transparent 60%); }
    .hero-vertical { display: none; }
    .container { padding: 0 1.5rem; }
    .panduan-section { padding: 4rem 0 5rem; }
    .panduan-card { flex-direction: column; }
    .panduan-card-img { width: 100%; height: 200px; }
    .panduan-card-body { padding: 1.5rem; border-left: none; border-top: 1.5px solid var(--sand); }
    .filter-row { flex-direction: column; }
    .filter-select-wrap, .search-wrap { width: 100%; }
}

@media (max-width: 600px) {
    .hero-left { padding: 4rem 1.5rem 3rem; }
    .panduan-header { flex-direction: column; align-items: flex-start; }
    .panduan-card-top { flex-direction: column; gap: 0.75rem; }
}
</style>
@endpush

@section('content')

<!-- ===================== HERO ===================== -->
<section class="hero">
    <div class="hero-left" data-aos="fade-right" data-aos-duration="1200">
        <p class="hero-eyebrow">Stoursys — Kawasan Borobudur</p>
        <h1 class="hero-title">
            Panduan<br>
            <em>Wisata</em>
        </h1>
        <p class="hero-desc">
            Hotel, rumah sakit, BPBD, layanan darurat, dan informasi penting lainnya untuk wisata aman dan nyaman di Kawasan Borobudur.
        </p>
    </div>

    <div class="hero-right">
        <img src="https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?w=1200&q=80" alt="Panduan Wisata Borobudur">
        <span class="hero-num">03</span>
        <span class="hero-vertical">Informasi &amp; Panduan</span>
    </div>
</section>

<!-- ===================== MARQUEE ===================== -->
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @foreach(array_fill(0, 2, null) as $_)
            <span class="marquee-item">Hotel &amp; Penginapan<span class="marquee-dot"></span></span>
            <span class="marquee-item">Rumah Sakit<span class="marquee-dot"></span></span>
            <span class="marquee-item">BPBD<span class="marquee-dot"></span></span>
            <span class="marquee-item">Layanan Darurat<span class="marquee-dot"></span></span>
            <span class="marquee-item">Pemerintahan<span class="marquee-dot"></span></span>
            <span class="marquee-item">Wisata Aman<span class="marquee-dot"></span></span>
            <span class="marquee-item">Info Kawasan<span class="marquee-dot"></span></span>
        @endforeach
    </div>
</div>

<!-- ===================== KONTEN UTAMA ===================== -->
<section class="panduan-section">
    <div class="container">

        <!-- Header -->
        <div class="panduan-header" data-aos="fade-up">
            <div>
                <p class="section-label">Informasi &amp; Panduan</p>
                <h2 class="section-title">
                    Semua yang Kamu<br>
                    <em>Butuhkan</em>
                </h2>
                @if(request('search') || request('kategori'))
                    <p class="dest-count">{{ $panduans->total() }} Informasi Ditemukan</p>
                @endif
            </div>
        </div>

        <!-- Filter + Search -->
        <div data-aos="fade-up">
            <form method="GET" action="{{ route('panduan.index') }}">
                <div class="filter-row">

                    <!-- Dropdown Kategori -->
                    <div class="filter-select-wrap">
                        <select name="kategori"
                                class="filter-select"
                                onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ strtolower($kat) }}" {{ request('kategori') == strtolower($kat) ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        <span class="filter-select-icon">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </div>

                    <!-- Search -->
                    <div class="search-wrap">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari nama tempat atau layanan...">
                        <div class="search-actions">
                            @if(request('search') || request('kategori'))
                                <a href="{{ route('panduan.index') }}" class="reset-btn">Reset</a>
                            @endif
                            <button type="submit" class="search-btn">Cari</button>
                        </div>
                    </div>

                </div>
            </form>

            @if(request('search') || request('kategori'))
                <p class="filter-result-info">
                    Menampilkan <strong>{{ $panduans->total() }}</strong> informasi
                    @if(request('kategori'))
                        — kategori <strong>{{ ucfirst(request('kategori')) }}</strong>
                    @endif
                    @if(request('search'))
                        — kata kunci "<strong>{{ request('search') }}</strong>"
                    @endif
                </p>
            @endif
        </div>

        <!-- List Panduan -->
        @if($panduans->count())
            <div class="panduan-list">
                @foreach($panduans as $idx => $panduan)
                    @php
                        $badgeClass = match($panduan->kategori) {
                            'hotel'         => 'badge-hotel',
                            'pemerintahan'  => 'badge-pemerintahan',
                            'rumah_sakit'   => 'badge-rumah_sakit',
                            'darurat'       => 'badge-darurat',
                            default         => 'badge-lainnya',
                        };
                    @endphp

                    <a href="{{ route('panduan.show', $panduan->id) }}"
                       class="panduan-card"
                       data-aos="fade-up"
                       data-aos-delay="{{ ($idx % 5) * 60 }}">

                        <!-- Image -->
                        <div class="panduan-card-img">
                            @if($panduan->gambar)
                                <img src="{{ Storage::url($panduan->gambar) }}"
                                     alt="{{ $panduan->judul }}"
                                     loading="lazy">
                                <div class="panduan-card-img-overlay"></div>
                            @else
                                <div class="panduan-no-img">
                                    <svg width="56" height="56" fill="none" stroke="white" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Body -->
                        <div class="panduan-card-body">
                            <div class="panduan-card-top">
                                <h3 class="panduan-card-title">{{ $panduan->judul }}</h3>
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $panduan->kategori ?? 'Informasi')) }}
                                </span>
                            </div>

                            <p class="panduan-card-desc">
                                {{ Str::limit(strip_tags($panduan->isi ?? ''), 180) }}
                            </p>

                            <div class="panduan-card-meta">
                                @if($panduan->alamat)
                                    <div class="panduan-meta-item">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ Str::limit($panduan->alamat, 60) }}</span>
                                    </div>
                                @endif
                                @if($panduan->kontak)
                                    <div class="panduan-meta-item">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>{{ $panduan->kontak }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="panduan-card-link">
                                <span class="panduan-card-link-line"></span>
                                Lihat Detail
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        @else
            <div class="empty-state" data-aos="fade-up">
                <div class="empty-icon">🗺️</div>
                <h3 class="empty-title">Tidak Ditemukan</h3>
                <p class="empty-desc">
                    @if(request('search'))
                        Tidak ada hasil untuk "{{ request('search') }}". Coba cari dengan kata kunci lain.
                    @elseif(request('kategori'))
                        Kategori ini belum memiliki data. Silakan cek kategori lain.
                    @else
                        Informasi hotel, rumah sakit, BPBD, dan layanan penting akan segera ditambahkan.
                    @endif
                </p>
                <a href="{{ route('panduan.index') }}" class="empty-cta">Lihat Semua Informasi</a>
            </div>
        @endif

        <!-- Pagination -->
        @if($panduans->hasPages())
            <div class="pagination-wrap" data-aos="fade-up">
                {{ $panduans->links('pagination::tailwind') }}
            </div>
        @endif

    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 900, easing: 'ease-out-cubic' });
</script>
@endpush