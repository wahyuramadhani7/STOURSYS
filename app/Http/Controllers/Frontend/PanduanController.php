<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Panduan;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    /**
     * Menampilkan daftar panduan aktif dengan pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $query = Panduan::query()
            ->where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('judul', 'asc');

        // Tambahkan fitur pencarian berdasarkan judul
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where('judul', 'like', "%{$search}%");
            // Jika ingin cari juga di isi panduan, uncomment baris ini:
            // ->orWhere('isi', 'like', "%{$search}%");
        }

        // Pagination: 9 item per halaman (cocok untuk tampilan list)
        $panduans = $query->paginate(9);

        // Pertahankan parameter search di link pagination
        $panduans->appends($request->query());

        return view('frontend.public.panduan.index', compact('panduans'));
    }

    /**
     * Menampilkan detail satu panduan.
     */
    public function show($id)
    {
        $panduan = Panduan::where('is_active', true)
            ->findOrFail($id);

        return view('frontend.public.panduan.show', compact('panduan'));
    }
}