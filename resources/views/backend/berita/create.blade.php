@extends('backend.layouts.app')

@section('title', 'Tambah Berita Baru')

@section('content')

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-200">

        <!-- Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-orange-600 to-orange-500 text-white">
            <h1 class="text-2xl font-bold">Tambah Berita Baru</h1>
            <p class="mt-1 text-orange-100 text-sm">Buat artikel atau berita terbaru</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="p-6 lg:p-8">
            @csrf

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
                        value="{{ old('judul') }}" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm"
                        placeholder="Contoh: Festival Budaya Borobudur 2026 Resmi Dibuka"
                    >
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ringkasan -->
                <div class="md:col-span-2">
                    <label for="ringkasan" class="block text-sm font-medium text-gray-700 mb-2">
                        Ringkasan (Excerpt) 
                    </label>
                    <textarea 
                        id="ringkasan" 
                        name="ringkasan" 
                        rows="3" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm"
                        placeholder="Ringkasan singkat untuk ditampilkan di halaman daftar (opsional, max 500 karakter)">{{ old('ringkasan') }}</textarea>
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
                        placeholder="Tulis isi lengkap berita di sini... (bisa gunakan editor rich text nanti)">{{ old('isi') }}</textarea>
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
                        value="{{ old('penulis') }}" 
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
                        value="{{ old('tanggal_publikasi') }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                    >
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika ingin otomatis hari ini</p>
                </div>

                <!-- Gambar Utama -->
                <div>
                    <label for="gambar_utama" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama / Cover</label>
                    <input 
                        id="gambar_utama" 
                        type="file" 
                        name="gambar_utama" 
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" 
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition shadow-sm"
                    >
                    <p class="mt-1.5 text-xs text-gray-500">Maks 3MB • jpeg, png, jpg, webp, gif</p>
                    @error('gambar_utama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Galeri (multiple) -->
                <div>
                    <label for="galeri" class="block text-sm font-medium text-gray-700 mb-2">Galeri Foto (opsional)</label>
                    <input 
                        id="galeri" 
                        type="file" 
                        name="galeri[]" 
                        accept="image/*" 
                        multiple 
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition shadow-sm"
                    >
                    <p class="mt-1.5 text-xs text-gray-500">Bisa upload beberapa foto pendukung</p>
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
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

@endsection