<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::latest()->get();
        return view('backend.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        return view('backend.destinasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'deskripsi_panjang' => 'nullable',
            'lokasi' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('destinasi', 'public');
        }

        // Galeri multiple upload
        if ($request->hasFile('galeri')) {
            $galeri = [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('destinasi/galeri', 'public');
            }
            $validated['galeri'] = $galeri;
        }

        $validated['slug'] = Str::slug($validated['nama']);
        Destinasi::create($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambahkan');
    }

    // edit(), update(), destroy() mirip pola Laravel resource, tambahkan logic upload & delete file jika perlu
}