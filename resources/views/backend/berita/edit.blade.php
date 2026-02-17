@extends('backend.layouts.app')

@section('title', 'Edit Berita: ' . Str::limit($berita->judul, 40))

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--accent)] transition-colors">Dashboard</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <a href="{{ route('admin.berita.index') }}" class="hover:text-[var(--accent)] transition-colors">Berita</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <span class="text-[var(--text-2)] font-medium">Edit: {{ Str::limit($berita->judul, 30) }}</span>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[var(--accent-bg)] to-[var(--surface)] rounded-[var(--radius)] p-8 border border-[var(--accent-border)] shadow-[var(--shadow-md)]">
        <!-- Decorative blobs -->
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-[var(--accent)]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-[var(--accent-light)]/15 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-5">
                <div class="bg-[var(--accent)] p-4 rounded-[var(--radius-sm)] shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">
                        Edit Berita
                    </h1>
                    <p class="text-[var(--text-2)] mt-1 font-medium line-clamp-1">
                        {{ $berita->judul }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.berita.update', ['beritum' => $berita->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Judul -->
                    <div class="md:col-span-2">
                        <label for="judul" class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input 
                            id="judul" 
                            type="text" 
                            name="judul" 
                            value="{{ old('judul', $berita->judul) }}" 
                            required 
                            class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                   focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                   shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)]"
                            placeholder="Contoh: Festival Budaya Borobudur 2026 Resmi Dibuka"
                        >
                        @error('judul')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ringkasan -->
                    <div class="md:col-span-2">
                        <label for="ringkasan" class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                            Ringkasan (Excerpt)
                        </label>
                        <textarea 
                            id="ringkasan" 
                            name="ringkasan" 
                            rows="4" 
                            class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                   focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                   shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)] resize-y"
                            placeholder="Ringkasan singkat untuk ditampilkan di halaman daftar...">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                        @error('ringkasan')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Isi Berita -->
                    <div class="md:col-span-2">
                        <label for="isi" class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                            Isi Berita Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="isi" 
                            name="isi" 
                            rows="14" 
                            required 
                            class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                   focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                   shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)] resize-y min-h-[300px]"
                        >{{ old('isi', $berita->isi) }}</textarea>
                        @error('isi')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penulis -->
                    <div>
                        <label for="penulis" class="block text-sm font-semibold text-[var(--text-2)] mb-2">Penulis</label>
                        <input 
                            id="penulis" 
                            type="text" 
                            name="penulis" 
                            value="{{ old('penulis', $berita->penulis) }}" 
                            class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                   focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                   shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)]"
                            placeholder="Nama penulis atau Admin"
                        >
                        @error('penulis')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Publikasi -->
                    <div>
                        <label for="tanggal_publikasi" class="block text-sm font-semibold text-[var(--text-2)] mb-2">Tanggal Publikasi</label>
                        <input 
                            id="tanggal_publikasi" 
                            type="date" 
                            name="tanggal_publikasi" 
                            value="{{ old('tanggal_publikasi', $berita->tanggal_publikasi?->format('Y-m-d')) }}" 
                            class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                   focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                   shadow-sm transition-all text-[var(--text-1)]"
                        >
                        <p class="mt-2 text-xs text-[var(--text-3)] italic">
                            Kosongkan jika ingin tetap menggunakan tanggal yang sudah ada
                        </p>
                    </div>

                    <!-- Gambar Utama (Preview + Ganti) -->
                    <div>
                        <label for="gambar_utama" class="block text-sm font-semibold text-[var(--text-2)] mb-2">Gambar Utama / Cover</label>

                        @if($berita->gambar_utama)
                        <div class="mb-4">
                            <p class="text-sm text-[var(--text-3)] mb-2 font-medium">Gambar saat ini:</p>
                            <div class="relative group/img inline-block overflow-hidden rounded-[var(--radius-sm)] shadow-md">
                                <img 
                                    src="{{ Storage::url($berita->gambar_utama) }}" 
                                    alt="{{ $berita->judul }}" 
                                    class="h-40 w-auto object-cover border-2 border-[var(--accent-border)]/30 group-hover/img:scale-105 transition-transform duration-300"
                                >
                                <div class="absolute inset-0 bg-[var(--accent)]/20 opacity-0 group-hover/img:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                        @endif

                        <input 
                            id="gambar_utama" 
                            type="file" 
                            name="gambar_utama" 
                            accept="image/*" 
                            class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                   shadow-sm transition-all text-[var(--text-1)] file:mr-4 file:py-2.5 file:px-5 
                                   file:rounded-[var(--radius-sm)] file:border-0 file:text-sm file:font-medium 
                                   file:bg-[var(--accent-bg)] file:text-[var(--accent)] hover:file:bg-[var(--accent-bg)]/80"
                        >
                        <p class="mt-2 text-xs text-[var(--text-3)]">
                            Upload baru untuk mengganti • Maks 3MB • jpeg, png, jpg, webp, gif
                        </p>
                        @error('gambar_utama')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Galeri Foto (Preview + Tambah Baru) -->
                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Galeri Foto</label>

                        @if($berita->galeri && count($berita->galeri) > 0)
                        <div class="mb-5">
                            <p class="text-sm text-[var(--text-3)] mb-3 font-medium">Foto saat ini:</p>
                            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                                @foreach($berita->galeri as $path)
                                    <div class="relative group/img overflow-hidden rounded-[var(--radius-sm)] shadow-sm">
                                        <img 
                                            src="{{ Storage::url($path) }}" 
                                            alt="Galeri" 
                                            class="w-full h-28 object-cover border-2 border-[var(--accent-border)]/30 group-hover/img:scale-105 transition-transform duration-300"
                                        >
                                        <div class="absolute inset-0 bg-[var(--accent)]/20 opacity-0 group-hover/img:opacity-100 transition-opacity"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <input 
                            type="file" 
                            name="galeri[]" 
                            accept="image/*" 
                            multiple 
                            class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                   shadow-sm transition-all text-[var(--text-1)] file:mr-4 file:py-2.5 file:px-5 
                                   file:rounded-[var(--radius-sm)] file:border-0 file:text-sm file:font-medium 
                                   file:bg-[var(--accent-bg)] file:text-[var(--accent)] hover:file:bg-[var(--accent-bg)]/80"
                        >
                        <p class="mt-2 text-xs text-[var(--text-3)]">
                            Tambah foto baru (foto lama tetap tersimpan)
                        </p>
                        @error('galeri.*')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Tombol Aksi -->
                <div class="mt-10 flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-[var(--border)]">
                    <a href="{{ route('admin.berita.index') }}"
                       class="px-7 py-3 bg-[var(--bg)] text-[var(--text-2)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                              hover:bg-[var(--accent-bg)] hover:border-[var(--accent-border)] transition-all font-medium text-center">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-[var(--accent)] text-white rounded-[var(--radius-sm)] 
                                   hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-sm)] 
                                   hover:shadow-[var(--shadow-md)] hover:scale-[1.02]">
                        Update Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection