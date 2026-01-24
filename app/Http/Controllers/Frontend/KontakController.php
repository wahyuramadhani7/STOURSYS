<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('frontend.public.kontak.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|max:100',
            'subjek' => 'nullable|string|max:150',
            'pesan'  => 'required|string|min:10',
        ]);

        PesanKontak::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih atas masukannya!');
    }
}