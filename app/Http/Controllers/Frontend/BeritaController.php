<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita aktif dengan pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $query = Berita::query()
            ->where('is_active', true)
            ->orderBy('tanggal_publikasi', 'desc')
            ->orderBy('created_at', 'desc');

        // Tambahkan fitur pencarian (judul atau excerpt/konten singkat)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
                // Opsional: jika ingin cari di konten lengkap juga
                // ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Pagination: 9 item per halaman (cocok grid 3 kolom)
        $beritas = $query->paginate(9);

        // Pertahankan parameter search di link pagination
        $beritas->appends($request->query());

        return view('frontend.public.berita.index', compact('beritas'));
    }

    /**
     * Menampilkan detail satu berita.
     */
    public function show($id)
    {
        $berita = Berita::where('is_active', true)
            ->findOrFail($id);

        // Tambah hitungan views
        $berita->increment('views');

        return view('frontend.public.berita.show', compact('berita'));
    }
}