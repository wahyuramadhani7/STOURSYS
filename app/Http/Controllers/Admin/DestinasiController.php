<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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

        try {
            // Upload gambar utama
            if ($request->hasFile('gambar_utama') && $request->file('gambar_utama')->isValid()) {
                $validated['gambar_utama'] = $request->file('gambar_utama')->store('destinasi', 'public');
            }

            // Upload galeri
            $galeriPaths = [];
            if ($request->hasFile('galeri') && is_array($request->file('galeri'))) {
                foreach ($request->file('galeri') as $file) {
                    if ($file->isValid()) {
                        $galeriPaths[] = $file->store('destinasi/galeri', 'public');
                    }
                }
            }

            // Karena kolom TEXT, encode manual jadi JSON string
            $validated['galeri'] = json_encode($galeriPaths);

            // Slug unik
            $slug = Str::slug($validated['nama']);
            $originalSlug = $slug;
            $count = 1;
            while (Destinasi::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;

            Destinasi::create($validated);

            return redirect()
                ->route('admin.destinasi.index')
                ->with('success', 'Destinasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan destinasi baru', [
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
                'data'    => $request->except(['_token', 'gambar_utama', 'galeri']),
                'galeri_paths' => $galeriPaths ?? [],
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan destinasi. Cek log untuk detail.');
        }
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

        try {
            // Slug jika nama berubah
            if ($request->filled('nama') && $destinasi->nama !== $validated['nama']) {
                $slug = Str::slug($validated['nama']);
                $originalSlug = $slug;
                $count = 1;
                while (Destinasi::where('slug', $slug)->where('id', '!=', $destinasi->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $validated['slug'] = $slug;
            }

            // Ganti gambar utama
            if ($request->hasFile('gambar_utama') && $request->file('gambar_utama')->isValid()) {
                if ($destinasi->gambar_utama && Storage::disk('public')->exists($destinasi->gambar_utama)) {
                    Storage::disk('public')->delete($destinasi->gambar_utama);
                }
                $validated['gambar_utama'] = $request->file('gambar_utama')->store('destinasi', 'public');
            }

            // Galeri baru (append)
            $galeriBaru = [];
            if ($request->hasFile('galeri') && is_array($request->file('galeri'))) {
                foreach ($request->file('galeri') as $file) {
                    if ($file->isValid()) {
                        $galeriBaru[] = $file->store('destinasi/galeri', 'public');
                    }
                }
            }

            // Decode galeri lama dari JSON string (karena kolom TEXT)
            $galeriLamaJson = $destinasi->galeri ?? '[]';
            $galeriLama = json_decode($galeriLamaJson, true) ?? [];

            // Merge dan encode kembali
            $galeriFinal = array_merge($galeriLama, $galeriBaru);
            $validated['galeri'] = json_encode($galeriFinal);

            $destinasi->update($validated);

            return redirect()
                ->route('admin.destinasi.index')
                ->with('success', 'Destinasi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update destinasi', [
                'id'       => $destinasi->id,
                'error'    => $e->getMessage(),
                'trace'    => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui destinasi. Cek log.');
        }
    }

    public function destroy(Destinasi $destinasi)
    {
        try {
            // Hapus gambar utama
            if ($destinasi->gambar_utama && Storage::disk('public')->exists($destinasi->gambar_utama)) {
                Storage::disk('public')->delete($destinasi->gambar_utama);
            }

            // Hapus galeri
            $galeriJson = $destinasi->galeri ?? '[]';
            $galeri = json_decode($galeriJson, true) ?? [];
            foreach ($galeri as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            $destinasi->delete();

            return redirect()
                ->route('admin.destinasi.index')
                ->with('success', 'Destinasi berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal hapus destinasi', [
                'id'    => $destinasi->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()
                ->route('admin.destinasi.index')
                ->with('error', 'Gagal menghapus destinasi.');
        }
    }
}