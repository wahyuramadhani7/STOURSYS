@extends('backend.layouts.app')

@section('title', 'Daftar Panduan')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a>
    <span class="separator">/</span>
    <span class="text-gray-700 font-medium">Panduan</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-teal-50 via-teal-100 to-cyan-50 rounded-3xl p-8 border border-teal-200/50 shadow-xl">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-teal-300/20 to-cyan-300/20 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-teal-200/30 to-emerald-200/30 rounded-full blur-3xl -ml-32 -mb-32"></div>
        
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%">
                <pattern id="pattern-info" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="currentColor" class="text-teal-600"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#pattern-info)"/>
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-teal-500 to-teal-600 p-3 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent">
                                Daftar Panduan
                            </h1>
                            <p class="text-gray-600 text-sm font-medium mt-1">Kelola informasi hotel, BPBD, rumah sakit, darurat & lainnya untuk wisatawan</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('admin.panduan.create') }}" 
                   class="group relative bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-3 rounded-2xl hover:from-teal-600 hover:to-teal-700 transition-all font-semibold shadow-lg hover:shadow-xl hover:scale-105 flex items-center gap-2 overflow-hidden">
                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    <svg class="w-5 h-5 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="relative z-10">Tambah Informasi Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Total Informasi -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-teal-300">
            <div class="absolute inset-0 bg-gradient-to-br from-teal-500/5 to-teal-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-teal-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-teal-500 to-teal-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-teal-600 bg-teal-100 px-3 py-1.5 rounded-full">Total</span>
                </div>
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Informasi</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-teal-600 transition-colors tabular-nums">
                        {{ $panduans->count() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Dengan Gambar -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-cyan-300">
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/5 to-cyan-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-cyan-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-cyan-500 to-cyan-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-cyan-600 bg-cyan-100 px-3 py-1.5 rounded-full">Media</span>
                </div>
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Dengan Gambar</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-cyan-600 transition-colors tabular-nums">
                        {{ $panduans->whereNotNull('gambar')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Aktif -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-emerald-300">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-emerald-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-emerald-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-emerald-500 to-emerald-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-3 py-1.5 rounded-full">Aktif</span>
                </div>
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Informasi Aktif</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-emerald-600 transition-colors tabular-nums">
                        {{ \App\Models\Panduan::where('is_active', true)->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100/50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Data Informasi Daerah
                </h2>
                <div class="text-sm text-gray-500 font-medium">
                    Total: <span class="text-teal-600 font-bold">{{ $panduans->count() }}</span> entri
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">No Urut</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama / Judul</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat & Kontak</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($panduans as $panduan)
                        <tr class="hover:bg-teal-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl shadow-md group-hover:scale-110 transition-transform">
                                    <span class="text-white font-bold text-lg tabular-nums">{{ $panduan->urutan }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-gray-800 group-hover:text-teal-600 transition-colors">
                                            {{ $panduan->judul }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1 line-clamp-2">
                                            {{ Str::limit(strip_tags($panduan->isi), 80) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $panduan->kategori == 'hotel' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $panduan->kategori == 'pemerintahan' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $panduan->kategori == 'rumah_sakit' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $panduan->kategori == 'darurat' ? 'bg-orange-100 text-orange-700' : '' }}
                                    {{ $panduan->kategori == 'lainnya' ? 'bg-gray-100 text-gray-700' : '' }}">
                                    {{ ucfirst($panduan->kategori ?? 'Tidak ada') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $panduan->alamat ?? '-' }}<br>
                                <span class="font-medium">{{ $panduan->kontak ?? '-' }}</span><br>
                                @if($panduan->website)
                                    <a href="{{ $panduan->website }}" target="_blank" class="text-teal-600 hover:underline">Website</a>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-100 border border-gray-200">
                                    <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                    <code class="text-sm text-gray-700 font-mono">{{ $panduan->slug }}</code>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    @if($panduan->gambar)
                                        <div class="relative group/img">
                                            <img src="{{ Storage::url($panduan->gambar) }}" 
                                                 alt="{{ $panduan->judul }}" 
                                                 class="h-16 w-16 object-cover rounded-xl border-2 border-teal-200 shadow-md group-hover/img:scale-110 transition-transform cursor-pointer">
                                            <div class="absolute inset-0 bg-teal-600/20 rounded-xl opacity-0 group-hover/img:opacity-100 transition-opacity"></div>
                                        </div>
                                    @else
                                        <div class="h-16 w-16 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-gray-200">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.panduan.show', $panduan->id) }}"
                                       class="group/btn relative bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Lihat
                                        </div>
                                    </a>

                                    <a href="{{ route('admin.panduan.edit', $panduan->id) }}"
                                       class="group/btn relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </div>
                                    </a>

                                    <form action="{{ route('admin.panduan.destroy', $panduan->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('⚠️ Yakin ingin menghapus \"{{ addslashes($panduan->judul) }}\"?\n\nData tidak dapat dikembalikan!')"
                                            class="group/btn relative bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition-all overflow-hidden">
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
                            <td colspan="7" class="px-6 py-16">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-20 h-20 bg-teal-100 rounded-full mb-6">
                                        <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-3">Belum ada informasi daerah</h3>
                                    <p class="text-gray-600 mb-6">Mulai tambahkan data hotel, BPBD, rumah sakit, dll. untuk membantu wisatawan</p>
                                    <a href="{{ route('admin.panduan.create') }}" 
                                       class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-500 to-teal-600 text-white px-8 py-4 rounded-2xl hover:from-teal-600 hover:to-teal-700 transition-all font-bold shadow-xl hover:shadow-2xl">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Informasi Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($panduans->isNotEmpty())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span>Menampilkan <span class="font-bold text-gray-800">{{ $panduans->count() }}</span> informasi</span>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-cyan-500 rounded-full"></div>
                        <span class="text-xs">Dengan Gambar: <span class="font-bold">{{ $panduans->whereNotNull('gambar')->count() }}</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                        <span class="text-xs">Aktif: <span class="font-bold">{{ \App\Models\Panduan::where('is_active', true)->count() }}</span></span>
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
        const rows = document.querySelectorAll('tbody tr');
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