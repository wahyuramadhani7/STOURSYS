@extends('frontend.layout.app')

@section('title', $event->judul . ' - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<style>
    /* Scroll progress bar */
    .scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #f97316, #fb923c);
        z-index: 9999;
        transition: width 0.1s ease-out;
        box-shadow: 0 2px 8px rgba(249, 115, 22, 0.5);
    }
    
    /* Hero parallax effect */
    .hero-image {
        transition: transform 0.3s ease-out;
        will-change: transform;
    }
    
    /* Shimmer effect */
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
    }
    
    /* Badge pulse animation */
    @keyframes badgePulse {
        0%, 100% { transform: scale(1); box-shadow: 0 4px 12px rgba(0,0,0,0.3); }
        50% { transform: scale(1.05); box-shadow: 0 6px 20px rgba(0,0,0,0.4); }
    }
    
    .badge-pulse {
        animation: badgePulse 2s ease-in-out infinite;
    }
    
    /* Floating animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Fade slide animations */
    @keyframes fadeSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Icon hover effects */
    .info-icon {
        transition: all 0.3s ease;
    }
    
    .info-icon:hover {
        transform: scale(1.2) rotate(10deg);
        color: #ea580c;
    }
    
    /* Info box animation */
    .info-box {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .info-box::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #f97316, #fb923c, #fdba74);
        border-radius: 1rem;
        opacity: 0;
        transition: opacity 0.4s;
        z-index: -1;
        filter: blur(8px);
    }
    
    .info-box:hover::before {
        opacity: 0.4;
    }
    
    .info-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(249, 115, 22, 0.2);
    }
    
    /* Sidebar sticky with smooth transition */
    .sidebar-sticky {
        position: sticky;
        top: 2rem;
        transition: all 0.3s ease;
    }
    
    /* Gallery hover effects */
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }
    
    .gallery-item::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, rgba(249, 115, 22, 0.4), rgba(59, 130, 246, 0.4));
        opacity: 0;
        transition: opacity 0.4s;
        z-index: 1;
    }
    
    .gallery-item:hover::before {
        opacity: 1;
    }
    
    .gallery-item img {
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .gallery-item:hover img {
        transform: scale(1.2) rotate(3deg);
    }
    
    .gallery-item:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
    
    /* Zoom icon on gallery hover */
    .zoom-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        z-index: 2;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .gallery-item:hover .zoom-icon {
        transform: translate(-50%, -50%) scale(1);
    }
    
    /* Time box animation */
    .time-box {
        position: relative;
        overflow: hidden;
    }
    
    .time-box::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(249, 115, 22, 0.1), transparent);
        transition: left 0.6s;
    }
    
    .time-box:hover::after {
        left: 100%;
    }
    
    /* Back button ripple effect */
    .back-button {
        position: relative;
        overflow: hidden;
    }
    
    .back-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .back-button:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .back-button svg {
        transition: transform 0.3s ease;
    }
    
    .back-button:hover svg {
        transform: translateX(-5px) scale(1.1);
    }
    
    /* Description list animation */
    dl div {
        transition: all 0.3s ease;
        padding: 0.75rem;
        border-radius: 0.5rem;
    }
    
    dl div:hover {
        background: rgba(249, 115, 22, 0.05);
        transform: translateX(5px);
    }
    
    /* Status badge glow based on status */
    .status-ongoing {
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.5);
    }
    
    .status-upcoming {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
    }
    
    .status-ended {
        box-shadow: 0 0 20px rgba(239, 68, 68, 0.5);
    }
    
    /* Hero content animation */
    .hero-content {
        animation: fadeSlideUp 0.8s ease-out forwards;
    }
    
    /* Prose content fade in */
    .prose-animate {
        animation: fadeSlideUp 0.8s ease-out forwards;
    }

    /* Full image display styles */
    .full-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 1rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .full-image-container:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }
    
    .full-image-container img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.6s ease;
    }
    
    .full-image-container:hover img {
        transform: scale(1.05);
    }
    
    .full-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
        opacity: 0;
        transition: opacity 0.4s;
        pointer-events: none;
    }
    
    .full-image-container:hover .full-image-overlay {
        opacity: 1;
    }
</style>
@endpush

@section('content')

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Hero / Cover Image -->
    <section class="relative h-[50vh] md:h-[60vh] min-h-[450px] overflow-hidden">
        @if($event->gambar_utama)
            <img 
                src="{{ Storage::url($event->gambar_utama) }}" 
                alt="{{ $event->judul }}"
                class="hero-image absolute inset-0 w-full h-full object-cover"
                id="heroImage"
            >
            <!-- Shimmer overlay -->
            <div class="absolute inset-0 shimmer-effect opacity-0 hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-950 to-orange-950">
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-32 h-32 text-white/20 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        @endif

        <!-- Overlay gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>

        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-end pb-12 md:pb-16">
            <div class="max-w-4xl hero-content">
                <!-- Badge Status -->
                @php
                    $statusClass = [
                        'Sedang Berlangsung' => 'bg-green-600 text-white status-ongoing',
                        'Akan Datang'        => 'bg-blue-600 text-white status-upcoming',
                        'Berakhir'           => 'bg-red-600 text-white status-ended',
                    ][$event->status ?? 'Akan Datang'] ?? 'bg-gray-600 text-white';
                    
                    $shouldPulse = $event->status === 'Sedang Berlangsung';
                @endphp

                <div class="inline-flex items-center gap-3 mb-4"
                     data-aos="fade-right"
                     data-aos-duration="800">
                    <span class="{{ $statusClass }} px-4 py-1.5 rounded-full text-sm font-bold shadow-md backdrop-blur-sm {{ $shouldPulse ? 'badge-pulse' : '' }}">
                        {{ $event->status ?? 'Akan Datang' }}
                    </span>
                    @if($event->tanggal_selesai && $event->tanggal_selesai->isPast())
                        <span class="bg-red-600/90 px-4 py-1.5 rounded-full text-sm font-bold shadow-md backdrop-blur-sm text-white">
                            Sudah Berakhir
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight mb-4 drop-shadow-lg"
                    data-aos="fade-up"
                    data-aos-duration="1000"
                    data-aos-delay="100">
                    {{ $event->judul }}
                </h1>

                <div class="flex flex-wrap gap-6 text-white/95 text-base md:text-lg"
                     data-aos="fade-up"
                     data-aos-duration="1000"
                     data-aos-delay="200">
                    <div class="flex items-center gap-3 group">
                        <svg class="info-icon w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>
                            {{ $event->tanggal_mulai->format('d M Y') }}
                            @if($event->tanggal_selesai)
                                — {{ $event->tanggal_selesai->format('d M Y') }}
                            @endif
                        </span>
                    </div>

                    @if($event->jam_mulai || $event->jam_selesai)
                        <div class="flex items-center gap-3 group">
                            <svg class="info-icon w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>
                                @if($event->jam_mulai) {{ $event->jam_mulai }} @endif
                                @if($event->jam_selesai) — {{ $event->jam_selesai }} @endif
                            </span>
                        </div>
                    @endif

                    @if($event->lokasi)
                        <div class="flex items-center gap-3 group">
                            <svg class="info-icon w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $event->lokasi }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-10 lg:gap-12">

                <!-- Left: Deskripsi Utama -->
                <div class="lg:col-span-2 prose prose-lg max-w-none prose-headings:text-slate-900 prose-a:text-orange-600">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-slate-900 relative inline-block"
                        data-aos="fade-right"
                        data-aos-duration="800">
                        Deskripsi Event
                        <span class="absolute bottom-0 left-0 w-24 h-1 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full"></span>
                    </h2>
                    <div class="prose-animate"
                         data-aos="fade-up"
                         data-aos-duration="800"
                         data-aos-delay="200">
                        {!! nl2br(e($event->deskripsi)) !!}
                    </div>

                    <!-- Waktu Pelaksanaan Box (jika ada jam) -->
                    @if($event->jam_mulai || $event->jam_selesai)
                    <div class="time-box my-10 p-6 bg-gradient-to-r from-orange-50 to-blue-50 rounded-2xl border border-orange-100/60 shadow-sm"
                         data-aos="fade-up"
                         data-aos-duration="800"
                         data-aos-delay="300">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                            <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Waktu Pelaksanaan
                        </h3>
                        <div class="text-lg text-gray-700">
                            @if($event->jam_mulai) Mulai pukul <strong class="text-orange-600">{{ $event->jam_mulai }}</strong> @endif
                            @if($event->jam_selesai) s/d <strong class="text-orange-600">{{ $event->jam_selesai }}</strong> @endif
                        </div>
                    </div>
                    @endif

                    <!-- Gambar Utama Full Display -->
                    @if($event->gambar_utama)
                    <div class="my-10"
                         data-aos="fade-up"
                         data-aos-duration="800"
                         data-aos-delay="400">
                        <h3 class="text-2xl md:text-3xl font-bold mb-6 text-slate-900 relative inline-block">
                            Foto Event
                            <span class="absolute bottom-0 left-0 w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full"></span>
                        </h3>
                        <a href="{{ Storage::url($event->gambar_utama) }}" 
                           class="full-image-container glightbox block">
                            <img 
                                src="{{ Storage::url($event->gambar_utama) }}" 
                                alt="{{ $event->judul }}"
                                class="w-full h-auto"
                            >
                            <div class="full-image-overlay">
                                <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg flex items-center gap-2">
                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-slate-700">Klik untuk memperbesar</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Right: Sidebar Info -->
                <div class="space-y-8 lg:space-y-10">

                    <!-- Informasi Singkat -->
                    <div class="sidebar-sticky">
                        <div class="info-box bg-gradient-to-br from-orange-50 via-white to-blue-50 p-7 rounded-2xl border border-orange-100/50 shadow-sm"
                             data-aos="fade-left"
                             data-aos-duration="800">
                            <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Informasi Event
                            </h3>
                            
                            <dl class="space-y-5 text-gray-700">
                                <div>
                                    <dt class="font-semibold text-slate-800 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Tanggal
                                    </dt>
                                    <dd class="mt-1 text-lg">
                                        {{ $event->tanggal_mulai->format('d F Y') }}
                                        @if($event->tanggal_selesai && $event->tanggal_selesai->ne($event->tanggal_mulai))
                                            — {{ $event->tanggal_selesai->format('d F Y') }}
                                        @endif
                                    </dd>
                                </div>

                                @if($event->jam_mulai || $event->jam_selesai)
                                <div>
                                    <dt class="font-semibold text-slate-800 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Waktu
                                    </dt>
                                    <dd class="mt-1 text-lg">
                                        @if($event->jam_mulai) {{ $event->jam_mulai }} @endif
                                        @if($event->jam_selesai) — {{ $event->jam_selesai }} @endif
                                    </dd>
                                </div>
                                @endif

                                @if($event->lokasi)
                                <div>
                                    <dt class="font-semibold text-slate-800 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Lokasi
                                    </dt>
                                    <dd class="mt-1 text-lg">{{ $event->lokasi }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Galeri -->
                        @if($event->galeri && count($event->galeri) > 0)
                        <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-sm mt-8"
                             data-aos="fade-left"
                             data-aos-duration="800"
                             data-aos-delay="200">
                            <h3 class="text-xl font-bold px-6 py-5 bg-gradient-to-r from-orange-500/10 to-blue-500/10 text-slate-800 flex items-center gap-2">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Galeri Event
                            </h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-4">
                                @foreach($event->galeri as $index => $foto)
                                    <a href="{{ Storage::url($foto) }}" 
                                       class="gallery-item glightbox"
                                       data-aos="zoom-in"
                                       data-aos-duration="600"
                                       data-aos-delay="{{ $index * 50 }}">
                                        <img 
                                            src="{{ Storage::url($foto) }}" 
                                            alt="Galeri {{ $event->judul }}" 
                                            class="w-full h-32 object-cover rounded-xl shadow-sm"
                                        >
                                        <div class="zoom-icon">
                                            <svg class="w-10 h-10 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                            </svg>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-16 text-center"
                 data-aos="fade-up"
                 data-aos-duration="800"
                 data-aos-delay="400">
                <a href="{{ route('event.index') }}"
                   class="back-button inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95 relative overflow-hidden">
                    <svg class="w-5 h-5 rotate-180 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <span class="relative z-10">Kembali ke Daftar Event</span>
                </a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        once: true,
        mirror: false,
        duration: 800,
        easing: 'ease-out-cubic',
    });
    
    // Initialize GLightbox for gallery
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: true,
        closeButton: true,
        zoomable: true,
    });
    
    // Scroll progress bar
    window.addEventListener('scroll', function() {
        const scrollProgress = document.getElementById('scrollProgress');
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollPercentage = (scrollTop / scrollHeight) * 100;
        scrollProgress.style.width = scrollPercentage + '%';
    });
    
    // Parallax effect on hero image
    const heroImage = document.getElementById('heroImage');
    if (heroImage) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.3;
            heroImage.style.transform = 'translateY(' + rate + 'px) scale(1.05)';
        });
    }
    
    // Add countdown timer for upcoming events
    const statusBadge = document.querySelector('.badge-pulse');
    if (statusBadge && statusBadge.textContent.includes('Sedang Berlangsung')) {
        // Add live indicator
        const liveIndicator = document.createElement('span');
        liveIndicator.className = 'inline-block w-2 h-2 bg-white rounded-full mr-2 animate-pulse';
        statusBadge.prepend(liveIndicator);
    }
    
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush