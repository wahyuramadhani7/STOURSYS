<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Panduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PanduanController extends Controller
{
    public function index()
    {
        $panduans = Panduan::orderBy('urutan')->get();
        return view('backend.panduan.index', compact('panduans'));
    }

    public function create()
    {
        return view('backend.panduan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('panduan', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']);
        Panduan::create($validated);

        return redirect()->route('admin.panduan.index')
            ->with('success', 'Panduan berhasil ditambahkan.');
    }

    public function edit(Panduan $panduan)
    {
        return view('backend.panduan.edit', compact('panduan'));
    }

    public function update(Request $request, Panduan $panduan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($panduan->gambar) {
                Storage::disk('public')->delete($panduan->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('panduan', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']);
        $panduan->update($validated);

        return redirect()->route('admin.panduan.index')
            ->with('success', 'Panduan berhasil diperbarui.');
    }

    public function destroy(Panduan $panduan)
    {
        if ($panduan->gambar) {
            Storage::disk('public')->delete($panduan->gambar);
        }
        $panduan->delete();

        return redirect()->route('admin.panduan.index')
            ->with('success', 'Panduan berhasil dihapus.');
    }
}