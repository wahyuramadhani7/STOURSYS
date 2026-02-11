@extends('backend.layouts.app')

@section('title', 'Tambah Informasi Daerah Baru')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a>
    <span class="separator">/</span>
    <a href="{{ route('admin.panduan.index') }}" class="hover:text-orange-600">Informasi Daerah</a>
    <span class="separator">/</span>
    <span class="text-gray-700 font-medium">Tambah Baru</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="relative overflow-hidden bg-gradient-to-r from-teal-50 via-teal-100 to-cyan-50 rounded-3xl p-8 border border-teal-200/50 shadow-xl">
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%">
                <pattern id="pattern-add" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="currentColor" class="text-teal-600"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#pattern-add)"/>
            </svg>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent mb-2">
                Tambah Informasi Daerah Baru
            </h1>
            <p class="text-gray-600">Masukkan data hotel, BPBD, rumah sakit, layanan darurat, atau lainnya</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form method="POST" action="{{ route('admin.panduan.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama / Judul Informasi <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" 
                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" 
                           placeholder="Contoh: RSUP Dr. Kariadi" required>
                    @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" required>
                        <option value="">Pilih Kategori</option>
                        <option value="hotel" {{ old('kategori') == 'hotel' ? 'selected' : '' }}>Hotel / Penginapan</option>
                        <option value="pemerintahan" {{ old('kategori') == 'pemerintahan' ? 'selected' : '' }}>Pemerintahan (BPBD, Dinas, dll)</option>
                        <option value="rumah_sakit" {{ old('kategori') == 'rumah_sakit' ? 'selected' : '' }}>Rumah Sakit / Kesehatan</option>
                        <option value="darurat" {{ old('kategori') == 'darurat' ? 'selected' : '' }}>Layanan Darurat</option>
                        <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Isi / Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi / Isi <span class="text-red-500">*</span></label>
                    <textarea name="isi" rows="8" 
                              class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" 
                              placeholder="Masukkan deskripsi lengkap, tips wisatawan, jam operasional, dll..." required>{{ old('isi') }}</textarea>
                    @error('isi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    <!-- Jika pakai Trix/CKEditor, ganti textarea dengan komponen editor di sini -->
                </div>

                <!-- Alamat & Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}" 
                               class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" 
                               placeholder="Jl. Dr. Sutomo No.16, Semarang">
                        @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kontak (Telp / WA / Email)</label>
                        <input type="text" name="kontak" value="{{ old('kontak') }}" 
                               class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" 
                               placeholder="(024) 8413476 | WA 0812-3456-7890">
                        @error('kontak') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Website - PERBAIKAN UTAMA -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Website / Link Resmi</label>
                    <input type="text" name="website" value="{{ old('website') }}" 
                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" 
                           placeholder="Contoh: rsupkariadi.co.id atau https://rsupkariadi.co.id">
                    <p class="mt-2 text-xs text-gray-500 italic">
                        Boleh tanpa https:// (contoh: rsupkariadi.co.id). Sistem akan otomatis tambahkan https:// jika perlu.
                    </p>
                    @error('website') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Gambar & Urutan & Status -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Sampul</label>
                        <input type="file" name="gambar" accept="image/*" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 shadow-sm transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                        @error('gambar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampil</label>
                        <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0" 
                               class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all">
                        @error('urutan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-teal-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700">Aktifkan Informasi</span>
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.panduan.index') }}" 
                       class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-all font-medium">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-xl hover:from-teal-600 hover:to-teal-700 transition-all font-semibold shadow-lg hover:shadow-xl">
                        Simpan Informasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Otomatis tambah https:// jika user tidak ketik protokol
    document.addEventListener('DOMContentLoaded', function() {
        const websiteInput = document.querySelector('input[name="website"]');
        if (websiteInput) {
            websiteInput.addEventListener('blur', function() {
                let val = this.value.trim();
                if (val && !val.match(/^https?:\/\//i) && val.match(/^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}/)) {
                    this.value = 'https://' + val;
                }
            });
        }
    });
</script>
@endpush
@endsection