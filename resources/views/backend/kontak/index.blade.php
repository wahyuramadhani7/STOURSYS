@extends('backend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Pesan Masuk dari Kontak</h1>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subjek</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($pesans as $pesan)
                    <tr>
                        <td class="px-6 py-4">{{ $pesan->nama }}</td>
                        <td class="px-6 py-4">{{ $pesan->email }}</td>
                        <td class="px-6 py-4">{{ $pesan->subjek ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-medium
                                {{ $pesan->status == 'baru' ? 'bg-yellow-100 text-yellow-800' :
                                   $pesan->status == 'dibaca' ? 'bg-blue-100 text-blue-800' :
                                   'bg-green-100 text-green-800' }}">
                                {{ ucfirst($pesan->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $pesan->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.kontak.show', $pesan) }}" class="text-indigo-600 hover:text-indigo-900">Lihat</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pesan masuk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection