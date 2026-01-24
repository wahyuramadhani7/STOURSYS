@extends('backend.layouts.app')

@section('title', 'Daftar Panduan')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header + Tombol Tambah -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Daftar Panduan Pengguna</h1>
        <a href="{{ route('admin.panduan.create') }}" 
           class="bg-orange-500 text-white px-5 py-2.5 rounded-lg hover:bg-orange-600 transition flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Panduan Baru
        </a>
    </div>

    <!-- Tabel Panduan -->
    <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No Urut</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Panduan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gambar Sampul</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($panduans as $panduan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                                {{ $panduan->urutan }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $panduan->judul }}</div>
                                <div class="text-xs text-gray-500 mt-1 truncate max-w-xs">
                                    {{ Str::limit(strip_tags($panduan->isi), 80) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $panduan->slug }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($panduan->gambar)
                                    <img src="{{ Storage::url($panduan->gambar) }}" 
                                         alt="Sampul" 
                                         class="h-16 w-16 object-cover rounded-md border border-gray-200">
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.panduan.edit', $panduan->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                <form action="{{ route('admin.panduan.destroy', $panduan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Yakin ingin menghapus panduan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-lg">
                                Belum ada panduan yang ditambahkan.
                                <br>
                                <a href="{{ route('admin.panduan.create') }}" 
                                   class="text-orange-600 hover:underline mt-2 inline-block">
                                    Tambahkan panduan pertama sekarang
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection