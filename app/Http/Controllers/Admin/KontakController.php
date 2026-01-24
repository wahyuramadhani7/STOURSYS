<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $pesans = PesanKontak::latest()->get();
        return view('backend.kontak.index', compact('pesans'));
    }

    public function show(PesanKontak $pesanKontak)
    {
        if ($pesanKontak->status === 'baru') {
            $pesanKontak->update(['status' => 'dibaca']);
        }
        return view('backend.kontak.show', compact('pesanKontak'));
    }

    public function updateStatus(Request $request, PesanKontak $pesanKontak)
    {
        $request->validate(['status' => 'required|in:dibaca,ditanggapi']);
        $pesanKontak->update(['status' => $request->status]);

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Status pesan berhasil diperbarui.');
    }
}