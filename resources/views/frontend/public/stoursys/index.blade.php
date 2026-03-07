@extends('frontend.layout.app')

@section('title', 'Apa itu STourSys - STOURSYS')

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
    margin-bottom: 3rem;
}
.hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    background: var(--terracota);
    color: var(--cream);
    padding: 1.1rem 2.5rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
    transition: all 0.3s ease;
}
.hero-cta:hover { background: var(--brick); gap: 1.5rem; }

.hero-right { position: relative; overflow: hidden; }
.hero-right video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.5;
    filter: sepia(20%) contrast(1.1);
}
.hero-right::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, var(--ink) 0%, transparent 40%);
    z-index: 1;
}
.hero-right-caption {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.5);
    white-space: nowrap;
}
.hero-num {
    position: absolute;
    bottom: 3rem;
    right: 3rem;
    font-family: 'Playfair Display', serif;
    font-size: 10rem;
    font-weight: 900;
    color: rgba(250,246,240,0.05);
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
    width: 4px; height: 4px;
    background: rgba(250,246,240,0.5);
    border-radius: 50%;
    flex-shrink: 0;
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
   SECTION LABELS
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
    margin-bottom: 2rem;
}
.section-title em { font-style: italic; color: var(--terracota); }

/* ========================
   TENTANG SECTION
   ======================== */
.tentang-section {
    padding: 7rem 0;
    background: var(--cream);
}

.tentang-grid {
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 6rem;
    align-items: start;
}

/* Sidebar kiri */
.tentang-desc {
    font-size: 1rem;
    color: rgba(28,25,23,0.65);
    line-height: 1.85;
    margin-bottom: 2rem;
}

/* Feature list */
.feature-list { display: flex; flex-direction: column; gap: 0.75rem; }
.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: white;
    border: 1.5px solid var(--sand);
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
    transition: border-color 0.3s ease, background 0.3s ease;
}
.feature-item:hover { border-color: var(--terracota); background: var(--cream); }
.feature-icon {
    width: 2.25rem;
    height: 2.25rem;
    background: var(--terracota);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    clip-path: polygon(0 0, calc(100% - 5px) 0, 100% 5px, 100% 100%, 5px 100%, 0 calc(100% - 5px));
    color: var(--cream);
    font-size: 0.9rem;
}
.feature-text {
    font-size: 0.9rem;
    color: var(--charcoal);
    line-height: 1.6;
    font-weight: 500;
}

/* ========================
   INFO GRID (5 kategori)
   ======================== */
.info-strip {
    padding: 5rem 0;
    background: white;
    border-top: 1.5px solid var(--sand);
    border-bottom: 1.5px solid var(--sand);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    border: 1.5px solid var(--sand);
}
.info-cell {
    padding: 2rem 1.75rem;
    border-right: 1.5px solid var(--sand);
    position: relative;
    transition: background 0.3s ease;
}
.info-cell:last-child { border-right: none; }
.info-cell:hover { background: var(--cream); }
.info-cell::before {
    content: '';
    display: block;
    height: 3px;
    background: var(--sand);
    margin-bottom: 1.5rem;
    transition: background 0.3s ease;
}
.info-cell:hover::before { background: var(--terracota); }
.info-cell-emoji { font-size: 1.75rem; margin-bottom: 0.75rem; }
.info-cell-title {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 0.6rem;
}
.info-cell-desc {
    font-size: 0.78rem;
    color: rgba(28,25,23,0.5);
    line-height: 1.7;
}
.info-cell-tag {
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.5rem;
}

/* ========================
   BAHASA SECTION
   ======================== */
.bahasa-section {
    padding: 7rem 0;
    background: var(--cream);
}

.bahasa-layout {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 5rem;
    align-items: start;
}

.bahasa-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1.5px solid var(--sand);
}
.bahasa-card {
    padding: 1.5rem 1rem;
    text-align: center;
    border-right: 1.5px solid var(--sand);
    border-bottom: 1.5px solid var(--sand);
    background: white;
    transition: background 0.3s ease, border-color 0.3s ease;
    cursor: default;
    position: relative;
}
.bahasa-card:nth-child(3n) { border-right: none; }
.bahasa-card:nth-last-child(-n+3) { border-bottom: none; }
.bahasa-card:hover { background: var(--cream); }
.bahasa-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--sand);
    transition: background 0.3s ease;
}
.bahasa-card:hover::before { background: var(--terracota); }
.bahasa-flag { font-size: 2rem; margin-bottom: 0.5rem; }
.bahasa-name {
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.55);
    transition: color 0.3s ease;
}
.bahasa-card:hover .bahasa-name { color: var(--terracota); }

.bahasa-note {
    margin-top: 2rem;
    padding: 1.25rem 1.5rem;
    background: white;
    border: 1.5px solid var(--sand);
    border-left: 3px solid var(--gold);
    font-size: 0.88rem;
    color: rgba(28,25,23,0.6);
    line-height: 1.7;
    font-style: italic;
}

/* ========================
   CTA SECTION
   ======================== */
.cta-section {
    padding: 7rem 0;
    background: var(--ink);
    position: relative;
    overflow: hidden;
}
.cta-section::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 60% at 50% 50%, rgba(196,92,46,0.15) 0%, transparent 70%);
    pointer-events: none;
}
.cta-inner {
    position: relative;
    z-index: 2;
    text-align: center;
}
.cta-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 0.35em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}
.cta-label::before, .cta-label::after {
    content: '';
    display: block;
    width: 2rem;
    height: 1px;
    background: var(--gold);
}
.cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.5rem, 4vw, 4rem);
    font-weight: 900;
    color: var(--cream);
    line-height: 1.05;
    margin-bottom: 1.5rem;
}
.cta-title em { font-style: italic; color: var(--terracota); }
.cta-desc {
    color: rgba(250,246,240,0.55);
    font-size: 1rem;
    margin-bottom: 3rem;
    max-width: 42ch;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.8;
}
.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    background: var(--terracota);
    color: var(--cream);
    padding: 1.25rem 3rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.82rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
    transition: all 0.3s ease;
}
.cta-btn:hover { background: var(--brick); gap: 1.5rem; }
.cta-deco {
    position: absolute;
    font-family: 'Playfair Display', serif;
    font-size: 18rem;
    font-weight: 900;
    color: rgba(250,246,240,0.025);
    line-height: 1;
    user-select: none;
    pointer-events: none;
    bottom: -2rem;
    right: 4rem;
    z-index: 1;
}

/* ========================
   VIDEO CREDIT
   ======================== */
.video-credit {
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.1em;
    color: rgba(28,25,23,0.35);
    text-align: center;
    margin-top: 0.75rem;
}
.video-credit a { color: var(--terracota); text-decoration: none; }
.video-credit a:hover { text-decoration: underline; }

/* ========================
   RESPONSIVE
   ======================== */
@media (max-width: 1200px) {
    .info-grid { grid-template-columns: repeat(3, 1fr); }
    .info-cell:nth-child(3) { border-right: none; }
    .info-cell:nth-child(3), .info-cell:nth-child(4), .info-cell:nth-child(5) {
        border-top: 1.5px solid var(--sand);
    }
}
@media (max-width: 1024px) {
    .tentang-grid { grid-template-columns: 1fr; gap: 3rem; }
    .bahasa-layout { grid-template-columns: 1fr; gap: 3rem; }
    .container { padding: 0 2.5rem; }
}
@media (max-width: 900px) {
    .hero { grid-template-columns: 1fr; min-height: auto; }
    .hero-left { padding: 5rem 2.5rem 4rem; }
    .hero-right { height: 50vw; min-height: 260px; }
    .hero-right::before { background: linear-gradient(to top, var(--ink) 0%, transparent 60%); }
    .hero-vertical { display: none; }
    .container { padding: 0 1.5rem; }
    .tentang-section, .bahasa-section { padding: 4rem 0 5rem; }
    .info-strip { padding: 3.5rem 0; }
    .info-grid { grid-template-columns: 1fr 1fr; }
    .info-cell:nth-child(2n) { border-right: none; }
    .info-cell:nth-child(n+3) { border-top: 1.5px solid var(--sand); }
    .bahasa-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 600px) {
    .hero-left { padding: 4rem 1.25rem 3rem; }
    .container { padding: 0 1.25rem; }
    .info-grid { grid-template-columns: 1fr; }
    .info-cell { border-right: none; border-top: 1.5px solid var(--sand); }
    .info-cell:first-child { border-top: none; }
    .bahasa-grid { grid-template-columns: repeat(3, 1fr); }
    .cta-title { font-size: clamp(2rem, 8vw, 3rem); }
}
</style>
@endpush

@section('content')

