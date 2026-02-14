@extends('frontend.layout.app')

@section('title', $destinasi->nama . ' | Destinasi Wisata Kawasan Borobudur')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

<style>
    :root {
        --primary: #f97316;
        --primary-dark: #ea580c;
        --accent: #0ea5e9;
        --glass: rgba(255, 255, 255, 0.78);
        --glass-border: rgba(255, 255, 255, 0.22);
        --text-gradient: linear-gradient(90deg, #1e293b, #334155);
    }

    .parallax-hero { transform: translateZ(0); will-change: transform; }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
    @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 0 0 rgba(249,115,22,0.5); } 50% { box-shadow: 0 0 0 16px rgba(249,115,22,0); } }
    @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(40px) scale(0.92); } to { opacity: 1; transform: translateY(0) scale(1); } }
    @keyframes shimmer { 0% { background-position: -1200px 0; } 100% { background-position: 1200px 0; } }

    .animate-float { animation: float 5s ease-in-out infinite; }
    .shimmer-effect { background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent); animation: shimmer 3s infinite; }

    .gallery-item {
        position: relative; overflow: hidden; border-radius: 0.75rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    .gallery-item img { transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
    .gallery-item:hover img { transform: scale(1.15) rotate(2deg); }

    .zoom-icon {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0);
        z-index: 2; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-item:hover .zoom-icon { transform: translate(-50%, -50%) scale(1); }

    .info-card {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        transition: all 0.3s ease;
    }

    .map-container {
        position: relative; overflow: hidden; border-radius: 0.75rem;
    }
    .map-container::after {
        content: ''; position: absolute; inset: -2px;
        background: linear-gradient(45deg, #f97316, #3b82f6, #f97316);
        background-size: 200% 200%; animation: rotateBorder 3s linear infinite;
        z-index: -1; opacity: 0; transition: opacity 0.3s;
    }
    .map-container:hover::after { opacity: 0.5; }

    .scroll-progress {
        position: fixed; top: 0; left: 0; width: 0%; height: 4px;
        background: linear-gradient(90deg, #f97316, #fb923c); z-index: 9999;
        transition: width 0.1s ease-out; box-shadow: 0 2px 8px rgba(249,115,22,0.5);
    }

    .harga-tiket-box {
        background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
        border: 2px solid #fb923c; border-radius: 1rem;
        padding: 1.5rem; box-shadow: 0 8px 20px rgba(251,146,60,0.2);
    }

    /* Fasilitas – Ukuran lebih kecil & compact */
    .facility-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.25rem 1rem;
    }

    .facility-card {
        background: var(--glass);
        backdrop-filter: blur(16px) saturate(200%);
        -webkit-backdrop-filter: blur(16px) saturate(200%);
        border: 1px solid var(--glass-border);
        border-radius: 1.25rem;
        padding: 1.4rem 1.2rem;
        box-shadow: 
            0 8px 32px rgba(0,0,0,0.08),
            inset 0 0 0 1px rgba(255,255,255,0.3);
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .facility-card:hover {
        transform: translateY(-12px) scale(1.03);
        box-shadow: 0 20px 45px -10px rgba(249,115,22,0.25);
        border-color: rgba(249,115,22,0.4);
    }

    .facility-icon-wrapper {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: linear-gradient(135deg, #fffbeb 0%, #fef9f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.9rem;
        transition: all 0.5s ease;
        box-shadow: 0 6px 16px rgba(249,115,22,0.2);
        position: relative;
        z-index: 2;
    }

    .facility-card:hover .facility-icon-wrapper {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        transform: scale(1.2) rotate(12deg);
        box-shadow: 0 12px 32px rgba(234,88,12,0.4);
        animation: pulse-glow 1.8s infinite;
    }

    .facility-icon {
        width: 28px;
        height: 28px;
        color: var(--primary-dark);
        transition: all 0.5s ease;
    }

    .facility-card:hover .facility-icon {
        color: white;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.35));
    }

    .facility-badge {
        position: absolute;
        top: 0.8rem;
        right: 0.8rem;
        background: linear-gradient(135deg, var(--accent), #22d3ee);
        color: white;
        font-size: 0.68rem;
        font-weight: 800;
        padding: 0.28rem 0.75rem;
        border-radius: 9999px;
        box-shadow: 0 4px 12px rgba(14,165,233,0.3);
        transform: translateY(-15px) scale(0.8);
        opacity: 0;
        transition: all 0.45s cubic-bezier(0.34, 1.56, 0.64, 1);
        z-index: 3;
    }

    .facility-card:hover .facility-badge {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    .facility-title {
        font-size: 1.12rem;
        font-weight: 900;
        margin-bottom: 0.45rem;
        letter-spacing: -0.015em;
        background: var(--text-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .facility-desc {
        font-size: 0.86rem;
        color: #475569;
        line-height: 1.45;
    }

    .facility-card::before {
        content: '';
        position: absolute;
        inset: -60%;
        background: radial-gradient(circle at 20% 30%, rgba(249,115,22,0.15), transparent 45%);
        opacity: 0;
        transition: opacity 0.6s ease;
        pointer-events: none;
        z-index: 1;
    }

    .facility-card:hover::before {
        opacity: 1;
    }

    /* Tab buttons */
    .tab-buttons {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: #fb923c #f3f4f6;
    }
    .tab-buttons::-webkit-scrollbar {
        height: 6px;
    }
    .tab-buttons::-webkit-scrollbar-thumb {
        background-color: #fb923c;
        border-radius: 3px;
    }
    .tab-btn {
        flex: 0 0 auto;
        padding: 0.75rem 1.25rem;
        font-weight: 600;
        border-radius: 0.5rem 0.5rem 0 0;
        background: #f3f4f6;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
        white-space: nowrap;
    }
    .tab-btn:hover { background: #e5e7eb; }
    .tab-btn.active {
        background: white;
        color: #ea580c;
        border-bottom: 3px solid #ea580c;
        transform: translateY(3px);
        box-shadow: 0 -4px 10px rgba(0,0,0,0.05);
    }
    .tab-content { display: none; padding: 1rem 0; }
    .tab-content.active { display: block; }
    .tab-pane { animation: fadeSlideUp 0.6s ease-out; }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .parallax-hero { height: 100% !important; object-fit: cover; }
        section.hero-section { height: 60vh; min-height: 350px; }
        h1 { font-size: 2.25rem !important; }
        .tab-btn { padding: 0.6rem 1rem; font-size: 0.95rem; }
        .gallery-item img { height: 140px !important; }
        .info-card { position: static !important; margin-top: 2rem; }
        .container { padding-left: 1rem; padding-right: 1rem; }
        .facility-grid { gap: 1rem; }
        .facility-card { padding: 1.2rem 1rem; }
        .facility-icon-wrapper { width: 52px; height: 52px; }
        .facility-icon { width: 24px; height: 24px; }
        .facility-title { font-size: 1.05rem; }
        .facility-desc { font-size: 0.82rem; }
    }

    @media (min-width: 641px) and (max-width: 1024px) {
        .gallery-item img { height: 180px; }
        .facility-grid { gap: 1.1rem; }
    }
</style>
@endpush

@section('content')

    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Hero Section -->
    <section class="relative h-[50vh] sm:h-[60vh] md:h-[500px] lg:h-[600px] overflow-hidden hero-section">
        @if($destinasi->gambar_utama_url)
            <img src="{{ $destinasi->gambar_utama_url }}" alt="{{ $destinasi->nama }}" class="parallax-hero absolute inset-0 w-full h-full object-cover brightness-[0.65]" id="heroImage" loading="lazy">
            <div class="absolute inset-0 shimmer-effect opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-950 flex items-center justify-center text-white text-xl sm:text-2xl font-medium">
                <span class="animate-float">Tidak ada gambar utama</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end justify-center pb-10 sm:pb-16 lg:pb-20">
            <div class="text-center text-white px-4 sm:px-6 max-w-5xl">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 sm:mb-4 drop-shadow-2xl tracking-tight" data-aos="fade-up" data-aos-duration="1000">
                    {{ $destinasi->nama }}
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl drop-shadow-lg opacity-95" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    {{ $destinasi->lokasi ?? 'Lokasi tidak disebutkan' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-10 sm:py-12 md:py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                <!-- Konten Utama -->
                <div class="lg:col-span-2 space-y-10 sm:space-y-12 lg:space-y-16">

                    @if($destinasi->deskripsi_singkat ?? false)
                    <div data-aos="fade-right" data-aos-duration="800">
                        <p class="text-lg sm:text-xl text-gray-700 leading-relaxed">{{ $destinasi->deskripsi_singkat }}</p>
                    </div>
                    @endif

                    <!-- Tabs -->
                    <div class="mt-8 sm:mt-10" data-aos="fade-up" data-aos-duration="900">
                        <div class="tab-buttons">
                            <button class="tab-btn active" data-tab="deskripsi">Deskripsi</button>
                            @if(count($destinasi->fasilitas_list ?? []) > 0)
                            <button class="tab-btn" data-tab="fasilitas">Fasilitas</button>
                            @endif
                            <button class="tab-btn" data-tab="jam-harga">Jam & Harga</button>
                            @if($destinasi->peta_embed_safe)
                            <button class="tab-btn" data-tab="lokasi">Lokasi</button>
                            @endif
                            @if(count($destinasi->galeri_urls ?? []) > 0)
                            <button class="tab-btn" data-tab="galeri">Galeri</button>
                            @endif
                        </div>

                        <div class="tab-content active" id="deskripsi">
                            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed tab-pane px-1 sm:px-0">
                                {!! nl2br(e($destinasi->deskripsi ?? 'Belum ada deskripsi lengkap.')) !!}
                            </div>
                        </div>

                        @if(count($destinasi->fasilitas_list ?? []) > 0)
                        <div class="tab-content" id="fasilitas">
                            <div class="facility-grid tab-pane">
                                @foreach($destinasi->fasilitas_list as $index => $fas)
                                    <div class="facility-card"
                                         data-aos="flip-left"
                                         data-aos-delay="{{ $index * 90 }}"
                                         data-aos-duration="800"
                                         data-aos-anchor-placement="top-center">
                                        <span class="facility-badge">Tersedia</span>
                                        <div class="facility-icon-wrapper">
                                            @php $fas_lower = strtolower($fas); @endphp
                                            @if(str_contains($fas_lower, 'toilet') || str_contains($fas_lower, 'wc') || str_contains($fas_lower, 'kamar mandi') || str_contains($fas_lower, 'restroom'))
                                                <svg class="facility-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m-6 0h12m-6 6v-6"/></svg>
                                            @elseif(str_contains($fas_lower, 'parkir') || str_contains($fas_lower, 'parking') || str_contains($fas_lower, 'mobil'))
                                                <svg class="facility-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8V6a4 4 0 00-8 0v2m-4 6h16a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z"/></svg>
                                            @elseif(str_contains($fas_lower, 'wifi') || str_contains($fas_lower, 'internet'))
                                                <svg class="facility-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 20.001a.999.999 0 01-.832-1.554l4-7a1 1 0 011.664 0l4 7a.999.999 0 01-.832 1.554H8.111zM5.5 14.5l-.778-1.556A1 1 0 015.5 11h13a1 1 0 01.778 1.944L18.5 14.5"/></svg>
                                            @elseif(str_contains($fas_lower, 'makan') || str_contains($fas_lower, 'restoran') || str_contains($fas_lower, 'cafe') || str_contains($fas_lower, 'food'))
                                                <svg class="facility-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 9h18M3 15h18M3 21h18"/></svg>
                                            @else
                                                <svg class="facility-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            @endif
                                        </div>
                                        <h4 class="facility-title">{{ $fas }}</h4>
                                        <p class="facility-desc">Fasilitas tersedia untuk kenyamanan pengunjung</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="tab-content" id="jam-harga">
                            <div class="space-y-8 tab-pane px-1 sm:px-0">
                                @if($destinasi->jam_operasional)
                                <div>
                                    <h4 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4 text-gray-800">Jam Operasional</h4>
                                    <div class="bg-gray-50 p-5 sm:p-6 rounded-xl border border-gray-200">
                                        <p class="text-base sm:text-lg font-medium text-gray-800">{{ $destinasi->jam_operasional }}</p>
                                    </div>
                                </div>
                                @else
                                <div>
                                    <h4 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4 text-gray-800">Jam Operasional</h4>
                                    <p class="text-base sm:text-lg text-gray-700">Informasi jam operasional tersedia di lokasi atau situs resmi.</p>
                                </div>
                                @endif

                                <div>
                                    <h4 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4 text-gray-800">Harga Tiket</h4>
                                    <div class="harga-tiket-box">
                                        @if($destinasi->harga_tiket_formatted)
                                            <p class="text-2xl sm:text-3xl font-bold text-orange-800 mb-4">{{ $destinasi->harga_tiket_formatted }}</p>
                                        @else
                                            <p class="text-base sm:text-lg text-gray-700">Informasi harga tiket tersedia di lokasi atau situs resmi.</p>
                                        @endif

                                        @if($destinasi->info_tiket)
                                            <p class="text-sm sm:text-base text-gray-700 italic border-t border-orange-300 pt-4 mt-4">{{ $destinasi->info_tiket }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($destinasi->peta_embed_safe)
                        <div class="tab-content" id="lokasi">
                            <div class="map-container aspect-video shadow-xl tab-pane">
                                <iframe src="{{ $destinasi->peta_embed_safe }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        @endif

                        @if(count($destinasi->galeri_urls ?? []) > 0)
                        <div class="tab-content" id="galeri">
                            <div class="tab-pane">
                                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-8 sm:mb-10 relative inline-block mx-auto">
                                    Galeri Foto
                                    <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-20 sm:w-24 h-1 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-500 rounded-full"></span>
                                </h2>

                                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
                                    @foreach($destinasi->galeri_urls as $index => $url)
                                    <a href="{{ $url }}" 
                                       class="gallery-item glightbox relative overflow-hidden rounded-xl shadow-md"
                                       data-aos="zoom-in" 
                                       data-aos-duration="700" 
                                       data-aos-delay="{{ $index * 60 }}">
                                        <img src="{{ $url }}" 
                                             class="w-full h-40 sm:h-48 md:h-56 object-cover transition-transform duration-700"
                                             alt="Galeri {{ $destinasi->nama }} - {{ $index + 1 }}"
                                             loading="lazy">
                                        <div class="zoom-icon text-white">
                                            <svg class="w-10 sm:w-12 md:w-14 h-10 sm:h-12 md:h-14 drop-shadow-xl" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                            </svg>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:sticky lg:top-6 space-y-8 order-last lg:order-none">
                    <div class="info-card p-5 sm:p-6 rounded-xl shadow-lg" data-aos="fade-left" data-aos-duration="800">
                        <h3 class="text-lg sm:text-xl font-bold mb-5 sm:mb-6 flex items-center gap-3 text-gray-800">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi Singkat
                        </h3>

                        <ul class="space-y-4 text-gray-700 text-sm sm:text-base">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-orange-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <strong class="block text-gray-900">Lokasi</strong>
                                    <span>{{ $destinasi->lokasi ?? 'Tidak disebutkan' }}</span>
                                </div>
                            </li>

                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <strong class="block text-gray-900">Dilihat</strong>
                                    <span class="counter-animate font-medium">{{ number_format($destinasi->views) }} kali</span>
                                </div>
                            </li>

                            @if($destinasi->kategori_nama)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <div>
                                    <strong class="block text-gray-900">Kategori</strong>
                                    <span>{{ $destinasi->kategori_nama }}</span>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Tombol Kembali -->
            <div class="mt-12 sm:mt-16 lg:mt-20 flex justify-center" data-aos="fade-up" data-aos-duration="900">
                @php
                    $kategori = request()->query('kategori') 
                                ?? (isset($destinasi->kategori) ? $destinasi->kategori : null);
                    $validKategori = in_array($kategori, ['candi','balkondes','kuliner','alam','budaya','religi','desa_wisata']);
                    $backUrl = $validKategori 
                        ? route('destinasi.index') . '?kategori=' . urlencode($kategori)
                        : route('destinasi.index');
                @endphp

                <a href="{{ $backUrl }}"
                   class="inline-flex items-center gap-3 px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-semibold text-base sm:text-lg rounded-full shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 group">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span>Kembali ke Daftar Destinasi</span>
                    @if($validKategori)
                        <span class="text-xs sm:text-sm opacity-90 ml-1">({{ $destinasi->kategori_nama }})</span>
                    @endif
                </a>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    AOS.init({
        once: true,
        mirror: false,
        duration: 800,
        easing: 'ease-out-cubic',
    });

    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: true,
        closeButton: true,
        zoomable: true,
    });

    const heroImage = document.getElementById('heroImage');
    if (heroImage) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            heroImage.style.transform = `translateY(${scrolled * 0.5}px)`;
        });
    }

    window.addEventListener('scroll', () => {
        const scrollProgress = document.getElementById('scrollProgress');
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollPercentage = (scrollTop / scrollHeight) * 100;
        scrollProgress.style.width = `${scrollPercentage}%`;
    });

    document.addEventListener('DOMContentLoaded', () => {
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                button.classList.add('active');
                const tabId = button.getAttribute('data-tab');
                const target = document.getElementById(tabId);
                if (target) target.classList.add('active');
            });
        });
    });
</script>
@endpush