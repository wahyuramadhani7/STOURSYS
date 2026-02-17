@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[var(--accent-bg)] to-[var(--surface)] rounded-[var(--radius)] p-8 border border-[var(--accent-border)] shadow-[var(--shadow-md)]">
        <!-- Decorative blobs -->
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-[var(--accent)]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-[var(--accent-light)]/15 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-8">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur-sm px-4 py-1.5 rounded-full border border-[var(--accent-border)] shadow-sm">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-semibold text-[var(--text-2)]">Admin Online</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h2>

                    <p class="text-[var(--text-2)] text-lg">
                        Kelola sistem Smart Tourism Kawasan Wisata Borobudur
                    </p>

                    <p class="text-[var(--text-3)] text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ now()->isoFormat('dddd, D MMMM Y') }}
                    </p>
                </div>

                <div class="bg-[var(--surface)]/80 backdrop-blur-md px-7 py-5 rounded-[var(--radius)] border border-[var(--border)] shadow-[var(--shadow-sm)] min-w-[180px] text-center">
                    <div class="text-xs font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Waktu Server</div>
                    <div class="text-3xl sm:text-4xl font-bold text-[var(--accent)] tabular-nums tracking-tight" id="clock">
                        {{ now()->format('H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Destinasi -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Aktif</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Total Destinasi</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ \App\Models\Destinasi::count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-2">Destinasi terdaftar</p>
            </div>
        </div>

        <!-- Event Mendatang -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Upcoming</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Event Mendatang</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ \App\Models\Event::where('tanggal_mulai', '>=', now())->count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-2">Acara akan datang</p>
            </div>
        </div>

        <!-- Total Berita -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Published</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Total Berita</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ \App\Models\Berita::count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-2">Artikel & informasi</p>
            </div>
        </div>

        <!-- Pesan Masuk -->
        <div class="group relative bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            @if(\App\Models\PesanKontak::where('status', 'baru')->count() > 0)
            <div class="absolute -top-2 -right-2 bg-[var(--red)] text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-md animate-bounce">
                {{ \App\Models\PesanKontak::where('status', 'baru')->count() }}
            </div>
            @endif

            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full animate-pulse">Baru</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Pesan Masuk</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ \App\Models\PesanKontak::where('status', 'baru')->count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-2">Belum dibaca</p>
            </div>
        </div>
    </div>

    <!-- Main Grid: System Info + Quick Links -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- System Info -->
        <div class="lg:col-span-2 bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] p-8 border border-[var(--border)] hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <div class="bg-[var(--accent)] p-3 rounded-[var(--radius-sm)] shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    Informasi Sistem
                </h3>
                <span class="text-xs font-medium text-[var(--text-3)] bg-[var(--bg)] px-4 py-1.5 rounded-full">Real-time</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach([
                    ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'label' => 'Total Destinasi Aktif', 'count' => \App\Models\Destinasi::count()],
                    ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'Event Berlangsung', 'count' => \App\Models\Event::where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->count()],
                    ['icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', 'label' => 'Berita Terpublikasi', 'count' => \App\Models\Berita::count()],
                    ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Pesan Perlu Dibalas', 'count' => \App\Models\PesanKontak::where('status', 'baru')->count()],
                ] as $item)
                <div class="bg-[var(--bg)] rounded-[var(--radius-sm)] p-6 border border-[var(--border)] hover:border-[var(--accent-border)] transition-all group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-[var(--accent-bg)] p-3 rounded-[var(--radius-sm)]">
                            <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="text-base font-semibold text-[var(--text-2)] group-hover:text-[var(--text-1)] transition-colors">{{ $item['label'] }}</span>
                    </div>
                    <div class="text-4xl font-black text-[var(--text-1)] tabular-nums">{{ $item['count'] }}</div>
                </div>
                @endforeach
            </div>

            <!-- Kontak Pengembang - Ditempatkan rapi tepat di bawah Informasi Sistem -->
            <div class="mt-8 pt-6 border-t border-[var(--border)] text-center text-sm text-[var(--text-3)]">
                <p class="mb-3">
                    Ada saran, masukan, atau menemukan masalah pada sistem? Silakan hubungi pengembang:
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="mailto:ramadani2677@gmail.com" 
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[var(--accent-bg)] hover:bg-[var(--accent)]/30 border border-[var(--accent-border)] rounded-[var(--radius-sm)] transition-all text-[var(--text-2)] font-medium">
                        <svg class="w-5 h-5 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Email: ramadani2677@gmail.com
                    </a>

                    <a href="https://wa.me/6282241992151" target="_blank" 
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-100 hover:bg-green-200 border border-green-300 rounded-[var(--radius-sm)] transition-all text-green-800 font-medium">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        WhatsApp: 0822-4199-2151
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] p-8 border border-[var(--border)] hover:shadow-xl transition-shadow">
            <h3 class="text-2xl font-bold text-[var(--text-1)] flex items-center gap-3 mb-8">
                <div class="bg-[var(--accent)] p-3 rounded-[var(--radius-sm)] shadow-md">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                </div>
                Pintasan Cepat
            </h3>

            <div class="space-y-4">
                @foreach([
                    ['route' => 'admin.destinasi.index', 'label' => 'Kelola Destinasi', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'],
                    ['route' => 'admin.event.index',     'label' => 'Kelola Event',     'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['route' => 'admin.berita.index',    'label' => 'Kelola Berita',    'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                    ['route' => 'admin.kontak.index',    'label' => 'Kelola Pesan',     'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'badge' => \App\Models\PesanKontak::where('status', 'baru')->count()],
                ] as $link)
                <a href="{{ route($link['route']) }}" class="group flex items-center justify-between p-4 bg-[var(--bg)] hover:bg-[var(--accent-bg)] rounded-[var(--radius-sm)] border border-[var(--border)] hover:border-[var(--accent-border)] transition-all relative">
                    @if(isset($link['badge']) && $link['badge'] > 0)
                    <div class="absolute -top-2 -right-2 bg-[var(--red)] text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-md animate-bounce">
                        {{ $link['badge'] }}
                    </div>
                    @endif

                    <div class="flex items-center gap-4">
                        <div class="bg-[var(--accent-bg)] p-3 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-[var(--text-2)] group-hover:text-[var(--accent)] transition-colors">{{ $link['label'] }}</span>
                    </div>
                    <svg class="w-5 h-5 text-[var(--accent)] opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateClock() {
        const now = new Date();
        const time = now.toTimeString().slice(0,8);
        const el = document.getElementById('clock');
        if (el && el.textContent !== time) {
            el.style.transition = 'opacity 0.15s';
            el.style.opacity = '0';
            setTimeout(() => {
                el.textContent = time;
                el.style.opacity = '1';
            }, 150);
        }
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>
@endpush
@endsection