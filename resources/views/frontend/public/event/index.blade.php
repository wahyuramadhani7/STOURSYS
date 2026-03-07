@extends('frontend.layout.app')

@section('title', 'Event & Kegiatan - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
    --ongoing:   #2d6a4f;
    --upcoming:  #1d4e89;
}

/* ── HERO ──────────────────────────────────── */
.event-hero {
    position: relative;
    background: var(--ink);
    padding: 7rem 0 5rem;
    overflow: hidden;
}
.event-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 80% 60% at 15% 50%, rgba(196,92,46,0.15) 0%, transparent 65%),
                radial-gradient(ellipse 60% 80% at 85% 20%, rgba(74,103,65,0.1) 0%, transparent 60%);
    pointer-events: none;
}
.event-hero-bg-text {
    position: absolute;
    right: -2rem;
    top: 50%;
    transform: translateY(-50%);
    font-family: 'Playfair Display', serif;
    font-size: 14rem;
    font-weight: 900;
    color: rgba(255,255,255,0.025);
    line-height: 1;
    user-select: none;
    pointer-events: none;
    white-space: nowrap;
}

.event-hero-inner {
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
.event-hero-eyebrow {
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
.event-hero-eyebrow::before {
    content: '';
    display: block;
    width: 2.5rem;
    height: 1px;
    background: var(--gold);
}
.event-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(3rem, 6vw, 5.5rem);
    font-weight: 900;
    color: var(--cream);
    line-height: 0.95;
    letter-spacing: -0.02em;
    margin-bottom: 1.5rem;
}
.event-hero-title em {
    font-style: italic;
    color: var(--terracota);
}
.event-hero-desc {
    font-size: 1.05rem;
    color: rgba(250,246,240,0.5);
    line-height: 1.8;
    max-width: 44ch;
}
.event-hero-stat {
    text-align: right;
    flex-shrink: 0;
}
.event-hero-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 4.5rem;
    font-weight: 900;
    color: var(--cream);
    line-height: 1;
    display: block;
}
.event-hero-stat-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-top: 0.4rem;
    display: block;
}

/* ── MARQUEE ───────────────────────────────── */
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

/* ── FILTER BAR ────────────────────────────── */
.filter-bar {
    background: white;
    border-bottom: 1.5px solid var(--sand);
    position: sticky;
    top: 72px;
    z-index: 100;
}
.filter-bar-inner {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    height: 68px;
}

/* Filter tabs */
.filter-tabs {
    display: flex;
    gap: 0;
    align-items: stretch;
    height: 100%;
    overflow-x: auto;
    scrollbar-width: none;
}
.filter-tabs::-webkit-scrollbar { display: none; }

.filter-tab {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0 1.5rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.62rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.4);
    text-decoration: none;
    border-bottom: 2px solid transparent;
    margin-bottom: -1.5px;
    transition: all 0.25s ease;
    white-space: nowrap;
}
.filter-tab:hover { color: var(--terracota); }
.filter-tab.active {
    color: var(--terracota);
    border-bottom-color: var(--terracota);
    font-weight: 700;
}
.filter-tab-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    flex-shrink: 0;
}

/* Search */
.search-wrap {
    position: relative;
    flex-shrink: 0;
    width: 280px;
}
.search-wrap input {
    width: 100%;
    height: 40px;
    background: var(--cream);
    border: 1.5px solid var(--sand);
    padding: 0 5.5rem 0 1.25rem;
    font-family: 'DM Sans', sans-serif;
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
    font-family: 'Space Mono', monospace;
    font-size: 0.6rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    cursor: pointer;
    clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 0 100%);
    transition: background 0.25s ease;
}
.search-wrap button:hover { background: var(--brick); }
.reset-link {
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(28,25,23,0.35);
    text-decoration: none;
    position: absolute;
    right: 5.5rem; top: 50%;
    transform: translateY(-50%);
    transition: color 0.2s ease;
    white-space: nowrap;
}
.reset-link:hover { color: var(--terracota); }

/* ── CONTENT AREA ──────────────────────────── */
.events-section {
    background: var(--cream);
    padding: 5rem 0 7rem;
}
.events-container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 4rem;
}

/* Result info bar */
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

/* ── EVENT GRID ────────────────────────────── */
.events-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1.5px solid var(--sand);
}

/* ── EVENT CARD ────────────────────────────── */
.event-card {
    position: relative;
    border-right: 1.5px solid var(--sand);
    border-bottom: 1.5px solid var(--sand);
    background: white;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    transition: background 0.3s ease;
    overflow: hidden;
}
.event-card:nth-child(3n) { border-right: none; }
.event-card:hover { background: var(--cream); }

