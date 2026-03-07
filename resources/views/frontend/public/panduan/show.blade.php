@extends('frontend.layout.app')

@section('title', $panduan->judul . ' - STOURSYS')

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
   SCROLL PROGRESS
   ======================== */
.scroll-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, var(--terracota), var(--gold));
    z-index: 10000;
    transition: width 0.1s ease-out;
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
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 70% at 80% 50%, rgba(196,92,46,0.15) 0%, transparent 70%);
    pointer-events: none;
}

.detail-hero-inner {
    position: relative;
    z-index: 2;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.7rem 1.75rem;
    border: 1.5px solid rgba(250,246,240,0.2);
    color: rgba(250,246,240,0.7);
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
    transition: all 0.3s ease;
    margin-bottom: 3rem;
    background: transparent;
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
    font-size: 0.7rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.detail-eyebrow::before {
    content: '';
    display: block;
    width: 2rem;
    height: 1px;
    background: var(--gold);
}

.detail-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 4vw, 4.5rem);
    font-weight: 900;
    color: var(--cream);
    line-height: 1.05;
    margin-bottom: 2rem;
    max-width: 22ch;
}

/* Badge */
.badge {
    display: inline-block;
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    padding: 0.4rem 1rem;
    clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
}
.badge-hotel       { background: var(--moss);     color: var(--cream); }
.badge-pemerintahan{ background: #2d5a8e;          color: var(--cream); }
.badge-rumah_sakit { background: #b93535;          color: var(--cream); }
.badge-darurat     { background: var(--terracota); color: var(--cream); }
.badge-lainnya     { background: var(--charcoal);  color: var(--cream); }

/* Decorative number */
.detail-hero-num {
    position: absolute;
    bottom: 1rem;
    right: 4rem;
    font-family: 'Playfair Display', serif;
    font-size: 12rem;
    font-weight: 900;
    color: rgba(250,246,240,0.04);
    line-height: 1;
    user-select: none;
    pointer-events: none;
    z-index: 1;
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
   DETAIL BODY
   ======================== */
.detail-section {
    padding: 6rem 0 8rem;
}

/* Cover image */
.cover-wrap {
    position: relative;
    overflow: hidden;
    background: var(--charcoal);
    margin-bottom: 4rem;
    clip-path: polygon(0 0, calc(100% - 24px) 0, 100% 24px, 100% 100%, 24px 100%, 0 calc(100% - 24px));
}
.cover-wrap img {
    width: 100%;
    max-height: 520px;
    object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.8s ease;
    display: block;
}
.cover-wrap:hover img { transform: scale(1.04); }
.cover-no-img {
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--charcoal), #2c2420);
    opacity: 0.7;
}

/* Content panel */
.content-panel {
    background: white;
    border: 1.5px solid var(--sand);
    clip-path: polygon(0 0, calc(100% - 20px) 0, 100% 20px, 100% 100%, 20px 100%, 0 calc(100% - 20px));
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.content-panel::before {
    content: '';
    display: block;
    height: 4px;
    background: linear-gradient(to right, var(--terracota), var(--gold), var(--moss));
}
.content-panel-inner {
    padding: 3.5rem 4rem;
}

/* Prose content */
.prose-content {
    font-size: 1.05rem;
    color: rgba(28,25,23,0.8);
    line-height: 1.9;
}
.prose-content h1,
.prose-content h2,
.prose-content h3 {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    color: var(--ink);
    margin: 2rem 0 1rem;
    line-height: 1.2;
}
.prose-content h2 { font-size: 1.8rem; }
.prose-content h3 { font-size: 1.4rem; }
.prose-content p  { margin-bottom: 1.5rem; }
.prose-content a  { color: var(--terracota); text-decoration: underline; }
.prose-content ul,
.prose-content ol {
    margin: 0 0 1.5rem 1.5rem;
    line-height: 2;
}
.prose-content strong { font-weight: 600; color: var(--ink); }
.prose-content blockquote {
    border-left: 3px solid var(--terracota);
    padding-left: 1.5rem;
    margin: 1.5rem 0;
    color: rgba(28,25,23,0.6);
    font-style: italic;
}

/* ========================
   CONTACT INFO SECTION
   ======================== */
.contact-section-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--terracota);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-top: 3rem;
    border-top: 1.5px solid var(--sand);
    margin-top: 3rem;
}
.contact-section-label::before {
    content: '';
    display: block;
    width: 2rem;
    height: 1px;
    background: currentColor;
}
.contact-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    font-weight: 900;
    color: var(--ink);
    margin-bottom: 2.5rem;
    line-height: 1.1;
}
.contact-section-title em {
    font-style: italic;
    color: var(--terracota);
}