<!-- ===================== HERO ===================== -->
<section class="hero">
    <div class="hero-left" data-aos="fade-right" data-aos-duration="1200">
        <p class="hero-eyebrow">Stoursys — Kawasan Borobudur</p>
        <h1 class="hero-title">
            Apa itu<br>
            <em>STourSys?</em>
        </h1>
        <p class="hero-desc">
            Smart Tourism System Kawasan Candi Borobudur — platform digital untuk wisata yang lebih cerdas, mudah, dan berkelanjutan.
        </p>
        <a href="{{ route('destinasi.index') }}" class="hero-cta">
            Mulai Eksplorasi
            <svg width="18" height="10" viewBox="0 0 18 10" fill="none">
                <path d="M0 5H16M16 5L12 1M16 5L12 9" stroke="currentColor" stroke-width="1.5"/>
            </svg>
        </a>
    </div>

    <div class="hero-right">
        <video autoplay loop muted playsinline preload="metadata"
               poster="{{ asset('storage/images/borobudur1.webp') }}">
            <source src="{{ asset('storage/videos/borobudur2.mp4') }}" type="video/mp4">
        </video>
        <span class="hero-num">00</span>
        <span class="hero-vertical">Smart Tourism System</span>
        <span class="hero-right-caption">Candi Borobudur — Warisan Dunia UNESCO</span>
    </div>
</section>

<!-- ===================== MARQUEE ===================== -->
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @foreach(array_fill(0, 2, null) as $_)
            <span class="marquee-item">Smart Tourism System<span class="marquee-dot"></span></span>
            <span class="marquee-item">Candi Borobudur<span class="marquee-dot"></span></span>
            <span class="marquee-item">Destinasi Wisata<span class="marquee-dot"></span></span>
            <span class="marquee-item">Panduan Digital<span class="marquee-dot"></span></span>
            <span class="marquee-item">Warisan Dunia UNESCO<span class="marquee-dot"></span></span>
            <span class="marquee-item">Wisata Berkelanjutan<span class="marquee-dot"></span></span>
            <span class="marquee-item">STOURSYS<span class="marquee-dot"></span></span>
        @endforeach
    </div>
</div>

<!-- ===================== TENTANG ===================== -->
<section class="tentang-section">
    <div class="container">
        <div class="tentang-grid">

            <!-- Kiri -->
            <div data-aos="fade-right" data-aos-duration="1000">
                <p class="section-label">Tentang Kami</p>
                <h2 class="section-title">
                    Platform Wisata<br>
                    <em>Cerdas</em>
                </h2>
                <p class="tentang-desc">
                    <strong style="color:var(--ink)">STourSys</strong> (Smart Tourism System) adalah sistem informasi pariwisata cerdas untuk mendukung pengelolaan, promosi, dan pengalaman wisata di kawasan <strong style="color:var(--ink)">Candi Borobudur dan sekitarnya</strong>.
                </p>
                <p class="tentang-desc">
                    STourSys melengkapi panduan resmi dengan informasi digital interaktif, real-time, mudah diakses via web maupun aplikasi — lengkap dengan penjelasan relief, etika kunjungan, dan tips praktis.
                </p>

                <div class="video-credit" style="text-align:left; margin-top:0; margin-bottom:2rem;">
                    Video aerial oleh <a href="https://youtu.be/6DiEVUSrRqE" target="_blank" rel="noopener noreferrer">Studio Sunday</a>
                </div>
            </div>

            <!-- Kanan — tujuan utama -->
            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="150">
                <p class="section-label">Tujuan Utama</p>
                <h3 style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:900;color:var(--ink);margin-bottom:2rem;line-height:1.1;">
                    Mengapa <em style="font-style:italic;color:var(--terracota)">STourSys</em>?
                </h3>

                <div class="feature-list">
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-icon">✓</div>
                        <p class="feature-text">Membantu perencanaan perjalanan: rute, jam buka, tiket, dan fasilitas tersedia dalam satu platform</p>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="180">
                        <div class="feature-icon">✓</div>
                        <p class="feature-text">Pengalaman wisata lebih baik dengan panduan digital real-time yang mudah diakses</p>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="260">
                        <div class="feature-icon">✓</div>
                        <p class="feature-text">Mendukung UMKM lokal — homestay, kuliner, souvenir, dan pemandu wisata setempat</p>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="340">
                        <div class="feature-icon">✓</div>
                        <p class="feature-text">Menjaga kelestarian budaya, alam, dan prinsip wisata berkelanjutan kawasan Borobudur</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== INFO STRIP (5 KATEGORI) ===================== -->
