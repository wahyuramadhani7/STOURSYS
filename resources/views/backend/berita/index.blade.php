@extends('backend.layouts.app')

@section('title', 'Daftar Berita')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--accent)] transition-colors">Dashboard</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <span class="text-[var(--text-2)] font-medium">Berita</span>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[var(--accent-bg)] to-[var(--surface)] rounded-[var(--radius)] p-8 border border-[var(--accent-border)] shadow-[var(--shadow-md)]">
        <!-- Decorative blobs -->
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-[var(--accent)]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-[var(--accent-light)]/15 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-8">
                <div class="flex items-center gap-5">
                    <div class="bg-[var(--accent)] p-4 rounded-[var(--radius-sm)] shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">
                            Daftar Berita Terbaru
                        </h1>
                        <p class="text-[var(--text-2)] mt-1">
                            Kelola semua berita dan artikel wisata Kawasan Borobudur
                        </p>
                    </div>
                </div>

                <a href="{{ route('admin.berita.create') }}"
                   class="group relative inline-flex items-center gap-2 bg-[var(--accent)] text-white px-6 py-3 rounded-[var(--radius)] hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] hover:scale-[1.03] overflow-hidden">
                    <div class="absolute inset-0 bg-white/15 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    <svg class="w-5 h-5 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="relative z-10">Tambah Berita Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Berita -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Total</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Total Berita</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ $beritas->count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-1">Semua entri berita</p>
            </div>
        </div>

        <!-- Terpublikasi -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full animate-pulse">Published</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Terpublikasi</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ $beritas->whereNotNull('tanggal_publikasi')->count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-1">Berita live</p>
            </div>
        </div>

        <!-- Dengan Gambar -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Media</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Dengan Gambar</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ $beritas->whereNotNull('gambar_utama')->count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-1">Berita bergambar</p>
            </div>
        </div>

        <!-- Total Views -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Views</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Total Views</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ number_format($beritas->sum('views')) }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-1">Total pembaca</p>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] overflow-hidden border border-[var(--border)]">
        <div class="bg-[var(--bg)] px-6 py-4 border-b border-[var(--border)]">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <div class="bg-[var(--accent)] p-2.5 rounded-[var(--radius-sm)] shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    Data Berita
                </h2>
                <div class="text-sm text-[var(--text-2)]">
                    Total: <span class="font-bold text-[var(--accent)]">{{ $beritas->count() }}</span> berita
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--border)]">
                <thead class="bg-[var(--bg)]">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Judul Berita</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Ringkasan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Penulis</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Views</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] bg-[var(--surface)]">
                    @forelse ($beritas as $berita)
                        <tr class="hover:bg-[var(--accent-bg)]/40 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-[var(--accent-bg)] rounded-[var(--radius-sm)] flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors line-clamp-2">
                                            {{ $berita->judul }}
                                        </div>
                                        <div class="text-sm text-[var(--text-3)] mt-1 truncate">{{ $berita->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm text-[var(--text-2)] line-clamp-2 max-w-xs">
                                    {{ $berita->ringkasan ?? Str::limit(strip_tags($berita->isi), 80) }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-[var(--accent-bg)] rounded-full flex items-center justify-center shadow-sm">
                                        <svg class="w-4 h-4 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-[var(--text-1)]">{{ $berita->penulis ?? 'Admin' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm text-[var(--text-2)]">
                                @if($berita->tanggal_publikasi)
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $berita->tanggal_publikasi->format('d M Y') }}</span>
                                        <span class="text-xs text-[var(--text-3)]">{{ $berita->tanggal_publikasi->diffForHumans() }}</span>
                                    </div>
                                @else
                                    <span class="italic text-[var(--text-3)]">Belum dipublikasi</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[var(--accent-bg)] border border-[var(--accent-border)]/30">
                                    <svg class="w-4 h-4 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span class="font-bold text-[var(--text-1)] tabular-nums">{{ number_format($berita->views ?? 0) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-center">
                                    @if($berita->gambar_utama)
                                        <div class="relative group/img">
                                            <img src="{{ Storage::url($berita->gambar_utama) }}" 
                                                 alt="{{ $berita->judul }}" 
                                                 class="h-16 w-16 object-cover rounded-[var(--radius-sm)] border-2 border-[var(--accent-border)]/30 shadow-md group-hover/img:scale-110 transition-transform">
                                            <div class="absolute inset-0 bg-[var(--accent)]/20 rounded-[var(--radius-sm)] opacity-0 group-hover/img:opacity-100 transition-opacity"></div>
                                        </div>
                                    @else
                                        <div class="h-16 w-16 bg-[var(--bg)] rounded-[var(--radius-sm)] flex items-center justify-center border-2 border-[var(--border)]">
                                            <svg class="w-8 h-8 text-[var(--text-3)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-3 flex-wrap">
                                    

                                    <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                       class="group/btn relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-[var(--radius-sm)] text-sm font-semibold shadow-sm hover:shadow-md transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </div>
                                    </a>

                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('⚠️ Yakin ingin menghapus berita \"{{ addslashes($berita->judul) }}\"?\n\nData tidak dapat dikembalikan!')"
                                            class="group/btn relative bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-[var(--radius-sm)] text-sm font-semibold shadow-sm hover:shadow-md transition-all overflow-hidden">
                                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                            <div class="relative flex items-center gap-1.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="inline-block">
                                    <div class="inline-flex items-center justify-center w-24 h-24 bg-[var(--accent-bg)] rounded-full mb-6 shadow-md">
                                        <svg class="w-12 h-12 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-[var(--text-1)] mb-3">Belum ada berita</h3>
                                    <p class="text-[var(--text-2)] mb-8 max-w-md mx-auto">Mulai tambahkan berita dan artikel wisata pertama Anda</p>
                                    <a href="{{ route('admin.berita.create') }}"
                                       class="inline-flex items-center gap-3 bg-[var(--accent)] text-white px-8 py-4 rounded-[var(--radius)] hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-md)] hover:shadow-[var(--shadow-lg)] hover:scale-[1.03]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Berita
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($beritas->isNotEmpty())
        <div class="bg-[var(--bg)] px-6 py-4 border-t border-[var(--border)] text-sm text-[var(--text-2)]">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <span>Menampilkan <span class="font-bold text-[var(--text-1)]">{{ $beritas->count() }}</span> berita</span>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-[var(--accent)] rounded-full"></div>
                        <span>Terpublikasi: <span class="font-bold text-[var(--text-1)]">{{ $beritas->whereNotNull('tanggal_publikasi')->count() }}</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span>Total Views: <span class="font-bold text-[var(--text-1)]">{{ number_format($beritas->sum('views')) }}</span></span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr:not(:only-child)');
        rows.forEach((row, index) => {
            setTimeout(() => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(12px)';
                row.style.transition = 'all 0.4s ease-out';
                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, 50);
            }, index * 60);
        });
    });
</script>
@endpush
@endsection