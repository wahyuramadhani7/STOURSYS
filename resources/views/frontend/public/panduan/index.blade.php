<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panduan Penggunaan Smart Tourism System
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($panduans as $panduan)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                @if($panduan->gambar)
                                    <div class="flex-shrink-0">
                                        <img src="{{ Storage::url($panduan->gambar) }}" alt="{{ $panduan->judul }}"
                                             class="w-20 h-20 md:w-24 md:h-24 object-cover rounded-lg">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="text-xl md:text-2xl font-bold text-navy-800 mb-3">
                                        {{ $panduan->judul }}
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        {{ Str::limit(strip_tags($panduan->isi), 150) }}
                                    </p>
                                    <a href="{{ route('panduan.show', $panduan->id) }}"
                                       class="inline-flex items-center text-orange-500 hover:text-orange-600 font-medium">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-xl shadow">
                        <p class="text-gray-500 text-lg">Belum ada panduan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>