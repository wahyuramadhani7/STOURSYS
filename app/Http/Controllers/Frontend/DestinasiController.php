<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view('frontend.public.destinasi.index', compact('destinasi'));
    }

    public function show($id)
    {
        $destinasi = Destinasi::where('is_active', true)
            ->findOrFail($id);

        // Optional: tambah view counter
        $destinasi->increment('views');

        return view('frontend.public.destinasi.show', compact('destinasi'));
    }
}