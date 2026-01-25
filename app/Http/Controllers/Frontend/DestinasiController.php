<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    /**
     * Menampilkan daftar destinasi wisata di halaman publik/frontend.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Destinasi::query()
            ->where('is_active', true)
            ->orderBy('nama', 'asc');

        // Tambahkan fitur pencarian (sinkron dengan form search di view)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
                // Opsional: bisa ditambah kolom lain jika diperlukan
                // ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Pagination - 9 item per halaman (cocok untuk grid 3 kolom di view)
        // Bisa diubah jadi 6, 8, 12 sesuai kebutuhan desain
        $destinasi = $query->paginate(9);

        // Pertahankan parameter pencarian di link pagination
        $destinasi->appends($request->query());

        return view('frontend.public.destinasi.index', compact('destinasi'));
    }

    /**
     * Menampilkan detail satu destinasi berdasarkan slug.
     * Menggunakan route model binding untuk kemudahan dan SEO.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\View\View
     */
    public function show(Destinasi $destinasi)
    {
        // Pastikan hanya destinasi yang aktif yang bisa dilihat
        if (!$destinasi->is_active) {
            abort(404, 'Destinasi tidak ditemukan atau tidak aktif.');
        }

        // Tambah hitungan views (increment views)
        $destinasi->increment('views');

        return view('frontend.public.destinasi.show', compact('destinasi'));
    }
}