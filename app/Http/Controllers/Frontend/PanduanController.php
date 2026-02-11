<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Panduan;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    /**
     * Menampilkan daftar panduan/informasi aktif (hotel, RS, BPBD, dll.) 
     * dengan pencarian, filter kategori, dan pagination.
     */
    public function index(Request $request)
    {
        $query = Panduan::query()
            ->where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('judul', 'asc');

        // Pencarian berdasarkan judul (dan opsional isi jika uncomment)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where('judul', 'like', "%{$search}%");
            // Uncomment jika ingin search juga di deskripsi/isi (bisa lebih lambat jika data banyak)
            // ->orWhere('isi', 'like', "%{$search}%");
        }

        // Filter berdasarkan kategori (misal: ?kategori=hotel atau ?kategori=rumah_sakit)
        if ($request->filled('kategori')) {
            $query->byKategori($request->input('kategori'));
        }

        // Pagination: 9 item per halaman (cocok untuk grid/list responsif)
        $panduans = $query->paginate(9);

        // Pertahankan semua parameter query di link pagination (search & kategori)
        $panduans->appends($request->query());

        // Ambil daftar kategori unik yang aktif (untuk dropdown filter di view)
        $kategoris = Panduan::where('is_active', true)
            ->select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori')
            ->map(fn($k) => ucfirst($k)); // Capitalize untuk tampilan bagus

        return view('frontend.public.panduan.index', compact('panduans', 'kategoris'));
    }

    /**
     * Menampilkan detail satu panduan/informasi (misal detail RS atau hotel).
     */
    public function show($id)
    {
        $panduan = Panduan::where('is_active', true)
            ->findOrFail($id);

        return view('frontend.public.panduan.show', compact('panduan'));
    }
}