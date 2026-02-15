<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index(Request $request)
    {
        $hasFilter = $request->filled('kategori') || $request->filled('search');

        if (!$hasFilter) {
            // Ambil daftar kategori unik, tapi gabungkan semua kuliner_* menjadi satu "Kuliner"
            $kategoriList = Destinasi::where('is_active', true)
                ->whereNotNull('kategori')
                ->select('kategori')
                ->distinct()
                ->orderBy('kategori')
                ->get()
                ->map(function ($item) {
                    $kategoriAsli = $item->kategori;

                    // Normalisasi untuk tampilan dan slug
                    if (str_starts_with($kategoriAsli, 'kuliner_') || $kategoriAsli === 'kuliner') {
                        $slug = 'kuliner';
                        $nama = 'Kuliner';
                    } else {
                        $slug = $kategoriAsli;
                        $nama = ucwords(str_replace(['_', '-'], ' ', $kategoriAsli));
                    }

                    // Ambil gambar representatif (prioritas views tertinggi)
                    $destinasiPertama = Destinasi::where('kategori', $kategoriAsli)
                        ->where('is_active', true)
                        ->orderByDesc('views')
                        ->first();

                    // Jika kuliner, ambil dari salah satu sub (atau dari 'kuliner' lama)
                    if ($slug === 'kuliner' && !$destinasiPertama) {
                        $destinasiPertama = Destinasi::where('kategori', 'like', 'kuliner%')
                            ->where('is_active', true)
                            ->orderByDesc('views')
                            ->first();
                    }

                    return [
                        'slug'            => $slug,
                        'nama'            => $nama,
                        'gambar_kategori' => $destinasiPertama?->gambar_utama_url,
                    ];
                })
                // Hilangkan duplikat kalau ada (misal kuliner & kuliner_kuliner muncul terpisah)
                ->unique('slug')
                ->values();

            return view('frontend.public.destinasi.index', compact('kategoriList'));
        }

        // =====================================
        // Bagian filtered (kategori atau search)
        // =====================================

        $query = Destinasi::where('is_active', true);

        // Pencarian
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $kategoriInput = $request->input('kategori');

            if ($kategoriInput === 'kuliner') {
                // Tampilkan semua varian kuliner
                $query->where('kategori', 'like', 'kuliner%');

                // Filter sub-kategori (opsional)
                if ($request->filled('sub')) {
                    $sub = $request->input('sub');
                    if (in_array($sub, ['kuliner', 'restoran'])) {
                        $query->where('kategori', "kuliner_{$sub}");
                    }
                }
            } else {
                // Kategori biasa (non-kuliner)
                $query->where('kategori', $kategoriInput);
            }
        }

        $destinasi = $query->orderBy('nama', 'asc')
            ->paginate(9)
            ->appends($request->query());

        return view('frontend.public.destinasi.index', compact('destinasi'));
    }

    public function show(Destinasi $destinasi)
    {
        if (!$destinasi->is_active) {
            abort(404);
        }

        $destinasi->increment('views');

        return view('frontend.public.destinasi.show', compact('destinasi'));
    }
}