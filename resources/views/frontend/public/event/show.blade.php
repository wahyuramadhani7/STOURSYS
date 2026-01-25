@extends('frontend.layout.app')

@section('title', $event->judul . ' - STOURSYS')

@section('content')

    <!-- Hero / Cover Image -->
    <section class="relative h-[50vh] md:h-[60vh] min-h-[450px] overflow-hidden">
        @if($event->gambar_utama)
            <img 
                src="{{ Storage::url($event->gambar_utama) }}" 
                alt="{{ $event->judul }}"
                class="absolute inset-0 w-full h-full object-cover"
            >
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-950 to-orange-950"></div>
        @endif

        <!-- Overlay gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>

        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-end pb-12 md:pb-16">
            <div class="max-w-4xl">
                <!-- Badge Status -->
                @php
                    $statusClass = [
                        'Sedang Berlangsung' => 'bg-green-600 text-white',
                        'Akan Datang'        => 'bg-blue-600 text-white',
                        'Berakhir'           => 'bg-red-600 text-white',
                    ][$event->status ?? 'Akan Datang'] ?? 'bg-gray-600 text-white';
                @endphp

                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="{{ $statusClass }} px-4 py-1.5 rounded-full text-sm font-bold shadow-md backdrop-blur-sm">
                        {{ $event->status ?? 'Akan Datang' }}
                    </span>
                    @if($event->tanggal_selesai && $event->tanggal_selesai->isPast())
                        <span class="bg-red-600/90 px-4 py-1.5 rounded-full text-sm font-bold shadow-md backdrop-blur-sm text-white">
                            Sudah Berakhir
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight mb-4 drop-shadow-lg">
                    {{ $event->judul }}
                </h1>

                <div class="flex flex-wrap gap-6 text-white/95 text-base md:text-lg">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>
                                @if($event->jam_mulai) {{ $event->jam_mulai }} @endif
                                @if($event->jam_selesai) — {{ $event->jam_selesai }} @endif
                            </span>
                        </div>
                    @endif

                    @if($event->lokasi)
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-slate-900">Deskripsi Event</h2>
                    {!! nl2br(e($event->deskripsi)) !!}

                    <!-- Waktu Pelaksanaan Box (jika ada jam) -->
                    @if($event->jam_mulai || $event->jam_selesai)
                    <div class="my-10 p-6 bg-gradient-to-r from-orange-50 to-blue-50 rounded-2xl border border-orange-100/60 shadow-sm">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Waktu Pelaksanaan</h3>
                        <div class="text-lg text-gray-700">
                            @if($event->jam_mulai) Mulai pukul <strong>{{ $event->jam_mulai }}</strong> @endif
                            @if($event->jam_selesai) s/d <strong>{{ $event->jam_selesai }}</strong> @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right: Sidebar Info -->
                <div class="space-y-8 lg:space-y-10">

                    <!-- Informasi Singkat -->
                    <div class="bg-gradient-to-br from-orange-50 via-white to-blue-50 p-7 rounded-2xl border border-orange-100/50 shadow-sm">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6">Informasi Event</h3>
                        
                        <dl class="space-y-5 text-gray-700">
                            <div>
                                <dt class="font-semibold text-slate-800">Tanggal</dt>
                                <dd class="mt-1 text-lg">
                                    {{ $event->tanggal_mulai->format('d F Y') }}
                                    @if($event->tanggal_selesai && $event->tanggal_selesai->ne($event->tanggal_mulai))
                                        — {{ $event->tanggal_selesai->format('d F Y') }}
                                    @endif
                                </dd>
                            </div>

                            @if($event->jam_mulai || $event->jam_selesai)
                            <div>
                                <dt class="font-semibold text-slate-800">Waktu</dt>
                                <dd class="mt-1 text-lg">
                                    @if($event->jam_mulai) {{ $event->jam_mulai }} @endif
                                    @if($event->jam_selesai) — {{ $event->jam_selesai }} @endif
                                </dd>
                            </div>
                            @endif

                            @if($event->lokasi)
                            <div>
                                <dt class="font-semibold text-slate-800">Lokasi</dt>
                                <dd class="mt-1 text-lg">{{ $event->lokasi }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    <!-- Galeri -->
                    @if($event->galeri && count($event->galeri) > 0)
                    <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                        <h3 class="text-xl font-bold px-6 py-5 bg-gradient-to-r from-orange-500/10 to-blue-500/10 text-slate-800">
                            Galeri Event
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-4">
                            @foreach($event->galeri as $foto)
                                <img 
                                    src="{{ Storage::url($foto) }}" 
                                    alt="Galeri {{ $event->judul }}" 
                                    class="w-full h-32 object-cover rounded-xl hover:scale-105 transition-transform duration-300 shadow-sm"
                                >
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-16 text-center">
                <a href="{{ route('event.index') }}"
                   class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    Kembali ke Daftar Event
                </a>
            </div>
        </div>
    </section>

@endsection