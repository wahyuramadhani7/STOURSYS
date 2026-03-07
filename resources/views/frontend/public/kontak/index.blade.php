@extends('frontend.layout.app')

@section('title', 'Hubungi Kami - STOURSYS')

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
    position: relative;
}
.marquee-track {
    display: flex;
    gap: 0;
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
   CONTAINER & LAYOUT
   ======================== */
.container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
}

.kontak-section {
    padding: 7rem 0;
    background: var(--cream);
}

.kontak-grid {
    display: grid;
    grid-template-columns: 1fr 1.6fr;
    gap: 4rem;
    align-items: start;
}

/* ========================
   SIDEBAR INFO
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

.sidebar-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.2rem, 3vw, 3.2rem);
    font-weight: 900;
    color: var(--ink);
    line-height: 1.05;
    margin-bottom: 1.5rem;
}
.sidebar-title em {
    font-style: italic;
    color: var(--terracota);
}

.sidebar-desc {
    font-size: 0.95rem;
    color: rgba(28,25,23,0.6);
    line-height: 1.8;
    margin-bottom: 3rem;
    max-width: 34ch;
}

/* Info cards */
.info-card {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    padding: 1.5rem;
    background: white;
    border: 1.5px solid var(--sand);
    margin-bottom: 1rem;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
    transition: border-color 0.3s ease, background 0.3s ease;
}
.info-card:hover {
    border-color: var(--terracota);
    background: var(--cream);
}

.info-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: var(--terracota);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
}
.info-icon svg { color: var(--cream); }

.info-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.3rem;
}
.info-value {
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--ink);
}
.info-value a {
    color: var(--ink);
    text-decoration: none;
    transition: color 0.2s ease;
}
.info-value a:hover { color: var(--terracota); }

/* Divider line */
.sidebar-divider {
    width: 100%;
    height: 1px;
    background: var(--sand);
    margin: 2.5rem 0;
}

/* Social links */
.social-row {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}
.social-link {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.6rem 1.25rem;
    border: 1.5px solid var(--sand);
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.6);
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 7px) 0, 100% 7px, 100% 100%, 7px 100%, 0 calc(100% - 7px));
    transition: all 0.3s ease;
}
.social-link:hover {
    background: var(--terracota);
    border-color: var(--terracota);
    color: var(--cream);
}

/* ========================
   FORM PANEL
   ======================== */
.form-panel {
    background: white;
    border: 1.5px solid var(--sand);
    clip-path: polygon(0 0, calc(100% - 20px) 0, 100% 20px, 100% 100%, 20px 100%, 0 calc(100% - 20px));
    position: relative;
    overflow: hidden;
}

.form-panel::before {
    content: '';
    display: block;
    height: 4px;
    background: linear-gradient(to right, var(--terracota), var(--gold), var(--moss));
}

.form-panel-inner {
    padding: 3rem 3.5rem 3.5rem;
}

.form-panel-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--terracota);
    margin-bottom: 0.6rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.form-panel-label::before {
    content: '';
    display: block;
    width: 2rem;
    height: 1px;
    background: currentColor;
}

.form-panel-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 900;
    color: var(--ink);
    line-height: 1.1;
    margin-bottom: 2.5rem;
}
.form-panel-title em {
    font-style: italic;
    color: var(--terracota);
}

/* Success alert */
.alert-success {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: rgba(74,103,65,0.08);
    border-left: 3px solid var(--moss);
    margin-bottom: 2.5rem;
}
.alert-success-icon {
    color: var(--moss);
    flex-shrink: 0;
    margin-top: 1px;
}
.alert-success-text {
    font-size: 0.9rem;
    color: var(--moss);
    font-weight: 500;
}

/* Form fields */
.form-group {
    margin-bottom: 1.75rem;
}
.form-label {
    display: block;
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--charcoal);
    margin-bottom: 0.65rem;
}
.form-label .req { color: var(--terracota); margin-left: 0.25rem; }

.form-input,
.form-textarea {
    width: 100%;
    background: var(--cream);
    border: 1.5px solid var(--sand);
    border-radius: 0;
    padding: 0.9rem 1.25rem;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    color: var(--ink);
    outline: none;
    transition: border-color 0.3s ease, background 0.3s ease;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
    appearance: none;
    -webkit-appearance: none;
}
.form-input::placeholder,
.form-textarea::placeholder {
    color: rgba(28,25,23,0.35);
}
.form-input:focus,
.form-textarea:focus {
    border-color: var(--terracota);
    background: white;
}
.form-textarea {
    resize: none;
    min-height: 160px;
}

/* Two-column row */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

/* Error text */
.form-error {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: var(--terracota);
    font-family: 'Space Mono', monospace;
    letter-spacing: 0.05em;
}

/* Submit button */
.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    background: var(--terracota);
    color: var(--cream);
    padding: 1.1rem 2.75rem;
    border: none;
    cursor: pointer;
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
    transition: all 0.3s ease;
    width: 100%;
    justify-content: center;
    margin-top: 0.5rem;
}
.submit-btn:hover {
    background: var(--brick);
    gap: 1.5rem;
}
.submit-btn svg { transition: transform 0.3s ease; }
.submit-btn:hover svg { transform: translateX(4px); }

/* Decorative bg number */
.form-deco-num {
    position: absolute;
    bottom: 1.5rem;
    right: 2rem;
    font-family: 'Playfair Display', serif;
    font-size: 8rem;
    font-weight: 900;
    color: rgba(28,25,23,0.03);
    line-height: 1;
    user-select: none;
    pointer-events: none;
}

/* ========================
   RESPONSIVE
   ======================== */
@media (max-width: 1100px) {
    .kontak-grid {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    .sidebar-desc { max-width: 100%; }
    .container { padding: 0 2.5rem; }
}

@media (max-width: 900px) {
    .hero { grid-template-columns: 1fr; min-height: auto; }
    .hero-left { padding: 5rem 2.5rem 4rem; }
    .hero-right { height: 45vw; min-height: 240px; }
    .hero-right::before { background: linear-gradient(to top, var(--ink) 0%, transparent 60%); }
    .hero-vertical { display: none; }
    .form-row { grid-template-columns: 1fr; }
    .container { padding: 0 1.5rem; }
    .kontak-section { padding: 4rem 0 5rem; }
    .form-panel-inner { padding: 2rem 2rem 2.5rem; }
}

@media (max-width: 600px) {
    .hero-left { padding: 4rem 1.5rem 3rem; }
    .form-row { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<!-- ===================== HERO ===================== -->
<section class="hero">
    <div class="hero-left" data-aos="fade-right" data-aos-duration="1200">
        <p class="hero-eyebrow">Stoursys — Kawasan Borobudur</p>
        <h1 class="hero-title">
            Hubungi<br>
            <em>Kami</em>
        </h1>
        <p class="hero-desc">
            Ada pertanyaan, saran, atau ingin berkolaborasi? Kami siap mendengar dan membantu setiap saat.
        </p>
    </div>

    <div class="hero-right">
        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=1200&q=80" alt="Hubungi Kami">
        <span class="hero-num">02</span>
        <span class="hero-vertical">Kontak &amp; Dukungan</span>
    </div>
</section>

<!-- ===================== MARQUEE ===================== -->
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @foreach(array_fill(0, 2, null) as $_)
            <span class="marquee-item">Hubungi Kami<span class="marquee-dot"></span></span>
            <span class="marquee-item">Kontak &amp; Dukungan<span class="marquee-dot"></span></span>
            <span class="marquee-item">Tanya Jawab<span class="marquee-dot"></span></span>
            <span class="marquee-item">Saran &amp; Masukan<span class="marquee-dot"></span></span>
            <span class="marquee-item">Kerja Sama<span class="marquee-dot"></span></span>
            <span class="marquee-item">Laporan<span class="marquee-dot"></span></span>
            <span class="marquee-item">Info Destinasi<span class="marquee-dot"></span></span>
        @endforeach
    </div>
</div>

<!-- ===================== KONTEN UTAMA ===================== -->
<section class="kontak-section">
    <div class="container">
        <div class="kontak-grid">

            <!-- ===== SIDEBAR KIRI ===== -->
            <div data-aos="fade-right" data-aos-duration="1000">
                <p class="section-label">Kontak &amp; Dukungan</p>
                <h2 class="sidebar-title">
                    Mari<br>
                    <em>Berbicara</em>
                </h2>
                <p class="sidebar-desc">
                    Setiap pertanyaan dan saran Anda sangat berarti bagi kami untuk terus mengembangkan wisata Kawasan Borobudur.
                </p>

                <div class="info-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="info-label">Email</p>
                        <p class="info-value">
                            <a href="mailto:info@stoursys.com">info@stoursys.com</a>
                        </p>
                    </div>
                </div>

                <div class="info-card" data-aos="fade-up" data-aos-delay="180">
                    <div class="info-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="info-label">Telepon</p>
                        <p class="info-value">
                            <a href="tel:+6281234567890">+62 812-3456-7890</a>
                        </p>
                    </div>
                </div>

                <div class="info-card" data-aos="fade-up" data-aos-delay="260">
                    <div class="info-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="info-label">Lokasi</p>
                        <p class="info-value">Kawasan Borobudur, Magelang, Jawa Tengah</p>
                    </div>
                </div>

                <div class="info-card" data-aos="fade-up" data-aos-delay="340">
                    <div class="info-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="info-label">Jam Operasional</p>
                        <p class="info-value">Senin – Jumat, 08.00 – 17.00 WIB</p>
                    </div>
                </div>

                <div class="sidebar-divider"></div>

                <p class="section-label" data-aos="fade-up">Ikuti Kami</p>
                <div class="social-row" data-aos="fade-up" data-aos-delay="80">
                    <a href="#" class="social-link">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                        Instagram
                    </a>
                    <a href="#" class="social-link">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </a>
                    <a href="#" class="social-link">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.28 6.28 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.79a4.85 4.85 0 01-1.01-.1z"/>
                        </svg>
                        TikTok
                    </a>
                </div>
            </div>

            <!-- ===== FORM PANEL KANAN ===== -->
            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="150">
                <div class="form-panel">
                    <div class="form-panel-inner">
                        <p class="form-panel-label">Kirim Pesan</p>
                        <h3 class="form-panel-title">
                            Ceritakan Apa yang<br>
                            <em>Ada di Pikiranmu</em>
                        </h3>

                        @if (session('success'))
                            <div class="alert-success">
                                <svg class="alert-success-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="alert-success-text">{{ session('success') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('kontak.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <!-- Nama -->
                                <div class="form-group">
                                    <label for="nama" class="form-label">
                                        Nama Lengkap<span class="req">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="nama"
                                        id="nama"
                                        required
                                        value="{{ old('nama') }}"
                                        class="form-input"
                                        placeholder="Nama Anda"
                                    >
                                    @error('nama')
                                        <p class="form-error">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        Email<span class="req">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        required
                                        value="{{ old('email') }}"
                                        class="form-input"
                                        placeholder="nama@email.com"
                                    >
                                    @error('email')
                                        <p class="form-error">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Subjek -->
                            <div class="form-group">
                                <label for="subjek" class="form-label">Subjek</label>
                                <input
                                    type="text"
                                    name="subjek"
                                    id="subjek"
                                    value="{{ old('subjek') }}"
                                    class="form-input"
                                    placeholder="Topik pesan Anda"
                                >
                                @error('subjek')
                                    <p class="form-error">
                                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Pesan -->
                            <div class="form-group">
                                <label for="pesan" class="form-label">
                                    Pesan<span class="req">*</span>
                                </label>
                                <textarea
                                    name="pesan"
                                    id="pesan"
                                    required
                                    class="form-textarea"
                                    placeholder="Tulis pesan Anda di sini..."
                                >{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <p class="form-error">
                                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button type="submit" class="submit-btn">
                                Kirim Pesan
                                <svg width="18" height="10" viewBox="0 0 18 10" fill="none">
                                    <path d="M0 5H16M16 5L12 1M16 5L12 9" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </button>
                        </form>

                        <span class="form-deco-num">02</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 900, easing: 'ease-out-cubic' });
</script>
@endpush