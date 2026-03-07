@extends('frontend.layout.app')

@section('title', $destinasi->nama . ' | Destinasi Wisata Kawasan Borobudur')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

<style>
:root {
    --cream:     #faf6f0;
    --sand:      #e8dcc8;
    --terracota: #c45c2e;
    --brick:     #9c3a1a;
    --gold:      #c9952a;
    --moss:      #4a6741;
    --charcoal:  #1c1917;
    --ink:       #0d0b09;
}

/* ── Scroll progress ───────────────────────── */
.scroll-progress {
    position: fixed;
    top: 0; left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, var(--terracota), var(--gold), var(--moss));
    z-index: 9998;
    transition: width 0.1s linear;
}

/* ── HERO ──────────────────────────────────── */
.detail-hero {
    position: relative;
    height: 75vh;
    min-height: 500px;
    overflow: hidden;
    background: var(--ink);
}
.detail-hero img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: sepia(15%) contrast(1.1) brightness(0.6);
    will-change: transform;
    transition: transform 0s linear;
}
.hero-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(13,11,9,0.92) 0%,
        rgba(13,11,9,0.45) 45%,
        rgba(13,11,9,0.15) 100%
    );
}

.hero-content {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 4rem 4rem 3.5rem;
    max-width: 1440px;
    margin: 0 auto;
}

.hero-eyebrow {
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.hero-eyebrow::before {
    content: '';
    display: block;
    width: 2.5rem;
    height: 1px;
    background: var(--gold);
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.8rem, 6vw, 5.5rem);
    font-weight: 900;
    color: var(--cream);
    line-height: 0.95;
    margin-bottom: 1.25rem;
    letter-spacing: -0.02em;
}

.hero-location {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.55);
}
.hero-location svg { color: var(--terracota); flex-shrink: 0; }

/* Hero meta strip */
.hero-meta {
    position: absolute;
    top: 2rem; right: 4rem;
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    align-items: flex-end;
    z-index: 2;
}
.hero-meta-tag {
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    background: var(--terracota);
    color: var(--cream);
    padding: 0.4rem 1rem;
    clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
}
.hero-views-tag {
    background: rgba(13,11,9,0.6);
    border: 1px solid rgba(250,246,240,0.15);
    color: rgba(250,246,240,0.6);
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 0.4rem 1rem;
}

/* ── MAIN LAYOUT ───────────────────────────── */
.detail-body {
    background: var(--cream);
    padding: 5rem 0 7rem;
}
.detail-container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 5rem;
    align-items: start;
}

/* ── TABS ──────────────────────────────────── */
.tab-nav {
    display: flex;
    gap: 0;
    border-bottom: 1.5px solid var(--sand);
    margin-bottom: 3rem;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.tab-nav::-webkit-scrollbar { display: none; }

.tab-btn {
    flex-shrink: 0;
    padding: 0.85rem 1.5rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.4);
    background: transparent;
    border: none;
    border-bottom: 2px solid transparent;
    margin-bottom: -1.5px;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}
.tab-btn:hover { color: var(--terracota); }
.tab-btn.active {
    color: var(--terracota);
    border-bottom-color: var(--terracota);
    font-weight: 700;
}

.tab-content { display: none; }
.tab-content.active { display: block; }

@keyframes tabIn {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
.tab-content.active { animation: tabIn 0.4s ease-out; }

/* ── DESKRIPSI ─────────────────────────────── */
.prose-editorial {
    font-size: 1.05rem;
    line-height: 1.9;
    color: rgba(28,25,23,0.75);
    max-width: 68ch;
}
.prose-editorial p { margin-bottom: 1.25rem; }

/* ── FASILITAS ─────────────────────────────── */
.fasilitas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1rem;
}
.fasilitas-card {
    position: relative;
    background: white;
    border: 1.5px solid var(--sand);
    padding: 1.75rem 1.5rem 1.5rem;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
    transition: all 0.35s ease;
    overflow: hidden;
}
.fasilitas-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(196,92,46,0.06) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.35s ease;
}
.fasilitas-card:hover {
    border-color: var(--terracota);
    transform: translateY(-4px);
}
.fasilitas-card:hover::before { opacity: 1; }

