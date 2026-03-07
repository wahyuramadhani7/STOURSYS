@extends('frontend.layout.app')

@section('title', 'Berita Terbaru - STOURSYS')

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
.hero-title em { font-style: italic; color: var(--terracota); }
.hero-desc {
    font-size: 1.05rem;
    color: rgba(250,246,240,0.6);
    line-height: 1.8;
    max-width: 36ch;
}
.hero-right { position: relative; overflow: hidden; }
.hero-right img {
    width: 100%; height: 100%;
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
    bottom: 3rem; right: 3rem;
    font-family: 'Playfair Display', serif;
    font-size: 10rem; font-weight: 900;
    color: rgba(250,246,240,0.06);
    line-height: 1; z-index: 2;
    user-select: none; pointer-events: none;
}
.hero-vertical {
    position: absolute;
    right: 2rem; top: 50%;
    transform: translateY(-50%) rotate(90deg);
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem; letter-spacing: 0.4em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.3);
    z-index: 3; white-space: nowrap;
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
   CONTAINER
   ======================== */
.container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
}

/* ========================
   BERITA SECTION
   ======================== */
.berita-section {
    padding: 7rem 0;
    background: var(--cream);
}

.berita-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 2rem;
    flex-wrap: wrap;
    border-bottom: 1px solid var(--sand);
    padding-bottom: 3rem;
    margin-bottom: 3.5rem;
}

.section-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.7rem; letter-spacing: 0.3em;
    text-transform: uppercase; color: var(--terracota);
    margin-bottom: 1rem;
    display: flex; align-items: center; gap: 0.75rem;
}
.section-label::before {
    content: '';
    display: block; width: 2rem; height: 1px;
    background: var(--terracota);
}
.section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.2rem, 3.5vw, 3.5rem);
    font-weight: 900; color: var(--ink); line-height: 1.05;
}
.section-title em { font-style: italic; color: var(--terracota); }
.dest-count {
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
    color: rgba(28,25,23,0.45);
    margin-top: 0.75rem; letter-spacing: 0.1em;
}

/* ========================
   SEARCH
   ======================== */
.search-wrap {
    position: relative;
    max-width: 420px; width: 100%;
    margin-bottom: 3.5rem;
}
.search-wrap input {
    width: 100%; height: 52px;
    background: white;
    border: 1.5px solid var(--sand);
    padding: 0 9rem 0 1.5rem;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem; color: var(--ink);
    outline: none;
    transition: border-color 0.3s ease;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
}
.search-wrap input:focus { border-color: var(--terracota); }
.search-wrap input::placeholder { color: rgba(28,25,23,0.35); }
.search-actions {
    position: absolute; right: 0; top: 0; height: 100%;
    display: flex;
}
.search-btn {
    height: 100%; padding: 0 1.5rem;
    background: var(--terracota); color: var(--cream);
    border: none;
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem; letter-spacing: 0.15em;
    text-transform: uppercase; cursor: pointer;
    transition: background 0.3s ease;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 0 100%);
}
.search-btn:hover { background: var(--brick); }
.reset-btn {
    display: flex; align-items: center;
    padding: 0 1rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem; letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.45);
    text-decoration: none;
    transition: color 0.3s ease;
    border-left: 1px solid var(--sand);
    background: white;
}
.reset-btn:hover { color: var(--terracota); }

.search-result-info {
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem; letter-spacing: 0.1em;
    color: rgba(28,25,23,0.5);
    margin-bottom: 2rem;
}
.search-result-info strong { color: var(--terracota); }

/* ========================
   BERITA GRID
   ======================== */
.berita-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1.5px solid var(--sand);
}

/* ========================
   BERITA CARD
   ======================== */
.berita-card {
    position: relative;
    border-right: 1.5px solid var(--sand);
    border-bottom: 1.5px solid var(--sand);
    text-decoration: none;
    display: flex; flex-direction: column;
    overflow: hidden; background: white;
    transition: background 0.3s ease;
}
.berita-card:nth-child(3n) { border-right: none; }
.berita-card:hover { background: var(--cream); }

/* Image */
.berita-card-img {
    position: relative; height: 220px;
    overflow: hidden; background: var(--charcoal);
    flex-shrink: 0;
}
.berita-card-img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.7s ease, filter 0.7s ease;
    filter: sepia(10%) contrast(1.05);
}
.berita-card:hover .berita-card-img img {
    transform: scale(1.07);
    filter: sepia(20%) contrast(1.1);
}
.berita-card-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(13,11,9,0.55) 100%);
}
.berita-card-badge {
    position: absolute; top: 1rem; right: 1rem;
    background: var(--terracota); color: var(--cream);
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem; letter-spacing: 0.2em;
    text-transform: uppercase; padding: 0.4rem 0.9rem;
    clip-path: polygon(0 0, calc(100% - 5px) 0, 100% 5px, 100% 100%, 5px 100%, 0 calc(100% - 5px));
}
.berita-no-img {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, var(--charcoal), #2c2420);
    opacity: 0.6;
}

/* Body */
.berita-card-body {
    padding: 2rem; flex-grow: 1;
    display: flex; flex-direction: column;
    border-top: 3px solid var(--sand);
    transition: border-color 0.3s ease;
}
.berita-card:hover .berita-card-body { border-top-color: var(--terracota); }

.berita-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.45rem; font-weight: 700;
    color: var(--ink); line-height: 1.25;
    margin-bottom: 0.85rem;
    transition: color 0.3s ease;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.berita-card:hover .berita-card-title { color: var(--terracota); }

.berita-card-excerpt {
    font-size: 0.88rem; color: rgba(28,25,23,0.6);
    line-height: 1.75; margin-bottom: 1.5rem; flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Meta info */
.berita-card-meta {
    display: flex; flex-wrap: wrap; gap: 1rem;
    margin-bottom: 1.5rem;
}
.berita-meta-item {
    display: flex; align-items: center; gap: 0.4rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem; letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.45);
}
.berita-meta-item svg { color: var(--gold); flex-shrink: 0; }

/* Link */
.berita-card-link {
    display: flex; align-items: center; gap: 0.75rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--terracota);
    margin-top: auto; transition: gap 0.3s ease;
}
.berita-card-link-line {
    height: 1px; width: 1.5rem;
    background: currentColor; transition: width 0.3s ease;
}
.berita-card:hover .berita-card-link-line { width: 3rem; }

/* ========================
   EMPTY STATE
   ======================== */
.empty-state {
    grid-column: 1/-1;
    padding: 8rem 2rem; text-align: center;
}
.empty-icon {
    font-size: 6rem; margin-bottom: 2rem; opacity: 0.3;
}
.empty-title {
    font-family: 'Playfair Display', serif;
    font-size: 3rem; font-weight: 900;
    color: var(--ink); margin-bottom: 1rem;
}
.empty-desc {
    color: rgba(28,25,23,0.5); font-size: 1rem;
    margin-bottom: 2.5rem; line-height: 1.8;
}
.empty-cta {
    display: inline-block; padding: 1rem 2.5rem;
    background: var(--terracota); color: var(--cream);
    font-family: 'Space Mono', monospace;
    font-size: 0.72rem; letter-spacing: 0.15em;
    text-transform: uppercase; text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
    transition: background 0.3s ease;
}
.empty-cta:hover { background: var(--brick); }

/* ========================
   PAGINATION
   ======================== */
.pagination-wrap {
    margin-top: 4rem;
    display: flex; justify-content: center;
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
    .berita-grid { grid-template-columns: 1fr 1fr; }
    .berita-card:nth-child(3n) { border-right: 1.5px solid var(--sand); }
    .berita-card:nth-child(2n) { border-right: none; }
    .container { padding: 0 1.5rem; }
    .berita-section { padding: 4rem 0 5rem; }
}
@media (max-width: 600px) {
    .hero-left { padding: 4rem 1.25rem 3rem; }
    .berita-grid { grid-template-columns: 1fr; }
    .berita-card:nth-child(n) { border-right: none; }
    .berita-header { flex-direction: column; align-items: flex-start; }
}
</style>
@endpush

@section('content')

<!-- ===================== HERO ===================== -->
<section class="hero">
    <div class="hero-left" data-aos="fade-right" data-aos-duration="1200">
        <p class="hero-eyebrow">Stoursys — Kawasan Borobudur</p>
        <h1 class="hero-title">
            Berita<br>
            <em>Terbaru</em>
        </h1>
        <p class="hero-desc">
            Update terkini seputar wisata, budaya, dan perkembangan kawasan Candi Borobudur.
        </p>
    </div>

    <div class="hero-right">
        <img src="{{ asset('storage/images/borobudur1.webp') }}"
        <span class="hero-num">04</span>
        <span class="hero-vertical">Berita &amp; Informasi</span>
    </div>
