@extends('backend.layouts.app')

@section('title', 'Daftar Event')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--accent)] transition-colors">Dashboard</a>
    <span class="separator mx-2 text-[var(--text-3)]">/</span>
    <span class="text-[var(--text-1)] font-medium">Event</span>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[var(--accent-bg)] to-[var(--surface)] rounded-[var(--radius)] p-8 border border-[var(--accent-border)] shadow-[var(--shadow-md)]">
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-[var(--accent)]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-[var(--accent-light)]/15 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="bg-[var(--accent)] p-4 rounded-[var(--radius-sm)] shadow-md">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-[var(--text-1)]">Daftar Event & Kegiatan</h1>
                        <p class="text-[var(--text-2)] mt-1">Kelola semua event dan kegiatan wisata di Kawasan Borobudur</p>
                    </div>
                </div>

                <a href="{{ route('admin.event.create') }}"
                   class="group relative inline-flex items-center gap-2 bg-[var(--accent)] text-white px-6 py-3 rounded-[var(--radius)] hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] hover:scale-[1.03] overflow-hidden">
                    <div class="absolute inset-0 bg-white/15 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    <svg class="w-5 h-5 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="relative z-10">Tambah Event Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Event -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] p-6 border border-[var(--border)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide">Total Event</p>
                    <p class="text-4xl font-black text-[var(--text-1)] mt-3 group-hover:text-[var(--accent)] transition-colors tabular-nums">
                        {{ $events->total() }}
                    </p>
                </div>
                <div class="bg-[var(--accent-bg)] p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Sedang Berlangsung -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] p-6 border border-[var(--border)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide">Sedang Berlangsung</p>
                    <p class="text-4xl font-black text-[var(--text-1)] mt-3 group-hover:text-green-600 transition-colors tabular-nums">
                        {{ $events->where('status', 'Sedang Berlangsung')->count() }}
                    </p>
                </div>
                <div class="bg-green-100/80 p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Akan Datang -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] p-6 border border-[var(--border)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide">Akan Datang</p>
                    <p class="text-4xl font-black text-[var(--text-1)] mt-3 group-hover:text-purple-600 transition-colors tabular-nums">
                        {{ $events->where('status', 'Akan Datang')->count() }}
                    </p>
                </div>
                <div class="bg-purple-100/80 p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Event Rutin -->
        <div class="bg-[var(--surface)] rounded-[var(--radius)] p-6 border border-[var(--border)] shadow-[var(--shadow-sm)] hover:shadow-[var(--shadow-md)] transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-[var(--text-3)] uppercase tracking-wide">Event Rutin</p>
                    <p class="text-4xl font-black text-[var(--text-1)] mt-3 group-hover:text-[var(--accent)] transition-colors tabular-nums">
                        {{ $events->where('event_type', 'recurring')->count() }}
                    </p>
                </div>
                <div class="bg-[var(--accent-bg)]/80 p-4 rounded-[var(--radius-sm)] group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-[var(--surface)] rounded-[var(--radius)] shadow-[var(--shadow-md)] border border-[var(--border)] overflow-hidden">
        <div class="bg-[var(--bg)] px-6 py-5 border-b border-[var(--border)]">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-xl font-bold text-[var(--text-1)] flex items-center gap-3">
                    <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Data Event & Kegiatan
                </h2>
                <div class="text-sm text-[var(--text-2)]">
                    Menampilkan <span class="font-bold text-[var(--accent)]">{{ $events->count() }}</span> dari {{ $events->total() }} event
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--border)]">
                <thead class="bg-[var(--bg)]">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Judul Event</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Tanggal / Jadwal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-[var(--text-3)] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] bg-[var(--surface)]">
                    @forelse ($events as $event)
                        <tr class="hover:bg-[var(--accent-bg)]/30 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="font-semibold text-[var(--text-1)] group-hover:text-[var(--accent)] transition-colors truncate max-w-xs">
                                    {{ $event->judul }}
                                </div>
                                <div class="text-xs text-[var(--text-3)] mt-1 truncate">{{ $event->slug ?? '—' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                @if($event->event_type === 'recurring')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[var(--accent-bg)] text-[var(--accent)] border border-[var(--accent-border)]/50 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        Rutin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 text-gray-700 border border-gray-300 text-xs font-semibold">
                                        Sekali Pakai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-[var(--text-2)]">
                                @if($event->event_type === 'recurring')
                                    <div class="text-sm font-medium text-amber-700">
                                        {{ $event->recurring_description ? Str::limit($event->recurring_description, 60) : '—' }}
                                    </div>
                                @else
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $event->tanggal_range }}</span>
                                        @if($event->jam_range !== '-')
                                            <span class="text-xs text-[var(--text-3)] mt-1">{{ $event->jam_range }}</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-[var(--text-2)]">
                                {{ $event->lokasi ?? '—' }}
                            </td>
                            <td class="px-6 py-5">
                                @if($event->status == 'Sedang Berlangsung')
                                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-green-100 text-green-800 border border-green-300 text-xs font-semibold">
                                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                        Sedang Berlangsung
                                    </span>
                                @elseif($event->status == 'Akan Datang')
                                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-purple-100 text-purple-800 border border-purple-300 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        Akan Datang
                                    </span>
                                @elseif($event->status == 'Telah Berakhir')
                                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-red-100 text-red-800 border border-red-300 text-xs font-semibold">
                                        Telah Berakhir
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-gray-100 text-gray-700 border border-gray-300 text-xs font-semibold">
                                        {{ $event->status ?? '—' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-3 flex-wrap">
                                    <a href="{{ route('admin.event.edit', $event) }}"
                                       class="group/btn relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-5 py-2.5 rounded-[var(--radius-sm)] text-sm font-semibold shadow-sm hover:shadow-md transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </div>
                                    </a>

                                    <button type="button"
                                            onclick="confirmDelete('{{ route('admin.event.destroy', $event) }}', '{{ addslashes($event->judul) }}')"
                                            class="group/btn relative bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-5 py-2.5 rounded-[var(--radius-sm)] text-sm font-semibold shadow-sm hover:shadow-md transition-all overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                        <div class="relative flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </div>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="inline-flex flex-col items-center">
                                    <div class="w-20 h-20 bg-[var(--accent-bg)] rounded-full flex items-center justify-center mb-6">
                                        <svg class="w-10 h-10 text-[var(--accent)]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-[var(--text-1)] mb-3">Belum ada event atau kegiatan</h3>
                                    <p class="text-[var(--text-2)] mb-8 max-w-md">Mulai tambahkan event pertama untuk kawasan wisata Borobudur</p>
                                    <a href="{{ route('admin.event.create') }}"
                                       class="inline-flex items-center gap-3 bg-[var(--accent)] text-white px-8 py-4 rounded-[var(--radius)] hover:bg-[var(--accent-dark)] transition-all font-semibold shadow-[var(--shadow-md)] hover:shadow-[var(--shadow-lg)] hover:scale-[1.03]">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Event Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($events->count() > 0)
        <div class="bg-[var(--bg)] px-6 py-5 border-t border-[var(--border)] flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="text-sm text-[var(--text-2)]">
                Menampilkan <span class="font-semibold text-[var(--text-1)]">{{ $events->count() }}</span> dari total {{ $events->total() }} event
            </div>
            <div class="pagination-container">
                {{ $events->links('pagination::tailwind') }}
            </div>
        </div>

        <div class="bg-[var(--bg)] px-6 py-4 border-t border-[var(--border)] text-sm text-[var(--text-2)]">
            <div class="flex flex-wrap justify-between items-center gap-6">
                <span>Menampilkan <span class="font-semibold text-[var(--text-1)]">{{ $events->count() }}</span> event</span>
                <div class="flex flex-wrap gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        Berlangsung: <span class="font-semibold">{{ $events->where('status', 'Sedang Berlangsung')->count() }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                        Akan Datang: <span class="font-semibold">{{ $events->where('status', 'Akan Datang')->count() }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-[var(--accent)] rounded-full"></div>
                        Rutin: <span class="font-semibold">{{ $events->where('event_type', 'recurring')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(url, judul) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                html: `Event <strong>"${judul}"</strong> akan dihapus permanen.<br>Data yang dihapus <b>tidak dapat dikembalikan</b>.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.style.display = 'none';

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        @endif

        // Fade-in animation untuk baris tabel
        document.querySelectorAll('tbody tr').forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(15px)';
            row.style.transition = 'all 0.4s ease-out';
            setTimeout(() => {
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 60);
        });
    </script>
@endpush
@endsection