.fasilitas-icon {
    width: 40px;
    height: 40px;
    color: var(--terracota);
    margin-bottom: 1rem;
    transition: transform 0.35s ease;
}
.fasilitas-card:hover .fasilitas-icon { transform: scale(1.15) rotate(5deg); }

.fasilitas-name {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.3;
}
.fasilitas-badge {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.55rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--moss);
    background: rgba(74,103,65,0.1);
    padding: 0.25rem 0.6rem;
    border: 1px solid rgba(74,103,65,0.2);
}

/* ── JAM & HARGA ───────────────────────────── */
.jam-harga-grid { display: grid; gap: 2rem; }

.info-block-title {
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.info-block-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(201,149,42,0.3);
}

.jam-box {
    background: white;
    border: 1.5px solid var(--sand);
    padding: 1.75rem 2rem;
    clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
}
.jam-value {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.3;
}

.harga-box {
    background: var(--ink);
    padding: 2.5rem 2rem;
    clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
    position: relative;
    overflow: hidden;
}
.harga-box::before {
    content: 'TIKET';
    position: absolute;
    bottom: -1rem;
    right: 1.5rem;
    font-family: 'Playfair Display', serif;
    font-size: 6rem;
    font-weight: 900;
    color: rgba(255,255,255,0.04);
    user-select: none;
    line-height: 1;
}
.harga-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.75rem;
}
.harga-value {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 3.5vw, 2.8rem);
    font-weight: 900;
    color: var(--cream);
    line-height: 1;
    margin-bottom: 1rem;
}
.harga-info {
    font-size: 0.88rem;
    color: rgba(250,246,240,0.45);
    line-height: 1.7;
    border-top: 1px solid rgba(250,246,240,0.08);
    padding-top: 1rem;
    margin-top: 0.5rem;
}

/* ── PETA ──────────────────────────────────── */
.map-wrap {
    position: relative;
    aspect-ratio: 16/9;
    border: 1.5px solid var(--sand);
    clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
    overflow: hidden;
}
.map-wrap iframe { width: 100%; height: 100%; border: none; }

/* ── GALERI ────────────────────────────────── */
.galeri-header {
    margin-bottom: 2rem;
}
.galeri-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 900;
    color: var(--ink);
}

.galeri-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
}
.galeri-item {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4/3;
    background: var(--charcoal);
}
.galeri-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.7s ease, filter 0.7s ease;
}
.galeri-item:hover img {
    transform: scale(1.1);
    filter: sepia(20%) contrast(1.1) brightness(0.75);
}
.galeri-item-overlay {
    position: absolute;
    inset: 0;
    background: rgba(13,11,9,0);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.4s ease;
}
.galeri-item:hover .galeri-item-overlay {
    background: rgba(13,11,9,0.45);
}
.galeri-zoom {
    color: var(--cream);
    opacity: 0;
    transform: scale(0.7);
    transition: all 0.35s ease;
}
.galeri-item:hover .galeri-zoom {
    opacity: 1;
    transform: scale(1);
}
.galeri-item:nth-child(1) {
    grid-column: span 2;
    grid-row: span 2;
    aspect-ratio: auto;
}

/* ── SIDEBAR ───────────────────────────────── */
.sidebar { position: sticky; top: 96px; }

.sidebar-card {
    background: white;
    border: 1.5px solid var(--sand);
    clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.sidebar-card-header {
    padding: 1.25rem 1.75rem;
    background: var(--ink);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.sidebar-card-header-title {
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
}
.sidebar-card-body { padding: 1.75rem; }

.sidebar-row {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--sand);
}
.sidebar-row:last-child { border-bottom: none; padding-bottom: 0; }
.sidebar-row:first-child { padding-top: 0; }
.sidebar-row-icon {
    width: 36px;
    height: 36px;
    background: rgba(196,92,46,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    clip-path: polygon(0 0, calc(100% - 5px) 0, 100% 5px, 100% 100%, 5px 100%, 0 calc(100% - 5px));
}
.sidebar-row-icon svg { width: 16px; height: 16px; color: var(--terracota); }
.sidebar-row-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.4);
    margin-bottom: 0.25rem;
}
.sidebar-row-value {
    font-size: 0.9rem;
    color: var(--charcoal);
    font-weight: 500;
    line-height: 1.4;
}

