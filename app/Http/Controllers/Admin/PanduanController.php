<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Panduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PanduanController extends Controller
{
    /**
     * Menampilkan daftar semua informasi daerah.
     */
    public function index()
    {
        $panduans = Panduan::orderBy('urutan')->get();
        return view('backend.panduan.index', compact('panduans'));
    }

    /**
     * Menampilkan form untuk menambah informasi baru.
     */
    public function create()
    {
        return view('backend.panduan.create');
    }

    /**
     * Menyimpan informasi baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|in:hotel,pemerintahan,rumah_sakit,darurat,lainnya',
            'isi'       => 'required|string',
            'alamat'    => 'nullable|string|max:255',
            'kontak'    => 'nullable|string',                       // ← Bebas panjang (tanpa max:255)
            'website'   => [
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $value = trim($value);
                        // Tambah https:// jika tidak ada protokol
                        if (!preg_match('#^https?://#i', $value)) {
                            $value = 'https://' . $value;
                        }
                        // Validasi URL menggunakan filter_var
                        if (!filter_var($value, FILTER_VALIDATE_URL)) {
                            $fail('Link website tidak valid. Contoh yang benar: rsupkariadi.co.id atau https://rsupkariadi.co.id');
                        }
                    }
                },
            ],
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg,bmp,tiff|max:2048',
            'urutan'    => 'required|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        // Handle upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            if ($file->isValid()) {
                $validated['gambar'] = $file->store('panduan', 'public');
            } else {
                return back()->withInput()->withErrors(['gambar' => 'File gambar gagal diupload. Coba lagi.']);
            }
        }

        // Generate slug unik
        $slug = Str::slug($validated['judul']);
        $count = 1;
        $originalSlug = $slug;
        while (Panduan::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $validated['slug'] = $slug;

        // Set default is_active
        $validated['is_active'] = $request->boolean('is_active', true);

        Panduan::create($validated);

        return redirect()->route('admin.panduan.index')
            ->with('success', 'Informasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit informasi.
     */
    public function edit(Panduan $panduan)
    {
        return view('backend.panduan.edit', compact('panduan'));
    }

    /**
     * Update informasi yang sudah ada.
     */
    public function update(Request $request, Panduan $panduan)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|in:hotel,pemerintahan,rumah_sakit,darurat,lainnya',
            'isi'       => 'required|string',
            'alamat'    => 'nullable|string|max:255',
            'kontak'    => 'nullable|string',                       // ← Bebas panjang (tanpa max:255)
            'website'   => [
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $value = trim($value);
                        if (!preg_match('#^https?://#i', $value)) {
                            $value = 'https://' . $value;
                        }
                        if (!filter_var($value, FILTER_VALIDATE_URL)) {
                            $fail('Link website tidak valid. Contoh yang benar: rsupkariadi.co.id atau https://rsupkariadi.co.id');
                        }
                    }
                },
            ],
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg,bmp,tiff|max:2048',
            'urutan'    => 'required|integer|min:0',
            'is_active' => 'sometimes|boolean',
            'slug'      => ['sometimes', Rule::unique('panduans', 'slug')->ignore($panduan->id)],
        ]);

        // Handle gambar baru
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            if ($file->isValid()) {
                if ($panduan->gambar) {
                    Storage::disk('public')->delete($panduan->gambar);
                }
                $validated['gambar'] = $file->store('panduan', 'public');
            } else {
                return back()->withInput()->withErrors(['gambar' => 'File gambar gagal diupload. Coba lagi.']);
            }
        }

        // Update slug hanya jika judul berubah
        if ($request->judul !== $panduan->judul) {
            $slug = Str::slug($validated['judul']);
            $count = 1;
            $originalSlug = $slug;
            while (Panduan::where('slug', $slug)->where('id', '!=', $panduan->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        // Handle is_active
        $validated['is_active'] = $request->boolean('is_active', $panduan->is_active);

        $panduan->update($validated);

        return redirect()->route('admin.panduan.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Hapus informasi.
     */
    public function destroy(Panduan $panduan)
    {
        if ($panduan->gambar) {
            Storage::disk('public')->delete($panduan->gambar);
        }

        $panduan->delete();

        return redirect()->route('admin.panduan.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }
}