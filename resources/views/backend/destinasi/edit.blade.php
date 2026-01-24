@extends('backend.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Event: {{ $event->judul }}</h1>
        <a href="{{ route('admin.event.index') }}" class="text-gray-600 hover:text-gray-900">Kembali</a>
    </div>

    <form action="{{ route('admin.event.update', $event) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-8 space-y-6">
        @csrf @method('PATCH')

        <!-- Sama seperti create, tapi tambahkan value -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul Event</label>
            <input type="text" name="judul" value="{{ old('judul', $event->judul) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
        </div>

        <!-- ... isi field lain mirip create, pakai old() atau $event->field ... -->

        <div>
            <label class="block text-sm font-medium text-gray-700">Gambar Utama Saat Ini</label>
            @if($event->gambar_utama)
                <img src="{{ Storage::url($event->gambar_utama) }}" alt="Gambar Utama" class="mt-2 h-40 object-cover rounded">
            @endif
            <input type="file" name="gambar_utama" accept="image/*" class="mt-2 block w-full text-sm text-gray-500 ...">
        </div>

        <!-- Galeri saat ini -->
        @if($event->galeri && count($event->galeri) > 0)
            <div>
                <label class="block text-sm font-medium text-gray-700">Galeri Saat Ini</label>
                <div class="grid grid-cols-3 gap-4 mt-2">
                    @foreach($event->galeri as $img)
                        <img src="{{ Storage::url($img) }}" alt="Galeri" class="h-32 object-cover rounded">
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Tombol simpan -->
        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600">
                Update Event
            </button>
        </div>
    </form>
</div>
@endsection