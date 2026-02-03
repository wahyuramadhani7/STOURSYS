@extends('frontend.layout.app')

@section('title', 'Destinasi Wisata Kawasan Borobudur - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-12px); } }
    @keyframes pulseGlow { 0%, 100% { box-shadow: 0 0 20px rgba(249, 115, 22, 0.4); } 50% { box-shadow: 0 0 35px rgba(249, 115, 22, 0.65); } }
    @keyframes shimmer { 0% { background-position: -1200px 0; } 100% { background-position: 1200px 0; } }

    .animate-float { animation: float 3.5s ease-in-out infinite; }
    .animate-pulse-glow { animation: pulseGlow 2.5s ease-in-out infinite; }
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent);
        background-size: 1200px 100%;
        animation: shimmer 2.5s infinite;
    }

    .card-hover-scale {
        transition: all 0.55s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .card-hover-scale:hover {
        transform: translateY(-16px) scale(1.065);
    }

    .kategori-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.09);
        transition: all 0.5s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .kategori-card:hover {
        transform: translateY(-16px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.18);
    }

    .kategori-image-wrapper {
        position: relative;
        height: 240px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .kategori-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.9s ease;
    }
    .kategori-card:hover .kategori-image-wrapper img {
        transform: scale(1.15) rotate(1.6deg);
    }

    .kategori-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.04), rgba(0,0,0,0.48));
        transition: background 0.6s ease;
    }
    .kategori-card:hover .kategori-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0.06), rgba(0,0,0,0.58));
    }

    .kategori-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem 1.5rem;
        text-align: center;
    }

    .kategori-icon {
        font-size: 6.5rem;
        margin-bottom: 1rem;
        opacity: 0.9;
        transition: all 0.6s ease;
    }
    .kategori-card:hover .kategori-icon {
        transform: scale(1.12);
        opacity: 1;
    }

    .kategori-title {
        font-size: 1.9rem;
        font-weight: 900;
        color: #0f172a;
        margin-bottom: 1rem;
        line-height: 1.1;
    }

    @media (min-width: 1024px) {
        .kategori-title { font-size: 2.3rem; }
        .kategori-icon   { font-size: 7.5rem; }
    }

    @media (min-width: 1280px) {
        .category-grid-wide {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="py-16 md:py-20 bg-gradient-to-r from-orange-50 via-white to-blue-50">
        <div class="max-w-screen-2xl mx-auto px-6 sm:px-8 lg:px-12 text-center">
            <div data-aos="fade-up" data-aos-duration="1000">
                <div class="inline-block mb-5 px-6 py-3 bg-orange-100 rounded-full border border-orange-200 animate-pulse-glow">
                    <span class="text-orange-600 font-semibold text-lg">Jelajahi Borobudur</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-5 tracking-tight leading-tight">
                    Destinasi Wisata <span class="bg-gradient-to-r from-orange-500 via-orange-600 to-orange-500 bg-clip-text text-transparent">Kawasan Borobudur</span>
                </h1>
                <p class="text-lg md:text-xl lg:text-xl text-gray-700 max-w-4xl mx-auto leading-relaxed">
                    Temukan keajaiban candi, alam, budaya, kuliner, religi, dan desa wisata terbaik di sekitar Candi Borobudur
                </p>
            </div>
        </div>
    </section>

    <!-- Kategori Section -->
    @if(!request()->has('kategori') && !request()->has('search'))
        <section class="py-16 md:py-20 bg-gray-50/70">
            <div class="max-w-screen-2xl mx-auto px-6 sm:px-8 lg:px-12">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-center mb-12 lg:mb-16 text-slate-900" data-aos="fade-up">
                    Pilih Kategori Favoritmu
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10 category-grid-wide">
                    @foreach($kategoriList as $kat)
                        <a href="{{ route('destinasi.index', ['kategori' => $kat['slug']]) }}"
                           class="kategori-card group card-hover-scale" 
                           data-aos="fade-up" 
                           data-aos-delay="{{ $loop->index * 100 }}"
                           aria-label="Jelajahi kategori {{ $kat['nama'] }}">
                            
                            <div class="kategori-image-wrapper">
                                @if($kat['gambar_kategori'])
                                    <img src="{{ $kat['gambar_kategori'] }}" 
                                         alt="{{ $kat['nama'] }}" 
                                         loading="lazy"
                                         class="transition-transform duration-800 group-hover:scale-110">
                                    <div class="kategori-overlay"></div>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-slate-950 via-slate-900 to-orange-950 flex items-center justify-center">
                                        <span class="kategori-icon">
                                            @switch($kat['slug'])
                                                @case('candi') 🏯 @break
                                                @case('balkondes') 🏡 @break
                                                @case('kuliner') 🍲 @break
                                                @case('alam') 🌄 @break
                                                @case('budaya') 🎭 @break
                                                @case('religi') 🙏 @break
                                                @case('desa_wisata') 🌾 @break
                                                @default 🌟
                                            @endswitch
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="kategori-content">
                                <h3 class="kategori-title">{{ $kat['nama'] }}</h3>
                                <span class="inline-block px-7 py-3.5 bg-white text-orange-700 rounded-full font-bold text-base shadow-xl transform group-hover:scale-110 group-hover:shadow-2xl transition-all duration-400">
                                    Jelajahi →
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

    @else
        <!-- Daftar Destinasi -->
        <section class="py-16 md:py-20">
            <div class="max-w-screen-2xl mx-auto px-6 sm:px-8 lg:px-12">

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                    <div data-aos="fade-right">
                        <a href="{{ route('destinasi.index') }}" 
                           class="inline-flex items-center text-orange-600 hover:text-orange-800 font-medium text-xl"
                           aria-label="Kembali ke halaman semua kategori">
                            ← Kembali ke Semua Kategori
                        </a>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900" data-aos="fade-left">
                        @if(request('kategori'))
                            {{ ucwords(str_replace('_', ' ', request('kategori'))) }}
                        @elseif(request('search'))
                            Hasil Pencarian: "{{ request('search') }}"
                        @endif
                        <span class="text-gray-500 text-2xl font-normal ml-3">({{ $destinasi->total() }} destinasi)</span>
                    </h2>
                </div>

                <div class="mb-12 max-w-2xl mx-auto md:mx-0" data-aos="fade-up">
                    <form method="GET" action="{{ route('destinasi.index') }}" class="relative">
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari destinasi di kategori ini..." 
                               class="w-full px-8 py-5 pr-40 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 shadow-lg text-lg">
                        <button type="submit" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-orange-600 text-white px-8 py-3 rounded-full hover:bg-orange-700 transition-all font-semibold text-base">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                    @forelse ($destinasi as $index => $item)
                        <div class="group relative bg-white rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/40 card-hover-scale"
                             data-aos="fade-up" 
                             data-aos-duration="900" 
                             data-aos-delay="{{ $index * 100 }}">

                            <div class="relative h-72 overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800">
                                @if($item->gambar_utama)
                                    <img src="{{ $item->gambar_utama_url }}" 
                                         alt="{{ $item->nama }} - Kawasan Borobudur"
                                         loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-110 group-hover:rotate-[2.5deg] transition-all duration-800">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/25 to-transparent"></div>
                                    <div class="absolute inset-0 shimmer-effect opacity-0 group-hover:opacity-75 transition-opacity duration-700"></div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-800 via-blue-950 to-orange-950">
                                        <svg class="w-28 h-28 text-white/35 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                @if($item->views >= 50)
                                    <div class="absolute top-5 right-5 bg-orange-500 text-white px-5 py-2 rounded-full text-sm font-bold shadow-xl transform group-hover:scale-110 group-hover:rotate-6 transition-all">
                                        Populer
                                    </div>
                                @endif
                            </div>

                            <div class="p-7">
                                @if($item->kategori)
                                    <span class="inline-block px-5 py-2 bg-orange-100 text-orange-800 rounded-full text-base font-semibold mb-4">
                                        {{ $item->kategori_nama }}
                                    </span>
                                @endif

                                <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors">
                                    {{ $item->nama }}
                                </h3>

                                <p class="text-gray-600 mb-6 line-clamp-3 text-base leading-relaxed">
                                    {{ Str::limit(strip_tags($item->deskripsi ?? ''), 110) }}
                                </p>

                                <a href="{{ route('destinasi.show', $item) }}"
                                   class="inline-flex items-center gap-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-7 py-4 rounded-2xl font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-1.5 group/btn text-base">
                                    <span>Jelajahi Detail</span>
                                    <svg class="w-6 h-6 group-hover/btn:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-24" data-aos="fade-up">
                            <div class="max-w-lg mx-auto">
                                <div class="w-32 h-32 bg-gradient-to-br from-orange-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-8 animate-float">
                                    <span class="text-7xl">🏯</span>
                                </div>
                                <h3 class="text-4xl font-bold text-slate-900 mb-6">
                                    Tidak ditemukan
                                </h3>
                                <p class="text-gray-700 text-xl mb-10">
                                    @if(request('kategori'))
                                        Belum ada destinasi di kategori ini.
                                    @elseif(request('search'))
                                        Tidak ada hasil untuk "{{ request('search') }}".
                                    @endif
                                </p>
                                <a href="{{ route('destinasi.index') }}" 
                                   class="inline-block bg-orange-600 text-white px-10 py-5 rounded-2xl font-bold hover:bg-orange-700 transition-all shadow-xl transform hover:scale-105 text-lg">
                                    Kembali ke Kategori
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($destinasi->hasPages())
                    <div class="mt-16 flex justify-center" data-aos="fade-up">
                        {{ $destinasi->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </section>
    @endif

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        mirror: false,
        duration: 900,
        easing: 'ease-out-cubic',
    });
</script>
@endpush