/* Left accent bar — color-coded by status */
.event-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--sand);
    transition: background 0.3s ease;
}
.event-card:hover::before { background: var(--terracota); }
.event-card.status-ongoing::before { background: var(--moss); }
.event-card.status-upcoming::before { background: var(--gold); }
.event-card.status-past::before { background: rgba(28,25,23,0.15); }
.event-card.status-recurring::before {
    background: linear-gradient(to bottom, var(--terracota), var(--gold), var(--moss));
}

/* Image */
.event-card-img {
    position: relative;
    height: 210px;
    overflow: hidden;
    background: var(--charcoal);
    flex-shrink: 0;
}
.event-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: sepia(10%) contrast(1.05);
    transition: transform 0.7s ease, filter 0.7s ease;
}
.event-card:hover .event-card-img img {
    transform: scale(1.07);
    filter: sepia(20%) contrast(1.1);
}
.event-card-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(13,11,9,0.5) 100%);
}
.event-no-img {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--charcoal), #2c2420);
    font-size: 4rem;
    opacity: 0.15;
}

/* Status badge */
.status-chip {
    position: absolute;
    top: 1rem; right: 1rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.55rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    padding: 0.35rem 0.85rem;
    font-weight: 700;
}
.status-chip.ongoing  { background: var(--moss);      color: var(--cream); }
.status-chip.upcoming { background: var(--gold);      color: var(--ink); }
.status-chip.past     { background: rgba(28,25,23,0.6); color: rgba(250,246,240,0.6); }
.status-chip.default  { background: var(--charcoal);  color: var(--cream); }

/* Recurring badge */
.recurring-chip {
    position: absolute;
    top: 1rem; left: 1rem;
    font-family: 'Space Mono', monospace;
    font-size: 0.52rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 0.3rem 0.75rem;
    background: var(--terracota);
    color: var(--cream);
    display: flex;
    align-items: center;
    gap: 0.4rem;
}
.recurring-chip svg {
    animation: spinSlow 6s linear infinite;
}
@keyframes spinSlow {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

/* Card body */
.event-card-body {
    padding: 2rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    border-top: 2px solid var(--sand);
    transition: border-color 0.3s ease;
}
.event-card:hover .event-card-body { border-top-color: var(--terracota); }

.event-card-cat {
    font-family: 'Space Mono', monospace;
    font-size: 0.58rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.65rem;
}
.event-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    margin-bottom: 0.85rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s ease;
}
.event-card:hover .event-card-title { color: var(--terracota); }

.event-card-desc {
    font-size: 0.88rem;
    color: rgba(28,25,23,0.55);
    line-height: 1.75;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Meta info rows */
.event-meta {
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    margin-bottom: 1.75rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--sand);
}
.event-meta-row {
    display: flex;
    align-items: flex-start;
    gap: 0.6rem;
    font-size: 0.82rem;
    color: rgba(28,25,23,0.5);
}
.event-meta-row svg {
    width: 13px; height: 13px;
    color: var(--terracota);
    flex-shrink: 0;
    margin-top: 2px;
}

/* CTA link */
.event-card-cta {
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
.event-card-cta-line {
    height: 1px;
    width: 1.5rem;
    background: currentColor;
    transition: width 0.3s ease;
    flex-shrink: 0;
}
.event-card:hover .event-card-cta-line { width: 3rem; }

/* ── EMPTY STATE ───────────────────────────── */
.empty-state {
    grid-column: 1/-1;
    padding: 8rem 2rem;
    text-align: center;
}
.empty-icon {
    font-size: 5rem;
    margin-bottom: 2rem;
    opacity: 0.25;
}
.empty-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--ink);
    margin-bottom: 1rem;
}
.empty-desc {
    font-size: 0.95rem;
    color: rgba(28,25,23,0.45);
    margin-bottom: 2.5rem;
    line-height: 1.8;
}
.empty-cta {
    display: inline-block;
    padding: 0.9rem 2.25rem;
    background: var(--terracota);
    color: var(--cream);
    font-family: 'Space Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
    transition: background 0.3s ease;
}
.empty-cta:hover { background: var(--brick); }

/* ── PAGINATION ────────────────────────────── */
.pagination-wrap {
    margin-top: 4rem;
    display: flex;
    justify-content: center;
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
}

