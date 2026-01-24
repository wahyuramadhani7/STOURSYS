@extends('backend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Daftar Event</h1>
        <a href="{{ route('admin.event.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
            Tambah Event
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($events as $event)
                    <tr>
                        <td class="px-6 py-4">{{ $event->judul }}</td>
                        <td class="px-6 py-4">{{ $event->tanggal_mulai->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">{{ $event->status }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.event.edit', $event) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.event.destroy', $event) }}" method="POST" class="inline ml-3">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada event</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection