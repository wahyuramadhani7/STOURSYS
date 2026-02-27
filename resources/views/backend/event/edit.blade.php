@extends('backend.layouts.app')

@section('title', 'Edit Event')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--accent)] transition-colors">Dashboard</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <a href="{{ route('admin.event.index') }}" class="hover:text-[var(--accent)] transition-colors">Event</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <span class="text-[var(--text-1)] font-medium">Edit {{ Str::limit($event->judul, 40) }}</span>
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
                    <h1 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">Edit Event</h1>
                    <p class="text-[var(--text-1)] font-semibold mt-1">{{ $event->judul }}</p>
                    <p class="text-[var(--text-2)] mt-2">Ubah informasi event dengan hati-hati. Perubahan akan langsung terlihat di halaman publik.</p>

                    <div class="mt-4 inline-flex items-center gap-2 bg-[var(--accent-bg)]/80 px-4 py-2 rounded-[var(--radius-sm)] border border-[var(--accent-border)]/50">
                        <svg class="w-5 h-5 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-[var(--text-2)]">Pastikan data tetap akurat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.event.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="eventForm">
        @csrf
        @method('PUT')

        <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
            <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
                <h5 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <span class="text-2xl">📅</span> Informasi Dasar Event
                </h5>
            </div>
            <div class="p-6 space-y-8">
                <!-- Pilihan Jenis Event -->
                <div class="mb-6">
                    <label class="block text-lg font-semibold text-[var(--text-1)] mb-4">
                        Jenis Event <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Event Akan Datang -->
                        <label class="relative flex flex-col p-6 border-2 rounded-[var(--radius)] cursor-pointer transition-all hover:border-[var(--accent)] hover:bg-[var(--accent-bg)]/20
                                      {{ old('event_type', $event->event_type ?? 'upcoming') === 'upcoming' ? 'border-[var(--accent)] bg-[var(--accent-bg)]/30' : 'border-[var(--border)] bg-[var(--bg)]' }}">
                            <input type="radio" name="event_type" value="upcoming" class="absolute inset-0 opacity-0" 
                                   {{ old('event_type', $event->event_type ?? 'upcoming') === 'upcoming' ? 'checked' : '' }} required>
                            <div class="text-xl font-semibold mb-2">Event yang Akan Datang / Sekali Pakai</div>
                            <p class="text-sm text-[var(--text-2)]">Event dengan tanggal dan jam tertentu (festival, pameran, konser, dll).</p>
                        </label>

                        <!-- Event Rutin -->
                        <label class="relative flex flex-col p-6 border-2 rounded-[var(--radius)] cursor-pointer transition-all hover:border-[var(--accent)] hover:bg-[var(--accent-bg)]/20
                                      {{ old('event_type', $event->event_type) === 'recurring' ? 'border-[var(--accent)] bg-[var(--accent-bg)]/30' : 'border-[var(--border)] bg-[var(--bg)]' }}">
                            <input type="radio" name="event_type" value="recurring" class="absolute inset-0 opacity-0" 
                                   {{ old('event_type', $event->event_type) === 'recurring' ? 'checked' : '' }}>
                            <div class="text-xl font-semibold mb-2">Event Rutin / Berulang</div>
                            <p class="text-sm text-[var(--text-2)]">Event yang berlangsung rutin (setiap minggu, tiap tanggal 1, setiap hari libur, dll).</p>
                        </label>
                    </div>
                    @error('event_type') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Judul Event <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul"
                           class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('judul') border-red-500 @enderror"
                           value="{{ old('judul', $event->judul) }}" placeholder="Contoh: Yoga Pagi di Candi Borobudur" required maxlength="150">
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Maksimal 150 karakter</small>
                    @error('judul') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Deskripsi Event <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="7"
                              class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('deskripsi') border-red-500 @enderror"
                              required>{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
                    @error('deskripsi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Section Tanggal & Jam (hanya untuk upcoming) -->
                <div id="date-time-section" class="{{ old('event_type', $event->event_type ?? 'upcoming') === 'recurring' ? 'hidden' : '' }} grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                            Tanggal Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                               class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('tanggal_mulai') border-red-500 @enderror"
                               value="{{ old('tanggal_mulai', $event->tanggal_mulai?->format('Y-m-d')) }}" required>
                        @error('tanggal_mulai') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                            Tanggal Selesai <span class="text-[var(--text-3)] font-normal">(opsional)</span>
                        </label>
                        <input type="date" name="tanggal_selesai"
                               class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('tanggal_selesai') border-red-500 @enderror"
                               value="{{ old('tanggal_selesai', $event->tanggal_selesai?->format('Y-m-d')) }}" min="{{ old('tanggal_mulai', $event->tanggal_mulai?->format('Y-m-d')) }}">
                        <small class="block mt-1.5 text-xs text-[var(--text-3)]">Kosongkan jika hanya 1 hari</small>
                        @error('tanggal_selesai') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                            Jam Mulai <span class="text-[var(--text-3)] font-normal">(opsional)</span>
                        </label>
                        <input type="time" name="jam_mulai"
                               class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('jam_mulai') border-red-500 @enderror"
                               value="{{ old('jam_mulai', $event->jam_mulai?->format('H:i')) }}">
                        @error('jam_mulai') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                            Jam Selesai <span class="text-[var(--text-3)] font-normal">(opsional)</span>
                        </label>
                        <input type="time" name="jam_selesai"
                               class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('jam_selesai') border-red-500 @enderror"
                               value="{{ old('jam_selesai', $event->jam_selesai?->format('H:i')) }}">
                        @error('jam_selesai') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Keterangan Jadwal Rutin (hanya untuk recurring) -->
                <div id="recurring-description-section" class="{{ old('event_type', $event->event_type) === 'recurring' ? '' : 'hidden' }}">
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Keterangan Jadwal Rutin <span class="text-red-500">*</span>
                    </label>
                    <textarea name="recurring_description" rows="5"
                              class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('recurring_description') border-red-500 @enderror"
                              placeholder="Contoh:&#10;• Setiap hari Minggu pukul 06.30 - 08.30 WIB&#10;• Setiap tanggal 1 dan 15 bulan berjalan pukul 07.00 - 09.00&#10;• Berlangsung hingga akhir 2026 (kecuali hari libur nasional)">{{ old('recurring_description', $event->recurring_description ?? '') }}</textarea>
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Jelaskan pola jadwal secara jelas agar pengunjung tahu kapan event berlangsung.</small>
                    @error('recurring_description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="block text-sm font-semibold text-[var(--text-2)] mb-2">
                        Lokasi / Tempat <span class="text-[var(--text-3)] font-normal">(sangat disarankan)</span>
                    </label>
                    <input type="text" name="lokasi"
                           class="w-full px-4 py-3 bg-[var(--bg)] border border-[var(--border)] rounded-[var(--radius-sm)] text-[var(--text-1)] placeholder-[var(--text-3)] focus:border-[var(--accent)] focus:ring-2 focus:ring-[var(--accent)]/20 @error('lokasi') border-red-500 @enderror"
                           value="{{ old('lokasi', $event->lokasi ?? '') }}" placeholder="Contoh: Zona 2 Candi Borobudur, Borobudur, Magelang">
                    <small class="block mt-1.5 text-xs text-[var(--text-3)]">Sebutkan area atau nama tempat spesifik</small>
                    @error('lokasi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Media -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
            <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
                <h5 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <span class="text-2xl">🖼️</span> Gambar & Galeri
                </h5>
            </div>
            <div class="p-6 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Gambar Utama -->
                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-3">
                            Ganti Gambar Utama / Cover <span class="text-[var(--text-3)] font-normal">(opsional)</span>
                        </label>

                        @if($event->gambar_utama)
                            <div class="mb-4 rounded-[var(--radius-sm)] overflow-hidden border border-[var(--border)] shadow-sm">
                                <img src="{{ Storage::url($event->gambar_utama) }}" alt="Gambar utama event"
                                     class="w-full h-64 object-cover">
                            </div>
                        @else
                            <p class="text-[var(--text-3)] text-sm mb-4">Belum ada gambar utama</p>
                        @endif

                        <div class="relative">
                            <input type="file" name="gambar_utama" id="gambar_utama"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                   accept="image/jpeg,image/png,image/jpg,image/webp"
                                   onchange="previewImage(this, 'preview-utama')">
                            <label for="gambar_utama" class="block p-10 border-2 border-dashed border-[var(--border)] rounded-[var(--radius)] bg-[var(--bg)] text-center cursor-pointer hover:border-[var(--accent)] hover:bg-[var(--accent-bg)]/30 transition-all">
                                <svg class="w-12 h-12 mx-auto text-[var(--accent)]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="mt-4 text-[var(--text-2)]">Klik atau drag untuk mengganti gambar utama</p>
                                <p class="text-xs text-[var(--text-3)] mt-1">Maks 3 MB • jpg, png, webp</p>
                            </label>
                        </div>
                        <div id="preview-utama" class="mt-4"></div>
                        @error('gambar_utama') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Galeri Tambahan -->
                    <div>
                        <label class="block text-sm font-semibold text-[var(--text-2)] mb-3">
                            Tambah Foto ke Galeri <span class="text-[var(--text-3)] font-normal">(opsional – akan ditambahkan)</span>
                        </label>

                        @if($event->galeri && count($event->galeri) > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-6">
                                @foreach($event->galeri as $path)
                                    <div class="relative group rounded-[var(--radius-sm)] overflow-hidden border border-[var(--border)] shadow-sm">
                                        <img src="{{ Storage::url($path) }}" alt="Foto galeri" class="w-full h-40 object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-[var(--text-3)] text-sm mb-4">Belum ada foto di galeri</p>
                        @endif

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
                                <p class="text-xs text-[var(--text-3)] mt-1">Foto lama tetap ada • Maks 2 MB/foto</p>
                            </label>
                        </div>
                        <div id="preview-galeri" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6">
            <a href="{{ route('admin.event.index') }}"
               class="px-8 py-3.5 border border-[var(--border)] text-[var(--text-2)] rounded-[var(--radius)] hover:bg-[var(--bg)] transition-all font-medium flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </a>
            <button type="submit"
                    class="px-10 py-3.5 bg-[var(--accent)] text-white rounded-[var(--radius)] hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update Event
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Preview Gambar Utama
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    if (!input.files?.[0]) return;

    const file = input.files[0];
    if (file.size > 3 * 1024 * 1024) {
        preview.innerHTML = '<p class="text-red-500 text-sm">File terlalu besar (maks 3 MB)</p>';
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

// Preview Galeri (foto baru yang akan ditambahkan)
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
                <img src="${e.target.result}" class="w-full h-40 object-cover rounded-[var(--radius-sm)] border border-[var(--border)]" alt="Galeri baru">
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

// Toggle section berdasarkan jenis event
document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="event_type"]');
    const dateSection = document.getElementById('date-time-section');
    const recurringDescSection = document.getElementById('recurring-description-section');
    const tanggalMulaiInput = document.getElementById('tanggal_mulai');

    function toggleSections() {
        const selectedValue = document.querySelector('input[name="event_type"]:checked')?.value;

        if (selectedValue === 'recurring') {
            dateSection.classList.add('hidden');
            recurringDescSection.classList.remove('hidden');

            // Nonaktifkan required pada tanggal mulai
            tanggalMulaiInput.removeAttribute('required');
        } else {
            dateSection.classList.remove('hidden');
            recurringDescSection.classList.add('hidden');

            // Aktifkan kembali required
            tanggalMulaiInput.setAttribute('required', 'required');
        }
    }

    radios.forEach(radio => {
        radio.addEventListener('change', toggleSections);
    });

    // Jalankan sekali di awal (penting untuk kondisi existing data)
    toggleSections();

    // Validasi sederhana sebelum submit
    document.getElementById('eventForm').addEventListener('submit', function(e) {
        const selected = document.querySelector('input[name="event_type"]:checked')?.value;

        if (!selected) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Mohon pilih jenis event terlebih dahulu.',
                confirmButtonText: 'OK'
            });
            return;
        }

        if (selected === 'recurring') {
            const desc = document.querySelector('textarea[name="recurring_description"]').value.trim();
            if (!desc) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Mohon isi keterangan jadwal rutin untuk event berulang.',
                    confirmButtonText: 'OK'
                });
            }
        } else if (selected === 'upcoming') {
            if (!document.getElementById('tanggal_mulai').value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Tanggal mulai wajib diisi untuk event yang akan datang.',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
});
</script>
@endpush
@endsection