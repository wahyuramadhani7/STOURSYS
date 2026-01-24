<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('backend.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('backend.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required',
            'penulis' => 'nullable|string|max:100',
            'tanggal_publikasi' => 'nullable|date',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('berita', 'public');
        }

        if ($request->hasFile('galeri')) {
            $galeri = [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('berita/galeri', 'public');
            }
            $validated['galeri'] = $galeri;
        }

        $validated['slug'] = Str::slug($validated['judul']);
        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('backend.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required',
            'penulis' => 'nullable|string|max:100',
            'tanggal_publikasi' => 'nullable|date',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            if ($berita->gambar_utama) Storage::disk('public')->delete($berita->gambar_utama);
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('berita', 'public');
        }

        if ($request->hasFile('galeri')) {
            $galeri = $berita->galeri ?? [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('berita/galeri', 'public');
            }
            $validated['galeri'] = $galeri;
        }

        $validated['slug'] = Str::slug($validated['judul']);
        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar_utama) Storage::disk('public')->delete($berita->gambar_utama);
        if ($berita->galeri) {
            foreach ($berita->galeri as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}