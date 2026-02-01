@extends('backend.layouts.app')

@section('title', 'Daftar Event')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a>
    <span class="separator">/</span>
    <span class="text-gray-700 font-medium">Event</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header Section - Redesigned -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-50 via-blue-100 to-indigo-50 rounded-3xl p-8 border border-blue-200/50 shadow-xl">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-blue-300/20 to-indigo-300/20 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-blue-200/30 to-purple-200/30 rounded-full blur-3xl -ml-32 -mb-32"></div>
        
        <!-- Pattern overlay -->
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%">
                <pattern id="pattern-events" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="currentColor" class="text-blue-600"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#pattern-events)"/>
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-3 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Daftar Event & Kegiatan
                            </h1>
                            <p class="text-gray-600 text-sm font-medium mt-1">Kelola semua event dan kegiatan wisata</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('admin.event.create') }}" 
                   class="group relative bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-2xl hover:from-blue-600 hover:to-blue-700 transition-all font-semibold shadow-lg hover:shadow-xl hover:scale-105 flex items-center gap-2 overflow-hidden">
                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    <svg class="w-5 h-5 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="relative z-10">Tambah Event Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Total Event -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-300">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-100 px-3 py-1.5 rounded-full">Total</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Event</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-blue-600 transition-colors tabular-nums">
                        {{ $events->count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                            </svg>
                            <span class="font-semibold">All</span>
                        </div>
                        <span class="text-gray-600">Semua event</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sedang Berlangsung -->
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
                    <span class="text-xs font-bold text-green-600 bg-green-100 px-3 py-1.5 rounded-full animate-pulse">Live</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Sedang Berlangsung</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-green-600 transition-colors tabular-nums">
                        {{ $events->where('status', 'Sedang Berlangsung')->count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-green-600 bg-green-50 px-2 py-1 rounded-lg">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="font-semibold">Active</span>
                        </div>
                        <span class="text-gray-600">Event berlangsung</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Akan Datang -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-purple-300">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-purple-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-purple-600 bg-purple-100 px-3 py-1.5 rounded-full">Soon</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Akan Datang</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-purple-600 transition-colors tabular-nums">
                        {{ $events->where('status', 'Akan Datang')->count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-purple-600 bg-purple-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Upcoming</span>
                        </div>
                        <span class="text-gray-600">Event mendatang</span>
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
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Data Event
                </h2>
                <div class="text-sm text-gray-500 font-medium">
                    Total: <span class="text-blue-600 font-bold">{{ $events->count() }}</span> event
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
                                Judul Event
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
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                Lokasi
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Status
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
                    @forelse ($events as $event)
                        <tr class="hover:bg-blue-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors truncate">
                                            {{ $event->judul }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-0.5 truncate">{{ $event->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-800">{{ $event->tanggal_mulai->format('d M Y') }}</span>
                                        @if($event->tanggal_selesai && $event->tanggal_selesai != $event->tanggal_mulai)
                                            <span class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                </svg>
                                                {{ $event->tanggal_selesai->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-gray-700">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span class="text-sm">{{ $event->lokasi ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($event->status == 'Sedang Berlangsung')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-green-100 to-green-200/50 border border-green-200 text-green-700 text-xs font-bold">
                                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                        {{ $event->status }}
                                    </span>
                                @elseif($event->status == 'Akan Datang')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-purple-100 to-purple-200/50 border border-purple-200 text-purple-700 text-xs font-bold">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $event->status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-gray-100 to-gray-200/50 border border-gray-200 text-gray-700 text-xs font-bold">
                                        {{ $event->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('admin.event.show', $event->id) }}"
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
                                    <a href="{{ route('admin.event.edit', $event->id) }}"
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
                                    <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('⚠️ Yakin ingin menghapus event \"{{ $event->judul }}\"?\n\nData yang dihapus tidak dapat dikembalikan!')"
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
                            <td colspan="5" class="px-6 py-16">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada event</h3>
                                    <p class="text-gray-500 mb-6">Mulai tambahkan event atau kegiatan pertama Anda</p>
                                    <a href="{{ route('admin.event.create') }}" 
                                       class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all font-semibold shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Event
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Info -->
        @if($events->isNotEmpty())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span>Menampilkan <span class="font-semibold text-gray-800">{{ $events->count() }}</span> event</span>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-xs">Berlangsung: <span class="font-semibold">{{ $events->where('status', 'Sedang Berlangsung')->count() }}</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                        <span class="text-xs">Akan Datang: <span class="font-semibold">{{ $events->where('status', 'Akan Datang')->count() }}</span></span>
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