@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Destinasi Baru</h3>
                </div>

                <form action="{{ route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Destinasi <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama') }}" placeholder="Contoh: Pantai Kuta" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                                          rows="4" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Deskripsi Panjang</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi_panjang" class="form-control @error('deskripsi_panjang') is-invalid @enderror" 
                                          rows="8">{{ old('deskripsi_panjang') }}</textarea>
                                <small class="form-text text-muted">Bisa menggunakan HTML sederhana jika diperlukan</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Lokasi</label>
                            <div class="col-sm-10">
                                <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" 
                                       value="{{ old('lokasi') }}" placeholder="Contoh: Kuta, Bali">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Koordinat</label>
                            <div class="col-sm-5">
                                <input type="number" step="any" name="latitude" class="form-control @error('latitude') is-invalid @enderror" 
                                       value="{{ old('latitude') }}" placeholder="Latitude (misal: -8.509294)">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-5">
                                <input type="number" step="any" name="longitude" class="form-control @error('longitude') is-invalid @enderror" 
                                       value="{{ old('longitude') }}" placeholder="Longitude (misal: 115.262271)">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Gambar Utama</label>
                            <div class="col-sm-10">
                                <input type="file" name="gambar_utama" class="form-control-file @error('gambar_utama') is-invalid @enderror" 
                                       accept="image/jpeg,image/png,image/jpg">
                                <small class="form-text text-muted">Ukuran maksimal 2MB (jpeg, png, jpg)</small>
                                @error('gambar_utama')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Galeri Foto</label>
                            <div class="col-sm-10">
                                <input type="file" name="galeri[]" class="form-control-file" multiple accept="image/jpeg,image/png,image/jpg">
                                <small class="form-text text-muted">Bisa upload banyak foto sekaligus (maks 2MB per foto)</small>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Destinasi</button>
                        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection