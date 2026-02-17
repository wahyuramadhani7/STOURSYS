@extends('backend.layouts.app')

@section('title', 'Daftar Destinasi')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--accent)] transition-colors">Dashboard</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <span class="text-[var(--text-1)] font-medium">Destinasi</span>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[var(--accent-bg)] to-[var(--surface)] rounded-[var(--radius)] p-8 border border-[var(--accent-border)] shadow-[var(--shadow-md)]">
        <!-- Decorative blobs -->
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-[var(--accent)]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-[var(--accent-light)]/15 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="bg-[var(--accent)] p-4 rounded-[var(--radius-sm)] shadow-md">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">
                            Daftar Destinasi Wisata
                        </h1>
                        <p class="text-[var(--text-2)] mt-1">
                            Kelola semua destinasi wisata di Kawasan Borobudur
                        </p>
                    </div>
                </div>

                <a href="{{ route('admin.destinasi.create') }}"
                   class="group relative inline-flex items-center gap-2 bg-[var(--accent)] text-white px-6 py-3 rounded-[var(--radius)] hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] hover:scale-[1.03] overflow-hidden">
                    <div class="absolute inset-0 bg-white/15 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    <svg class="w-5 h-5 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="relative z-10">Tambah Destinasi Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Destinasi -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] p-6 border border-[var(--border)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide">Total Destinasi</p>
                    <p class="text-4xl font-black text-[var(--text-1)] mt-3 group-hover:text-[var(--accent)] transition-colors tabular-nums">
                        {{ $totalDestinasi }}
                    </p>
                </div>
                <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Views -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] p-6 border border-[var(--border)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide">Total Views</p>
                    <p class="text-4xl font-black text-[var(--text-1)] mt-3 group-hover:text-[var(--accent)] transition-colors tabular-nums">
                        {{ number_format($totalViews) }}
                    </p>
                </div>
                <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Rata-rata Views -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] p-6 border border-[var(--border)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide">Rata-rata Views</p>
                    <p class="text-4xl font-black text-[var(--text-1)] mt-3 group-hover:text-[var(--accent)] transition-colors tabular-nums">
                        {{ number_format($avgViews, 0) }}
                    </p>
                </div>
                <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
        <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Data Destinasi Wisata
                </h2>
                <div class="text-sm text-[var(--text-2)]">
                    Total: <span class="font-bold text-[var(--accent)]">{{ $destinasi->total() }}</span> destinasi
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--border)]">
                <thead class="bg-[var(--bg)]">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Nama Destinasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Harga Tiket</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Views</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] bg-[var(--surface)]">
                    @forelse ($destinasi as $item)
                        <tr class="hover:bg-[var(--accent-bg)]/40 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="font-semibold text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors">
                                    {{ $item->nama }}
                                </div>
                                <div class="text-xs text-[var(--text-3)] mt-1">
                                    ID: {{ $item->id }} • {{ $item->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                @php
                                    $kategoriMap = [
                                        'candi'          => 'Destinasi Candi',
                                        'balkondes'      => 'Balkondes',
                                        'kuliner'        => 'Kuliner',
                                        'alam'           => 'Destinasi Alam',
                                        'budaya'         => 'Destinasi Budaya',
                                        'religi'         => 'Destinasi Religi',
                                        'desa_wisata'    => 'Desa Wisata',
                                        'wisata_edukasi' => 'Wisata Edukasi',
                                    ];
                                    $kategoriDisplay = $kategoriMap[$item->kategori] ?? ucwords(str_replace('_', ' ', $item->kategori ?? '—'));
                                @endphp

                                @if($item->kategori)
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-[var(--accent-bg)] text-[var(--accent)] border border-[var(--accent-border)]/50">
                                        {{ $kategoriDisplay }}
                                    </span>
                                @else
                                    <span class="text-[var(--text-3)] text-sm">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-[var(--text-2)]">
                                {{ $item->lokasi ?? '—' }}
                            </td>
                            <td class="px-6 py-5">
                                @if($item->harga_tiket)
                                    <span class="inline-flex px-3.5 py-1.5 rounded-full text-sm font-semibold bg-gradient-to-r from-amber-100/80 to-amber-200/60 text-amber-800 border border-amber-300/70">
                                        {{ $item->harga_tiket }}
                                    </span>
                                @else
                                    <span class="text-[var(--text-3)]">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[var(--accent-bg)]/60 border border-[var(--accent-border)]/40">
                                    <svg class="w-4 h-4 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span class="font-bold text-[var(--accent)] tabular-nums">{{ number_format($item->views ?? 0) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-3 flex-wrap">
                                    <a href="{{ route('admin.destinasi.show', $item) }}"
                                       class="group/btn relative bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white px-5 py-2.5 rounded-[var(--radius-sm)] text-sm font-semibold shadow-sm hover:shadow-md transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a9 9 0 11-18 0 9 9 0 0118 0z M12 8v4l3 3"/>
                                            </svg>
                                            Detail
                                        </div>
                                    </a>

                                    <a href="{{ route('admin.destinasi.edit', $item) }}"
                                       class="group/btn relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-5 py-2.5 rounded-[var(--radius-sm)] text-sm font-semibold shadow-sm hover:shadow-md transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </div>
                                    </a>

                                    <form action="{{ route('admin.destinasi.destroy', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="group/btn relative bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-5 py-2.5 rounded-[var(--radius-sm)] text-sm font-semibold shadow-sm hover:shadow-md transition-all overflow-hidden delete-btn"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ addslashes($item->nama) }}">
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
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="inline-flex flex-col items-center">
                                    <div class="w-20 h-20 bg-[var(--accent-bg)] rounded-full flex items-center justify-center mb-6">
                                        <svg class="w-10 h-10 text-[var(--accent)]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-[var(--text-1)] mb-3">Belum ada destinasi wisata</h3>
                                    <p class="text-[var(--text-2)] mb-8 max-w-md">Mulai tambahkan destinasi wisata pertama Anda di kawasan Borobudur</p>
                                    <a href="{{ route('admin.destinasi.create') }}"
                                       class="inline-flex items-center gap-3 bg-[var(--accent)] text-white px-8 py-4 rounded-[var(--radius)] hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-md)] hover:shadow-[var(--shadow-lg)] hover:scale-[1.03]">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Destinasi Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($destinasi->count() > 0)
        <div class="bg-[var(--bg)] px-6 py-5 border-t border-[var(--border)] flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="text-sm text-[var(--text-2)]">
                Menampilkan <span class="font-semibold text-[var(--text-1)]">{{ $destinasi->count() }}</span> dari total {{ $destinasi->total() }} destinasi
            </div>
            <div class="pagination-container">
                {{ $destinasi->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Toast success message
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        @endif

        // Delete confirmation
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const name = this.dataset.name;

                Swal.fire({
                    title: 'Hapus destinasi?',
                    html: `Anda akan menghapus <strong>"${name}"</strong><br><br>Data akan <b>hilang permanen</b>!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--red)',
                    cancelButtonColor: 'var(--gray-500)',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Fade-in animation for table rows
        document.querySelectorAll('tbody tr').forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(15px)';
            row.style.transition = 'all 0.4s ease-out';
            setTimeout(() => {
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 60);
        });
    </script>
@endpush
@endsection