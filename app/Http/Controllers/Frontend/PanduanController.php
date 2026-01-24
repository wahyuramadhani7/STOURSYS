<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Panduan;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function index()
    {
        $panduans = Panduan::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('judul', 'asc')
            ->get();

        return view('frontend.public.panduan.index', compact('panduans'));
    }

    public function show($id)
    {
        $panduan = Panduan::where('is_active', true)
            ->findOrFail($id);

        return view('frontend.public.panduan.show', compact('panduan'));
    }
}