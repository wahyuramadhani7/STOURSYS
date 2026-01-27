@extends('frontend.layout.app')

@section('title', $destinasi->nama . ' | Destinasi Wisata Kawasan Borobudur')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<style>
    /* Parallax hero effect */
    .parallax-hero {
        transform: translateZ(0);
        will-change: transform;
    }
    
    /* Floating animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    
    /* Fade slide up animation */
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
    
    /* Shimmer loading effect */
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    /* Gradient border animation */
    @keyframes rotateBorder {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Pulse scale */
    @keyframes pulseScale {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .animate-float {
        animation: float 4s ease-in-out infinite;
    }
    
    .animate-fade-slide {
        animation: fadeSlideUp 0.8s ease-out forwards;
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
    }
    
    /* Hero image zoom on scroll */
    .hero-zoom {
        transition: transform 0.3s ease-out;
    }
    
    /* Gallery hover effect */
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .gallery-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    
    .gallery-item img {
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .gallery-item:hover img {
        transform: scale(1.15) rotate(2deg);
    }
    
    .gallery-item::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, rgba(249, 115, 22, 0.3), rgba(59, 130, 246, 0.3));
        opacity: 0;
        transition: opacity 0.4s;
        z-index: 1;
    }
    
    .gallery-item:hover::before {
        opacity: 1;
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
    
    /* Sidebar info card animation */
    .info-card {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }
    
    /* Counter animation */
    .counter-animate {
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .counter-animate:hover {
        transform: scale(1.1);
        color: #ea580c;
    }
    
    /* Map container pulse */
    .map-container {
        position: relative;
        overflow: hidden;
    }
    
    .map-container::after {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #f97316, #3b82f6, #f97316);
        background-size: 200% 200%;
        animation: rotateBorder 3s linear infinite;
        border-radius: 0.75rem;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .map-container:hover::after {
        opacity: 0.5;
    }
    
    /* Prose content fade in */
    .prose-animate p {
        opacity: 0;
        animation: fadeSlideUp 0.6s ease-out forwards;
    }
    
    .prose-animate p:nth-child(1) { animation-delay: 0.1s; }
    .prose-animate p:nth-child(2) { animation-delay: 0.2s; }
    .prose-animate p:nth-child(3) { animation-delay: 0.3s; }
    .prose-animate p:nth-child(4) { animation-delay: 0.4s; }
    
    /* Back button hover effect */
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
</style>
@endpush

@section('content')

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Hero Section -->
    <section class="relative h-96 md:h-[500px] lg:h-[600px] overflow-hidden">
        @if($destinasi->gambar_utama_url)
            <img src="{{ $destinasi->gambar_utama_url }}"
                 alt="{{ $destinasi->nama }}"
                 class="parallax-hero absolute inset-0 w-full h-full object-cover brightness-[0.65]"
                 id="heroImage"
                 loading="lazy">
            <!-- Shimmer overlay -->
            <div class="absolute inset-0 shimmer-effect opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-950 flex items-center justify-center text-white text-2xl font-medium">
                <span class="animate-float">Tidak ada gambar utama tersedia</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end justify-center pb-12 md:pb-16 lg:pb-20">
            <div class="text-center text-white px-6 max-w-5xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 drop-shadow-2xl tracking-tight"
                    data-aos="fade-up" 
                    data-aos-duration="1000">
                    {{ $destinasi->nama }}
                </h1>
                <p class="text-xl md:text-2xl lg:text-3xl drop-shadow-lg opacity-95"
                   data-aos="fade-up" 
                   data-aos-duration="1000" 
                   data-aos-delay="200">
                    {{ $destinasi->lokasi ?? 'Lokasi tidak disebutkan' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 md:py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 xl:gap-12">

                <!-- Konten Kiri -->
                <div class="lg:col-span-2 space-y-12 lg:space-y-16">

                    <div data-aos="fade-right" data-aos-duration="800">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 relative inline-block">
                            Deskripsi
                            <span class="absolute bottom-0 left-0 w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full"></span>
                        </h2>
                        <div class="prose prose-lg max-w-none prose-animate">
                            {!! nl2br(e($destinasi->deskripsi)) !!}
                        </div>
                    </div>

                    @if($destinasi->deskripsi_panjang)
                        <div data-aos="fade-right" data-aos-duration="800" data-aos-delay="100">
                            <h3 class="text-2xl font-semibold mb-5 relative inline-block">
                                Informasi Lengkap
                                <span class="absolute bottom-0 left-0 w-16 h-1 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full"></span>
                            </h3>
                            <div class="prose-animate">
                                {!! nl2br(e($destinasi->deskripsi_panjang)) !!}
                            </div>
                        </div>
                    @endif

                    @if($destinasi->latitude && $destinasi->longitude)
                        <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                            <h3 class="text-2xl font-semibold mb-5 relative inline-block">
                                Lokasi di Peta
                                <span class="absolute bottom-0 left-0 w-16 h-1 bg-gradient-to-r from-green-500 to-green-600 rounded-full"></span>
                            </h3>
                            <div class="map-container rounded-xl overflow-hidden border-2 border-transparent aspect-video">
                                <iframe
                                    src="https://www.google.com/maps?q={{ $destinasi->latitude }},{{ $destinasi->longitude }}&output=embed"
                                    class="w-full h-full border-0"
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Sidebar -->
                <div>
                    <div class="info-card p-6 rounded-xl shadow sticky top-6"
                         data-aos="fade-left" 
                         data-aos-duration="800">
                        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi Destinasi
                        </h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start gap-2 p-3 rounded-lg hover:bg-white transition-colors">
                                <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <strong class="text-gray-900">Lokasi:</strong> 
                                    <span>{{ $destinasi->lokasi ?? '-' }}</span>
                                </div>
                            </li>

                            @if($destinasi->latitude && $destinasi->longitude)
                                <li class="flex items-start gap-2 p-3 rounded-lg hover:bg-white transition-colors">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                    <div>
                                        <strong class="text-gray-900">Koordinat:</strong><br>
                                        <span class="text-sm font-mono">
                                            {{ number_format($destinasi->latitude, 6) }},
                                            {{ number_format($destinasi->longitude, 6) }}
                                        </span>
                                    </div>
                                </li>
                            @endif

                            @if(isset($destinasi->views))
                                <li class="flex items-start gap-2 p-3 rounded-lg hover:bg-white transition-colors">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <div>
                                        <strong class="text-gray-900">Dilihat:</strong> 
                                        <span class="counter-animate">{{ number_format($destinasi->views) }}</span> kali
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Galeri -->
            @if($destinasi->galeri_urls && count($destinasi->galeri_urls))
                <div class="mt-16" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="text-3xl font-bold text-center mb-8 relative inline-block left-1/2 -translate-x-1/2">
                        Galeri Foto
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-500 rounded-full"></span>
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($destinasi->galeri_urls as $index => $url)
                            <a href="{{ $url }}" 
                               class="gallery-item glightbox"
                               data-aos="zoom-in" 
                               data-aos-duration="600" 
                               data-aos-delay="{{ $index * 50 }}">
                                <img src="{{ $url }}" 
                                     class="rounded-lg shadow object-cover h-60 w-full"
                                     alt="Galeri {{ $destinasi->nama }} - {{ $index + 1 }}">
                                <div class="zoom-icon">
                                    <svg class="w-12 h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- ✅ Tombol Kembali (DI BAWAH) -->
            <div class="mt-16 flex justify-center" data-aos="fade-up" data-aos-duration="800">
                <a href="{{ route('destinasi.index') }}"
                   class="back-button inline-flex items-center gap-2 text-base font-semibold
                          text-white bg-orange-600 hover:bg-orange-700
                          px-8 py-3 rounded-xl shadow-lg hover:shadow-xl
                          transition-all duration-300 transform hover:scale-105 active:scale-95 relative overflow-hidden group">

                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="w-5 h-5 transition-transform group-hover:-translate-x-1" 
                         fill="none"
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 19l-7-7 7-7"/>
                    </svg>

                    <span class="relative z-10">Kembali ke Daftar Destinasi</span>
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
    
    // Parallax effect on hero image
    let heroImage = document.getElementById('heroImage');
    if (heroImage) {
        window.addEventListener('scroll', function() {
            let scrolled = window.pageYOffset;
            let rate = scrolled * 0.5;
            heroImage.style.transform = 'translateY(' + rate + 'px)';
        });
    }
    
    // Scroll progress bar
    window.addEventListener('scroll', function() {
        let scrollProgress = document.getElementById('scrollProgress');
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        let scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrollPercentage = (scrollTop / scrollHeight) * 100;
        scrollProgress.style.width = scrollPercentage + '%';
    });
    
    // Smooth scroll behavior
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
    
    // Counter animation on scroll
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-pulse');
                setTimeout(() => {
                    entry.target.classList.remove('animate-pulse');
                }, 1000);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.counter-animate').forEach(counter => {
        observer.observe(counter);
    });
</script>
@endpush