/* ── BACK BUTTON ───────────────────────────── */
.back-section {
    max-width: 1440px;
    margin: 4rem auto 0;
    padding: 0 4rem;
    display: flex;
    justify-content: flex-start;
}
.back-cta {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.72rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    text-decoration: none;
    color: var(--cream);
    background: var(--ink);
    padding: 1rem 2.25rem;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
    transition: all 0.3s ease;
}
.back-cta:hover { background: var(--terracota); }
.back-cta-line {
    width: 1.5rem;
    height: 1px;
    background: currentColor;
    flex-shrink: 0;
    transition: width 0.3s ease;
}
.back-cta:hover .back-cta-line { width: 2.5rem; }

/* ── RESPONSIVE ────────────────────────────── */
@media (max-width: 1100px) {
    .detail-container {
        grid-template-columns: 1fr;
        gap: 3rem;
        padding: 0 2.5rem;
    }
    .sidebar { position: static; }
    .hero-content { padding: 3rem 2.5rem 2.5rem; }
    .hero-meta { right: 2.5rem; }
    .back-section { padding: 0 2.5rem; }
}

@media (max-width: 640px) {
    .detail-hero { height: 65vh; min-height: 380px; }
    .hero-content { padding: 2.5rem 1.5rem 2rem; }
    .hero-meta { top: 1.5rem; right: 1.5rem; }
    .detail-container { padding: 0 1.5rem; }
    .galeri-grid { grid-template-columns: 1fr 1fr; }
    .galeri-item:nth-child(1) { grid-column: span 2; }
    .fasilitas-grid { grid-template-columns: 1fr; }
    .back-section { padding: 0 1.5rem; }
    .detail-body { padding: 3rem 0 5rem; }
}
</style>
@endpush

@section('content')

<div class="scroll-progress" id="scrollProgress"></div>

