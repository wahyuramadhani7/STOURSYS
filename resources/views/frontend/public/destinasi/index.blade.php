@extends('frontend.layout.app')

@section('title', 'Destinasi Wisata Kawasan Borobudur - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

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

/* ── GLOBAL RESET & BASE ─────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { background: var(--cream); font-family: 'DM Sans', sans-serif; color: var(--charcoal); }

/* ── NOISE TEXTURE ────────────────────────────────────── */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 9999;
    opacity: 0.55;
}

/* ── HERO ─────────────────────────────────────────────── */
.hero {
    position: relative;
    background: var(--ink);
    padding: 7rem 0 5rem;
    overflow: hidden;
}
.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 80% 60% at 15% 50%, rgba(196,92,46,0.15) 0%, transparent 65%),
                radial-gradient(ellipse 60% 80% at 85% 20%, rgba(74,103,65,0.1) 0%, transparent 60%);
    pointer-events: none;
}
.hero-bg-text {
    position: absolute;
    right: -2rem;
    top: 50%;
    transform: translateY(-50%);
    font-family: 'Playfair Display', serif;
    font-size: 13rem;
    font-weight: 900;
    color: rgba(255,255,255,0.025);
    line-height: 1;
    user-select: none;
    pointer-events: none;
    white-space: nowrap;
}

.hero-inner {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: end;
    gap: 4rem;
}
.hero-eyebrow {
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1.5rem;
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
    font-size: clamp(3rem, 6vw, 5.5rem);
    font-weight: 900;
    color: var(--cream);
    line-height: 0.95;
    letter-spacing: -0.02em;
    margin-bottom: 1.5rem;
}
.hero-title em {
    font-style: italic;
    color: var(--terracota);
}
.hero-desc {
    font-size: 1.05rem;
    color: rgba(250,246,240,0.5);
    line-height: 1.8;
    max-width: 44ch;
}
.hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    background: var(--terracota);
    color: var(--cream);
    padding: 1rem 2.2rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
    transition: all 0.3s ease;
}
.hero-cta:hover {
    background: var(--brick);
    gap: 1.4rem;
}

/* ── MARQUEE ──────────────────────────────────────────── */
.marquee-strip {
    background: var(--terracota);
    padding: 0.8rem 0;
    overflow: hidden;
}
.marquee-track {
    display: flex;
    animation: marquee 30s linear infinite;
    width: max-content;
}
.marquee-item {
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.85);
    padding: 0 3rem;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}
.marquee-dot {
    width: 4px; height: 4px;
    background: rgba(250,246,240,0.4);
    border-radius: 50%;
    flex-shrink: 0;
}
@keyframes marquee {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* ── CONTAINER & SECTION ──────────────────────────────── */
.container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
}

/* ── KATEGORI SECTION (Bento) ─────────────────────────── */
.kategori-section {
    background: var(--cream);
    padding: 5rem 0 7rem;
}
.section-header {
    margin-bottom: 3.5rem;
}
.section-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--terracota);
    margin-bottom: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.section-label::before {
    content: '';
    width: 2.2rem;
    height: 1px;
    background: var(--terracota);
}
.section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.8rem, 5vw, 4.8rem);
    font-weight: 900;
    color: var(--ink);
    line-height: 1;
}

/* Bento grid */
.bento-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1.5px solid var(--sand);
}
.bento-card {
    position: relative;
    border-right: 1.5px solid var(--sand);
    border-bottom: 1.5px solid var(--sand);
    background: white;
    text-decoration: none;
    overflow: hidden;
    transition: background 0.3s ease;
}
.bento-card:nth-child(3n) { border-right: none; }
.bento-card:hover { background: var(--cream); }

.bento-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--sand);
    transition: background 0.3s ease;
}
.bento-card:hover::before { background: var(--terracota); }

.bento-card-img {
    height: 240px;
    overflow: hidden;
    background: var(--charcoal);
}
.bento-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.7s ease, filter 0.7s ease;
}
.bento-card:hover .bento-card-img img {
    transform: scale(1.07);
    filter: sepia(20%) contrast(1.1);
}

.bento-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(13,11,9,0.65) 100%);
}

.bento-content {
    position: absolute;
    inset: 0;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    color: white;
}

.bento-number {
    position: absolute;
    top: 1.2rem;
    right: 1.5rem;
    font-size: 4.5rem;
    font-weight: 900;
    color: rgba(255,255,255,0.08);
    line-height: 1;
}
.bento-tag {
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.6rem;
}
.bento-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.55rem;
    font-weight: 900;
    line-height: 1.15;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}
.bento-card:hover .bento-title { color: var(--terracota); }

/* ── DAFTAR DESTINASI ─────────────────────────────────── */
.dest-section {
    background: var(--cream);
    padding: 5rem 0 7rem;
}

/* Result bar mirip event */
.result-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1.5px solid var(--sand);
    flex-wrap: wrap;
    gap: 1rem;
}
.result-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.35);
}
.result-label strong {
    color: var(--terracota);
    font-weight: 700;
}
.result-count {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
}

