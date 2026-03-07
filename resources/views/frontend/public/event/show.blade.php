@extends('frontend.layout.app')

@section('title', $event->judul . ' - STOURSYS')

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
    height: 78vh;
    min-height: 520px;
    overflow: hidden;
    background: var(--ink);
}
.detail-hero img {
    position: absolute;
    inset: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    filter: sepia(15%) contrast(1.1) brightness(0.58);
    will-change: transform;
}
.hero-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(13,11,9,0.93) 0%,
        rgba(13,11,9,0.4)  45%,
        rgba(13,11,9,0.12) 100%
    );
}

/* Content sits at bottom-left, max-width container */
.hero-content-wrap {
    position: absolute;
    inset: 0;
    max-width: 1440px;
    margin: 0 auto;
    width: 100%;
    left: 0; right: 0;
}
.hero-content {
    position: absolute;
    bottom: 0; left: 0;
    padding: 4rem 4rem 3.5rem;
    max-width: 860px;
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
    width: 2.5rem; height: 1px;
    background: var(--gold);
}

/* Status chips inside hero */
.hero-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
    margin-bottom: 1.5rem;
}
.hero-chip {
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    padding: 0.4rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.hero-chip.ongoing  { background: var(--moss);  color: var(--cream); }
.hero-chip.upcoming { background: var(--gold);  color: var(--ink); }
.hero-chip.past     { background: rgba(28,25,23,0.65); color: rgba(250,246,240,0.6); }
.hero-chip.default  { background: var(--charcoal); color: var(--cream); }
.hero-chip.recurring { background: var(--terracota); color: var(--cream); }

.hero-chip.ongoing .live-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #86efac;
    animation: livePulse 1.5s ease-in-out infinite;
    flex-shrink: 0;
}
@keyframes livePulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.4); }
}

.hero-chip svg {
    animation: spinSlow 7s linear infinite;
}
@keyframes spinSlow {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.6rem, 5.5vw, 5rem);
    font-weight: 900;
    color: var(--cream);
    line-height: 0.97;
    letter-spacing: -0.02em;
    margin-bottom: 1.75rem;
}

/* Hero meta row */
.hero-meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    align-items: center;
}
.hero-meta-item {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.5);
}
.hero-meta-item svg { color: var(--terracota); flex-shrink: 0; }

/* Top-right meta (decorative) */
.hero-top-right {
    position: absolute;
    top: 2.5rem; right: 4rem;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.5rem;
    z-index: 2;
}
.hero-top-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: rgba(250,246,240,0.3);
}

/* ── BODY ──────────────────────────────────── */
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

/* ── MAIN CONTENT ──────────────────────────── */
.section-label {
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
.section-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(201,149,42,0.3);
}
.section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 2.5vw, 2.5rem);
    font-weight: 900;
    color: var(--ink);
    line-height: 1.1;
    margin-bottom: 2rem;
}

.prose-editorial {
    font-size: 1.05rem;
    line-height: 1.9;
    color: rgba(28,25,23,0.72);
}
.prose-editorial p { margin-bottom: 1.25rem; }

/* Recurring info block */
.recurring-block {
    background: var(--ink);
    padding: 2rem 2.5rem;
    margin: 3rem 0;
    clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
    position: relative;
    overflow: hidden;
}
.recurring-block::before {
    content: '↻';
    position: absolute;
    right: 2rem; bottom: -1rem;
    font-size: 9rem;
    color: rgba(255,255,255,0.03);
    font-family: monospace;
    user-select: none;
}
.recurring-block-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.recurring-block-label svg { animation: spinSlow 7s linear infinite; }
.recurring-block-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--cream);
    margin-bottom: 0.75rem;
}
.recurring-block-desc {
    font-size: 0.92rem;
    color: rgba(250,246,240,0.5);
    line-height: 1.7;
}

/* Waktu box */
.time-block {
    background: white;
    border: 1.5px solid var(--sand);
    padding: 2rem 2.5rem;
    margin: 3rem 0;
    clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
    display: flex;
    align-items: center;
    gap: 2rem;
}
.time-block-icon {
    width: 52px; height: 52px;
    background: rgba(196,92,46,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
}
.time-block-icon svg { color: var(--terracota); width: 22px; height: 22px; }
.time-block-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.35);
    margin-bottom: 0.3rem;
}
.time-block-value {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
}

