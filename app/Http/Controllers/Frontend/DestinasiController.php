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
            $kategoriList = Destinasi::where('is_active', true)
                ->whereNotNull('kategori')
                ->select('kategori')
                ->distinct()
                ->orderBy('kategori')
                ->get()
                ->map(function ($item) {
                    $destinasiPertama = Destinasi::where('kategori', $item->kategori)
                        ->where('is_active', true)
                        ->orderByDesc('views')
                        ->first();

                    return [
                        'slug'            => $item->kategori,
                        'nama'            => ucwords(str_replace('_', ' ', $item->kategori)),
                        'gambar_kategori' => $destinasiPertama?->gambar_utama_url,
                    ];
                });

            return view('frontend.public.destinasi.index', compact('kategoriList'));
        }

        $query = Destinasi::where('is_active', true);

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $allowed = ['candi', 'balkondes', 'kuliner', 'alam', 'budaya', 'religi', 'desa_wisata', 'wisata_edukasi'];

            $kategoris = is_array($request->kategori)
                ? array_filter($request->kategori, fn($v) => in_array($v, $allowed))
                : [$request->kategori];

            $kategoris = array_intersect($kategoris, $allowed);

            if (!empty($kategoris)) {
                $query->whereIn('kategori', $kategoris);
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