/* Search mirip event */
.search-wrap {
    position: relative;
    width: 280px;
    flex-shrink: 0;
}
.search-wrap input {
    width: 100%;
    height: 40px;
    background: var(--cream);
    border: 1.5px solid var(--sand);
    padding: 0 5.5rem 0 1.25rem;
    font-size: 0.88rem;
    color: var(--ink);
    outline: none;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
    transition: border-color 0.25s ease;
}
.search-wrap input:focus { border-color: var(--terracota); }
.search-wrap input::placeholder { color: rgba(28,25,23,0.3); }
.search-wrap button {
    position: absolute;
    right: 0; top: 0;
    height: 100%;
    padding: 0 1.1rem;
    background: var(--terracota);
    color: var(--cream);
    border: none;
    font-size: 0.6rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    cursor: pointer;
    clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 0 100%);
}
.search-wrap button:hover { background: var(--brick); }
.reset-link {
    position: absolute;
    right: 5.5rem; top: 50%;
    transform: translateY(-50%);
    font-size: 0.58rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.35);
    text-decoration: none;
}
.reset-link:hover { color: var(--terracota); }

/* Destinasi grid — mirip event grid */
.dest-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1.5px solid var(--sand);
}
.dest-card {
    position: relative;
    border-right: 1.5px solid var(--sand);
    border-bottom: 1.5px solid var(--sand);
    background: white;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    transition: background 0.3s ease;
}
.dest-card:nth-child(3n) { border-right: none; }
.dest-card:hover { background: var(--cream); }

.dest-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--sand);
    transition: background 0.3s ease;
}
.dest-card:hover::before { background: var(--terracota); }

.dest-card-img {
    height: 210px;
    overflow: hidden;
    background: var(--charcoal);
    flex-shrink: 0;
}
.dest-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.7s ease, filter 0.7s ease;
}
.dest-card:hover .dest-card-img img {
    transform: scale(1.07);
    filter: sepia(20%) contrast(1.1);
}

.dest-card-body {
    padding: 2rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    border-top: 2px solid var(--sand);
    transition: border-color 0.3s ease;
}
.dest-card:hover .dest-card-body { border-top-color: var(--terracota); }

.dest-card-cat {
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.65rem;
}
.dest-card-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    margin-bottom: 0.85rem;
    transition: color 0.3s ease;
}
.dest-card:hover .dest-card-name { color: var(--terracota); }

.dest-card-desc {
    font-size: 0.88rem;
    color: rgba(28,25,23,0.55);
    line-height: 1.75;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.dest-card-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--terracota);
    margin-top: auto;
    transition: gap 0.3s ease;
}
.dest-card-link-line {
    height: 1px;
    width: 1.5rem;
    background: currentColor;
    transition: width 0.3s ease;
}
.dest-card:hover .dest-card-link-line { width: 3rem; }

/* ── EMPTY STATE & PAGINATION ─────────────────────────── */
.empty-state, .pagination-wrap {
    /* sama persis seperti di event */
}

/* ── RESPONSIVE ───────────────────────────────────────── */
@media (max-width: 1100px) {
    .bento-grid, .dest-grid { grid-template-columns: repeat(2, 1fr); }
    .bento-card:nth-child(3n), .dest-card:nth-child(3n) { border-right: 1.5px solid var(--sand); }
    .bento-card:nth-child(2n), .dest-card:nth-child(2n) { border-right: none; }
    .container, .hero-inner { padding: 0 2.5rem; }
}

@media (max-width: 768px) {
    .hero-inner { grid-template-columns: 1fr; gap: 2.5rem; padding: 0 1.5rem; }
    .hero { padding: 5rem 0 4rem; }
    .hero-bg-text { font-size: 8rem; }
    .search-wrap { width: 100%; }
    .container { padding: 0 1.5rem; }
}

@media (max-width: 600px) {
    .bento-grid, .dest-grid { grid-template-columns: 1fr; border: none; }
    .bento-card, .dest-card {
        border: 1.5px solid var(--sand);
        margin-bottom: 1.2rem;
    }
    .bento-card:nth-child(n), .dest-card:nth-child(n) { border-right: 1.5px solid var(--sand); }
}
</style>
@endpush

@section('content')

<!-- HERO -->
<section class="hero">
    <span class="hero-bg-text" aria-hidden="true">Borobudur</span>
    <div class="hero-inner">
        <div data-aos="fade-right" data-aos-duration="1000">
            <p class="hero-eyebrow">Stoursys · Kawasan Borobudur</p>
            <h1 class="hero-title">
                Jelajahi<br><em>Keajaiban</em><br>Borobudur
            </h1>
            <p class="hero-desc">
                Warisan dunia yang hidup — candi megah, desa tersembunyi, kesenian, kuliner autentik, dan cerita spiritual yang masih bernapas.
            </p>
            <a href="#destinasi" class="hero-cta">
                Mulai Jelajah
            </a>
        </div>
    </div>
</section>