/* Foto utama */
.foto-utama {
    margin: 3rem 0 0;
}
.foto-utama-link {
    display: block;
    position: relative;
    overflow: hidden;
    border: 1.5px solid var(--sand);
}
.foto-utama-link img {
    width: 100%;
    height: auto;
    display: block;
    filter: sepia(8%) contrast(1.05);
    transition: transform 0.7s ease, filter 0.7s ease;
}
.foto-utama-link:hover img {
    transform: scale(1.04);
    filter: sepia(18%) contrast(1.1);
}
.foto-utama-hint {
    position: absolute;
    bottom: 1.25rem; right: 1.25rem;
    background: rgba(13,11,9,0.75);
    color: var(--cream);
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 0.5rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
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
    width: 36px; height: 36px;
    background: rgba(196,92,46,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    clip-path: polygon(0 0, calc(100% - 5px) 0, 100% 5px, 100% 100%, 5px 100%, 0 calc(100% - 5px));
}
.sidebar-row-icon svg { width: 15px; height: 15px; color: var(--terracota); }
.sidebar-row-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.57rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.38);
    margin-bottom: 0.25rem;
}
.sidebar-row-value {
    font-size: 0.9rem;
    color: var(--charcoal);
    font-weight: 500;
    line-height: 1.45;
}
.sidebar-row-value.accent { color: var(--terracota); font-weight: 700; }

/* Recurring sidebar block */
.sidebar-recurring {
    background: var(--ink);
    padding: 1.25rem 1.5rem;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
}
.sidebar-recurring-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gold);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}
.sidebar-recurring-label svg { animation: spinSlow 7s linear infinite; }
.sidebar-recurring-value {
    font-size: 0.88rem;
    color: rgba(250,246,240,0.55);
    line-height: 1.65;
}

/* ── GALERI ─────────────────────────────────── */
.galeri-card {
    background: white;
    border: 1.5px solid var(--sand);
    clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
    overflow: hidden;
}
.galeri-header {
    padding: 1.25rem 1.75rem;
    background: var(--ink);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.galeri-header-title {
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
}
.galeri-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
    padding: 1rem;
}
.galeri-item {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4/3;
    background: var(--charcoal);
}
.galeri-item img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.6s ease, filter 0.6s ease;
}
.galeri-item:hover img {
    transform: scale(1.1);
    filter: sepia(20%) contrast(1.1) brightness(0.7);
}
.galeri-overlay {
    position: absolute;
    inset: 0;
    background: rgba(13,11,9,0);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.4s ease;
}
.galeri-item:hover .galeri-overlay { background: rgba(13,11,9,0.45); }
.galeri-zoom {
    color: var(--cream);
    opacity: 0;
    transform: scale(0.6);
    transition: all 0.35s ease;
}
.galeri-item:hover .galeri-zoom { opacity: 1; transform: scale(1); }

/* ── BACK BUTTON ───────────────────────────── */
.back-section {
    max-width: 1440px;
    margin: 4rem auto 0;
    padding: 0 4rem;
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
    transition: background 0.3s ease;
}
.back-cta:hover { background: var(--terracota); }
.back-cta-line {
    width: 1.5rem; height: 1px;
    background: currentColor;
    flex-shrink: 0;
    transition: width 0.3s ease;
}
.back-cta:hover .back-cta-line { width: 2.5rem; }

/* ── RESPONSIVE ─────────────────────────────── */
@media (max-width: 1100px) {
    .detail-container { grid-template-columns: 1fr; gap: 3rem; padding: 0 2.5rem; }
    .sidebar { position: static; }
    .hero-content { padding: 3rem 2.5rem 2.5rem; }
    .hero-top-right { right: 2.5rem; }
    .back-section { padding: 0 2.5rem; }
}
@media (max-width: 640px) {
    .detail-hero { height: 68vh; min-height: 400px; }
    .hero-content { padding: 2.5rem 1.5rem 2rem; }
    .hero-top-right { display: none; }
    .detail-container { padding: 0 1.5rem; }
    .detail-body { padding: 3rem 0 5rem; }
    .back-section { padding: 0 1.5rem; }
    .galeri-grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endpush

@section('content')

<div class="scroll-progress" id="scrollProgress"></div>

{{-- ═══════════════ HERO ═══════════════ --}}
@php
    $isRecurring = $event->event_type === 'recurring';
    $statusKey = match($event->status ?? '') {
        'Sedang Berlangsung' => 'ongoing',
        'Akan Datang'        => 'upcoming',
        'Telah Berakhir'     => 'past',
        default              => 'default',
    };
@endphp

<section class="detail-hero">
    @if($event->gambar_utama)
        <img src="{{ Storage::url($event->gambar_utama) }}"
             alt="{{ $event->judul }}"
             id="heroImg"
             loading="eager">
    @else
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:9rem;color:rgba(250,246,240,0.06);">📅</div>
    @endif

    <div class="hero-gradient"></div>

    {{-- Top-right label --}}
    <div class="hero-top-right">
        <span class="hero-top-label">Event · STOURSYS</span>
        @if($isRecurring)
            <span class="hero-chip recurring" style="position:static;">
                <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Rutin
            </span>
        @endif
    </div>

    {{-- Bottom content --}}
    <div class="hero-content-wrap">
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <p class="hero-eyebrow">Event & Kegiatan · Kawasan Borobudur</p>

            <div class="hero-chips">
                <span class="hero-chip {{ $statusKey }}">
                    @if($statusKey === 'ongoing')<span class="live-dot"></span>@endif
                    {{ $event->status ?? 'Event' }}
                </span>
                @if($isRecurring)
                    <span class="hero-chip recurring">
                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Event Rutin
                    </span>
                @endif
            </div>

            <h1 class="hero-title">{{ $event->judul }}</h1>

            <div class="hero-meta-row">
                <div class="hero-meta-item">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    {{ $isRecurring ? ($event->recurring_description ?? 'Jadwal Rutin') : $event->tanggal_range }}
                </div>
                @if(!$isRecurring && $event->jam_range && $event->jam_range !== '-')
                    <div class="hero-meta-item">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $event->jam_range }}
                    </div>
                @endif
                @if($event->lokasi)
                    <div class="hero-meta-item">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0zM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                        </svg>
                        {{ $event->lokasi }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════ BODY ═══════════════ --}}
<section class="detail-body">
    <div class="detail-container">

        {{-- ── MAIN ── --}}
        <div>
            <p class="section-label">Tentang Event</p>
            <h2 class="section-title">Deskripsi</h2>

            <div class="prose-editorial" data-aos="fade-up">
                {!! nl2br(e($event->deskripsi)) !!}
            </div>

            {{-- Recurring block --}}
            @if($isRecurring)
                <div class="recurring-block" data-aos="fade-up">
                    <p class="recurring-block-label">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Event Rutin / Berulang
                    </p>
                    <p class="recurring-block-title">Jadwal Pelaksanaan</p>
                    <p class="recurring-block-desc">
                        @if($event->recurring_description)
                            {{ $event->recurring_description }}
                        @else
                            Acara ini berlangsung secara rutin dan berulang. Informasi jadwal lengkap tersedia di lokasi atau penyelenggara.
                        @endif
                    </p>
                </div>
            @endif

            {{-- Waktu block (non-recurring) --}}
            @if(!$isRecurring && ($event->jam_mulai || $event->jam_selesai))
                <div class="time-block" data-aos="fade-up">
                    <div class="time-block-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="time-block-label">Waktu Pelaksanaan</p>
                        <p class="time-block-value">
                            @if($event->jam_mulai) {{ $event->jam_mulai->format('H:i') }} @endif
                            @if($event->jam_selesai) — {{ $event->jam_selesai->format('H:i') }} @endif
                            WIB
                        </p>
                    </div>
                </div>
            @endif

            {{-- Foto utama --}}
            @if($event->gambar_utama)
                <div class="foto-utama" data-aos="fade-up">
                    <p class="section-label" style="margin-top:0;">Foto Utama</p>
                    <a href="{{ Storage::url($event->gambar_utama) }}"
                       class="foto-utama-link glightbox">
                        <img src="{{ Storage::url($event->gambar_utama) }}"
                             alt="{{ $event->judul }}"
                             loading="lazy">
                        <div class="foto-utama-hint">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 0zM10.5 7.5v6m3-3h-6"/>
                            </svg>
                            Perbesar
                        </div>
                    </a>
                </div>
            @endif
        </div>

        {{-- ── SIDEBAR ── --}}
        <div class="sidebar" data-aos="fade-left" data-aos-duration="900">

            {{-- Info card --}}
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--gold);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                    <span class="sidebar-card-header-title">Informasi Event</span>
                </div>
                <div class="sidebar-card-body">

                    {{-- Tanggal --}}
                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Tanggal</p>
                            <p class="sidebar-row-value">
                                {{ $isRecurring ? ($event->recurring_description ?? 'Jadwal Rutin') : $event->tanggal_range }}
                            </p>
                        </div>
                    </div>

                    {{-- Waktu --}}
                    @if(!$isRecurring && $event->jam_range && $event->jam_range !== '-')
                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Waktu</p>
                            <p class="sidebar-row-value">{{ $event->jam_range }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Lokasi --}}
                    @if($event->lokasi)
                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0zM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Lokasi</p>
                            <p class="sidebar-row-value">{{ $event->lokasi }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Status --}}
                    <div class="sidebar-row">
                        <div class="sidebar-row-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.651a3.75 3.75 0 010-5.303m5.304 0a3.75 3.75 0 010 5.303m-7.425 2.122a6.75 6.75 0 010-9.546m9.546 0a6.75 6.75 0 010 9.546M5.106 18.894c-3.808-3.808-3.808-9.98 0-13.789m13.788 0c3.808 3.808 3.808 9.981 0 13.789M12 12h.008v.008H12V12z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="sidebar-row-label">Status</p>
                            <p class="sidebar-row-value accent">{{ $event->status ?? '—' }}</p>
                        </div>
                    </div>

                    {{-- Recurring info --}}
                    @if($isRecurring)
                    <div class="sidebar-row" style="border:none;padding-top:1rem;">
                        <div style="width:100%;">
                            <div class="sidebar-recurring">
                                <p class="sidebar-recurring-label">
                                    <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Event Rutin
                                </p>
                                <p class="sidebar-recurring-value">
                                    {{ $event->recurring_description ?? 'Berlangsung secara rutin dan berulang.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            {{-- Galeri sidebar --}}
            @if($event->galeri && count($event->galeri) > 0)
                <div class="galeri-card" data-aos="fade-left" data-aos-delay="150">
                    <div class="galeri-header">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--gold);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                        </svg>
                        <span class="galeri-header-title">Galeri Event</span>
                    </div>
                    <div class="galeri-grid">
                        @foreach($event->galeri as $idx => $foto)
                            <a href="{{ Storage::url($foto) }}"
                               class="galeri-item glightbox"
                               data-aos="fade-up"
                               data-aos-delay="{{ $idx * 50 }}">
                                <img src="{{ Storage::url($foto) }}"
                                     alt="Galeri {{ $event->judul }} {{ $idx + 1 }}"
                                     loading="lazy">
                                <div class="galeri-overlay">
                                    <div class="galeri-zoom">
                                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803a7.5 7.5 0 0010.607 0zM10.5 7.5v6m3-3h-6"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Quick back --}}
            <a href="{{ route('event.index') }}" class="back-cta" style="width:100%;justify-content:center;display:flex;margin-top:0.25rem;">
                <span class="back-cta-line"></span>
                Semua Event
            </a>

        </div>
    </div>

    {{-- Back full --}}
    <div class="back-section" data-aos="fade-up">
        <a href="{{ route('event.index') }}" class="back-cta">
            <span class="back-cta-line"></span>
            Kembali ke Daftar Event
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

// Scroll progress
const bar = document.getElementById('scrollProgress');
window.addEventListener('scroll', () => {
    const pct = window.pageYOffset / (document.documentElement.scrollHeight - document.documentElement.clientHeight) * 100;
    bar.style.width = pct + '%';
}, { passive: true });

// Parallax hero
const heroImg = document.getElementById('heroImg');
if (heroImg) {
    window.addEventListener('scroll', () => {
        heroImg.style.transform = `translateY(${window.pageYOffset * 0.35}px)`;
    }, { passive: true });
}
</script>
@endpush