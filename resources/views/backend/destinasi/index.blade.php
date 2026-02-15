@extends('backend.layouts.app')

@section('title', 'Daftar Destinasi')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a>
    <span class="separator">/</span>
    <span class="text-gray-700 font-medium">Destinasi</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-orange-50 via-orange-100 to-amber-50 rounded-3xl p-8 border border-orange-200/50 shadow-xl">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-orange-300/20 to-amber-300/20 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-orange-200/30 to-yellow-200/30 rounded-full blur-3xl -ml-32 -mb-32"></div>
        
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%">
                <pattern id="pattern-destinations" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="currentColor" class="text-orange-600"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#pattern-destinations)"/>
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                                Daftar Destinasi Wisata
                            </h1>
                            <p class="text-gray-600 text-sm font-medium mt-1">Kelola semua destinasi wisata di Kawasan Borobudur</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('admin.destinasi.create') }}" 
                   class="group relative bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-2xl hover:from-orange-600 hover:to-orange-700 transition-all font-semibold shadow-lg hover:shadow-xl hover:scale-105 flex items-center gap-2 overflow-hidden">
                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    <svg class="w-5 h-5 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="relative z-10">Tambah Destinasi Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-md hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Destinasi</p>
                    <p class="text-3xl font-black text-gray-800 mt-2 tabular-nums">{{ $totalDestinasi }}</p>
                </div>
                <div class="bg-gradient-to-br from-orange-100 to-orange-200 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-md hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Views</p>
                    <p class="text-3xl font-black text-gray-800 mt-2 tabular-nums">{{ number_format($totalViews) }}</p>
                </div>
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-md hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Rata-rata Views</p>
                    <p class="text-3xl font-black text-gray-800 mt-2 tabular-nums">{{ number_format($avgViews, 0) }}</p>
                </div>
                <div class="bg-gradient-to-br from-purple-100 to-purple-200 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100/50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Data Destinasi
                </h2>
                <div class="text-sm text-gray-500 font-medium">
                    Total: <span class="text-orange-600 font-bold">{{ $destinasi->total() }}</span> destinasi
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Destinasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Harga Tiket</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Views</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($destinasi as $item)
                        <tr class="hover:bg-orange-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800 group-hover:text-orange-600 transition-colors">
                                    {{ $item->nama }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    ID: {{ $item->id }} • Dibuat: {{ $item->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
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
                                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium
                                        {{ $item->kategori === 'wisata_edukasi' ? 'bg-indigo-100 text-indigo-800' : 'bg-orange-100 text-orange-800' }}">
                                        {{ $kategoriDisplay }}
                                    </span>
                                @else
                                    <span class="text-gray-500 text-sm">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $item->lokasi ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->harga_tiket)
                                    <span class="inline-flex px-3 py-1.5 rounded-full text-sm font-semibold bg-gradient-to-r from-amber-100 to-amber-200 text-amber-800 border border-amber-300">
                                        {{ $item->harga_tiket }}
                                    </span>
                                @else
                                    <span class="text-gray-500 text-sm">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gradient-to-r from-orange-100 to-orange-200/50 border border-orange-200">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span class="text-orange-700 font-bold text-sm tabular-nums">{{ number_format($item->views ?? 0) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.destinasi.show', $item) }}"
                                       class="group/btn relative bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                            </svg>
                                            Detail
                                        </div>
                                    </a>

                                    <a href="{{ route('admin.destinasi.edit', $item) }}"
                                       class="group/btn relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition-all overflow-hidden">
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
                                                class="group/btn relative bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition-all overflow-hidden delete-btn"
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
                            <td colspan="6" class="px-6 py-16">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-50 rounded-full mb-6">
                                        <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-700 mb-3">Belum ada destinasi wisata</h3>
                                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Mulai tambahkan destinasi wisata pertama Anda di kawasan Borobudur</p>
                                    <a href="{{ route('admin.destinasi.create') }}" 
                                       class="inline-flex items-center gap-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-2xl hover:from-orange-600 hover:to-orange-700 transition-all font-semibold shadow-xl hover:shadow-2xl hover:scale-105">
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
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between items-center flex-wrap gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold text-gray-800">{{ $destinasi->count() }}</span> dari total {{ $destinasi->total() }} destinasi
            </div>
            <div>
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
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
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

        // Fade-in rows
        document.querySelectorAll('tbody tr').forEach((row, i) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            row.style.transition = 'all 0.5s ease';
            setTimeout(() => {
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, i * 80);
        });
    </script>
@endpush
@endsection