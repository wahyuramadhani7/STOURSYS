@extends('backend.layouts.app')

@section('title', 'Tambah Informasi Daerah Baru')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--accent)] transition-colors">Dashboard</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <a href="{{ route('admin.panduan.index') }}" class="hover:text-[var(--accent)] transition-colors">Panduan</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <span class="text-[var(--text-2)] font-medium">Tambah Baru</span>
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">
                        Tambah Informasi Daerah Baru
                    </h1>
                    <p class="text-[var(--text-2)] mt-1">
                        Masukkan data hotel, BPBD, rumah sakit, layanan darurat, atau informasi penting lainnya
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
        <div class="p-8">
            <form method="POST" action="{{ route('admin.panduan.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Nama / Judul Informasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                           class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                  focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                  shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)]"
                           placeholder="Contoh: RSUP Dr. Kariadi" required>
                    @error('judul')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori"
                            class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                   focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                   shadow-sm transition-all text-[var(--text-1)]"
                            required>
                        <option value="">Pilih Kategori</option>
                        <option value="hotel"     {{ old('kategori') == 'hotel'     ? 'selected' : '' }}>Hotel / Penginapan</option>
                        <option value="pemerintahan" {{ old('kategori') == 'pemerintahan' ? 'selected' : '' }}>Pemerintahan (BPBD, Dinas, dll)</option>
                        <option value="rumah_sakit"  {{ old('kategori') == 'rumah_sakit'  ? 'selected' : '' }}>Rumah Sakit / Kesehatan</option>
                        <option value="darurat"      {{ old('kategori') == 'darurat'      ? 'selected' : '' }}>Layanan Darurat</option>
                        <option value="lainnya"      {{ old('kategori') == 'lainnya'      ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Isi / Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Deskripsi / Isi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="isi" rows="8"
                              class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                     focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                     shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)] resize-y"
                              placeholder="Masukkan deskripsi lengkap, tips wisatawan, jam operasional, fasilitas, dll..." required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat & Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Alamat Lengkap</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}"
                               class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                      focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                      shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)]"
                               placeholder="Jl. Dr. Sutomo No.16, Semarang">
                        @error('alamat')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Kontak (Telp / WA / Email)</label>
                        <input type="text" name="kontak" value="{{ old('kontak') }}"
                               class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                      focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                      shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)]"
                               placeholder="(024) 8413476 | WA 0812-3456-7890">
                        @error('kontak')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Website -->
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Website / Link Resmi</label>
                    <input type="text" name="website" value="{{ old('website') }}"
                           class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                  focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                  shadow-sm transition-all text-[var(--text-1)] placeholder-[var(--text-3)]"
                           placeholder="Contoh: rsupkariadi.co.id atau https://rsupkariadi.co.id">
                    <p class="mt-2 text-xs text-[var(--text-3)] italic">
                        Boleh tanpa https:// — sistem akan menambahkannya secara otomatis jika diperlukan.
                    </p>
                    @error('website')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar, Urutan, Status -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Gambar Sampul</label>
                        <input type="file" name="gambar" accept="image/*"
                               class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                      shadow-sm transition-all text-[var(--text-1)] file:mr-4 file:py-2 file:px-5 
                                      file:rounded-[var(--radius-sm)] file:border-0 file:text-sm file:font-medium 
                                      file:bg-[var(--accent-bg)] file:text-[var(--accent)] hover:file:bg-[var(--accent-bg)]/80">
                        @error('gambar')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Urutan Tampil</label>
                        <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                               class="w-full px-5 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                                      focus:ring-2 focus:ring-[var(--accent)] focus:border-[var(--accent-border)] 
                                      shadow-sm transition-all text-[var(--text-1)]">
                        @error('urutan')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center pt-6 md:pt-0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-[var(--border)] peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[var(--accent)]/30 rounded-full peer 
                                         peer-checked:after:translate-x-full peer-checked:after:border-white 
                                         after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white 
                                         after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all 
                                         peer-checked:bg-[var(--accent)]"></div>
                            <span class="ml-3 text-sm font-medium text-[var(--text-2)]">Aktifkan Informasi</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 pt-8 border-t border-[var(--border)]">
                    <a href="{{ route('admin.panduan.index') }}"
                       class="px-7 py-3 bg-[var(--bg)] text-[var(--text-2)] border border-[var(--border)] rounded-[var(--radius-sm)] 
                              hover:bg-[var(--accent-bg)] hover:border-[var(--accent-border)] transition-all font-medium text-center">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-[var(--accent)] text-white rounded-[var(--radius-sm)] 
                                   hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-sm)] 
                                   hover:shadow-[var(--shadow-md)] hover:scale-[1.02]">
                        Simpan Informasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
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