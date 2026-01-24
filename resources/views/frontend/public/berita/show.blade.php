<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $berita->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                @if($berita->gambar_utama)
                    <img src="{{ $berita->gambar_utama_url }}" alt="{{ $berita->judul }}"
                         class="w-full h-80 md:h-96 object-cover">
                @endif

                <div class="p-8 md:p-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-navy-900 mb-4">
                        {{ $berita->judul }}
                    </h1>

                    <div class="flex items-center gap-4 text-sm text-gray-600 mb-8">
                        <span>Ditulis oleh: <strong>{{ $berita->penulis ?? 'Admin' }}</strong></span>
                        <span>•</span>
                        <span>{{ $berita->tanggal_publikasi?->format('d F Y') }}</span>
                        <span>•</span>
                        <span>Dilihat: {{ $berita->views }} kali</span>
                    </div>

                    @if($berita->ringkasan)
                        <p class="text-lg italic text-gray-700 mb-6 border-l-4 border-orange-500 pl-4">
                            {{ $berita->ringkasan }}
                        </p>
                    @endif

                    <div class="prose prose-lg max-w-none text-gray-800">
                        {!! $berita->isi !!}
                    </div>

                    @if($berita->galeri && count($berita->galeri) > 0)
                        <div class="mt-10">
                            <h3 class="text-2xl font-semibold mb-4">Galeri Foto</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($berita->galeri as $gambar)
                                    <img src="{{ Storage::url($gambar) }}" alt="Galeri"
                                         class="w-full h-40 object-cover rounded-lg">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('berita.index') }}"
                   class="inline-block bg-orange-500 text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition font-medium">
                    Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </div>
</x-app-layout>