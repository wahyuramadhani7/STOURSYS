<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('is_active', true)
            ->orderBy('tanggal_publikasi', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(9);  // 9 item per halaman (cocok untuk grid 3 kolom)

        return view('frontend.public.berita.index', compact('beritas'));
    }

    public function show($id)
    {
        $berita = Berita::where('is_active', true)
            ->findOrFail($id);

        // Optional: tambah hitungan views
        $berita->increment('views');

        return view('frontend.public.berita.show', compact('berita'));
    }
}