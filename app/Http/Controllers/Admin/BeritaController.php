<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the berita (news/articles).
     */
    public function index()
    {
        $beritas = Berita::latest()->paginate(12);
        return view('backend.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new berita.
     */
    public function create()
    {
        return view('backend.berita.create');
    }

    /**
     * Store a newly created berita in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'              => 'required|string|max:255',
            'ringkasan'          => 'nullable|string|max:500',
            'isi'                => 'required|string',
            'penulis'            => 'nullable|string|max:100',
            'tanggal_publikasi'  => 'nullable|date',
            'gambar_utama'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        // Handle gambar utama
        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('berita/utama', 'public');
        }

        // Handle multiple galeri
        if ($request->hasFile('galeri')) {
            $galeriPaths = [];
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = $file->store('berita/galeri', 'public');
            }
            $validated['galeri'] = $galeriPaths;
        }

        // Slug unik (tambah pengecekan duplikat jika perlu)
        $validated['slug'] = Str::slug($validated['judul']);
        $count = 1;
        while (Berita::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = Str::slug($validated['judul']) . '-' . $count++;
        }

        Berita::create($validated);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified berita (untuk frontend publik).
     */
    public function show(Berita $berita)
    {
        return view('frontend.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified berita.
     */
    public function edit($beritum)
    {
        $berita = Berita::findOrFail($beritum);

        return view('backend.berita.edit', compact('berita'));
    }

    /**
     * Update the specified berita in storage.
     */
    public function update(Request $request, $beritum)
    {
        $berita = Berita::findOrFail($beritum);

        $validated = $request->validate([
            'judul'              => 'required|string|max:255',
            'ringkasan'          => 'nullable|string|max:500',
            'isi'                => 'required|string',
            'penulis'            => 'nullable|string|max:100',
            'tanggal_publikasi'  => 'nullable|date',
            'gambar_utama'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        // Handle gambar utama (replace jika upload baru)
        if ($request->hasFile('gambar_utama')) {
            if ($berita->gambar_utama) {
                Storage::disk('public')->delete($berita->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('berita/utama', 'public');
        }

        // Tambah galeri baru (lama tetap)
        if ($request->hasFile('galeri')) {
            $existing = $berita->galeri ?? [];
            $newPaths = [];
            foreach ($request->file('galeri') as $file) {
                $newPaths[] = $file->store('berita/galeri', 'public');
            }
            $validated['galeri'] = array_merge($existing, $newPaths);
        }

        // Update slug jika judul berubah
        if ($berita->judul !== $validated['judul']) {
            $validated['slug'] = Str::slug($validated['judul']);
            $count = 1;
            while (Berita::where('slug', $validated['slug'])->where('id', '!=', $berita->id)->exists()) {
                $validated['slug'] = Str::slug($validated['judul']) . '-' . $count++;
            }
        }

        $berita->update($validated);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified berita from storage.
     */
    public function destroy($beritum)
    {
        $berita = Berita::findOrFail($beritum);

        if ($berita->gambar_utama) {
            Storage::disk('public')->delete($berita->gambar_utama);
        }

        if ($berita->galeri && is_array($berita->galeri)) {
            foreach ($berita->galeri as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Optional: Hapus satu foto galeri (bisa dipanggil via AJAX)
     */
    public function deleteGalleryImage(Request $request, $beritum)
    {
        $berita = Berita::findOrFail($beritum);

        $request->validate([
            'image' => 'required|string',
        ]);

        $imagePath = $request->input('image');

        if (in_array($imagePath, $berita->galeri ?? [])) {
            Storage::disk('public')->delete($imagePath);

            $updated = array_filter($berita->galeri, fn($p) => $p !== $imagePath);
            $berita->update(['galeri' => array_values($updated)]);

            return response()->json(['success' => true, 'message' => 'Foto galeri dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Foto tidak ditemukan'], 404);
    }
}