/* ── RESPONSIVE ────────────────────────────── */
@media (max-width: 1100px) {
    .events-grid { grid-template-columns: repeat(2, 1fr); }
    .event-card:nth-child(3n) { border-right: 1.5px solid var(--sand); }
    .event-card:nth-child(2n) { border-right: none; }
    .filter-bar-inner, .events-container { padding: 0 2.5rem; }
    .event-hero-inner { padding: 0 2.5rem; }
}

@media (max-width: 768px) {
    .event-hero-inner { grid-template-columns: 1fr; gap: 2rem; }
    .event-hero-stat { text-align: left; }
    .event-hero-bg-text { font-size: 8rem; }
    .filter-bar-inner { height: auto; padding: 1rem 1.5rem; flex-wrap: wrap; gap: 1rem; }
    .filter-tabs { width: 100%; }
    .search-wrap { width: 100%; }
    .filter-bar { position: static; }
    .events-container { padding: 0 1.5rem; }
    .event-hero-inner { padding: 0 1.5rem; }
    .event-hero { padding: 5rem 0 4rem; }
}

@media (max-width: 600px) {
    .events-grid { grid-template-columns: 1fr; border: none; }
    .event-card { border: 1.5px solid var(--sand); margin-bottom: 1rem; }
    .event-card:nth-child(n) { border-right: 1.5px solid var(--sand); }
}
</style>
@endpush

@section('content')

{{-- ════════════ HERO ════════════ --}}
<section class="event-hero">
    <span class="event-hero-bg-text" aria-hidden="true">Event</span>
    <div class="event-hero-inner">
        <div data-aos="fade-right" data-aos-duration="1000">
            <p class="event-hero-eyebrow">Stoursys · Kawasan Borobudur</p>
            <h1 class="event-hero-title">
                Event &<br><em>Kegiatan</em>
            </h1>
            <p class="event-hero-desc">
                Festival budaya, pertunjukan seni, ritual religi, dan beragam kegiatan di jantung peradaban Jawa.
            </p>
        </div>
        <div class="event-hero-stat" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
            <span class="event-hero-stat-num">{{ $events->total() }}</span>
            <span class="event-hero-stat-label">Total Event</span>
        </div>
    </div>
</section>

{{-- Marquee --}}
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @foreach(array_fill(0, 2, null) as $_)
            <span class="marquee-item">Festival Budaya<span class="marquee-dot"></span></span>
            <span class="marquee-item">Pertunjukan Seni<span class="marquee-dot"></span></span>
            <span class="marquee-item">Ritual Religi<span class="marquee-dot"></span></span>
            <span class="marquee-item">Event Rutin<span class="marquee-dot"></span></span>
            <span class="marquee-item">Pameran Lokal<span class="marquee-dot"></span></span>
            <span class="marquee-item">Workshop Budaya<span class="marquee-dot"></span></span>
            <span class="marquee-item">Yoga Sunrise<span class="marquee-dot"></span></span>
        @endforeach
    </div>
</div>

{{-- ════════════ FILTER BAR ════════════ --}}
<div class="filter-bar">
    <div class="filter-bar-inner">
        <nav class="filter-tabs">
            <a href="{{ route('event.index') }}"
               class="filter-tab {{ !request()->has('filter') ? 'active' : '' }}">
                Semua
            </a>
            <a href="{{ route('event.index', ['filter' => 'rutin'] + request()->except('filter')) }}"
               class="filter-tab {{ request('filter') === 'rutin' ? 'active' : '' }}">
                <span class="filter-tab-dot" style="background:var(--terracota)"></span>
                Rutin
            </a>
            <a href="{{ route('event.index', ['filter' => 'ongoing'] + request()->except('filter')) }}"
               class="filter-tab {{ request('filter') === 'ongoing' ? 'active' : '' }}">
                <span class="filter-tab-dot" style="background:var(--moss)"></span>
                Berlangsung
            </a>
            <a href="{{ route('event.index', ['filter' => 'upcoming'] + request()->except('filter')) }}"
               class="filter-tab {{ request('filter') === 'upcoming' ? 'active' : '' }}">
                <span class="filter-tab-dot" style="background:var(--gold)"></span>
                Akan Datang
            </a>
            <a href="{{ route('event.index', ['filter' => 'past'] + request()->except('filter')) }}"
               class="filter-tab {{ request('filter') === 'past' ? 'active' : '' }}">
                <span class="filter-tab-dot" style="background:rgba(28,25,23,0.2)"></span>
                Berakhir
            </a>
        </nav>

        <div class="search-wrap">
            <form method="GET" action="{{ route('event.index') }}">
                <input type="hidden" name="filter" value="{{ request('filter') }}">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari event...">
                @if(request('search') || request('filter'))
                    <a href="{{ route('event.index') }}" class="reset-link">×</a>
                @endif
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
</div>

{{-- ════════════ DAFTAR EVENT ════════════ --}}
<section class="events-section">
    <div class="events-container">

        {{-- Result info --}}
        <div class="result-bar" data-aos="fade-up">
            <div>
                <p class="result-label">
                    Menampilkan
                    <strong>
                        @if(request('filter') === 'rutin') Event Rutin
                        @elseif(request('filter') === 'ongoing') Sedang Berlangsung
                        @elseif(request('filter') === 'upcoming') Akan Datang
                        @elseif(request('filter') === 'past') Sudah Berakhir
                        @else Semua Event
                        @endif
                    </strong>
                    @if(request('search'))· "{{ request('search') }}"@endif
                </p>
            </div>
            <span class="result-count">{{ $events->total() }} event ditemukan</span>
        </div>

        {{-- Grid --}}
        <div class="events-grid">
            @forelse($events as $index => $event)
                @php
                    $isRecurring = $event->event_type === 'recurring';
                    $statusKey = match($event->status) {
                        'Sedang Berlangsung' => 'ongoing',
                        'Akan Datang'        => 'upcoming',
                        'Telah Berakhir'     => 'past',
                        default              => 'default',
                    };
                    $cardClass = 'status-' . $statusKey . ($isRecurring ? ' status-recurring' : '');
                @endphp

                <a href="{{ route('event.show', $event->slug) }}"
                   class="event-card {{ $cardClass }}"
                   data-aos="fade-up"
                   data-aos-delay="{{ ($index % 3) * 80 }}">

                    {{-- Image --}}
                    <div class="event-card-img">
                        @if($event->gambar_utama)
                            <img src="{{ Storage::url($event->gambar_utama) }}"
                                 alt="{{ $event->judul }}"
                                 loading="lazy">
                            <div class="event-card-img-overlay"></div>
                        @else
                            <div class="event-no-img">📅</div>
                        @endif

                        {{-- Status chip --}}
                        <span class="status-chip {{ $statusKey }}">{{ $event->status }}</span>

                        {{-- Recurring chip --}}
                        @if($isRecurring)
                            <span class="recurring-chip">
                                <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Rutin
                            </span>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="event-card-body">
                        <p class="event-card-cat">
                            {{ $isRecurring ? 'Event Rutin' : 'Event' }}
                        </p>
                        <h3 class="event-card-title">{{ $event->judul }}</h3>
                        <p class="event-card-desc">{{ Str::limit($event->deskripsi ?? '', 100) }}</p>

                        <div class="event-meta">
                            {{-- Tanggal --}}
                            <div class="event-meta-row">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                </svg>
                                <span>
                                    @if($isRecurring)
                                        {{ Str::limit($event->recurring_description ?? 'Jadwal rutin', 55) }}
                                    @else
                                        {{ $event->tanggal_range }}
                                        @if($event->jam_range && $event->jam_range !== '-')
                                            · {{ $event->jam_range }}
                                        @endif
                                    @endif
                                </span>
                            </div>

                            {{-- Lokasi --}}
                            @if($event->lokasi)
                            <div class="event-meta-row">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0zM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                                <span>{{ $event->lokasi }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="event-card-cta">
                            <span class="event-card-cta-line"></span>
                            Lihat Detail
                        </div>
                    </div>
                </a>

            @empty
                <div class="empty-state">
                    <div class="empty-icon">📅</div>
                    <h3 class="empty-title">
                        @if(request('search') || request('filter'))
                            Tidak Ada Hasil
                        @else
                            Belum Ada Event
                        @endif
                    </h3>
                    <p class="empty-desc">
                        @if(request('search') || request('filter'))
                            Coba ubah kata kunci atau filter untuk melihat event lainnya.
                        @else
                            Saat ini belum ada event yang dijadwalkan. Pantau kembali nanti!
                        @endif
                    </p>
                    <a href="{{ route('event.index') }}" class="empty-cta">Lihat Semua Event</a>
                </div>
            @endforelse
        </div>

        @if($events->hasPages())
            <div class="pagination-wrap" data-aos="fade-up">
                {{ $events->links('pagination::tailwind') }}
            </div>
        @endif

    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ once: true, duration: 800, easing: 'ease-out-cubic' });
</script>
@endpush