<div class="info-strip">
    <div class="container">
        <p class="section-label" style="margin-bottom:2.5rem;" data-aos="fade-up">Menyediakan Informasi</p>
        <div class="info-grid" data-aos="fade-up" data-aos-delay="80">
            <div class="info-cell">
                <p class="info-cell-tag">01</p>
                <div class="info-cell-emoji">🗺️</div>
                <p class="info-cell-title">Destinasi</p>
                <p class="info-cell-desc">Alam · Balkondes · Kesenian &amp; Budaya · Candi · Desa Wisata · Kuliner · Religi</p>
            </div>
            <div class="info-cell">
                <p class="info-cell-tag">02</p>
                <div class="info-cell-emoji">🎪</div>
                <p class="info-cell-title">Event</p>
                <p class="info-cell-desc">Keagamaan · Olahraga · Seni Budaya · Rutin · Akan Datang · Berlangsung</p>
            </div>
            <div class="info-cell">
                <p class="info-cell-tag">03</p>
                <div class="info-cell-emoji">📰</div>
                <p class="info-cell-title">Berita</p>
                <p class="info-cell-desc">Kabar terkini kawasan Borobudur &amp; sekitarnya</p>
            </div>
            <div class="info-cell">
                <p class="info-cell-tag">04</p>
                <div class="info-cell-emoji">📖</div>
                <p class="info-cell-title">Panduan</p>
                <p class="info-cell-desc">Layanan Darurat · Akomodasi · Pemerintahan · Kesehatan · Transportasi</p>
            </div>
            <div class="info-cell">
                <p class="info-cell-tag">05</p>
                <div class="info-cell-emoji">📬</div>
                <p class="info-cell-title">Kontak</p>
                <p class="info-cell-desc">Saran, pesan, laporan, dan kemitraan</p>
            </div>
        </div>
    </div>
</div>

<!-- ===================== BAHASA ===================== -->
<section class="bahasa-section">
    <div class="container">
        <div class="bahasa-layout">

            <!-- Kiri -->
            <div data-aos="fade-right" data-aos-duration="1000">
                <p class="section-label">Multibahasa</p>
                <h2 class="section-title">
                    Panduan<br>
                    <em>Tanpa Batas</em><br>
                    Bahasa
                </h2>
                <p style="font-size:0.95rem;color:rgba(28,25,23,0.6);line-height:1.85;margin-bottom:1.5rem;">
                    Kawasan Borobudur memiliki panduan multibahasa resmi — pemandu &amp; audio guide tersedia dalam berbagai bahasa internasional.
                </p>
                <div class="bahasa-note">
                    Multibahasa resmi + panduan digital STourSys memudahkan wisatawan internasional menikmati Borobudur tanpa kendala bahasa.
                </div>
            </div>

            <!-- Kanan — grid bahasa -->
            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="150">
                <div class="bahasa-grid">
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🇮🇩</div>
                        <p class="bahasa-name">Indonesia</p>
                    </div>
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🇬🇧</div>
                        <p class="bahasa-name">English</p>
                    </div>
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🇨🇳</div>
                        <p class="bahasa-name">中文</p>
                    </div>
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🇰🇷</div>
                        <p class="bahasa-name">한국어</p>
                    </div>
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🇯🇵</div>
                        <p class="bahasa-name">日本語</p>
                    </div>
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🇫🇷</div>
                        <p class="bahasa-name">Français</p>
                    </div>
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🇩🇪</div>
                        <p class="bahasa-name">Deutsch</p>
                    </div>
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🇪🇸</div>
                        <p class="bahasa-name">Español</p>
                    </div>
                    <div class="bahasa-card">
                        <div class="bahasa-flag">🌐</div>
                        <p class="bahasa-name">Lainnya</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section class="cta-section">
    <div class="container">
        <div class="cta-inner" data-aos="fade-up" data-aos-duration="1000">
            <p class="cta-label">Mulai Sekarang</p>
            <h2 class="cta-title">
                Jelajahi Borobudur<br>
                <em>Bersama STourSys</em>
            </h2>
            <p class="cta-desc">
                Temukan destinasi tersembunyi, ikuti event budaya, dan rencanakan perjalanan impianmu ke Kawasan Borobudur.
            </p>
            <a href="{{ route('destinasi.index') }}" class="cta-btn">
                Lihat Semua Destinasi
                <svg width="18" height="10" viewBox="0 0 18 10" fill="none">
                    <path d="M0 5H16M16 5L12 1M16 5L12 9" stroke="currentColor" stroke-width="1.5"/>
                </svg>
            </a>
        </div>
    </div>
    <span class="cta-deco">00</span>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 900, easing: 'ease-out-cubic' });
</script>
@endpush