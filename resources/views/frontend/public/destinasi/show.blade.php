@extends('frontend.layout.app')

@section('title', $destinasi->nama . ' | Destinasi Wisata Kawasan Borobudur')

@section('content')

    <!-- Hero Section -->
    <section class="relative h-96 md:h-[500px] lg:h-[600px] overflow-hidden">
        @if($destinasi->gambar_utama_url)
            <img src="{{ $destinasi->gambar_utama_url }}"
                 alt="{{ $destinasi->nama }}"
                 class="absolute inset-0 w-full h-full object-cover brightness-[0.65] transition-all duration-700 group-hover:brightness-[0.55]"
                 loading="lazy">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-950 flex items-center justify-center text-white text-2xl font-medium">
                <span>Tidak ada gambar utama tersedia</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent flex items-end justify-center pb-12 md:pb-16 lg:pb-20">
            <div class="text-center text-white px-6 max-w-5xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 drop-shadow-2xl tracking-tight">
                    {{ $destinasi->nama }}
                </h1>
                <p class="text-xl md:text-2xl lg:text-3xl drop-shadow-lg opacity-95">
                    {{ $destinasi->lokasi ?? 'Lokasi tidak disebutkan' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 md:py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 xl:gap-12">

                <!-- Deskripsi & Informasi Lengkap + Peta -->
                <div class="lg:col-span-2 space-y-12 lg:space-y-16">

                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Deskripsi</h2>
                        <div class="prose prose-lg md:prose-xl prose-gray max-w-none leading-relaxed">
                            {!! nl2br(e($destinasi->deskripsi)) !!}
                        </div>
                    </div>

                    @if($destinasi->deskripsi_panjang)
                        <div>
                            <h3 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-5">Informasi Lengkap</h3>
                            <div class="prose prose-lg md:prose-xl prose-gray max-w-none leading-relaxed">
                                {!! nl2br(e($destinasi->deskripsi_panjang)) !!}
                            </div>
                        </div>
                    @endif

                    @if($destinasi->latitude && $destinasi->longitude)
                        <div>
                            <h3 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-5">Lokasi di Peta</h3>
                            <div class="rounded-2xl overflow-hidden shadow-xl border border-gray-200 aspect-video">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15000!2d{{ $destinasi->longitude }}!3d{{ $destinasi->latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z{{ number_format($destinasi->latitude, 6) }}%2C{{ number_format($destinasi->longitude, 6) }}!5e0!3m2!1sid!2sid!4v{{ now()->timestamp }}!5m2!1sid!2sid"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Sidebar Info -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 p-6 md:p-8 rounded-2xl shadow-lg border border-gray-100 sticky top-6 lg:top-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Destinasi</h3>
                        <ul class="space-y-5 text-gray-700 text-base">
                            <li>
                                <strong class="block text-gray-900 text-lg">Lokasi</strong>
                                {{ $destinasi->lokasi ?? '-' }}
                            </li>
                            @if($destinasi->latitude && $destinasi->longitude)
                                <li>
                                    <strong class="block text-gray-900 text-lg">Koordinat</strong>
                                    <span class="text-sm font-mono">{{ number_format($destinasi->latitude, 6) }}, {{ number_format($destinasi->longitude, 6) }}</span>
                                </li>
                            @endif
                            @if(isset($destinasi->views))
                                <li>
                                    <strong class="block text-gray-900 text-lg">Dilihat</strong>
                                    {{ number_format($destinasi->views) }} kali
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Galeri Foto -->
            @if($destinasi->galeri_urls && count($destinasi->galeri_urls) > 0)
                <div class="mt-16 lg:mt-20">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 lg:mb-10 text-center">Galeri Foto</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                        @foreach($destinasi->galeri_urls as $url)
                            <div class="group relative overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500">
                                <img src="{{ $url }}"
                                     alt="Galeri {{ $destinasi->nama }}"
                                     class="w-full h-64 md:h-72 lg:h-80 object-cover transform group-hover:scale-110 transition-transform duration-700"
                                     loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- Related Destinations -->
    @if(isset($related) && $related->isNotEmpty())
        <section class="py-16 lg:py-20 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-10 lg:mb-12 text-center">Destinasi Lainnya di Kawasan Borobudur</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                    @foreach($related as $item)
                        <a href="{{ route('destinasi.show', $item->slug) }}"
                           class="group block bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 border border-gray-200 hover:border-orange-200">
                            @if($item->gambar_utama_url)
                                <div class="aspect-[4/3] overflow-hidden">
                                    <img src="{{ $item->gambar_utama_url }}"
                                         alt="{{ $item->nama }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                         loading="lazy">
                                </div>
                            @else
                                <div class="aspect-[4/3] bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-gray-500">
                                    <span class="text-xl font-medium">No Image</span>
                                </div>
                            @endif
                            <div class="p-6 lg:p-7">
                                <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                    {{ $item->nama }}
                                </h3>
                                <p class="text-gray-600 text-base line-clamp-3">
                                    {{ strip_tags(Str::limit($item->deskripsi ?? '', 110)) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection