<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class DestinasiController extends Controller
{
    /**
     * Display a listing of the destinations (dengan paginasi + statistik global).
     */
    public function index()
    {
        $destinasi = Destinasi::latest()->paginate(15);

        $totalDestinasi = Destinasi::count();
        $totalViews     = Destinasi::sum('views');
        $avgViews       = $totalDestinasi > 0 ? round(Destinasi::avg('views'), 0) : 0;

        return view('backend.destinasi.index', compact(
            'destinasi',
            'totalDestinasi',
            'totalViews',
            'avgViews'
        ));
    }

    /**
     * Show the form for creating a new destination.
     */
    public function create()
    {
        return view('backend.destinasi.create');
    }

    /**
     * Store a newly created destination in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'kategori'          => [
                'required',
                'string',
                'max:50',
            ],
            'sub_kategori'      => 'nullable|string|in:kuliner,restoran',
            'deskripsi'         => 'required|string',
            'lokasi'            => 'nullable|string|max:255',
            'jam_operasional'   => 'nullable|string|max:255',
            'fasilitas'         => 'nullable|array',
            'fasilitas.*'       => 'string|max:100',
            'fasilitas_custom'  => 'nullable|string|max:1000',
            'harga_tiket'       => 'nullable|string|max:1000',
            'info_tiket'        => 'nullable|string',
            'peta_embed'        => 'nullable|url|max:500',
            'gambar_utama'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'galeri.*'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Logika khusus kategori kuliner
        if ($request->kategori === 'kuliner') {
            if (!$request->sub_kategori) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['sub_kategori' => 'Pilih tipe Kuliner: Warung/Street Food atau Restoran/Cafe']);
            }
            $validated['kategori'] = 'kuliner_' . $request->sub_kategori;
        }

        try {
            // Proses fasilitas (gabungkan checkbox + custom)
            $fasilitasChecked = $request->input('fasilitas', []);
            $customString     = trim($request->input('fasilitas_custom', ''));
            $customArray      = $customString ? array_filter(explode('|||', $customString)) : [];
            
            $allFasilitas = array_unique(array_merge($fasilitasChecked, $customArray));
            $validated['fasilitas'] = json_encode($allFasilitas);

            // Upload gambar utama
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('destinasi/utama', 'public');

            // Upload galeri (opsional)
            $galeriPaths = [];
            if ($request->hasFile('galeri') && is_array($request->file('galeri'))) {
                foreach ($request->file('galeri') as $file) {
                    if ($file->isValid()) {
                        $galeriPaths[] = $file->store('destinasi/galeri', 'public');
                    }
                }
            }
            $validated['galeri'] = json_encode($galeriPaths);

            Destinasi::create($validated);

            return redirect()
                ->route('admin.destinasi.index')
                ->with('success', 'Destinasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan destinasi baru', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['_token', 'gambar_utama', 'galeri']),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan destinasi. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for editing the specified destination.
     */
    public function edit(Destinasi $destinasi)
    {
        return view('backend.destinasi.edit', compact('destinasi'));
    }

    /**
     * Update the specified destination in storage.
     */
    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'kategori'          => [
                'required',
                'string',
                'max:50',
            ],
            'sub_kategori'      => 'nullable|string|in:kuliner,restoran',
            'deskripsi'         => 'required|string',
            'lokasi'            => 'nullable|string|max:255',
            'jam_operasional'   => 'nullable|string|max:255',
            'fasilitas'         => 'nullable|array',
            'fasilitas.*'       => 'string|max:100',
            'fasilitas_custom'  => 'nullable|string|max:1000',
            'harga_tiket'       => 'nullable|string|max:1000',
            'info_tiket'        => 'nullable|string',
            'peta_embed'        => 'nullable|url|max:500',
            'gambar_utama'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'galeri.*'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Logika khusus kategori kuliner
        if ($request->kategori === 'kuliner') {
            if (!$request->sub_kategori) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['sub_kategori' => 'Pilih tipe Kuliner: Warung/Street Food atau Restoran/Cafe']);
            }
            $validated['kategori'] = 'kuliner_' . $request->sub_kategori;
        }

        try {
            // Proses fasilitas
            $fasilitasChecked = $request->input('fasilitas', []);
            $customString     = trim($request->input('fasilitas_custom', ''));
            $customArray      = $customString ? array_filter(explode('|||', $customString)) : [];
            
            $allFasilitas = array_unique(array_merge($fasilitasChecked, $customArray));
            $validated['fasilitas'] = json_encode($allFasilitas);

            // Update gambar utama jika ada file baru
            if ($request->hasFile('gambar_utama') && $request->file('gambar_utama')->isValid()) {
                if ($destinasi->gambar_utama && Storage::disk('public')->exists($destinasi->gambar_utama)) {
                    Storage::disk('public')->delete($destinasi->gambar_utama);
                }
                $validated['gambar_utama'] = $request->file('gambar_utama')->store('destinasi/utama', 'public');
            } else {
                $validated['gambar_utama'] = $destinasi->gambar_utama;
            }

            // Galeri: append gambar baru
            $galeriBaru = [];
            if ($request->hasFile('galeri') && is_array($request->file('galeri'))) {
                foreach ($request->file('galeri') as $file) {
                    if ($file->isValid()) {
                        $galeriBaru[] = $file->store('destinasi/galeri', 'public');
                    }
                }
            }

            $galeriLama = json_decode($destinasi->galeri ?? '[]', true) ?? [];
            $galeriFinal = array_merge($galeriLama, $galeriBaru);
            $validated['galeri'] = json_encode($galeriFinal);

            $destinasi->update($validated);

            return redirect()
                ->route('admin.destinasi.index')
                ->with('success', 'Destinasi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui destinasi', [
                'id'    => $destinasi->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui destinasi. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified destination from storage.
     */
    public function destroy(Destinasi $destinasi)
    {
        try {
            // Hapus gambar utama
            if ($destinasi->gambar_utama && Storage::disk('public')->exists($destinasi->gambar_utama)) {
                Storage::disk('public')->delete($destinasi->gambar_utama);
            }

            // Hapus galeri
            $galeri = json_decode($destinasi->galeri ?? '[]', true) ?? [];
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
            Log::error('Gagal menghapus destinasi', [
                'id'    => $destinasi->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()
                ->route('admin.destinasi.index')
                ->with('error', 'Gagal menghapus destinasi. Silakan coba lagi.');
        }
    }
}