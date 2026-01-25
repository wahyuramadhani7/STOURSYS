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
            'nama'              => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'deskripsi_panjang' => 'nullable|string',
            'lokasi'            => 'nullable|string|max:255',
            'latitude'          => 'nullable|numeric|between:-90,90',
            'longitude'         => 'nullable|numeric|between:-180,180',
            'gambar_utama'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar utama
        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')
                ->store('destinasi', 'public');
        }

        // Upload multiple galeri
        if ($request->hasFile('galeri')) {
            $galeriPaths = [];
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = $file->store('destinasi/galeri', 'public');
            }
            $validated['galeri'] = $galeriPaths; // akan di-json oleh model jika cast json
        }

        $validated['slug'] = Str::slug($validated['nama']);

        Destinasi::create($validated);

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function show(Destinasi $destinasi)
    {
        return view('backend.destinasi.show', compact('destinasi'));
    }

    public function edit(Destinasi $destinasi)
    {
        return view('backend.destinasi.edit', compact('destinasi'));
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'deskripsi_panjang' => 'nullable|string',
            'lokasi'            => 'nullable|string|max:255',
            'latitude'          => 'nullable|numeric|between:-90,90',
            'longitude'         => 'nullable|numeric|between:-180,180',
            'gambar_utama'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update slug jika nama berubah
        if ($request->filled('nama') && $destinasi->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        // Ganti gambar utama (hapus yang lama jika ada file baru)
        if ($request->hasFile('gambar_utama')) {
            if ($destinasi->gambar_utama && Storage::disk('public')->exists($destinasi->gambar_utama)) {
                Storage::disk('public')->delete($destinasi->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')
                ->store('destinasi', 'public');
        }

        // Tambah galeri baru (append, tidak replace)
        if ($request->hasFile('galeri')) {
            $galeriBaru = [];
            foreach ($request->file('galeri') as $file) {
                $galeriBaru[] = $file->store('destinasi/galeri', 'public');
            }

            $galeriLama = $destinasi->galeri ?? [];
            $validated['galeri'] = array_merge($galeriLama, $galeriBaru);
        }

        $destinasi->update($validated);

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy(Destinasi $destinasi)
    {
        // Hapus gambar utama
        if ($destinasi->gambar_utama && Storage::disk('public')->exists($destinasi->gambar_utama)) {
            Storage::disk('public')->delete($destinasi->gambar_utama);
        }

        // Hapus semua gambar di galeri
        if (!empty($destinasi->galeri)) {
            foreach ($destinasi->galeri as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $destinasi->delete();

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil dihapus.');
    }
}