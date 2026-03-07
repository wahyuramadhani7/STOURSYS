@extends('frontend.layout.app')

@section('title', $berita->judul . ' - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
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
    position: fixed; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none; z-index: 9999; opacity: 0.6;
}

/* ========================
   SCROLL PROGRESS
   ======================== */
.scroll-progress {
    position: fixed; top: 0; left: 0;
    width: 0%; height: 3px;
    background: linear-gradient(90deg, var(--terracota), var(--gold));
    z-index: 10000; transition: width 0.1s ease-out;
}

/* ========================
   CONTAINER
   ======================== */
.container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
}
.container-narrow {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 4rem;
}

/* ========================
   HERO DETAIL
   ======================== */
.detail-hero {
    background: var(--ink);
    position: relative;
    overflow: hidden;
    padding: 6rem 0 5rem;
}
.detail-hero::after {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(ellipse 60% 70% at 80% 50%, rgba(196,92,46,0.15) 0%, transparent 70%);
    pointer-events: none;
}
.detail-hero-inner {
    position: relative; z-index: 2;
}

.back-btn {
    display: inline-flex; align-items: center; gap: 0.75rem;
    padding: 0.7rem 1.75rem;
    border: 1.5px solid rgba(250,246,240,0.2);
    color: rgba(250,246,240,0.7);
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem; letter-spacing: 0.15em;
    text-transform: uppercase; text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
    transition: all 0.3s ease;
    margin-bottom: 3rem;
}
.back-btn:hover {
    border-color: var(--terracota);
    color: var(--cream);
    background: rgba(196,92,46,0.15);
}
.back-btn svg { transition: transform 0.3s ease; }
.back-btn:hover svg { transform: translateX(-4px); }

.detail-eyebrow {
    font-family: 'Space Mono', monospace;
    font-size: 0.7rem; letter-spacing: 0.3em;
    text-transform: uppercase; color: var(--gold);
    margin-bottom: 1.5rem;
    display: flex; align-items: center; gap: 0.75rem;
}
.detail-eyebrow::before {
    content: '';
    display: block; width: 2rem; height: 1px;
    background: var(--gold);
}

.detail-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.2rem, 4vw, 4rem);
    font-weight: 900; color: var(--cream);
    line-height: 1.08; margin-bottom: 2.5rem;
    max-width: 26ch;
}

/* Meta info row */
.detail-meta {
    display: flex; flex-wrap: wrap; gap: 1.5rem;
    align-items: center;
}
.detail-meta-item {
    display: flex; align-items: center; gap: 0.5rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem; letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.5);
}
.detail-meta-item svg { color: var(--gold); flex-shrink: 0; }
.detail-meta-sep {
    width: 3px; height: 3px;
    background: rgba(250,246,240,0.25);
    border-radius: 50%;
}

/* Decorative number */
.detail-hero-num {
    position: absolute; bottom: 1rem; right: 4rem;
    font-family: 'Playfair Display', serif;
    font-size: 12rem; font-weight: 900;
    color: rgba(250,246,240,0.04);
    line-height: 1; z-index: 1;
    user-select: none; pointer-events: none;
}

/* ========================
   MARQUEE
   ======================== */
.marquee-strip {
    background: var(--terracota);
    padding: 0.9rem 0; overflow: hidden;
}
.marquee-track {
    display: flex;
    animation: marquee 28s linear infinite;
    width: max-content;
}
.marquee-item {
    font-family: 'Space Mono', monospace;
    font-size: 0.72rem; letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.9);
    padding: 0 3rem; white-space: nowrap;
    display: flex; align-items: center; gap: 1.5rem;
}
.marquee-dot {
    width: 4px; height: 4px;
    background: rgba(250,246,240,0.5);
    border-radius: 50%; flex-shrink: 0;
}
@keyframes marquee {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* ========================
   DETAIL BODY
   ======================== */
.detail-section {
    padding: 6rem 0 8rem;
}

/* Cover image */
.cover-wrap {
    position: relative; overflow: hidden;
    background: var(--charcoal); margin-bottom: 4rem;
    clip-path: polygon(0 0, calc(100% - 24px) 0, 100% 24px, 100% 100%, 24px 100%, 0 calc(100% - 24px));
}
.cover-wrap img {
    width: 100%; max-height: 500px; object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.8s ease;
    display: block;
}
.cover-wrap:hover img { transform: scale(1.04); }

/* Content panel */
.content-panel {
    background: white;
    border: 1.5px solid var(--sand);
    clip-path: polygon(0 0, calc(100% - 20px) 0, 100% 20px, 100% 100%, 20px 100%, 0 calc(100% - 20px));
    position: relative; overflow: hidden;
    margin-bottom: 3rem;
}
.content-panel::before {
    content: '';
    display: block; height: 4px;
    background: linear-gradient(to right, var(--terracota), var(--gold), var(--moss));
}
.content-panel-inner {
    padding: 3.5rem 4rem;
}

/* Ringkasan / summary */
.ringkasan-box {
    display: flex; gap: 1.25rem;
    padding: 1.5rem 1.75rem;
    background: var(--cream);
    border: 1.5px solid var(--sand);
    border-left: 3px solid var(--gold);
    margin-bottom: 3rem;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 0 100%);
}
.ringkasan-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem; letter-spacing: 0.3em;
    text-transform: uppercase; color: var(--gold);
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    flex-shrink: 0; user-select: none;
}
.ringkasan-text {
    font-size: 1rem; color: rgba(28,25,23,0.7);
    line-height: 1.85; font-style: italic;
}

/* Prose */
.prose-content {
    font-size: 1.05rem;
    color: rgba(28,25,23,0.8);
    line-height: 1.9;
}
.prose-content h1, .prose-content h2, .prose-content h3 {
    font-family: 'Playfair Display', serif;
    font-weight: 900; color: var(--ink);
    margin: 2rem 0 1rem; line-height: 1.2;
}
.prose-content h2 { font-size: 1.8rem; }
.prose-content h3 { font-size: 1.4rem; }
.prose-content p  { margin-bottom: 1.5rem; }
.prose-content a  { color: var(--terracota); text-decoration: underline; }
.prose-content ul,
.prose-content ol {
    margin: 0 0 1.5rem 1.5rem; line-height: 2;
}
.prose-content strong { font-weight: 600; color: var(--ink); }
.prose-content blockquote {
    border-left: 3px solid var(--terracota);
    padding-left: 1.5rem; margin: 1.5rem 0;
    color: rgba(28,25,23,0.6); font-style: italic;
}

/* ========================
   GALERI
   ======================== */
.galeri-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.7rem; letter-spacing: 0.3em;
    text-transform: uppercase; color: var(--terracota);
    margin-bottom: 1rem; margin-top: 3.5rem;
    padding-top: 3rem; border-top: 1.5px solid var(--sand);
    display: flex; align-items: center; gap: 0.75rem;
}
.galeri-label::before {
    content: '';
    display: block; width: 2rem; height: 1px;
    background: currentColor;
}
.galeri-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem; font-weight: 900;
    color: var(--ink); margin-bottom: 2rem; line-height: 1.1;
}
.galeri-title em { font-style: italic; color: var(--terracota); }

.galeri-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1.5px solid var(--sand);
}
.galeri-item {
    position: relative; overflow: hidden;
    background: var(--charcoal);
    border-right: 1.5px solid var(--sand);
    border-bottom: 1.5px solid var(--sand);
    aspect-ratio: 4/3;
    display: block;
}
.galeri-item:nth-child(3n) { border-right: none; }
.galeri-item img {
    width: 100%; height: 100%; object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.7s ease, filter 0.7s ease;
    display: block;
}
.galeri-item:hover img {
    transform: scale(1.08);
    filter: sepia(20%) contrast(1.1);
}
.galeri-item-overlay {
    position: absolute; inset: 0;
    background: rgba(13,11,9,0);
    transition: background 0.4s ease;
    display: flex; align-items: center; justify-content: center;
}
.galeri-item:hover .galeri-item-overlay {
    background: rgba(13,11,9,0.45);
}
.galeri-zoom-icon {
    opacity: 0; transform: scale(0.7);
    transition: all 0.3s ease;
    color: var(--cream);
}
.galeri-item:hover .galeri-zoom-icon {
    opacity: 1; transform: scale(1);
}

/* ========================
   BACK BUTTON BOTTOM
   ======================== */
.back-btn-bottom {
    display: inline-flex; align-items: center; gap: 0.75rem;
    padding: 1rem 2.5rem;
    background: var(--terracota); color: var(--cream);
    font-family: 'Space Mono', monospace;
    font-size: 0.78rem; letter-spacing: 0.12em;
    text-transform: uppercase; text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
    transition: all 0.3s ease;
}
.back-btn-bottom:hover { background: var(--brick); gap: 1.25rem; }
.back-btn-bottom svg { transition: transform 0.3s ease; }
.back-btn-bottom:hover svg { transform: translateX(-4px); }

/* ========================
   RESPONSIVE
   ======================== */
@media (max-width: 900px) {
    .container-narrow { padding: 0 1.5rem; }
    .content-panel-inner { padding: 2rem 1.75rem; }
    .detail-hero { padding: 4rem 0 3.5rem; }
    .detail-title { font-size: clamp(1.9rem, 5vw, 2.8rem); }
    .detail-hero-num { display: none; }
    .detail-section { padding: 3.5rem 0 5rem; }
    .galeri-grid { grid-template-columns: 1fr 1fr; }
    .galeri-item:nth-child(3n) { border-right: 1.5px solid var(--sand); }
    .galeri-item:nth-child(2n) { border-right: none; }
}
@media (max-width: 600px) {
    .container, .container-narrow { padding: 0 1.25rem; }
    .content-panel-inner { padding: 1.5rem; }
    .galeri-grid { grid-template-columns: 1fr 1fr; }
    .detail-meta { gap: 1rem; }
    .ringkasan-box { flex-direction: column; gap: 0.75rem; }
    .ringkasan-label { writing-mode: horizontal-tb; transform: none; }
}
</style>
@endpush

@section('content')

<!-- Scroll Progress -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- ===================== HERO ===================== -->
<section class="detail-hero">
    <div class="container detail-hero-inner">

        <a href="{{ route('berita.index') }}" class="back-btn" data-aos="fade-right" data-aos-duration="800">
            <svg width="16" height="10" viewBox="0 0 16 10" fill="none">
                <path d="M16 5H2M2 5L6 1M2 5L6 9" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            Kembali ke Berita
        </a>

        <p class="detail-eyebrow" data-aos="fade-up" data-aos-delay="100">
            Berita &amp; Informasi
        </p>

        <h1 class="detail-title" data-aos="fade-up" data-aos-delay="200">
            {{ $berita->judul }}
        </h1>

        <div class="detail-meta" data-aos="fade-up" data-aos-delay="300">
            <div class="detail-meta-item">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ $berita->penulis ?? 'Admin' }}
            </div>
            <span class="detail-meta-sep"></span>
            <div class="detail-meta-item">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $berita->tanggal_publikasi?->format('d F Y') ?? '-' }}
            </div>
            <span class="detail-meta-sep"></span>
            <div class="detail-meta-item">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                {{ $berita->views }} views
            </div>
        </div>

    </div>
    <span class="detail-hero-num">04</span>
</section>

<!-- ===================== MARQUEE ===================== -->
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @foreach(array_fill(0, 2, null) as $_)
            <span class="marquee-item">{{ Str::limit($berita->judul, 40) }}<span class="marquee-dot"></span></span>
            <span class="marquee-item">Berita Terbaru<span class="marquee-dot"></span></span>
            <span class="marquee-item">Kawasan Borobudur<span class="marquee-dot"></span></span>
            <span class="marquee-item">{{ $berita->tanggal_publikasi?->format('d M Y') ?? 'STOURSYS' }}<span class="marquee-dot"></span></span>
            <span class="marquee-item">Wisata &amp; Budaya<span class="marquee-dot"></span></span>
            <span class="marquee-item">STOURSYS<span class="marquee-dot"></span></span>
        @endforeach
    </div>
</div>

<!-- ===================== BODY ===================== -->
<section class="detail-section">
    <div class="container-narrow">

        <!-- Cover Image -->
        @if($berita->gambar_utama)
            <div class="cover-wrap" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{ Storage::url($berita->gambar_utama) }}"
                     alt="{{ $berita->judul }}"
                     loading="lazy">
            </div>
        @endif

        <!-- Content Panel -->
        <div class="content-panel" data-aos="fade-up" data-aos-duration="900" data-aos-delay="100">
            <div class="content-panel-inner">

                <!-- Ringkasan -->
                @if($berita->ringkasan)
                    <div class="ringkasan-box" data-aos="fade-up" data-aos-delay="120">
                        <span class="ringkasan-label">Ringkasan</span>
                        <p class="ringkasan-text">{{ $berita->ringkasan }}</p>
                    </div>
                @endif

                <!-- Isi Artikel -->
                <div class="prose-content" data-aos="fade-up" data-aos-delay="200">
                    {!! $berita->isi !!}
                </div>

                <!-- Galeri -->
                @if(!empty($berita->galeri))
                    <p class="galeri-label" data-aos="fade-up">Galeri Foto</p>
                    <h3 class="galeri-title" data-aos="fade-up" data-aos-delay="60">
                        Dokumentasi <em>Visual</em>
                    </h3>

                    <div class="galeri-grid" data-aos="fade-up" data-aos-delay="120">
                        @foreach($berita->galeri as $idx => $gambar)
                            <a href="{{ Storage::url($gambar) }}"
                               class="galeri-item glightbox"
                               data-aos="fade-in"
                               data-aos-delay="{{ $idx * 50 }}">
                                <img src="{{ Storage::url($gambar) }}"
                                     alt="Galeri {{ $idx + 1 }}"
                                     loading="lazy">
                                <div class="galeri-item-overlay">
                                    <div class="galeri-zoom-icon">
                                        <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>

        <!-- Back Button -->
        <div data-aos="fade-up" data-aos-delay="150">
            <a href="{{ route('berita.index') }}" class="back-btn-bottom">
                <svg width="16" height="10" viewBox="0 0 16 10" fill="none">
                    <path d="M16 5H2M2 5L6 1M2 5L6 9" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                Kembali ke Daftar Berita
            </a>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    AOS.init({ once: true, duration: 900, easing: 'ease-out-cubic' });

    // GLightbox untuk galeri
    GLightbox({ touchNavigation: true, loop: true, zoomable: true });

    // Scroll progress bar
    window.addEventListener('scroll', function () {
        const el  = document.getElementById('scrollProgress');
        const top = window.pageYOffset || document.documentElement.scrollTop;
        const h   = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        el.style.width = (top / h * 100) + '%';
    });
</script>
@endpush