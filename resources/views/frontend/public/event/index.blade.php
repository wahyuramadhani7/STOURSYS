<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Event & Kegiatan di Kawasan Borobudur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($events as $event)
                    @php
                        $statusClass = [
                            'Sedang Berlangsung' => 'bg-green-100 text-green-800',
                            'Akan Datang' => 'bg-blue-100 text-blue-800',
                        ][$event->status] ?? 'bg-gray-100 text-gray-800';
                    @endphp

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                        @if ($event->gambar_utama)
                            <img
                                src="{{ Storage::url($event->gambar_utama) }}"
                                alt="{{ $event->judul }}"
                                class="w-full h-48 object-cover"
                            >
                        @endif

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3 gap-2">
                                <h3 class="text-xl font-bold text-navy-800">
                                    {{ $event->judul }}
                                </h3>

                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                                    {{ $event->status }}
                                </span>
                            </div>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit($event->deskripsi, 100) }}
                            </p>

                            <div class="text-sm text-gray-500 mb-4 space-y-1">
                                <p>
                                    <strong>Tanggal:</strong>
                                    {{ $event->tanggal_mulai->format('d M Y') }}
                                    @if ($event->tanggal_selesai)
                                        - {{ $event->tanggal_selesai->format('d M Y') }}
                                    @endif
                                </p>

                                @if ($event->lokasi)
                                    <p>
                                        <strong>Lokasi:</strong>
                                        {{ $event->lokasi }}
                                    </p>
                                @endif
                            </div>

                            <a
                                href="{{ route('event.show', $event->id) }}"
                                class="inline-block text-orange-500 hover:text-orange-700 font-medium transition"
                            >
                                Detail Event →
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        Belum ada event yang dijadwalkan saat ini.
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