<!-- MARQUEE -->
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @foreach(array_fill(0, 2, null) as $_)
            <span class="marquee-item">Candi Borobudur<span class="marquee-dot"></span></span>
            <span class="marquee-item">Desa Wisata<span class="marquee-dot"></span></span>
            <span class="marquee-item">Kesenian & Budaya<span class="marquee-dot"></span></span>
            <span class="marquee-item">Kuliner Lokal<span class="marquee-dot"></span></span>
            <span class="marquee-item">Wisata Alam<span class="marquee-dot"></span></span>
            <span class="marquee-item">Religi & Spiritual<span class="marquee-dot"></span></span>
            <span class="marquee-item">Balkondes<span class="marquee-dot"></span></span>
        @endforeach
    </div>
</div>

<!-- MAIN CONTENT -->
<div id="destinasi" class="container">

@if(!request()->has('kategori') && !request()->has('search'))

    <section class="kategori-section">
        <div class="section-header" data-aos="fade-up">
            <div>
                <p class="section-label">Kategori Destinasi</p>
                <h2 class="section-title">Pilih Kategori<em>Favoritmu</em></h2>
            </div>
        </div>

        <div class="bento-grid">
            @foreach($kategoriList as $idx => $kat)
                @php
                    $slug = strtolower($kat['slug'] ?? '');
                    $namaDisplay = match($slug) {
                        'budaya' => 'Kesenian & Budaya',
                        'kuliner' => 'Kuliner',
                        default => ucwords(str_replace(['_','-'], ' ', $slug)),
                    };
                @endphp
                <a href="{{ route('destinasi.index', ['kategori' => $slug]) }}"
                   class="bento-card" data-aos="fade-up" data-aos-delay="{{ $idx * 80 }}">
                    @if(!empty($kat['gambar_kategori']))
                        <img src="{{ $kat['gambar_kategori'] }}" alt="{{ $namaDisplay }}" loading="lazy">
                    @endif
                    <div class="bento-overlay"></div>
                    <div class="bento-content">
                        <span class="bento-number">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <p class="bento-tag">{{ $namaDisplay }}</p>
                        <h3 class="bento-title">{{ $namaDisplay }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

@else

    <section class="dest-section">
        <div class="result-bar" data-aos="fade-up">
            <div>
                <p class="result-label">
                    Menampilkan <strong>
                        @if(request('kategori'))
                            {{ ucwords(str_replace(['_','-'], ' ', request('kategori'))) }}
                        @elseif(request('search'))
                            Pencarian "{{ request('search') }}"
                        @else
                            Semua Destinasi
                        @endif
                    </strong>
                </p>
            </div>
            <span class="result-count">{{ $destinasi->total() }} destinasi ditemukan</span>
        </div>

        <div class="search-wrap" data-aos="fade-up" data-aos-delay="100">
            <form method="GET" action="{{ route('destinasi.index') }}">
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari destinasi...">
                @if(request('search') || request('kategori'))
                    <a href="{{ route('destinasi.index') }}" class="reset-link">×</a>
                @endif
                <button type="submit">Cari</button>
            </form>
        </div>

        <div class="dest-grid">
            @forelse($destinasi as $idx => $item)
                <a href="{{ route('destinasi.show', $item) }}"
                   class="dest-card"
                   data-aos="fade-up"
                   data-aos-delay="{{ ($idx % 3) * 80 }}">

                    <div class="dest-card-img">
                        @if($item->gambar_utama)
                            <img src="{{ $item->gambar_utama_url ?? Storage::url($item->gambar_utama) }}"
                                 alt="{{ $item->nama }}" loading="lazy">
                        @else
                            <div class="dest-no-img">🏯</div>
                        @endif
                    </div>

                    <div class="dest-card-body">
                        @if($item->kategori)
                            <p class="dest-card-cat">
                                {{ match($item->kategori) {
                                    'budaya' => 'Kesenian & Budaya',
                                    default => ucwords(str_replace(['_','-'], ' ', $item->kategori))
                                } }}
                            </p>
                        @endif
                        <h3 class="dest-card-name">{{ $item->nama }}</h3>
                        <p class="dest-card-desc">{{ Str::limit(strip_tags($item->deskripsi ?? ''), 100) }}</p>

                        <div class="dest-card-link">
                            <span class="dest-card-link-line"></span>
                            Lihat Detail
                        </div>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">🏯</div>
                    <h3 class="empty-title">Tidak Ditemukan</h3>
                    <p class="empty-desc">
                        @if(request('search') || request('kategori'))
                            Coba ubah kata kunci atau kategori lain.
                        @else
                            Belum ada destinasi saat ini.
                        @endif
                    </p>
                    <a href="{{ route('destinasi.index') }}" class="empty-cta">Lihat Semua Kategori</a>
                </div>
            @endforelse
        </div>

        @if($destinasi->hasPages())
            <div class="pagination-wrap" data-aos="fade-up">
                {{ $destinasi->links('pagination::tailwind') }}
            </div>
        @endif

    </section>

@endif

</div>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ once: true, duration: 800, easing: 'ease-out-cubic' });

document.querySelector('.hero-cta')?.addEventListener('click', e => {
    e.preventDefault();
    document.querySelector('#destinasi')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
});
</script>
@endpush