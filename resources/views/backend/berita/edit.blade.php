@extends('backend.layouts.app')

@section('title', 'Edit Berita: ' . Str::limit($berita->judul, 40))

@section('content')

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-200">

        <!-- Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-orange-600 to-orange-500 text-white">
            <h1 class="text-2xl font-bold">Edit Berita</h1>
            <p class="mt-1 text-orange-100 text-sm">{{ $berita->judul }}</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="p-6 lg:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Judul -->
                <div class="md:col-span-2">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <input 
                        id="judul" 
                        type="text" 
                        name="judul" 
                        value="{{ old('judul', $berita->judul) }}" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm"
                    >
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ringkasan -->
                <div class="md:col-span-2">
                    <label for="ringkasan" class="block text-sm font-medium text-gray-700 mb-2">Ringkasan (Excerpt)</label>
                    <textarea 
                        id="ringkasan" 
                        name="ringkasan" 
                        rows="3" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm"
                        placeholder="Ringkasan singkat...">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                    @error('ringkasan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Isi Berita -->
                <div class="md:col-span-2">
                    <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                        Isi Berita Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="isi" 
                        name="isi" 
                        rows="12" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm font-mono text-sm"
                    >{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                    <input 
                        id="penulis" 
                        type="text" 
                        name="penulis" 
                        value="{{ old('penulis', $berita->penulis) }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm"
                        placeholder="Nama penulis atau Admin"
                    >
                </div>

                <!-- Tanggal Publikasi -->
                <div>
                    <label for="tanggal_publikasi" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                    <input 
                        id="tanggal_publikasi" 
                        type="date" 
                        name="tanggal_publikasi" 
                        value="{{ old('tanggal_publikasi', $berita->tanggal_publikasi?->format('Y-m-d')) }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                    >
                </div>

                <!-- Gambar Utama (dengan preview) -->
                <div>
                    <label for="gambar_utama" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama / Cover</label>

                    @if($berita->gambar_utama)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2 font-medium">Gambar saat ini:</p>
                        <img 
                            src="{{ Storage::url($berita->gambar_utama) }}" 
                            alt="Preview utama" 
                            class="h-40 w-auto object-cover rounded-lg shadow-md border border-gray-200"
                        >
                    </div>
                    @endif

                    <input 
                        id="gambar_utama" 
                        type="file" 
                        name="gambar_utama" 
                        accept="image/*" 
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition shadow-sm"
                    >
                    <p class="mt-1.5 text-xs text-gray-500">Upload baru untuk mengganti • Maks 3MB</p>
                    @error('gambar_utama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Galeri Saat Ini + Tambah Baru -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Galeri Foto</label>

                    @if($berita->galeri && count($berita->galeri) > 0)
                    <div class="mb-5">
                        <p class="text-sm text-gray-600 mb-3 font-medium">Foto saat ini:</p>
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            @foreach($berita->galeri as $path)
                                <div class="relative group">
                                    <img 
                                        src="{{ Storage::url($path) }}" 
                                        alt="Galeri" 
                                        class="w-full h-28 object-cover rounded-lg shadow-sm border border-gray-200 transition group-hover:scale-105"
                                    >
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
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition shadow-sm"
                    >
                    <p class="mt-1.5 text-xs text-gray-500">Tambah foto baru (foto lama tetap ada)</p>
                    @error('galeri.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Tombol Aksi -->
            <div class="mt-10 flex flex-col sm:flex-row justify-end gap-4">
                <a href="{{ route('admin.berita.index') }}"
                   class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition shadow-sm text-center">
                    Batal
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                    Update Berita
                </button>
            </div>
        </form>
    </div>
</div>

@endsection