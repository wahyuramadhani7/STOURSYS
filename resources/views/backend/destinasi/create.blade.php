@extends('backend.layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-9">
            
            <!-- Header -->
            <div class="page-header mb-4">
                <h2 class="page-title">Tambah Destinasi Baru</h2>
                <p class="page-subtitle">Lengkapi informasi destinasi wisata dengan detail</p>
            </div>

            <form action="{{ route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Card Informasi Dasar -->
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
                                   placeholder="Masukkan nama destinasi" required>
                            @error('nama')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group-custom">
                            <label>Deskripsi Singkat <span class="required">*</span></label>
                            <textarea name="deskripsi" 
                                      class="input-custom @error('deskripsi') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Tulis deskripsi singkat yang menarik" 
                                      required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group-custom">
                            <label>Deskripsi Lengkap</label>
                            <textarea name="deskripsi_panjang" 
                                      class="input-custom @error('deskripsi_panjang') is-invalid @enderror" 
                                      rows="5" 
                                      placeholder="Ceritakan lebih detail tentang destinasi ini">{{ old('deskripsi_panjang') }}</textarea>
                            <small class="input-hint">Anda bisa menggunakan HTML sederhana</small>
                        </div>

                    </div>
                </div>

                <!-- Card Lokasi -->
                <div class="form-card mb-4">
                    <div class="form-card-header">
                        <h5>📍 Lokasi & Koordinat</h5>
                    </div>
                    <div class="form-card-body">
                        
                        <div class="form-group-custom">
                            <label>Alamat Lokasi</label>
                            <input type="text" name="lokasi" 
                                   class="input-custom @error('lokasi') is-invalid @enderror" 
                                   value="{{ old('lokasi') }}" 
                                   placeholder="Contoh: Kuta, Bali">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>Latitude</label>
                                    <input type="number" step="any" name="latitude" 
                                           class="input-custom @error('latitude') is-invalid @enderror" 
                                           value="{{ old('latitude') }}" 
                                           placeholder="-8.509294">
                                    @error('latitude')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>Longitude</label>
                                    <input type="number" step="any" name="longitude" 
                                           class="input-custom @error('longitude') is-invalid @enderror" 
                                           value="{{ old('longitude') }}" 
                                           placeholder="115.262271">
                                    @error('longitude')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Card Media -->
                <div class="form-card mb-4">
                    <div class="form-card-header">
                        <h5>🖼️ Gambar & Galeri</h5>
                    </div>
                    <div class="form-card-body">
                        
                        <div class="form-group-custom">
                            <label>Gambar Utama</label>
                            <div class="upload-area">
                                <input type="file" name="gambar_utama" 
                                       class="file-input @error('gambar_utama') is-invalid @enderror" 
                                       accept="image/jpeg,image/png,image/jpg"
                                       id="gambar_utama"
                                       onchange="previewImage(this, 'preview-utama')">
                                <label for="gambar_utama" class="upload-label">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    <span>Klik untuk upload gambar utama</span>
                                    <small>JPG, PNG atau JPEG (Max. 2MB)</small>
                                </label>
                            </div>
                            
                            <div id="preview-utama" class="preview-box"></div>
                            
                            @error('gambar_utama')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group-custom">
                            <label>Galeri Foto</label>
                            <div class="upload-area">
                                <input type="file" name="galeri[]" 
                                       class="file-input" 
                                       multiple 
                                       accept="image/jpeg,image/png,image/jpg"
                                       id="galeri"
                                       onchange="previewGallery(this)">
                                <label for="galeri" class="upload-label">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                    <span>Klik untuk upload beberapa foto</span>
                                    <small>Bisa pilih banyak foto sekaligus (Max. 2MB per foto)</small>
                                </label>
                            </div>
                            
                            <div id="preview-galeri" class="gallery-preview"></div>
                        </div>

                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <a href="{{ route('admin.destinasi.index') }}" class="btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        Simpan Destinasi
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<style>
* {
    box-sizing: border-box;
}

.page-header {
    margin-bottom: 2rem;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 8px 0;
}

.page-subtitle {
    font-size: 15px;
    color: #6b7280;
    margin: 0;
}

.form-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
}

.form-card-header {
    background: #f9fafb;
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
}

.form-card-header h5 {
    margin: 0;
    font-size: 17px;
    font-weight: 600;
    color: #1f2937;
}

.form-card-body {
    padding: 24px;
}

.form-group-custom {
    margin-bottom: 24px;
}

.form-group-custom:last-child {
    margin-bottom: 0;
}

.form-group-custom label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.required {
    color: #ef4444;
}

.input-custom {
    width: 100%;
    padding: 12px 16px;
    font-size: 15px;
    color: #1f2937;
    background: #ffffff;
    border: 1.5px solid #d1d5db;
    border-radius: 8px;
    transition: all 0.2s;
}

.input-custom:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.input-custom.is-invalid {
    border-color: #ef4444;
}

.input-custom::placeholder {
    color: #9ca3af;
}

textarea.input-custom {
    resize: vertical;
    font-family: inherit;
    line-height: 1.6;
}

.input-hint {
    display: block;
    margin-top: 6px;
    font-size: 13px;
    color: #6b7280;
}

.error-message {
    display: block;
    margin-top: 6px;
    font-size: 13px;
    color: #ef4444;
}

.upload-area {
    position: relative;
}

.file-input {
    position: absolute;
    width: 1px;
    height: 1px;
    opacity: 0;
    overflow: hidden;
}

.upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    background: #f9fafb;
    cursor: pointer;
    transition: all 0.2s;
    margin: 0;
}

.upload-label:hover {
    border-color: #3b82f6;
    background: #eff6ff;
}

.upload-label svg {
    color: #9ca3af;
    margin-bottom: 12px;
}

.upload-label span {
    font-size: 15px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 4px;
}

.upload-label small {
    font-size: 13px;
    color: #6b7280;
}

.preview-box {
    margin-top: 12px;
}

.preview-box img {
    max-width: 300px;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
}

.preview-box .status {
    display: inline-block;
    padding: 6px 12px;
    margin-top: 8px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
}

.preview-box .status.success {
    background: #dcfce7;
    color: #166534;
}

.preview-box .status.error {
    background: #fee2e2;
    color: #991b1b;
}

.gallery-preview {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 12px;
    margin-top: 12px;
}

.gallery-preview img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
}

.form-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    padding-top: 8px;
}

.btn-primary,
.btn-secondary {
    padding: 12px 32px;
    font-size: 15px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: #3b82f6;
    color: #ffffff;
}

.btn-primary:hover {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-secondary {
    background: #ffffff;
    color: #374151;
    border: 1.5px solid #d1d5db;
}

.btn-secondary:hover {
    background: #f9fafb;
    border-color: #9ca3af;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 24px;
    }
    
    .form-card-body {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column-reverse;
    }
    
    .btn-primary,
    .btn-secondary {
        width: 100%;
        text-align: center;
    }
}
</style>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];
    
    if (file) {
        // Cek ukuran
        if (file.size > 2048000) {
            preview.innerHTML = '<div class="status error">❌ Gagal: Ukuran file melebihi 2MB</div>';
            input.value = '';
            return;
        }
        
        // Preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview">
                <div class="status success">✅ ${file.name} siap diupload</div>
            `;
        }
        reader.readAsDataURL(file);
    }
}

function previewGallery(input) {
    const preview = document.getElementById('preview-galeri');
    preview.innerHTML = '';
    
    Array.from(input.files).forEach(file => {
        if (file.size > 2048000) {
            preview.innerHTML += `<div class="status error">❌ ${file.name} melebihi 2MB</div>`;
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
    
    if (input.files.length > 0) {
        preview.innerHTML += `<div class="status success" style="grid-column: 1/-1;">✅ ${input.files.length} foto siap diupload</div>`;
    }
}
</script>
@endsection