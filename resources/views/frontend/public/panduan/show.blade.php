<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $panduan->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                @if($panduan->gambar)
                    <img src="{{ Storage::url($panduan->gambar) }}" alt="{{ $panduan->judul }}"
                         class="w-full h-64 md:h-80 object-cover">
                @endif

                <div class="p-8 md:p-10">
                    <h1 class="text-3xl md:text-4xl font-bold text-navy-900 mb-6">
                        {{ $panduan->judul }}
                    </h1>

                    <div class="prose prose-lg max-w-none text-gray-800">
                        {!! nl2br(e($panduan->isi)) !!}
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-200 text-sm text-gray-500">
                        <p>Urutan tampilan: {{ $panduan->urutan }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('panduan.index') }}"
                   class="inline-block bg-orange-500 text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition font-medium">
                    Kembali ke Daftar Panduan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>