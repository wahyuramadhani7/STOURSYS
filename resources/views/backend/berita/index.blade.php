@extends('backend.layouts.app')

@section('title', 'Daftar Berita')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a>
    <span class="separator">/</span>
    <span class="text-gray-700 font-medium">Berita</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header Section - Redesigned -->
    <div class="relative overflow-hidden bg-gradient-to-r from-purple-50 via-purple-100 to-pink-50 rounded-3xl p-8 border border-purple-200/50 shadow-xl">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-purple-300/20 to-pink-300/20 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-purple-200/30 to-fuchsia-200/30 rounded-full blur-3xl -ml-32 -mb-32"></div>
        
        <!-- Pattern overlay -->
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%">
                <pattern id="pattern-news" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="currentColor" class="text-purple-600"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#pattern-news)"/>
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-3 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                Daftar Berita Terbaru
                            </h1>
                            <p class="text-gray-600 text-sm font-medium mt-1">Kelola semua berita dan artikel wisata</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('admin.berita.create') }}" 
                   class="group relative bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-3 rounded-2xl hover:from-purple-600 hover:to-purple-700 transition-all font-semibold shadow-lg hover:shadow-xl hover:scale-105 flex items-center gap-2 overflow-hidden">
                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    <svg class="w-5 h-5 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="relative z-10">Tambah Berita Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards (4 Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
        <!-- Total Berita -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-purple-300">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-purple-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-purple-600 bg-purple-100 px-3 py-1.5 rounded-full">Total</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Berita</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-purple-600 transition-colors tabular-nums">
                        {{ $beritas->count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-purple-600 bg-purple-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                            </svg>
                            <span class="font-semibold">All</span>
                        </div>
                        <span class="text-gray-600">Semua berita</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terpublikasi -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-green-300">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-green-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-green-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-green-500 to-green-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-green-600 bg-green-100 px-3 py-1.5 rounded-full">Published</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Terpublikasi</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-green-600 transition-colors tabular-nums">
                        {{ $beritas->whereNotNull('tanggal_publikasi')->count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-green-600 bg-green-50 px-2 py-1 rounded-lg">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="font-semibold">Live</span>
                        </div>
                        <span class="text-gray-600">Berita terpublikasi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dengan Gambar -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-pink-300">
            <div class="absolute inset-0 bg-gradient-to-br from-pink-500/5 to-pink-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-pink-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-pink-500 to-pink-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-pink-600 bg-pink-100 px-3 py-1.5 rounded-full">Media</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Dengan Gambar</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-pink-600 transition-colors tabular-nums">
                        {{ $beritas->whereNotNull('gambar_utama')->count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-pink-600 bg-pink-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Images</span>
                        </div>
                        <span class="text-gray-600">Dengan gambar</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Views -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-300">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-100 px-3 py-1.5 rounded-full">Views</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Views</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-blue-600 transition-colors tabular-nums">
                        {{ number_format($beritas->sum('views')) }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Readers</span>
                        </div>
                        <span class="text-gray-600">Total pembaca</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section - Redesigned -->
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100/50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Data Berita
                </h2>
                <div class="text-sm text-gray-500 font-medium">
                    Total: <span class="text-purple-600 font-bold">{{ $beritas->count() }}</span> berita
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Judul Berita
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                                </svg>
                                Ringkasan
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Penulis
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Tanggal
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Views
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Gambar
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                </svg>
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($beritas as $berita)
                        <tr class="hover:bg-purple-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-gray-800 group-hover:text-purple-600 transition-colors line-clamp-2">
                                            {{ $berita->judul }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-0.5 truncate">{{ $berita->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-700 line-clamp-2 max-w-xs">
                                    {{ $berita->ringkasan ?? Str::limit(strip_tags($berita->isi), 80) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center shadow-sm">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="text-sm font-medium text-gray-800">{{ $berita->penulis ?? 'Admin' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if($berita->tanggal_publikasi)
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-gray-800">{{ $berita->tanggal_publikasi->format('d M Y') }}</span>
                                            <span class="text-xs text-gray-500">{{ $berita->tanggal_publikasi->diffForHumans() }}</span>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400 italic">Belum dipublikasi</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gradient-to-r from-blue-100 to-blue-200/50 border border-blue-200">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span class="text-blue-700 font-bold text-sm tabular-nums">{{ number_format($berita->views ?? 0) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    @if($berita->gambar_utama)
                                        <div class="relative group/img">
                                            <img src="{{ Storage::url($berita->gambar_utama) }}" 
                                                 alt="Gambar Berita" 
                                                 class="h-16 w-16 object-cover rounded-xl border-2 border-purple-200 shadow-md group-hover/img:scale-110 transition-transform cursor-pointer">
                                            <div class="absolute inset-0 bg-purple-600/20 rounded-xl opacity-0 group-hover/img:opacity-100 transition-opacity"></div>
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
                                <div class="flex justify-center gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('admin.berita.show', $berita->id) }}"
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

                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                       class="group/btn relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </div>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('⚠️ Yakin ingin menghapus berita \"{{ $berita->judul }}\"?\n\nData yang dihapus tidak dapat dikembalikan!')"
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
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada berita</h3>
                                    <p class="text-gray-500 mb-6">Mulai tambahkan berita dan artikel pertama Anda</p>
                                    <a href="{{ route('admin.berita.create') }}" 
                                       class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-3 rounded-xl hover:from-purple-600 hover:to-purple-700 transition-all font-semibold shadow-lg hover:shadow-xl">
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

        <!-- Footer Info -->
        @if($beritas->isNotEmpty())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span>Menampilkan <span class="font-semibold text-gray-800">{{ $beritas->count() }}</span> berita</span>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-xs">Terpublikasi: <span class="font-semibold">{{ $beritas->whereNotNull('tanggal_publikasi')->count() }}</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-xs">Total Views: <span class="font-semibold">{{ number_format($beritas->sum('views')) }}</span></span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Add animation on page load
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            setTimeout(() => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(10px)';
                row.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, 50);
            }, index * 50);
        });
    });
</script>
@endpush
@endsection