@extends('backend.layouts.app')

@section('title', 'Edit Event: ' . Str::limit($event->judul, 40))

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Card utama -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

            <!-- Header -->
            <div class="px-6 py-5 bg-gradient-to-r from-orange-600 to-orange-500 text-white">
                <h1 class="text-2xl sm:text-3xl font-bold">Edit Event</h1>
                <p class="mt-1 text-orange-100 text-sm sm:text-base">
                    {{ $event->judul }}
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.event.update', $event) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Judul -->
                    <div class="md:col-span-2">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Event <span class="text-red-500">*</span>
                        </label>
                        <input 
                            id="judul"
                            type="text" 
                            name="judul" 
                            value="{{ old('judul', $event->judul) }}" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm"
                            placeholder="Contoh: Festival Budaya Borobudur 2025"
                        >
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Event <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="deskripsi"
                            name="deskripsi" 
                            rows="7" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm"
                            placeholder="Jelaskan detail acara, rangkaian kegiatan, tiket (jika ada), dll...">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Mulai <span class="text-red-500">*</span>
                        </label>
                        <input 
                            id="tanggal_mulai"
                            type="date" 
                            name="tanggal_mulai" 
                            value="{{ old('tanggal_mulai', $event->tanggal_mulai?->format('Y-m-d')) }}" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                        >
                        @error('tanggal_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Selesai
                        </label>
                        <input 
                            id="tanggal_selesai"
                            type="date" 
                            name="tanggal_selesai" 
                            value="{{ old('tanggal_selesai', $event->tanggal_selesai?->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                        >
                        @error('tanggal_selesai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jam Mulai -->
                    <div>
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                        <input 
                            id="jam_mulai"
                            type="time" 
                            name="jam_mulai" 
                            value="{{ old('jam_mulai', $event->jam_mulai?->format('H:i')) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                        >
                        @error('jam_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jam Selesai -->
                    <div>
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                        <input 
                            id="jam_selesai"
                            type="time" 
                            name="jam_selesai" 
                            value="{{ old('jam_selesai', $event->jam_selesai?->format('H:i')) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                        >
                        @error('jam_selesai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="md:col-span-2">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi / Tempat</label>
                        <input 
                            id="lokasi"
                            type="text" 
                            name="lokasi" 
                            value="{{ old('lokasi', $event->lokasi) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                            placeholder="Contoh: Candi Borobudur, Magelang, Jawa Tengah"
                        >
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar Utama -->
                    <div>
                        <label for="gambar_utama" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama / Cover</label>

                        @if($event->gambar_utama)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2 font-medium">Gambar saat ini:</p>
                            <img 
                                src="{{ Storage::url($event->gambar_utama) }}" 
                                alt="Preview gambar utama" 
                                class="max-h-48 object-cover rounded-lg shadow-md border border-gray-200"
                            >
                        </div>
                        @endif

                        <input 
                            id="gambar_utama"
                            type="file" 
                            name="gambar_utama" 
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition shadow-sm"
                        >
                        <p class="mt-1.5 text-xs text-gray-500">Upload baru untuk mengganti • Maks 3 MB</p>
                        @error('gambar_utama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Galeri -->
                    <div>
                        <label for="galeri" class="block text-sm font-medium text-gray-700 mb-2">Tambah Foto Galeri</label>

                        @if($event->galeri && count($event->galeri) > 0)
                        <div class="mb-5">
                            <p class="text-sm text-gray-600 mb-3 font-medium">Galeri saat ini:</p>
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                                @foreach($event->galeri as $path)
                                    <div class="relative group">
                                        <img 
                                            src="{{ Storage::url($path) }}" 
                                            alt="Foto galeri" 
                                            class="w-full h-28 object-cover rounded-lg shadow-sm border border-gray-200 transition group-hover:scale-105"
                                        >
                                        <!-- Optional: tombol hapus per foto (jika sudah ada fitur deleteGalleryImage) -->
                                        <!-- <button type="button" class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition">Hapus</button> -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <input 
                            id="galeri"
                            type="file" 
                            name="galeri[]" 
                            accept="image/*" 
                            multiple
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition shadow-sm"
                        >
                        <p class="mt-1.5 text-xs text-gray-500">Foto baru akan ditambahkan (foto lama tetap ada)</p>
                        @error('galeri.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ============================================= -->
                    <!-- Bagian Recurring / Event Rutin -->
                    <!-- ============================================= -->
                    <div class="md:col-span-2 mt-6 border-t border-gray-200 pt-6">
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="is_recurring" 
                                name="is_recurring" 
                                value="1"
                                {{ old('is_recurring', $event->is_recurring) ? 'checked' : '' }}
                                class="h-5 w-5 text-orange-600 focus:ring-orange-500 border-gray-300 rounded"
                            >
                            <label for="is_recurring" class="ml-3 text-lg font-medium text-gray-900">
                                Jadikan event ini rutin / berulang
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">
                            Centang jika event ini berulang (misal tiap tahun, tiap bulan, dll). Mengubah status ini akan mempengaruhi tampilan di frontend.
                        </p>
                    </div>

                    <!-- Field recurring (hidden awalnya) -->
                    <div id="recurring-fields" class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6" style="display: {{ old('is_recurring', $event->is_recurring) ? 'grid' : 'none' }};">

                        <!-- Tipe Pengulangan -->
                        <div>
                            <label for="recurrence_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipe Pengulangan <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="recurrence_type" 
                                name="recurrence_type" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                            >
                                <option value="" {{ old('recurrence_type', $event->recurrence_type) ? '' : 'selected' }}>Pilih tipe...</option>
                                <option value="daily"   {{ old('recurrence_type', $event->recurrence_type) == 'daily'   ? 'selected' : '' }}>Harian</option>
                                <option value="weekly"  {{ old('recurrence_type', $event->recurrence_type) == 'weekly'  ? 'selected' : '' }}>Mingguan</option>
                                <option value="monthly" {{ old('recurrence_type', $event->recurrence_type) == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                                <option value="yearly"  {{ old('recurrence_type', $event->recurrence_type) == 'yearly'  ? 'selected' : '' }}>Tahunan</option>
                            </select>
                            @error('recurrence_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Interval -->
                        <div>
                            <label for="recurrence_interval" class="block text-sm font-medium text-gray-700 mb-2">
                                Setiap berapa kali <span class="text-red-500">*</span>
                            </label>
                            <input 
                                id="recurrence_interval" 
                                type="number" 
                                name="recurrence_interval" 
                                min="1" 
                                value="{{ old('recurrence_interval', $event->recurrence_interval ?? 1) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                                placeholder="1 = setiap minggu/bulan/tahun"
                            >
                            @error('recurrence_interval')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Berakhir (opsional) -->
                        <div>
                            <label for="recurrence_end_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Berakhir pada
                            </label>
                            <input 
                                id="recurrence_end_date" 
                                type="date" 
                                name="recurrence_end_date" 
                                value="{{ old('recurrence_end_date', $event->recurrence_end_date?->format('Y-m-d')) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 shadow-sm"
                            >
                            <p class="mt-1 text-xs text-gray-500">Kosongkan jika berulang selamanya</p>
                            @error('recurrence_end_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>

                <!-- Tombol -->
                <div class="mt-10 flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('admin.event.index') }}"
                       class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition text-center shadow-sm">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                        Update Event
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('is_recurring');
        const fields = document.getElementById('recurring-fields');

        function toggleRecurring() {
            fields.style.display = checkbox.checked ? 'grid' : 'none';
        }

        checkbox.addEventListener('change', toggleRecurring);
        // Jalankan sekali saat load
        toggleRecurring();
    });
</script>
@endsection