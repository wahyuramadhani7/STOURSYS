@extends('frontend.layout.app')

@section('title', $panduan->judul . ' - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* Reuse banyak style dari berita */
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

    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
    @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes gradientShift { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }

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
    .back-link:hover::before { width: 100%; }
    .back-link:hover { transform: translateX(-5px); }

    .cover-image-container {
        position: relative;
        overflow: hidden;
    }
    .cover-image {
        transition: transform 0.4s ease-out;
        will-change: transform;
    }
    .cover-image-container:hover .cover-image {
        transform: scale(1.06);
    }

    .category-badge {
        padding: 0.5rem 1.25rem;
        border-radius: 9999px;
        font-weight: 700;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    /* ==============================
       CONTACT CARD — DIPERBAIKI
       ============================== */
    .contact-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        border: 1px solid #f3f4f6;
        transition: all 0.3s ease;
        /* Cegah card meluber keluar grid */
        min-width: 0;
        overflow: hidden;
    }
    .contact-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
    }

    /* Ikon agar tidak ikut menyusut */
    .contact-card .icon-wrap {
        flex-shrink: 0;
    }

    /* Teks konten: bungkus kata panjang agar tidak meluber */
    .contact-card .contact-body {
        min-width: 0;
        overflow: hidden;
    }
    .contact-card .contact-body p,
    .contact-card .contact-body a {
        word-break: break-word;
        overflow-wrap: anywhere;
        white-space: pre-wrap;    /* jaga newline tapi tetap wrap */
        display: block;
    }
    /* URL/website perlu break-all agar titik-titik URL panjang tetap terpotong */
    .contact-card .contact-body a {
        word-break: break-all;
    }

    .title-gradient {
        background: linear-gradient(45deg, #1e293b, #f97316, #1e293b);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 5s ease infinite;
    }
</style>
@endpush

@section('content')

<!-- Scroll Progress Bar -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- Hero Header -->
<section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <a href="{{ route('panduan.index') }}" 
               class="back-link text-orange-600 font-semibold text-sm"
               data-aos="fade-right"
               data-aos-duration="800">
                ← Kembali ke Daftar Informasi
            </a>

            <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight title-gradient"
                data-aos="fade-up"
                data-aos-duration="1000"
                data-aos-delay="100">
                {{ $panduan->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600"
                 data-aos="fade-up"
                 data-aos-duration="1000"
                 data-aos-delay="200">
                <span class="category-badge
                    {{ $panduan->kategori == 'hotel' ? 'bg-green-500 text-white' : '' }}
                    {{ $panduan->kategori == 'pemerintahan' ? 'bg-blue-500 text-white' : '' }}
                    {{ $panduan->kategori == 'rumah_sakit' ? 'bg-red-500 text-white' : '' }}
                    {{ $panduan->kategori == 'darurat' ? 'bg-orange-500 text-white' : '' }}
                    {{ $panduan->kategori == 'lainnya' ? 'bg-gray-600 text-white' : '' }}">
                    {{ ucfirst($panduan->kategori ?? 'Informasi') }}
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-14">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100"
             data-aos="fade-up"
             data-aos-duration="1000">

            <!-- Gambar Sampul -->
            @if($panduan->gambar)
                <div class="cover-image-container">
                    <img 
                        src="{{ Storage::url($panduan->gambar) }}" 
                        alt="{{ $panduan->judul }}"
                        class="cover-image w-full h-64 md:h-96 object-cover"
                    >
                </div>
            @else
                <div class="h-64 md:h-96 bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 flex items-center justify-center">
                    <svg class="w-32 h-32 text-white/30 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            @endif

            <div class="p-8 md:p-12">

                <!-- Isi Konten -->
                <div class="prose prose-lg max-w-none text-gray-800 prose-animate mb-12"
                     data-aos="fade-up"
                     data-aos-duration="800"
                     data-aos-delay="200">
                    {!! $panduan->isi !!}
                </div>

                <!-- Informasi Kontak -->
                @if($panduan->alamat || $panduan->kontak || $panduan->website)
                    <div class="mt-12 pt-10 border-t border-gray-200"
                         data-aos="fade-up"
                         data-aos-duration="800"
                         data-aos-delay="300">
                        <h3 class="text-2xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                            <svg class="w-8 h-8 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Informasi Kontak
                        </h3>

                        {{-- 
                            Grid pakai auto-fill agar card tidak terlalu sempit di layar kecil.
                            max-w di tiap card diganti min-w: 0 + overflow: hidden (via CSS .contact-card).
                        --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                            @if($panduan->alamat)
                                <div class="contact-card">
                                    <div class="flex items-start gap-4">
                                        <span class="icon-wrap">
                                            <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </span>
                                        <div class="contact-body">
                                            <h4 class="font-semibold text-slate-800 mb-1">Alamat</h4>
                                            <p class="text-gray-700 text-sm leading-relaxed">{{ $panduan->alamat }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($panduan->kontak)
                                <div class="contact-card">
                                    <div class="flex items-start gap-4">
                                        <span class="icon-wrap">
                                            <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </span>
                                        <div class="contact-body">
                                            <h4 class="font-semibold text-slate-800 mb-1">Kontak</h4>
                                            <p class="text-gray-700 text-sm leading-relaxed">{{ $panduan->kontak }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($panduan->website)
                                <div class="contact-card">
                                    <div class="flex items-start gap-4">
                                        <span class="icon-wrap">
                                            <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                            </svg>
                                        </span>
                                        <div class="contact-body">
                                            <h4 class="font-semibold text-slate-800 mb-1">Website</h4>
                                            <a href="{{ $panduan->website }}" target="_blank" rel="noopener noreferrer"
                                               class="text-orange-600 hover:text-orange-700 hover:underline text-sm">
                                                {{ $panduan->website }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <!-- WhatsApp Button -->
                        @if($panduan->kontak && (str_contains(strtolower($panduan->kontak), 'wa') || preg_match('/08[0-9]{8,12}/', $panduan->kontak)))
                            <div class="mt-10 text-center md:text-left"
                                 data-aos="zoom-in"
                                 data-aos-duration="800"
                                 data-aos-delay="400">
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $panduan->kontak) }}" target="_blank"
                                   class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                                    <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12c0 2.12.55 4.11 1.59 5.84L2 22l4.16-1.59C7.89 21.45 9.94 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm3.78 14.38c-.25.7-.92 1.24-1.62 1.24-.7 0-1.37-.54-1.62-1.24-.25-.7-.92-1.24-1.62-1.24-.7 0-1.37.54-1.62 1.24z"/>
                                    </svg>
                                    Hubungi via WhatsApp
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-16 flex justify-center"
             data-aos="fade-up"
             data-aos-duration="800"
             data-aos-delay="500">
            <a href="{{ route('panduan.index') }}"
               class="inline-flex items-center gap-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-10 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
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
    AOS.init({
        once: true,
        mirror: false,
        duration: 800,
        easing: 'ease-out-cubic',
    });

    // Scroll progress bar
    window.addEventListener('scroll', function() {
        const scrollProgress = document.getElementById('scrollProgress');
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollPercentage = (scrollTop / scrollHeight) * 100;
        scrollProgress.style.width = scrollPercentage + '%';
    });
</script>
@endpush