/* Contact cards grid */
.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 1rem;
    margin-bottom: 2.5rem;
}

.contact-card {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    padding: 1.5rem;
    background: var(--cream);
    border: 1.5px solid var(--sand);
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
    transition: border-color 0.3s ease, background 0.3s ease;
    min-width: 0;
    overflow: hidden;
}
.contact-card:hover {
    border-color: var(--terracota);
    background: white;
}

.contact-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: var(--terracota);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
    color: var(--cream);
}

.contact-body { min-width: 0; overflow: hidden; }
.contact-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.4rem;
}
.contact-value {
    font-size: 0.9rem;
    color: var(--ink);
    font-weight: 500;
    word-break: break-word;
    overflow-wrap: anywhere;
    line-height: 1.6;
}
.contact-value a {
    color: var(--terracota);
    text-decoration: none;
    word-break: break-all;
    transition: color 0.2s ease;
}
.contact-value a:hover { color: var(--brick); text-decoration: underline; }

/* WhatsApp button */
.wa-btn {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    background: #25d366;
    color: white;
    padding: 1rem 2.5rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.78rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
    transition: all 0.3s ease;
    font-weight: 700;
}
.wa-btn:hover {
    background: #128c7e;
    gap: 1.5rem;
}

/* ========================
   BACK BUTTON BOTTOM
   ======================== */
.back-btn-bottom {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2.5rem;
    background: var(--terracota);
    color: var(--cream);
    font-family: 'Space Mono', monospace;
    font-size: 0.78rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
    transition: all 0.3s ease;
    border: none;
}
.back-btn-bottom:hover {
    background: var(--brick);
    gap: 1.25rem;
}
.back-btn-bottom svg { transition: transform 0.3s ease; }
.back-btn-bottom:hover svg { transform: translateX(-4px); }

/* ========================
   RESPONSIVE
   ======================== */
