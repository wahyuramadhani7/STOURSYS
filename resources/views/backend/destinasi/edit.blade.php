@extends('backend.layouts.app')

@section('title', 'Edit Destinasi')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--accent)] transition-colors">Dashboard</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <a href="{{ route('admin.destinasi.index') }}" class="hover:text-[var(--accent)] transition-colors">Destinasi</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <span class="text-[var(--text-1)] font-medium">Edit {{ $destinasi->nama }}</span>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[var(--accent-bg)] to-[var(--surface)] rounded-[var(--radius)] p-8 border border-[var(--accent-border)] shadow-[var(--shadow-md)]">
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-[var(--accent)]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-[var(--accent-light)]/15 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex items-start gap-5">
                <div class="bg-[var(--accent)] p-4 rounded-[var(--radius-sm)] shadow-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">Edit Destinasi: {{ $destinasi->nama }}</h1>
                    <p class="text-[var(--text-2)] mt-2">Perbarui informasi dengan data terbaru dan akurat</p>

                    <div class="mt-4 inline-flex items-center gap-2 bg-[var(--accent-bg)]/70 px-4 py-2 rounded-[var(--radius-sm)] border border-[var(--accent-border)]/50">
                        <svg class="w-5 h-5 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-[var(--text-2)]">Pastikan semua field penting tetap terisi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.destinasi.update', $destinasi) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PATCH')

        <!-- 1. Informasi Dasar -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
            <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
                <h5 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <span class="text-2xl">📋</span> Informasi Dasar
                </h5>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Nama Destinasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama"
                           class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('nama') border-red-500 @enderror"
                           value="{{ old('nama', $destinasi->nama) }}" placeholder="Contoh: Candi Borobudur, Sate Klathak Pak Pong" required autofocus>
                    @error('nama') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori" id="kategori-select"
                            class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('kategori') border-red-500 @enderror"
                            required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="candi" {{ old('kategori', $destinasi->kategori) == 'candi' ? 'selected' : '' }}>Destinasi Candi</option>
                        <option value="balkondes" {{ old('kategori', $destinasi->kategori) == 'balkondes' ? 'selected' : '' }}>Balkondes</option>
                        <option value="kuliner" data-type="kuliner" {{ old('kategori', $destinasi->kategori) == 'kuliner' && old('sub_kategori', $destinasi->sub_kategori ?? '') != 'restoran' ? 'selected' : '' }}>Kuliner (warung, street food, dll)</option>
                        <option value="kuliner" data-type="restoran" {{ old('kategori', $destinasi->kategori) == 'kuliner' && old('sub_kategori', $destinasi->sub_kategori ?? '') == 'restoran' ? 'selected' : '' }}>Restoran / Cafe</option>
                        <option value="alam" {{ old('kategori', $destinasi->kategori) == 'alam' ? 'selected' : '' }}>Destinasi Alam</option>
                        <option value="budaya" {{ old('kategori', $destinasi->kategori) == 'budaya' ? 'selected' : '' }}>Kesenian dan Budaya</option>
                        <option value="religi" {{ old('kategori', $destinasi->kategori) == 'religi' ? 'selected' : '' }}>Destinasi Religi</option>
                        <option value="desa_wisata" {{ old('kategori', $destinasi->kategori) == 'desa_wisata' ? 'selected' : '' }}>Desa Wisata</option>
                        <option value="wisata_edukasi" {{ old('kategori', $destinasi->kategori) == 'wisata_edukasi' ? 'selected' : '' }}>Wisata Edukasi</option>
                    </select>
                    @error('kategori') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

                    <div id="info-kuliner-type" class="mt-4 hidden">
                        <div class="bg-[var(--accent-bg)]/60 border border-[var(--accent-border)]/40 rounded-[var(--radius-sm)] p-5">
                            <div class="flex items-start gap-4">
                                <svg class="w-8 h-8 text-[var(--accent)] flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <strong id="kuliner-type-title" class="block text-[var(--text-1)]">Anda memilih Kuliner</strong>
                                    <span id="kuliner-type-text" class="text-sm text-[var(--text-2)]">Pilih tipe di atas untuk menentukan jenisnya.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="sub_kategori" id="sub_kategori" value="{{ old('sub_kategori', $destinasi->sub_kategori ?? '') }}">

                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="6"
                              class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('deskripsi') border-red-500 @enderror"
                              required>{{ old('deskripsi', $destinasi->deskripsi ?? '') }}</textarea>
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Ideal 100–400 karakter untuk tampilan daftar & SEO</small>
                    @error('deskripsi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- 2. Jam & Fasilitas -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
            <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
                <h5 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <span class="text-2xl">⏰</span> Jam Operasional & Fasilitas
                </h5>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Jam Operasional</label>
                    <input type="text" name="jam_operasional"
                           class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('jam_operasional') border-red-500 @enderror"
                           value="{{ old('jam_operasional', $destinasi->jam_operasional ?? '') }}"
                           placeholder="Contoh: Setiap hari 06:00–17:00 WIB | Sunrise tour 04:30">
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Sebutkan perbedaan hari/musim jika ada</small>
                    @error('jam_operasional') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-3">Fasilitas yang Tersedia</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @php
                            $daftarFasilitas = [
                                'Toilet bersih', 'Toilet difabel', 'Mushola / Tempat ibadah',
                                'Parkir luas', 'Parkir bus / kendaraan besar', 'Warung makan / Kafe',
                                'Makanan halal tersedia', 'Toko souvenir', 'Spot foto Instagramable',
                                'Area bermain anak', 'Akses kursi roda / difabel', 'WiFi gratis',
                                'Pemandu wisata tersedia', 'Homestay / Penginapan', 'Camping ground',
                                'Gazebo / Tempat duduk', 'Charging station', 'P3K / Klinik kesehatan',
                                'ATM / Money changer terdekat', 'Area parkir motor', 'Jalur sepeda',
                                'Pemandangan sunrise / sunset', 'Jalur trekking', 'Spot fotografi drone',
                                'Area piknik', 'Ruang kelas / workshop', 'Papan edukasi / informasi',
                                'Pusat informasi wisata', 'Koleksi artefak / museum mini',
                                'AC / Ruangan berpendingin', 'Live music', 'Pemesanan meja online',
                            ];
                            $fasilitasDb = json_decode($destinasi->fasilitas ?? '[]', true) ?? [];
                        @endphp

                        @foreach($daftarFasilitas as $fas)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="fasilitas[]" value="{{ $fas }}"
                                       class="w-5 h-5 text-[var(--accent)] border-[var(--border)] rounded focus:ring-[var(--accent)]/30"
                                       {{ in_array($fas, old('fasilitas', $fasilitasDb)) ? 'checked' : '' }}>
                                <span class="text-[var(--text-2)] group-hover:text-[var(--text-1)] transition-colors">{{ $fas }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-3">Fasilitas Khusus / Tambahan</label>
                        <div id="custom-fasilitas-list" class="flex flex-wrap gap-2 mb-4"></div>

                        <div class="flex gap-2">
                            <input type="text" id="input-fasilitas-baru"
                                   class="flex-1 px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20"
                                   placeholder="Contoh: Rental sepeda, Menu vegan, Pemandu bahasa Jepang">
                            <button type="button" id="btn-tambah-fasilitas"
                                    class="px-6 py-3 bg-[var(--accent)] text-white rounded-[var(--radius-sm)] hover:bg-[var(--accent-dark)] transition-all font-medium shadow-sm hover:shadow-md">
                                Tambah
                            </button>
                        </div>
                        <input type="hidden" name="fasilitas_custom" id="fasilitas_custom_hidden">
                        <small class="block mt-2 text-xs text-[var(--text-3)]">Tambahkan fasilitas yang tidak ada di daftar standar</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Harga & Catatan -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
            <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
                <h5 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <span class="text-2xl">💰</span> Harga Tiket & Catatan
                </h5>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Harga Tiket / Kisaran Harga</label>
                    <input type="text" name="harga_tiket"
                           class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('harga_tiket') border-red-500 @enderror"
                           value="{{ old('harga_tiket', $destinasi->harga_tiket ?? '') }}"
                           placeholder="Contoh: Rp 25.000 (WNI) | Rp 375.000 (WNA) | Paket sunrise Rp 150.000">
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Tulis bebas termasuk catatan WNI/WNA, paket, dll</small>
                    @error('harga_tiket') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Catatan Tambahan / Info Penting</label>
                    <textarea name="info_tiket" rows="4"
                              class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('info_tiket') border-red-500 @enderror"
                              >{{ old('info_tiket', $destinasi->info_tiket ?? '') }}</textarea>
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Informasi penting lain (reservasi, diskon, dll)</small>
                    @error('info_tiket') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- 4. Lokasi & Peta -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
            <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
                <h5 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <span class="text-2xl">📍</span> Lokasi & Peta
                </h5>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Alamat / Deskripsi Lokasi</label>
                    <input type="text" name="lokasi"
                           class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('lokasi') border-red-500 @enderror"
                           value="{{ old('lokasi', $destinasi->lokasi ?? '') }}"
                           placeholder="Contoh: Desa Borobudur, Kec. Borobudur, Kab. Magelang ...">
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Sertakan landmark terdekat</small>
                    @error('lokasi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">Embed URL Google Maps (src saja)</label>
                    <input type="url" name="peta_embed"
                           class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('peta_embed') border-red-500 @enderror"
                           value="{{ old('peta_embed', $destinasi->peta_embed ?? '') }}"
                           placeholder="https://www.google.com/maps/embed?pb=!1m18!...">
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Copy src="..." dari embed code</small>

                    @if(old('peta_embed', $destinasi->peta_embed ?? ''))
                        <div class="mt-4 rounded-[var(--radius-sm)] overflow-hidden border border-[var(--border)]">
                            <iframe class="w-full h-80" style="border:0;" loading="lazy" allowfullscreen src="{{ old('peta_embed', $destinasi->peta_embed) }}"></iframe>
                        </div>
                    @endif
                    @error('peta_embed') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- 5. Media -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
            <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
                <h5 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <span class="text-2xl">🖼️</span> Gambar & Galeri
                </h5>
            </div>
            <div class="p-6 space-y-8">
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-3">Gambar Utama Saat Ini</label>
                    @if($destinasi->gambar_utama_url)
                        <div class="mt-2 mb-4 rounded-[var(--radius-sm)] overflow-hidden border border-[var(--border)] shadow-sm">
                            <img src="{{ $destinasi->gambar_utama_url }}" alt="{{ $destinasi->nama }}"
                                 class="w-full h-64 object-cover">
                        </div>
                    @else
                        <p class="text-[var(--text-3)] text-sm">Belum ada gambar utama</p>
                    @endif

                    <label class="block text-sm font-semibold text-[var(--text-2)] mt-4 mb-2">Ganti Gambar Utama <span class="text-[var(--text-3)] font-normal">(opsional)</span></label>
                    <div class="relative">
                        <input type="file" name="gambar_utama" id="gambar_utama"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               onchange="previewImage(this, 'preview-utama')">
                        <label for="gambar_utama" class="block p-10 border-2 border-dashed border-[var(--border)] rounded-[var(--radius)] bg-[var(--bg)] text-center cursor-pointer hover:border-[var(--accent)] hover:bg-[var(--accent-bg)]/30 transition-all">
                            <svg class="w-12 h-12 mx-auto text-[var(--accent)]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="mt-4 text-[var(--text-2)]">Klik atau drag untuk mengganti</p>
                            <p class="text-xs text-[var(--text-3)] mt-1">Maks 2 MB • JPG/PNG/WEBP</p>
                        </label>
                    </div>
                    <div id="preview-utama" class="mt-4"></div>
                    @error('gambar_utama') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-3">Galeri Foto Saat Ini</label>
                    @php $galeri = json_decode($destinasi->galeri ?? '[]', true) ?? []; @endphp
                    @if(count($galeri) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-3">
                            @foreach($galeri as $path)
                                <div class="rounded-[var(--radius-sm)] overflow-hidden border border-[var(--border)] shadow-sm">
                                    <img src="{{ Storage::url($path) }}" alt="Galeri" class="w-full h-40 object-cover">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-[var(--text-3)] text-sm">Belum ada foto di galeri</p>
                    @endif

                    <label class="block text-sm font-semibold text-[var(--text-2)] mt-6 mb-2">Tambah Foto Baru ke Galeri <span class="text-[var(--text-3)] font-normal">(opsional – akan ditambahkan)</span></label>
                    <div class="relative">
                        <input type="file" name="galeri[]" id="galeri" multiple
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               onchange="previewGallery(this)">
                        <label for="galeri" class="block p-10 border-2 border-dashed border-[var(--border)] rounded-[var(--radius)] bg-[var(--bg)] text-center cursor-pointer hover:border-[var(--accent)] hover:bg-[var(--accent-bg)]/30 transition-all">
                            <svg class="w-12 h-12 mx-auto text-[var(--accent)]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-4 text-[var(--text-2)]">Klik untuk upload foto baru</p>
                            <p class="text-xs text-[var(--text-3)] mt-1">Bisa pilih banyak • Maks 2 MB/foto</p>
                        </label>
                    </div>
                    <div id="preview-galeri" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6"></div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6">
            <a href="{{ route('admin.destinasi.index') }}"
               class="px-8 py-3.5 border border-[var(--border)] text-[var(--text-2)] rounded-[var(--radius)] hover:bg-[var(--bg)] transition-all font-medium flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </a>
            <button type="submit"
                    class="px-8 py-3.5 bg-[var(--accent)] text-white rounded-[var(--radius)] hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Preview functions (sama seperti create)
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    if (!input.files?.[0]) return;

    const file = input.files[0];
    if (file.size > 2 * 1024 * 1024) {
        preview.innerHTML = '<p class="text-red-500 text-sm">File terlalu besar (maks 2 MB)</p>';
        input.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = e => {
        preview.innerHTML = `
            <div class="relative inline-block">
                <img src="${e.target.result}" class="max-h-64 rounded-[var(--radius-sm)] object-cover border border-[var(--border)]" alt="Preview">
                <p class="mt-2 text-xs text-green-600">✓ ${file.name}</p>
            </div>`;
    };
    reader.readAsDataURL(file);
}

function previewGallery(input) {
    const preview = document.getElementById('preview-galeri');
    preview.innerHTML = '';

    Array.from(input.files).forEach(file => {
        if (file.size > 2 * 1024 * 1024) {
            preview.innerHTML += `<p class="text-red-500 text-sm col-span-full">❌ ${file.name} > 2MB</p>`;
            return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-40 object-cover rounded-[var(--radius-sm)] border border-[var(--border)]" alt="Galeri">
            `;
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });

    if (input.files.length > 0) {
        const summary = document.createElement('div');
        summary.className = 'col-span-full text-sm text-green-600 mt-2';
        summary.textContent = `✓ ${input.files.length} foto baru dipilih (akan ditambahkan)`;
        preview.appendChild(summary);
    }
}

// Custom fasilitas & kuliner logic
document.addEventListener('DOMContentLoaded', () => {
    // Custom Fasilitas
    const btnTambah    = document.getElementById('btn-tambah-fasilitas');
    const inputBaru    = document.getElementById('input-fasilitas-baru');
    const listCustom   = document.getElementById('custom-fasilitas-list');
    const hiddenCustom = document.getElementById('fasilitas_custom_hidden');

    let customItems = @json($customFromDb ?? []);

    // Prioritaskan old jika ada error validasi
    @if(old('fasilitas_custom'))
        const oldCustom = "{{ old('fasilitas_custom') }}".split('|||').filter(v => v.trim());
        customItems = [...new Set([...customItems, ...oldCustom])];
    @endif

    function renderChips() {
        listCustom.innerHTML = '';
        customItems.forEach((text, idx) => {
            const chip = document.createElement('div');
            chip.className = 'inline-flex items-center gap-2 px-4 py-1.5 bg-[var(--accent-bg)] text-[var(--accent)] rounded-full text-sm border border-[var(--accent-border)]/50';
            chip.innerHTML = `
                ${text}
                <button type="button" data-idx="${idx}" class="text-red-500 hover:text-red-700 font-bold text-lg leading-none">×</button>
            `;
            listCustom.appendChild(chip);
        });
        hiddenCustom.value = customItems.join('|||');
    }

    renderChips();

    function tambahCustom() {
        const val = inputBaru.value.trim();
        if (!val || customItems.includes(val)) return;
        customItems.push(val);
        renderChips();
        inputBaru.value = '';
    }

    btnTambah.addEventListener('click', tambahCustom);
    inputBaru.addEventListener('keypress', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            tambahCustom();
        }
    });

    listCustom.addEventListener('click', e => {
        if (e.target.tagName === 'BUTTON') {
            const idx = parseInt(e.target.dataset.idx);
            customItems.splice(idx, 1);
            renderChips();
        }
    });

    // Kuliner logic
    const kategoriSelect = document.getElementById('kategori-select');
    const subKategori    = document.getElementById('sub_kategori');
    const infoBox        = document.getElementById('info-kuliner-type');
    const titleInfo      = document.getElementById('kuliner-type-title');
    const textInfo       = document.getElementById('kuliner-type-text');

    function updateKulinerType() {
        const opt = kategoriSelect.options[kategoriSelect.selectedIndex];
        if (opt?.value === 'kuliner') {
            infoBox.classList.remove('hidden');
            if (opt.dataset.type === 'restoran') {
                subKategori.value = 'restoran';
                titleInfo.textContent = 'Restoran / Cafe';
                textInfo.textContent = 'Tempat duduk nyaman, AC, pelayanan meja, cocok untuk keluarga atau makan santai.';
            } else {
                subKategori.value = 'kuliner';
                titleInfo.textContent = 'Kuliner (warung/jajanan)';
                textInfo.textContent = 'Warung, angkringan, street food, jajanan pasar, sate klathak, dll – biasanya lebih kasual & cepat saji.';
            }
        } else {
            infoBox.classList.add('hidden');
            subKategori.value = '';
        }
    }

    updateKulinerType(); // initial load dari data existing
    kategoriSelect.addEventListener('change', updateKulinerType);
});
</script>
@endpush
@endsection