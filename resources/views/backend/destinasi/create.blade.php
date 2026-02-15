@extends('backend.layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-9">
            
            <div class="page-header mb-4">
                <h2 class="page-title">Tambah Destinasi Baru</h2>
                <p class="page-subtitle">Lengkapi informasi destinasi wisata kawasan Borobudur dengan lengkap dan akurat</p>
            </div>

            <form action="{{ route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Informasi Dasar -->
                <div class="form-card mb-4">
                    <div class="form-card-header">
                        <h5>📋 Informasi Dasar</h5>
                    </div>
                    <div class="form-card-body">
                        
                        <div class="form-group-custom">
                            <label>Nama Destinasi <span class="required">*</span></label>
                            <input type="text" name="nama" 
                                   class="input-custom @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama') }}" 
                                   placeholder="Contoh: Candi Borobudur, Balkondes Karangrejo, Punthuk Setumbu, Soto & Kopi Mbah Kromo, Restoran Griya Rasa" 
                                   required autofocus>
                            @error('nama')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group-custom">
                            <label>Kategori <span class="required">*</span></label>
                            <select name="kategori" id="kategori-select"
                                    class="input-custom @error('kategori') is-invalid @enderror" 
                                    required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="candi" {{ old('kategori') == 'candi' ? 'selected' : '' }}>Destinasi Candi</option>
                                <option value="balkondes" {{ old('kategori') == 'balkondes' ? 'selected' : '' }}>Balkondes</option>
                                <option value="kuliner" data-type="kuliner" 
                                        {{ old('kategori') == 'kuliner' && old('sub_kategori') != 'restoran' ? 'selected' : '' }}>
                                    Kuliner (warung, jajanan, street food, angkringan, sate klathak, dll)
                                </option>
                                <option value="kuliner" data-type="restoran" 
                                        {{ old('kategori') == 'kuliner' && old('sub_kategori') == 'restoran' ? 'selected' : '' }}>
                                    Restoran / Cafe (duduk nyaman, AC, pelayanan meja, resto keluarga, coffee shop, dll)
                                </option>
                                <option value="alam" {{ old('kategori') == 'alam' ? 'selected' : '' }}>Destinasi Alam</option>
                                <option value="budaya" {{ old('kategori') == 'budaya' ? 'selected' : '' }}>Kesenian dan Budaya</option>
                                <option value="religi" {{ old('kategori') == 'religi' ? 'selected' : '' }}>Destinasi Religi</option>
                                <option value="desa_wisata" {{ old('kategori') == 'desa_wisata' ? 'selected' : '' }}>Desa Wisata</option>
                                <option value="wisata_edukasi" {{ old('kategori') == 'wisata_edukasi' ? 'selected' : '' }}>Wisata Edukasi</option>
                            </select>
                            @error('kategori')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                            @error('sub_kategori')
                                <span class="error-message d-block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Hidden field untuk membedakan kuliner vs restoran -->
                        <input type="hidden" name="sub_kategori" id="sub_kategori" value="{{ old('sub_kategori', '') }}">

                        <div class="form-group-custom mt-3" id="info-kuliner-type" style="display: none; font-size: 0.9rem; color: #4b5563;">
                            <div class="alert alert-info mb-0 py-2">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong id="kuliner-type-title">Anda memilih kategori Kuliner</strong><br>
                                <span id="kuliner-type-text">Pilih tipe di atas untuk menentukan apakah ini warung/street food atau restoran/cafe.</span>
                            </div>
                        </div>

                        <div class="form-group-custom mt-4">
                            <label>Deskripsi <span class="required">*</span></label>
                            <textarea name="deskripsi" 
                                      class="input-custom @error('deskripsi') is-invalid @enderror" 
                                      rows="6" 
                                      placeholder="Deskripsi utama destinasi. Ideal 100–400 karakter untuk tampilan daftar & SEO.&#10;Contoh kuliner warung: Menyajikan sate klathak empuk, kopi robusta lokal, wedang ronde hangat dengan view sawah.&#10;Contoh restoran: Restoran dengan view sawah/gunung, menu Indonesia & western, ruangan ber-AC, cocok untuk keluarga." 
                                      required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Jam Operasional & Fasilitas -->
                <div class="form-card mb-4">
                    <div class="form-card-header">
                        <h5>⏰ Jam Operasional & Fasilitas</h5>
                    </div>
                    <div class="form-card-body">
                        
                        <div class="form-group-custom">
                            <label>Jam Operasional <small class="text-muted">(sangat disarankan)</small></label>
                            <input type="text" name="jam_operasional" 
                                   class="input-custom @error('jam_operasional') is-invalid @enderror" 
                                   value="{{ old('jam_operasional') }}" 
                                   placeholder="Contoh: Setiap hari 06:00 - 17:00 WIB | Loket tutup 16:30 | Jumat malam sampai 22:00">
                            <small class="input-hint">Bisa berbeda per hari/musim (misal: Naik Candi pukul 04:30–09:00)</small>
                            @error('jam_operasional')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group-custom">
                            <label>Fasilitas yang Tersedia <small class="text-muted">(centang yang ada, tambah jika perlu)</small></label>
                            
                            <div class="checkbox-grid mt-2">
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
                                @endphp

                                @foreach($daftarFasilitas as $fas)
                                    <label class="checkbox-custom d-flex align-items-center">
                                        <input type="checkbox" name="fasilitas[]" value="{{ $fas }}"
                                            {{ in_array($fas, old('fasilitas', [])) ? 'checked' : '' }}>
                                        <span class="ms-2">{{ $fas }}</span>
                                    </label>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <div id="custom-fasilitas-list" class="d-flex flex-wrap gap-2 mb-3"></div>
                                
                                <div class="input-group">
                                    <input type="text" id="input-fasilitas-baru" class="form-control input-custom" 
                                           placeholder="Contoh: Rental sepeda, Drone spot, Toilet bayi, Pemandu bahasa Inggris, Menu vegan">
                                    <button type="button" class="btn btn-outline-primary" id="btn-tambah-fasilitas">Tambah</button>
                                </div>
                                
                                <input type="hidden" name="fasilitas_custom" id="fasilitas_custom_hidden">
                            </div>

                            <small class="input-hint mt-2 d-block">
                                Centang fasilitas yang tersedia. Tambahkan fasilitas khusus dengan mengetik lalu tekan "Tambah" atau Enter.
                            </small>

                            @error('fasilitas.*') <span class="error-message">{{ $message }}</span> @enderror
                            @error('fasilitas_custom') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                    </div>
                </div>

                <!-- Harga Tiket & Info -->
                <div class="form-card mb-4">
                    <div class="form-card-header">
                        <h5>💰 Harga Tiket & Catatan</h5>
                    </div>
                    <div class="form-card-body">
                        
                        <div class="form-group-custom">
                            <label>Harga Tiket / Kisaran Harga <small class="text-muted">(opsional)</small></label>
                            <input type="text" name="harga_tiket" 
                                   class="input-custom @error('harga_tiket') is-invalid @enderror" 
                                   value="{{ old('harga_tiket') }}" 
                                   placeholder="Contoh: Rp 15.000 – Rp 45.000 / porsi | Rp 35.000 – Rp 120.000 / orang | Gratis masuk">
                            <small class="input-hint d-block mt-1">
                                Tulis bebas termasuk catatan WNI/WNA, dewasa/anak, paket, harga minuman, dll.
                            </small>
                            @error('harga_tiket')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group-custom mt-4">
                            <label>Catatan Tambahan / Info Penting</label>
                            <textarea name="info_tiket" 
                                      class="input-custom @error('info_tiket') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Contoh: Harga belum termasuk minuman, Bisa pesan antar via GoFood/GrabFood, Open table reservasi via WA, Diskon pelajar 15%">{{ old('info_tiket') }}</textarea>
                            @error('info_tiket')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Lokasi -->
                <div class="form-card mb-4">
                    <div class="form-card-header">
                        <h5>📍 Lokasi</h5>
                    </div>
                    <div class="form-card-body">
                        <div class="form-group-custom">
                            <label>Alamat / Deskripsi Lokasi</label>
                            <input type="text" name="lokasi" 
                                   class="input-custom @error('lokasi') is-invalid @enderror" 
                                   value="{{ old('lokasi') }}" 
                                   placeholder="Contoh: Desa Borobudur, Kec. Borobudur, Kab. Magelang, Jawa Tengah 56553 (dekat pintu masuk Candi)">
                            <small class="input-hint">Sertakan desa/kecamatan/landmark terdekat jika perlu</small>
                            @error('lokasi')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Peta Embed -->
                <div class="form-card mb-4">
                    <div class="form-card-header">
                        <h5>🗺️ Peta Lokasi (Google Maps Embed)</h5>
                    </div>
                    <div class="form-card-body">
                        <div class="form-group-custom">
                            <label>Embed URL Google Maps (hanya bagian src)</label>
                            <input type="url" name="peta_embed" 
                                   class="input-custom @error('peta_embed') is-invalid @enderror" 
                                   value="{{ old('peta_embed') }}" 
                                   placeholder="https://www.google.com/maps/embed?pb=!1m18!...">
                            <small class="input-hint d-block mb-2">
                                Cara copy: Google Maps → Share → Embed a map → Copy src saja
                            </small>

                            @if(old('peta_embed'))
                                <div class="mt-3">
                                    <label>Preview:</label>
                                    <iframe class="w-100" height="300" style="border:0;" 
                                            loading="lazy" allowfullscreen 
                                            src="{{ old('peta_embed') }}"></iframe>
                                </div>
                            @endif

                            @error('peta_embed')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="form-card mb-4">
                    <div class="form-card-header">
                        <h5>🖼️ Gambar & Galeri</h5>
                    </div>
                    <div class="form-card-body">
                        
                        <div class="form-group-custom">
                            <label>Gambar Utama <span class="required">*</span></label>
                            <div class="upload-area">
                                <input type="file" name="gambar_utama" 
                                       class="file-input @error('gambar_utama') is-invalid @enderror" 
                                       accept="image/jpeg,image/png,image/jpg,image/webp"
                                       id="gambar_utama"
                                       onchange="previewImage(this, 'preview-utama')"
                                       required>
                                <label for="gambar_utama" class="upload-label">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    <span>Klik atau drag gambar utama</span>
                                    <small>JPG, PNG, WEBP • Maks. 2MB</small>
                                </label>
                            </div>
                            <div id="preview-utama" class="preview-box mt-3"></div>
                            @error('gambar_utama')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group-custom mt-5">
                            <label>Galeri Foto Tambahan <small class="text-muted">(opsional, maks 8–10 foto)</small></label>
                            <div class="upload-area">
                                <input type="file" name="galeri[]" 
                                       class="file-input" 
                                       multiple 
                                       accept="image/jpeg,image/png,image/jpg,image/webp"
                                       id="galeri"
                                       onchange="previewGallery(this)">
                                <label for="galeri" class="upload-label">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                    <span>Klik untuk upload beberapa foto</span>
                                    <small>Bisa pilih banyak • Maks. 2MB per foto</small>
                                </label>
                            </div>
                            <div id="preview-galeri" class="gallery-preview mt-3"></div>
                        </div>

                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="form-actions d-flex gap-3 justify-content-end mt-5">
                    <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary px-5 py-3">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-5 py-3">
                        <i class="fas fa-save me-2"></i> Simpan Destinasi
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<style>
    * { box-sizing: border-box; }

    .page-header { margin-bottom: 2.5rem; }
    .page-title { font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem; }
    .page-subtitle { font-size: 1rem; color: #6b7280; }

    .form-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .form-card-header {
        background: #f9fafb;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .form-card-header h5 { margin: 0; font-size: 1.125rem; font-weight: 600; }

    .form-card-body { padding: 1.5rem; }

    .form-group-custom { margin-bottom: 1.75rem; }
    .form-group-custom label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    .required { color: #ef4444; }

    .input-custom {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        border: 1.5px solid #d1d5db;
        border-radius: 8px;
        transition: all 0.2s;
    }
    .input-custom:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        outline: none;
    }
    .input-custom.is-invalid { border-color: #ef4444; }

    textarea.input-custom { resize: vertical; min-height: 100px; }

    .input-hint {
        font-size: 0.8rem;
        color: #6b7280;
        margin-top: 0.35rem;
        display: block;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 0.35rem;
        display: block;
    }

    .upload-area { position: relative; }
    .file-input { position: absolute; width: 1px; height: 1px; opacity: 0; }
    .upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 1.5rem;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.2s;
    }
    .upload-label:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .preview-box img, .gallery-preview img {
        max-width: 100%;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        margin-bottom: 0.75rem;
    }
    .gallery-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 1rem;
    }

    .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 0.9rem 1.5rem;
    }
    .checkbox-custom {
        cursor: pointer;
        font-size: 0.95rem;
    }
    .checkbox-custom input {
        margin-right: 0.6rem;
        accent-color: #3b82f6;
    }

    .custom-fasilitas-chip {
        background: #e5e7eb;
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .custom-fasilitas-chip button {
        background: none;
        border: none;
        color: #ef4444;
        font-weight: bold;
        font-size: 1.1rem;
        cursor: pointer;
        line-height: 1;
    }
    .custom-fasilitas-chip button:hover { color: #b91c1c; }

    .form-actions { margin-top: 2rem; }

    @media (max-width: 768px) {
        .form-actions { flex-direction: column-reverse; gap: 1rem; }
        .btn-primary, .btn-secondary { width: 100%; }
    }
</style>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    const file = input.files[0];
    
    if (!file) return;

    if (file.size > 2048000) {
        preview.innerHTML = '<div class="status error">File terlalu besar (maks 2MB)</div>';
        input.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = e => {
        preview.innerHTML = `
            <img src="${e.target.result}" alt="Preview">
            <div class="status success mt-2">✓ ${file.name}</div>
        `;
    };
    reader.readAsDataURL(file);
}

function previewGallery(input) {
    const preview = document.getElementById('preview-galeri');
    preview.innerHTML = '';

    Array.from(input.files).forEach((file, i) => {
        if (file.size > 2048000) {
            preview.innerHTML += `<div class="status error">❌ ${file.name} > 2MB</div>`;
            return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.innerHTML = `<img src="${e.target.result}" alt="Galeri ${i+1}">`;
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });

    if (input.files.length > 0) {
        const summary = document.createElement('div');
        summary.className = 'status success mt-3';
        summary.style.gridColumn = '1 / -1';
        summary.textContent = `✓ ${input.files.length} foto dipilih`;
        preview.appendChild(summary);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // ── Custom Fasilitas ──
    const btnTambah    = document.getElementById('btn-tambah-fasilitas');
    const inputBaru    = document.getElementById('input-fasilitas-baru');
    const listCustom   = document.getElementById('custom-fasilitas-list');
    const hiddenCustom = document.getElementById('fasilitas_custom_hidden');

    let customItems = [];

    function renderChips() {
        listCustom.innerHTML = '';
        customItems.forEach((text, idx) => {
            const chip = document.createElement('div');
            chip.className = 'custom-fasilitas-chip';
            chip.innerHTML = `
                ${text}
                <button type="button" data-idx="${idx}">×</button>
            `;
            listCustom.appendChild(chip);
        });
        hiddenCustom.value = customItems.join('|||');
    }

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

    @if(old('fasilitas_custom'))
        const oldCustom = "{{ old('fasilitas_custom') }}".split('|||').filter(Boolean);
        customItems = oldCustom;
        renderChips();
    @endif

    // ── Logika Kuliner vs Restoran ──
    const kategoriSelect = document.getElementById('kategori-select');
    const subKategori    = document.getElementById('sub_kategori');
    const infoBox        = document.getElementById('info-kuliner-type');
    const titleInfo      = document.getElementById('kuliner-type-title');
    const textInfo       = document.getElementById('kuliner-type-text');

    function updateKulinerType() {
        const selected = kategoriSelect.options[kategoriSelect.selectedIndex];
        
        if (selected && selected.value === 'kuliner') {
            infoBox.style.display = 'block';
            if (selected.dataset.type === 'restoran') {
                subKategori.value = 'restoran';
                titleInfo.textContent = 'Restoran / Cafe';
                textInfo.textContent = 'Tempat duduk nyaman, AC, pelayanan meja, cocok untuk keluarga atau makan santai.';
            } else {
                subKategori.value = 'kuliner';
                titleInfo.textContent = 'Kuliner (warung/jajanan)';
                textInfo.textContent = 'Warung, angkringan, street food, jajanan pasar, sate klathak, dll – biasanya lebih kasual & cepat saji.';
            }
        } else {
            infoBox.style.display = 'none';
            subKategori.value = '';
        }
    }

    // Jalankan saat halaman dimuat (penting untuk old input)
    updateKulinerType();

    // Update setiap kali kategori berubah
    kategoriSelect.addEventListener('change', updateKulinerType);
});
</script>
@endsection