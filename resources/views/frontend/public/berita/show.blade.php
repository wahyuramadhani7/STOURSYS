@extends('frontend.layout.app')

@section('title', $berita->judul . ' - STOURSYS')

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
    
    /* Floating animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
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
    
    @keyframes fadeSlideLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Gradient shift animation */
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    /* Pulse scale */
    @keyframes pulseScale {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    /* Shimmer effect */
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
    }
    
    /* Back link hover */
    .back-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .back-link::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #f97316, #fb923c);
        transition: width 0.3s ease;
    }
    
    .back-link:hover::before {
        width: 100%;
    }
    
    .back-link:hover {
        transform: translateX(-5px);
    }
    
    /* Article card entrance */
    .article-card {
        animation: fadeSlideUp 0.8s ease-out forwards;
    }
    
    /* Featured image zoom on scroll */
    .featured-image {
        transition: transform 0.3s ease-out;
        will-change: transform;
    }
    
    .featured-image-container {
        position: relative;
        overflow: hidden;
    }
    
    .featured-image-container::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
        opacity: 0;
        transition: opacity 0.4s;
    }
    
    .featured-image-container:hover::after {
        opacity: 1;
    }
    
    .featured-image-container:hover .featured-image {
        transform: scale(1.05);
    }
    
    /* Summary box animation */
    .summary-box {
        position: relative;
        overflow: hidden;
    }
    
    .summary-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(249, 115, 22, 0.1), transparent);
        transition: left 0.6s;
    }
    
    .summary-box:hover::before {
        left: 100%;
    }
    
    /* Prose content fade in */
    .prose-animate {
        animation: fadeSlideUp 0.8s ease-out forwards;
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
        transform: scale(1.15) rotate(2deg);
    }
    
    .gallery-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
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
    
    /* Meta info icons animation */
    .meta-info {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .meta-info:hover {
        transform: scale(1.05);
        color: #f97316;
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
        transform: translateX(-5px);
    }
    
    /* Title gradient animation */
    .title-gradient {
        background: linear-gradient(45deg, #1e293b, #f97316, #1e293b);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 4s ease infinite;
    }
    
    /* View counter pulse */
    .view-counter {
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .view-counter:hover {
        transform: scale(1.2);
        color: #ea580c;
        font-weight: 700;
    }
    
    /* Reading progress indicator */
    .reading-progress {
        position: fixed;
        top: 4px;
        left: 0;
        right: 0;
        height: 2px;
        background: rgba(249, 115, 22, 0.2);
        z-index: 9998;
    }
    
    .reading-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #f97316, #fb923c);
        width: 0%;
        transition: width 0.1s ease-out;
    }
</style>
@endpush

@section('content')

<!-- Scroll Progress Bar -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- Header -->
<section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <a href="{{ route('berita.index') }}" 
               class="back-link text-orange-600 font-semibold text-sm"
               data-aos="fade-right"
               data-aos-duration="800">
                ← Kembali ke Berita
            </a>

            <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight"
                data-aos="fade-up"
                data-aos-duration="1000"
                data-aos-delay="100">
                {{ $berita->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600"
                 data-aos="fade-up"
                 data-aos-duration="1000"
                 data-aos-delay="200">
                <span class="meta-info">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    {{ $berita->penulis ?? 'Admin' }}
                </span>
                <span class="text-gray-400">•</span>
                <span class="meta-info">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $berita->tanggal_publikasi?->format('d F Y') ?? '-' }}
                </span>
                <span class="text-gray-400">•</span>
                <span class="meta-info">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span class="view-counter">{{ $berita->views }}</span> kali dilihat
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Konten -->
<section class="py-14">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <article class="article-card bg-white rounded-2xl shadow-xl overflow-hidden"
                 data-aos="fade-up"
                 data-aos-duration="1000">

            {{-- Gambar Utama --}}
            @if($berita->gambar_utama)
                <div class="featured-image-container">
                    <img 
                        src="{{ Storage::url($berita->gambar_utama) }}" 
                        alt="{{ $berita->judul }}"
                        class="featured-image w-full h-[420px] object-cover"
                    >
                    <!-- Shimmer overlay -->
                    <div class="absolute inset-0 shimmer-effect opacity-0 hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                </div>
            @endif

            <div class="p-8 md:p-12">

                {{-- Ringkasan --}}
                @if($berita->ringkasan)
                    <div class="summary-box mb-8 p-5 border-l-4 border-orange-500 bg-orange-50 rounded"
                         data-aos="fade-right"
                         data-aos-duration="800"
                         data-aos-delay="200">
                        <p class="italic text-gray-700 text-lg leading-relaxed">
                            {{ $berita->ringkasan }}
                        </p>
                    </div>
                @endif

                {{-- Isi --}}
                <div class="prose prose-lg max-w-none text-gray-800 prose-animate"
                     data-aos="fade-up"
                     data-aos-duration="800"
                     data-aos-delay="300">
                    {!! $berita->isi !!}
                </div>

                {{-- Galeri --}}
                @if(!empty($berita->galeri))
                    <div class="mt-14"
                         data-aos="fade-up"
                         data-aos-duration="1000"
                         data-aos-delay="400">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                            <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Galeri Foto
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                            @foreach($berita->galeri as $index => $gambar)
                                <a href="{{ Storage::url($gambar) }}" 
                                   class="gallery-item glightbox"
                                   data-aos="zoom-in"
                                   data-aos-duration="600"
                                   data-aos-delay="{{ $index * 50 }}">
                                    <img 
                                        src="{{ Storage::url($gambar) }}" 
                                        class="rounded-xl h-48 w-full object-cover"
                                        alt="Galeri {{ $index + 1 }}"
                                    >
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

            </div>
        </article>

        <!-- ✅ Tombol Kembali (DI BAWAH) -->
        <div class="mt-16 flex justify-center"
             data-aos="fade-up"
             data-aos-duration="800"
             data-aos-delay="500">
            <a href="{{ route('berita.index') }}"
               class="back-button inline-flex items-center gap-2 text-base font-semibold
                      text-white bg-orange-600 hover:bg-orange-700
                      px-8 py-3 rounded-xl shadow-lg hover:shadow-xl
                      transition-all duration-300 transform hover:scale-105 active:scale-95 relative overflow-hidden">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 relative z-10" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>

                <span class="relative z-10">Kembali ke Daftar Berita</span>
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
    
    // Parallax effect on featured image
    const featuredImage = document.querySelector('.featured-image');
    if (featuredImage) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.3;
            featuredImage.style.transform = 'translateY(' + rate + 'px) scale(1.05)';
        });
    }
    
    // View counter animation
    const viewCounter = document.querySelector('.view-counter');
    if (viewCounter) {
        const target = parseInt(viewCounter.textContent);
        let current = 0;
        const duration = 2000;
        const steps = 50;
        const increment = target / steps;
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            viewCounter.textContent = target;
                            clearInterval(timer);
                        } else {
                            viewCounter.textContent = Math.floor(current);
                        }
                    }, duration / steps);
                    
                    observer.unobserve(viewCounter);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(viewCounter);
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
    
    // Add reading time estimator
    const articleContent = document.querySelector('.prose-animate');
    if (articleContent) {
        const text = articleContent.textContent;
        const wordsPerMinute = 200;
        const wordCount = text.trim().split(/\s+/).length;
        const readingTime = Math.ceil(wordCount / wordsPerMinute);
        
        console.log(`Estimated reading time: ${readingTime} minute(s)`);
    }
</script>
@endpush