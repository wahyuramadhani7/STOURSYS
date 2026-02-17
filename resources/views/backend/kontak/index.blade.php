@extends('backend.layouts.app')

@section('title', 'Pesan Kontak')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--accent)] transition-colors">Dashboard</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <span class="text-[var(--text-2)] font-medium">Pesan Kontak</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">
                            Pesan Kontak Masuk
                        </h1>
                        <p class="text-[var(--text-2)] mt-1">
                            Kelola semua pesan dan feedback dari pengunjung website
                        </p>
                    </div>
                </div>

                <div class="bg-[var(--surface)]/80 backdrop-blur-md px-6 py-4 rounded-[var(--radius)] border border-[var(--border)] shadow-[var(--shadow-sm)] text-center min-w-[180px]">
                    <div class="text-xs font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Total Pesan</div>
                    <div class="text-3xl sm:text-4xl font-bold text-[var(--accent)] tabular-nums">
                        {{ $pesans->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Pesan Baru -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full animate-pulse">Baru</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Pesan Baru</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ $pesans->where('status', 'baru')->count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-1">Belum dibaca</p>
            </div>
        </div>

        <!-- Sudah Dibaca -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Dibaca</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Sudah Dibaca</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ $pesans->where('status', 'dibaca')->count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-1">Telah dilihat</p>
            </div>
        </div>

        <!-- Ditanggapi -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Ditanggapi</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Ditanggapi</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ $pesans->where('status', 'ditanggapi')->count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-1">Sudah dibalas</p>
            </div>
        </div>

        <!-- Total Pesan -->
        <div class="group bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all duration-300 border border-[var(--border)] hover:border-[var(--accent-border)] overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-[var(--accent)] bg-[var(--accent-bg)] px-3 py-1.5 rounded-full">Total</span>
                </div>
                <h3 class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide mb-1">Total Pesan</h3>
                <p class="text-5xl font-black text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors tabular-nums">
                    {{ \App\Models\PesanKontak::count() }}
                </p>
                <p class="text-sm text-[var(--text-2)] mt-1">Semua pesan</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    Daftar Pesan Kontak
                </h2>
                <div class="text-sm text-[var(--text-2)]">
                    Total: <span class="font-bold text-[var(--accent)]">{{ $pesans->count() }}</span> pesan
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--border)]">
                <thead class="bg-[var(--bg)]">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Subjek</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] bg-[var(--surface)]">
                    @forelse ($pesans as $pesan)
                        <tr class="hover:bg-[var(--accent-bg)]/40 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 bg-[var(--accent-bg)] rounded-full flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="font-semibold text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors">
                                        {{ $pesan->nama }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-[var(--text-2)]">
                                {{ $pesan->email }}
                            </td>
                            <td class="px-6 py-5 text-[var(--text-2)]">
                                {{ $pesan->subjek ?? '-' }}
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($pesan->status == 'baru')
                                    <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-1.5"></span>
                                        Baru
                                    </span>
                                @elseif($pesan->status == 'dibaca')
                                    <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-1.5"></span>
                                        Dibaca
                                    </span>
                                @elseif($pesan->status == 'ditanggapi')
                                    <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-green-100 text-green-800 border border-green-200">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span>
                                        Ditanggapi
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 inline-flex items-center text-xs font-medium rounded-full bg-gray-100 text-gray-700 border border-gray-200">
                                        {{ ucfirst($pesan->status ?? 'Lainnya') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-sm text-[var(--text-2)]">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $pesan->created_at->format('d M Y') }}</span>
                                    <span class="text-xs text-[var(--text-3)]">{{ $pesan->created_at->format('H:i') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <a href="{{ route('admin.kontak.show', $pesan) }}"
                                   class="group/btn relative bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-5 py-2.5 rounded-[var(--radius-sm)] text-sm font-semibold shadow-sm hover:shadow-md transition-all inline-flex items-center gap-2 overflow-hidden">
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                    <div class="relative flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Lihat Detail
                                    </div>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="inline-block">
                                    <div class="inline-flex items-center justify-center w-24 h-24 bg-[var(--accent-bg)] rounded-full mb-6 shadow-md">
                                        <svg class="w-12 h-12 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-[var(--text-1)] mb-3">Belum ada pesan masuk</h3>
                                    <p class="text-[var(--text-2)] mb-6 max-w-md mx-auto">Pesan dari pengunjung website akan muncul di sini setelah mereka mengirim melalui form kontak</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pesans->isNotEmpty())
        <div class="bg-[var(--bg)] px-6 py-4 border-t border-[var(--border)] text-sm text-[var(--text-2)]">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <span>Menampilkan <span class="font-bold text-[var(--text-1)]">{{ $pesans->count() }}</span> dari <span class="font-bold text-[var(--text-1)]">{{ \App\Models\PesanKontak::count() }}</span> pesan</span>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span>Baru: <span class="font-bold text-[var(--text-1)]">{{ $pesans->where('status', 'baru')->count() }}</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span>Ditanggapi: <span class="font-bold text-[var(--text-1)]">{{ $pesans->where('status', 'ditanggapi')->count() }}</span></span>
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