@extends('backend.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Detail Pesan dari {{ $pesanKontak->nama }}</h1>
        <a href="{{ route('admin.kontak.index') }}" class="text-gray-600 hover:text-gray-900">Kembali</a>
    </div>

    <div class="bg-white shadow rounded-lg p-8 space-y-6">
        <div>
            <strong>Nama:</strong> {{ $pesanKontak->nama }}
        </div>
        <div>
            <strong>Email:</strong> {{ $pesanKontak->email }}
        </div>
        <div>
            <strong>Subjek:</strong> {{ $pesanKontak->subjek ?? '-' }}
        </div>
        <div>
            <strong>Pesan:</strong>
            <p class="mt-2 whitespace-pre-wrap">{{ $pesanKontak->pesan }}</p>
        </div>
        <div>
            <strong>Status Saat Ini:</strong> {{ ucfirst($pesanKontak->status) }}
        </div>

        <form action="{{ route('admin.kontak.updateStatus', $pesanKontak) }}" method="POST" class="flex gap-4">
            @csrf @method('PATCH')
            <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                <option value="dibaca" {{ $pesanKontak->status == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                <option value="ditanggapi" {{ $pesanKontak->status == 'ditanggapi' ? 'selected' : '' }}>Ditanggapi</option>
            </select>
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                Update Status
            </button>
        </form>
    </div>
</div>
@endsection