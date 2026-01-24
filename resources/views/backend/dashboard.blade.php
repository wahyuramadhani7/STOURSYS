@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card Destinasi -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-medium text-gray-700">Destinasi</h3>
        <p class="text-3xl font-bold text-orange-600 mt-2">{{ \App\Models\Destinasi::count() }}</p>
        <p class="text-sm text-gray-500 mt-1">Total destinasi aktif</p>
    </div>

    <!-- Card Event -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-medium text-gray-700">Event</h3>
        <p class="text-3xl font-bold text-orange-600 mt-2">{{ \App\Models\Event::where('tanggal_mulai', '>=', now())->count() }}</p>
        <p class="text-sm text-gray-500 mt-1">Event mendatang</p>
    </div>

    <!-- Card Berita -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-medium text-gray-700">Berita</h3>
        <p class="text-3xl font-bold text-orange-600 mt-2">{{ \App\Models\Berita::count() }}</p>
        <p class="text-sm text-gray-500 mt-1">Total berita</p>
    </div>

    <!-- Card Pesan Belum Dibaca -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-medium text-gray-700">Pesan Masuk</h3>
        <p class="text-3xl font-bold text-orange-600 mt-2">{{ \App\Models\PesanKontak::where('status', 'baru')->count() }}</p>
        <p class="text-sm text-gray-500 mt-1">Belum dibaca</p>
    </div>
</div>

<!-- Quick Links -->
<div class="mt-10">
    <h2 class="text-xl font-semibold mb-4">Aksi Cepat</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.destinasi.create') }}" class="bg-orange-100 hover:bg-orange-200 p-6 rounded-xl text-center font-medium">+ Tambah Destinasi</a>
        <a href="{{ route('admin.event.create') }}" class="bg-orange-100 hover:bg-orange-200 p-6 rounded-xl text-center font-medium">+ Tambah Event</a>
        <a href="{{ route('admin.berita.create') }}" class="bg-orange-100 hover:bg-orange-200 p-6 rounded-xl text-center font-medium">+ Tambah Berita</a>
    </div>
</div>
@endsection