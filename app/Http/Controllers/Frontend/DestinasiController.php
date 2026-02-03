<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    /**
     * Menampilkan halaman daftar destinasi wisata (frontend publik).
     * - Jika belum ada filter kategori/search → tampilkan daftar kategori dengan gambar representatif
     * - Jika ada filter → tampilkan grid destinasi dengan paginasi
     */
    public function index(Request $request)
    {
        // Cek apakah ada filter (kategori atau search)
        $hasFilter = $request->filled('kategori') || $request->filled('search');

        if (!$hasFilter) {
            // Mode Kategori (tampilan awal)
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
                        ->orderByDesc('views')
                        ->first();

                    return [
                        'slug'            => $item->kategori,
                        'nama'            => ucwords(str_replace('_', ' ', $item->kategori)),
                        'gambar_kategori' => $destinasiPertama ? $destinasiPertama->gambar_utama_url : null,
                    ];
                });

            return view('frontend.public.destinasi.index', compact('kategoriList'));
        }

        // Mode Filtered (ada kategori atau search)
        $query = Destinasi::query()
            ->where('is_active', true);

        // Pencarian (nama atau lokasi)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%"); // tambahan pencarian di deskripsi
            });
        }

        // Filter kategori (bisa single atau array/multiple)
        if ($request->filled('kategori')) {
            $kategoris = is_array($request->kategori)
                ? array_filter($request->kategori, fn($v) => !empty($v) && in_array($v, ['candi','balkondes','kuliner','alam','budaya','religi','desa_wisata']))
                : [$request->kategori];

            if (!empty($kategoris)) {
                $query->whereIn('kategori', $kategoris);
            }
        }

        // Urutkan: default alfabetis, atau bisa diganti ke views populer
        $query->orderBy('nama', 'asc');
        // Alternatif populer: $query->orderByDesc('views');

        $destinasi = $query->paginate(9)->appends($request->query());

        return view('frontend.public.destinasi.index', compact('destinasi'));
    }

    /**
     * Menampilkan detail satu destinasi berdasarkan ID (model binding).
     * - Cek apakah aktif
     * - Tambah views counter
     */
    public function show(Destinasi $destinasi)
    {
        // Blokir jika destinasi tidak aktif
        if (!$destinasi->is_active) {
            abort(404, 'Destinasi tidak ditemukan atau tidak aktif.');
        }

        // Tambah hitungan views (increment atomic)
        $destinasi->increment('views');

        return view('frontend.public.destinasi.show', compact('destinasi'));
    }
}