</section>

<!-- ===================== MARQUEE ===================== -->
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @foreach(array_fill(0, 2, null) as $_)
            <span class="marquee-item">Berita Terbaru<span class="marquee-dot"></span></span>
            <span class="marquee-item">Kawasan Borobudur<span class="marquee-dot"></span></span>
            <span class="marquee-item">Wisata &amp; Budaya<span class="marquee-dot"></span></span>
            <span class="marquee-item">Warisan UNESCO<span class="marquee-dot"></span></span>
            <span class="marquee-item">Update Terkini<span class="marquee-dot"></span></span>
            <span class="marquee-item">Komunitas Lokal<span class="marquee-dot"></span></span>
            <span class="marquee-item">STOURSYS<span class="marquee-dot"></span></span>
        @endforeach
    </div>
</div>

<!-- ===================== KONTEN ===================== -->
<section class="berita-section">
    <div class="container">

        <!-- Header -->
        <div class="berita-header" data-aos="fade-up">
            <div>
                <p class="section-label">Berita &amp; Informasi</p>
                <h2 class="section-title">
                    Kabar dari<br>
                    <em>Borobudur</em>
                </h2>
                @if(request('search'))
                    <p class="dest-count">{{ $beritas->total() }} Berita Ditemukan</p>
                @endif
            </div>
        </div>

        <!-- Search -->
        <div data-aos="fade-up">
            <form method="GET" action="{{ route('berita.index') }}">
                <div class="search-wrap">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari berita atau topik...">
                    <div class="search-actions">
                        @if(request('search'))
                            <a href="{{ route('berita.index') }}" class="reset-btn">Reset</a>
                        @endif
                        <button type="submit" class="search-btn">Cari</button>
                    </div>
                </div>
            </form>

            @if(request('search'))
                <p class="search-result-info">
                    Hasil untuk "<strong>{{ request('search') }}</strong>"
                    — <strong>{{ $beritas->total() }}</strong> berita ditemukan
                </p>
            @endif
        </div>

        <!-- Grid -->
        <div class="berita-grid">
            @forelse($beritas as $index => $berita)
                <a href="{{ route('berita.show', $berita->id) }}"
                   class="berita-card"
                   data-aos="fade-up"
                   data-aos-delay="{{ ($index % 3) * 80 }}">

                    <!-- Image -->
                    <div class="berita-card-img">
                        @if($berita->gambar_utama)
                            <img src="{{ Storage::url($berita->gambar_utama) }}"
                                 alt="{{ $berita->judul }}"
                                 loading="lazy">
                            <div class="berita-card-img-overlay"></div>
                        @else
                            <div class="berita-no-img">
                                <svg width="56" height="56" fill="none" stroke="rgba(250,246,240,0.3)" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="berita-card-badge">Terbaru</div>
                    </div>

                    <!-- Body -->
                    <div class="berita-card-body">
                        <h3 class="berita-card-title">{{ $berita->judul }}</h3>
                        <p class="berita-card-excerpt">{{ Str::limit($berita->excerpt ?? '', 120) }}</p>

                        <div class="berita-card-meta">
                            @if($berita->penulis ?? false)
                                <div class="berita-meta-item">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $berita->penulis }}
                                </div>
                            @endif
                            <div class="berita-meta-item">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $berita->tanggal_publikasi?->format('d M Y') ?? 'TBA' }}
                            </div>
                            <div class="berita-meta-item">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ $berita->views ?? 0 }} views
                            </div>
                        </div>

                        <div class="berita-card-link">
                            <span class="berita-card-link-line"></span>
                            Baca Selengkapnya
                        </div>
                    </div>
                </a>

            @empty
                <div class="empty-state">
                    <div class="empty-icon">📰</div>
                    <h3 class="empty-title">
                        @if(request('search')) Tidak Ditemukan
                        @else Belum Ada Berita
                        @endif
                    </h3>
                    <p class="empty-desc">
                        @if(request('search'))
                            Tidak ada berita untuk "{{ request('search') }}". Coba kata kunci lain.
                        @else
                            Berita terbaru akan segera hadir. Nantikan update dari kami!
                        @endif
                    </p>
                    @if(request('search'))
                        <a href="{{ route('berita.index') }}" class="empty-cta">Lihat Semua Berita</a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($beritas->hasPages())
            <div class="pagination-wrap" data-aos="fade-up">
                {{ $beritas->links('pagination::tailwind') }}
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