{{-- ════════════════════ HERO ════════════════════ --}}
<section class="detail-hero">
    @if($destinasi->gambar_utama_url)
        <img src="{{ $destinasi->gambar_utama_url }}"
             alt="{{ $destinasi->nama }}"
             id="heroImg"
             loading="eager">
    @else
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:8rem;opacity:0.08;color:var(--cream);">🏯</div>
    @endif

    <div class="hero-gradient"></div>

    {{-- Meta tags (top-right) --}}
    <div class="hero-meta">
        @if($destinasi->kategori)
            @php
                $kd = $destinasi->kategori;
                if(str_starts_with($kd,'kuliner_') || $kd==='kuliner') $kd='Kuliner';
                elseif($kd==='budaya') $kd='Kesenian & Budaya';
                else $kd = ucwords(str_replace(['_','-'],' ',$kd));
            @endphp
            <span class="hero-meta-tag">{{ $kd }}</span>
        @endif
        @if($destinasi->views >= 50)
            <span class="hero-meta-tag" style="background:var(--gold);color:var(--ink);">Populer</span>
        @endif
        <span class="hero-views-tag">{{ number_format($destinasi->views) }} views</span>
    </div>

    {{-- Title (bottom-left) --}}
    <div style="position:absolute;inset:0;max-width:1440px;margin:0 auto;">
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <p class="hero-eyebrow">Destinasi Wisata · Kawasan Borobudur</p>
            <h1 class="hero-title">{{ $destinasi->nama }}</h1>
            @if($destinasi->lokasi)
                <div class="hero-location">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $destinasi->lokasi }}
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ════════════════════ BODY ════════════════════ --}}
<section class="detail-body">
    <div class="detail-container">

        {{-- ── KONTEN UTAMA ── --}}
        <div>

            @if($destinasi->deskripsi_singkat ?? false)
                <p class="prose-editorial" style="font-size:1.2rem;margin-bottom:3rem;font-style:italic;color:rgba(28,25,23,0.65);"
                   data-aos="fade-up">
                    {{ $destinasi->deskripsi_singkat }}
                </p>
            @endif

            {{-- Tab navigation --}}
            <div class="tab-nav" data-aos="fade-up" data-aos-delay="100">
                <button class="tab-btn active" data-tab="deskripsi">Deskripsi</button>
                @if(count($destinasi->fasilitas_list ?? []) > 0)
                    <button class="tab-btn" data-tab="fasilitas">Fasilitas</button>
                @endif
                <button class="tab-btn" data-tab="jam-harga">Jam & Harga</button>
                @if($destinasi->peta_embed_safe)
                    <button class="tab-btn" data-tab="lokasi">Lokasi</button>
                @endif
                @if(count($destinasi->galeri_urls ?? []) > 0)
                    <button class="tab-btn" data-tab="galeri">Galeri</button>
                @endif
            </div>

            {{-- Tab: Deskripsi --}}
            <div class="tab-content active" id="deskripsi">
                <div class="prose-editorial">
                    {!! nl2br(e($destinasi->deskripsi ?? 'Belum ada deskripsi lengkap.')) !!}
                </div>
            </div>

            {{-- Tab: Fasilitas --}}
            @if(count($destinasi->fasilitas_list ?? []) > 0)
            <div class="tab-content" id="fasilitas">
                <div class="fasilitas-grid">
                    @foreach($destinasi->fasilitas_list as $idx => $fas)
                        @php $fl = strtolower($fas); @endphp
                        <div class="fasilitas-card"
                             data-aos="fade-up"
                             data-aos-delay="{{ $idx * 70 }}">
                            <span class="fasilitas-badge">Tersedia</span>

                            @if(str_contains($fl,'toilet')||str_contains($fl,'wc')||str_contains($fl,'kamar mandi'))
                                <svg class="fasilitas-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                            @elseif(str_contains($fl,'parkir')||str_contains($fl,'parking'))
                                <svg class="fasilitas-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8m0-4h4a2 2 0 000-4H8m0 0V7m12 5a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @elseif(str_contains($fl,'wifi')||str_contains($fl,'internet'))
                                <svg class="fasilitas-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                            @elseif(str_contains($fl,'makan')||str_contains($fl,'restoran')||str_contains($fl,'cafe')||str_contains($fl,'food'))
                                <svg class="fasilitas-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            @else
                                <svg class="fasilitas-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @endif

                            <div class="fasilitas-name">{{ $fas }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Tab: Jam & Harga --}}
            <div class="tab-content" id="jam-harga">
                <div class="jam-harga-grid">
                    <div>
                        <p class="info-block-title">Jam Operasional</p>
                        <div class="jam-box">
                            @if($destinasi->jam_operasional)
                                <div class="jam-value">{{ $destinasi->jam_operasional }}</div>
                            @else
                                <div class="jam-value" style="color:rgba(28,25,23,0.35);font-size:1rem;">
                                    Informasi jam operasional tersedia di lokasi atau situs resmi.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <p class="info-block-title">Harga Tiket Masuk</p>
                        <div class="harga-box">
                            <p class="harga-label">Mulai dari</p>
                            @if($destinasi->harga_tiket_formatted)
                                <div class="harga-value">{{ $destinasi->harga_tiket_formatted }}</div>
                            @else
                                <div class="harga-value" style="font-size:1.4rem;opacity:0.5;">Informasi di lokasi</div>
                            @endif
                            @if($destinasi->info_tiket)
                                <p class="harga-info">{{ $destinasi->info_tiket }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab: Lokasi --}}
            @if($destinasi->peta_embed_safe)
            <div class="tab-content" id="lokasi">
                <div class="map-wrap">
                    <iframe src="{{ $destinasi->peta_embed_safe }}"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            @endif

            {{-- Tab: Galeri --}}
            @if(count($destinasi->galeri_urls ?? []) > 0)
            <div class="tab-content" id="galeri">
                <div class="galeri-header">
                    <p class="info-block-title">Foto Destinasi</p>
                    <h3 class="galeri-title">{{ $destinasi->nama }}</h3>
                </div>
                <div class="galeri-grid">
                    @foreach($destinasi->galeri_urls as $idx => $url)
                        <a href="{{ $url }}"
                           class="galeri-item glightbox"
                           data-aos="fade-up"
                           data-aos-delay="{{ $idx * 50 }}">
                            <img src="{{ $url }}"
                                 alt="Galeri {{ $destinasi->nama }} {{ $idx + 1 }}"
                                 loading="lazy">
                            <div class="galeri-item-overlay">
                                <div class="galeri-zoom">
                                    <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 0zM10.5 7.5v6m3-3h-6"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>{{-- end main --}}

        {{-- ── SIDEBAR ── --}}
        <div class="sidebar" data-aos="fade-left" data-aos-duration="900">

            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--gold)">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                    <span class="sidebar-card-header-title">Informasi Singkat</span>
                </div>
                <div class="sidebar-card-body">
                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0zM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Lokasi</p>
                            <p class="sidebar-row-value">{{ $destinasi->lokasi ?? 'Tidak disebutkan' }}</p>
                        </div>
                    </div>

                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Total Dilihat</p>
                            <p class="sidebar-row-value">{{ number_format($destinasi->views) }} kali</p>
                        </div>
                    </div>

                    @if($destinasi->kategori_nama)
                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Kategori</p>
                            <p class="sidebar-row-value">{{ $destinasi->kategori_nama }}</p>
                        </div>
                    </div>
                    @endif

                    @if($destinasi->jam_operasional)
                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Jam Buka</p>
                            <p class="sidebar-row-value">{{ $destinasi->jam_operasional }}</p>
                        </div>
                    </div>
                    @endif

                    @if($destinasi->harga_tiket_formatted)
                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a3 3 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Tiket Masuk</p>
                            <p class="sidebar-row-value" style="color:var(--terracota);font-weight:700;">{{ $destinasi->harga_tiket_formatted }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Quick nav back --}}
            <a href="{{ route('destinasi.index') }}" class="back-cta" style="width:100%;justify-content:center;display:flex;">
                <span class="back-cta-line"></span>
                Semua Destinasi
            </a>

        </div>

    </div>

    {{-- Back button (full) --}}
    <div class="back-section" data-aos="fade-up">
        @php
            $kategori = request()->query('kategori') ?? ($destinasi->kategori ?? null);
            $validKat = in_array($kategori, ['candi','balkondes','kuliner','alam','budaya','religi','desa_wisata']);
            $backUrl  = $validKat
                ? route('destinasi.index') . '?kategori=' . urlencode($kategori)
                : route('destinasi.index');
        @endphp
        <a href="{{ $backUrl }}" class="back-cta">
            <span class="back-cta-line"></span>
            Kembali ke Daftar
            @if($validKat && $destinasi->kategori_nama)
                &nbsp;·&nbsp;{{ $destinasi->kategori_nama }}
            @endif
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
AOS.init({ once: true, duration: 800, easing: 'ease-out-cubic' });

GLightbox({ touchNavigation: true, loop: true, zoomable: true });

// Parallax hero
const heroImg = document.getElementById('heroImg');
if (heroImg) {
    window.addEventListener('scroll', () => {
        heroImg.style.transform = `translateY(${window.pageYOffset * 0.38}px)`;
    }, { passive: true });
}

// Scroll progress
const bar = document.getElementById('scrollProgress');
window.addEventListener('scroll', () => {
    const pct = window.pageYOffset / (document.documentElement.scrollHeight - document.documentElement.clientHeight) * 100;
    bar.style.width = pct + '%';
}, { passive: true });

// Tabs
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');
        const target = document.getElementById(btn.dataset.tab);
        if (target) target.classList.add('active');
    });
});
</script>
@endpush