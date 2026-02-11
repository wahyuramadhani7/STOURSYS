@extends('backend.layouts.app')

@section('title', 'Edit Informasi Daerah')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a>
    <span class="separator">/</span>
    <a href="{{ route('admin.panduan.index') }}" class="hover:text-orange-600">Informasi Daerah</a>
    <span class="separator">/</span>
    <span class="text-gray-700 font-medium">Edit: {{ Str::limit($panduan->judul, 30) }}</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="relative overflow-hidden bg-gradient-to-r from-teal-50 via-teal-100 to-cyan-50 rounded-3xl p-8 border border-teal-200/50 shadow-xl">
        <div class="relative z-10">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent mb-2">
                Edit Informasi Daerah
            </h1>
            <p class="text-gray-600">{{ $panduan->judul }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form method="POST" action="{{ route('admin.panduan.update', $panduan->id) }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama / Judul Informasi <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $panduan->judul) }}" 
                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" required>
                    @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" required>
                        <option value="hotel" {{ old('kategori', $panduan->kategori) == 'hotel' ? 'selected' : '' }}>Hotel / Penginapan</option>
                        <option value="pemerintahan" {{ old('kategori', $panduan->kategori) == 'pemerintahan' ? 'selected' : '' }}>Pemerintahan (BPBD, Dinas, dll)</option>
                        <option value="rumah_sakit" {{ old('kategori', $panduan->kategori) == 'rumah_sakit' ? 'selected' : '' }}>Rumah Sakit / Kesehatan</option>
                        <option value="darurat" {{ old('kategori', $panduan->kategori) == 'darurat' ? 'selected' : '' }}>Layanan Darurat</option>
                        <option value="lainnya" {{ old('kategori', $panduan->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Isi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi / Isi <span class="text-red-500">*</span></label>
                    <textarea name="isi" rows="8" 
                              class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all" required>{{ old('isi', $panduan->isi) }}</textarea>
                    @error('isi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat & Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $panduan->alamat) }}" 
                               class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all">
                        @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kontak (Telp / WA / Email)</label>
                        <input type="text" name="kontak" value="{{ old('kontak', $panduan->kontak) }}" 
                               class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all">
                        @error('kontak') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Website -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Website / Link Resmi</label>
                    <input type="url" name="website" value="{{ old('website', $panduan->website) }}" 
                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all">
                    @error('website') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Gambar Preview + Upload Baru -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Sampul Saat Ini</label>
                        @if($panduan->gambar)
                            <div class="relative group/img inline-block">
                                <img src="{{ Storage::url($panduan->gambar) }}" alt="{{ $panduan->judul }}" 
                                     class="h-32 w-32 object-cover rounded-xl border-2 border-teal-200 shadow-md group-hover/img:scale-105 transition-transform">
                                <div class="absolute inset-0 bg-teal-600/20 rounded-xl opacity-0 group-hover/img:opacity-100 transition-opacity"></div>
                            </div>
                        @else
                            <div class="h-32 w-32 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-gray-200">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Gambar (opsional)</label>
                        <input type="file" name="gambar" accept="image/*" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                        @error('gambar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col justify-between">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampil</label>
                            <input type="number" name="urutan" value="{{ old('urutan', $panduan->urutan) }}" min="0" 
                                   class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 shadow-sm transition-all">
                            @error('urutan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $panduan->is_active ? 1 : 0) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-teal-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Aktifkan Informasi</span>
                            </label>
                        </div>
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
                        Update Informasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection