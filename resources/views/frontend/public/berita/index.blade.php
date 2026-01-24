<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Berita Terbaru Kawasan Wisata Borobudur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($beritas as $berita)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col hover:shadow-2xl transition-shadow">
                        @if($berita->gambar_utama)
                            <div class="relative h-48">
                                <img src="{{ $berita->gambar_utama_url }}" alt="{{ $berita->judul }}"
                                     class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-navy-800 mb-3 line-clamp-2">
                                {{ $berita->judul }}
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                                {{ $berita->excerpt }}
                            </p>
                            <div class="text-sm text-gray-500 mt-auto">
                                <p>Ditulis oleh: {{ $berita->penulis ?? 'Admin' }}</p>
                                <p>{{ $berita->tanggal_publikasi?->format('d F Y') }}</p>
                                <p>Dilihat: {{ $berita->views }} kali</p>
                            </div>
                        </div>
                        <div class="px-6 pb-6">
                            <a href="{{ route('berita.show', $berita->id) }}"
                               class="block text-center bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500 text-lg">
                        Belum ada berita terbaru.
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $beritas->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>