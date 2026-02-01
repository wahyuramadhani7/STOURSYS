<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    /**
     * Menampilkan halaman daftar destinasi wisata (frontend publik).
     * - Jika belum ada filter kategori/search → tampilkan daftar kategori
     * - Jika ada filter → tampilkan grid destinasi
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Destinasi::query()
            ->where('is_active', true);

        // Pencarian (nama atau lokasi)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter kategori (single atau multiple)
        if ($request->filled('kategori')) {
            $kategoris = is_array($request->kategori)
                ? array_filter($request->kategori, fn($v) => !empty($v))
                : [$request->kategori];

            if (!empty($kategoris)) {
                $query->whereIn('kategori', $kategoris);
            }
        }

        // Urutkan berdasarkan nama (bisa diganti views atau created_at)
        $query->orderBy('nama', 'asc');

        // Pagination hanya untuk mode filtered
        $destinasi = $query->paginate(9)->appends($request->query());

        // Ambil daftar kategori + gambar representatif (untuk tampilan awal)
        $kategoriList = Destinasi::where('is_active', true)
            ->whereNotNull('kategori')
            ->select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->get()
            ->map(function ($item) {
                // Ambil destinasi pertama di kategori ini (paling populer = views tertinggi)
                $destinasiPertama = Destinasi::where('kategori', $item->kategori)
                    ->where('is_active', true)
                    ->orderByDesc('views') // atau orderBy('nama') jika ingin alfabet
                    ->first();

                return [
                    'slug'            => $item->kategori,
                    'nama'            => ucwords(str_replace('_', ' ', $item->kategori)),
                    'gambar_kategori' => $destinasiPertama ? $destinasiPertama->gambar_utama_url : null,
                ];
            });

        return view('frontend.public.destinasi.index', compact(
            'destinasi',
            'kategoriList'
        ));
    }

    /**
     * Menampilkan detail satu destinasi berdasarkan slug.
     * Route model binding + SEO friendly.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\View\View
     */
    public function show(Destinasi $destinasi)
    {
        // Blokir jika tidak aktif
        if (!$destinasi->is_active) {
            abort(404, 'Destinasi tidak ditemukan atau tidak aktif.');
        }

        // Tambah hitungan views
        $destinasi->increment('views');

        // Optional: load relation jika nanti ada (contoh: galeri, reviews, dll)
        // $destinasi->load(['galeri' => fn($q) => $q->latest()]);

        return view('frontend.public.destinasi.show', compact('destinasi'));
    }
}