@media (max-width: 900px) {
    .container-narrow { padding: 0 1.5rem; }
    .content-panel-inner { padding: 2rem 1.75rem; }
    .detail-hero { padding: 4rem 0 3.5rem; }
    .detail-title { font-size: clamp(2rem, 6vw, 3rem); }
    .detail-hero-num { display: none; }
    .detail-section { padding: 3.5rem 0 5rem; }
}
@media (max-width: 600px) {
    .container, .container-narrow { padding: 0 1.25rem; }
    .content-panel-inner { padding: 1.5rem; }
    .contact-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<!-- Scroll Progress -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- ===================== HERO ===================== -->
<section class="detail-hero">
    <div class="container detail-hero-inner">

        <a href="{{ route('panduan.index') }}" class="back-btn" data-aos="fade-right" data-aos-duration="800">
            <svg width="16" height="10" viewBox="0 0 16 10" fill="none">
                <path d="M16 5H2M2 5L6 1M2 5L6 9" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            Kembali ke Panduan
        </a>

        @php
            $badgeClass = match($panduan->kategori) {
                'hotel'         => 'badge-hotel',
                'pemerintahan'  => 'badge-pemerintahan',
                'rumah_sakit'   => 'badge-rumah_sakit',
                'darurat'       => 'badge-darurat',
                default         => 'badge-lainnya',
            };
        @endphp

        <p class="detail-eyebrow" data-aos="fade-up" data-aos-delay="100">
            Informasi &amp; Panduan
        </p>

        <h1 class="detail-title" data-aos="fade-up" data-aos-delay="200">
            {{ $panduan->judul }}
        </h1>

        <div data-aos="fade-up" data-aos-delay="300">
            <span class="badge {{ $badgeClass }}">
                {{ ucfirst(str_replace('_', ' ', $panduan->kategori ?? 'Informasi')) }}
            </span>
        </div>

    </div>
    <span class="detail-hero-num">03</span>
</section>

<!-- ===================== MARQUEE ===================== -->
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @foreach(array_fill(0, 2, null) as $_)
            <span class="marquee-item">{{ $panduan->judul }}<span class="marquee-dot"></span></span>
            <span class="marquee-item">Panduan Wisata<span class="marquee-dot"></span></span>
            <span class="marquee-item">Kawasan Borobudur<span class="marquee-dot"></span></span>
            <span class="marquee-item">{{ ucfirst(str_replace('_', ' ', $panduan->kategori ?? 'Informasi')) }}<span class="marquee-dot"></span></span>
            <span class="marquee-item">Wisata Aman &amp; Nyaman<span class="marquee-dot"></span></span>
            <span class="marquee-item">STOURSYS<span class="marquee-dot"></span></span>
        @endforeach
    </div>
</div>

<!-- ===================== BODY ===================== -->
<section class="detail-section">
    <div class="container-narrow">

        <!-- Cover Image -->
        @if($panduan->gambar)
            <div class="cover-wrap" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{ Storage::url($panduan->gambar) }}"
                     alt="{{ $panduan->judul }}"
                     loading="lazy">
            </div>
        @else
            <div class="cover-wrap" data-aos="fade-up" data-aos-duration="1000">
                <div class="cover-no-img">
                    <svg width="80" height="80" fill="none" stroke="rgba(250,246,240,0.3)" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
        @endif

        <!-- Content Panel -->
        <div class="content-panel" data-aos="fade-up" data-aos-duration="900" data-aos-delay="100">
            <div class="content-panel-inner">

                <!-- Isi Artikel -->
                <div class="prose-content">
                    {!! $panduan->isi !!}
                </div>

                <!-- Informasi Kontak -->
                @if($panduan->alamat || $panduan->kontak || $panduan->website)
                    <p class="contact-section-label">Informasi Kontak</p>
                    <h3 class="contact-section-title">
                        Temukan &amp; <em>Hubungi</em>
                    </h3>

                    <div class="contact-grid">
                        @if($panduan->alamat)
                            <div class="contact-card" data-aos="fade-up" data-aos-delay="80">
                                <div class="contact-icon">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="contact-body">
                                    <p class="contact-label">Alamat</p>
                                    <p class="contact-value">{{ $panduan->alamat }}</p>
                                </div>
                            </div>
                        @endif

                        @if($panduan->kontak)
                            <div class="contact-card" data-aos="fade-up" data-aos-delay="160">
                                <div class="contact-icon">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="contact-body">
                                    <p class="contact-label">Kontak</p>
                                    <p class="contact-value">{{ $panduan->kontak }}</p>
                                </div>
                            </div>
                        @endif

                        @if($panduan->website)
                            <div class="contact-card" data-aos="fade-up" data-aos-delay="240">
                                <div class="contact-icon">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                </div>
                                <div class="contact-body">
                                    <p class="contact-label">Website</p>
                                    <p class="contact-value">
                                        <a href="{{ $panduan->website }}" target="_blank" rel="noopener noreferrer">
                                            {{ $panduan->website }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- WhatsApp Button -->
                    @if($panduan->kontak && (str_contains(strtolower($panduan->kontak), 'wa') || preg_match('/08[0-9]{8,12}/', $panduan->kontak)))
                        <div data-aos="fade-up" data-aos-delay="300">
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $panduan->kontak) }}"
                               target="_blank"
                               class="wa-btn">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Hubungi via WhatsApp
                                <svg width="18" height="10" viewBox="0 0 18 10" fill="none">
                                    <path d="M0 5H16M16 5L12 1M16 5L12 9" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </a>
                        </div>
                    @endif
                @endif

            </div>
        </div>

        <!-- Back Button Bottom -->
        <div class="flex justify-start" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('panduan.index') }}" class="back-btn-bottom">
                <svg width="16" height="10" viewBox="0 0 16 10" fill="none">
                    <path d="M16 5H2M2 5L6 1M2 5L6 9" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                Kembali ke Daftar Informasi
            </a>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 900, easing: 'ease-out-cubic' });

    // Scroll progress bar
    window.addEventListener('scroll', function () {
        const el  = document.getElementById('scrollProgress');
        const top = window.pageYOffset || document.documentElement.scrollTop;
        const h   = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        el.style.width = (top / h * 100) + '%';
    });
</script>
@endpush