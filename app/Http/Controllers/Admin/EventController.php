<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index()
    {
        $events = Event::latest()->paginate(12);
        return view('backend.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('backend.event.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'           => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'       => 'nullable|string|date_format:H:i',
            'jam_selesai'     => 'nullable|string|date_format:H:i|after_or_equal:jam_mulai',
            'lokasi'          => 'nullable|string|max:255',
            'gambar_utama'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        // Handle gambar utama
        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('events/utama', 'public');
        }

        // Handle multiple galeri
        if ($request->hasFile('galeri')) {
            $galeriPaths = [];
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = $file->store('events/galeri', 'public');
            }
            $validated['galeri'] = $galeriPaths;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['judul']);

        Event::create($validated);

        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Display the specified event (untuk frontend).
     */
    public function show(Event $event)
    {
        // Optional: load relation jika ada (misal comments nanti)
        // $event->load('comments');

        return view('frontend.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('backend.event.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'judul'           => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'       => 'nullable|string|date_format:H:i',
            'jam_selesai'     => 'nullable|string|date_format:H:i|after_or_equal:jam_mulai',
            'lokasi'          => 'nullable|string|max:255',
            'gambar_utama'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        // Handle gambar utama (replace jika upload baru)
        if ($request->hasFile('gambar_utama')) {
            // Hapus yang lama jika ada
            if ($event->gambar_utama) {
                Storage::disk('public')->delete($event->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('events/utama', 'public');
        }

        // Handle galeri: tambah baru (lama tetap ada)
        if ($request->hasFile('galeri')) {
            $existingGaleri = $event->galeri ?? [];
            $newGaleri = [];

            foreach ($request->file('galeri') as $file) {
                $newGaleri[] = $file->store('events/galeri', 'public');
            }

            $validated['galeri'] = array_merge($existingGaleri, $newGaleri);
        }

        // Update slug jika judul berubah
        $validated['slug'] = Str::slug($validated['judul']);

        $event->update($validated);

        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified event from storage (soft delete atau hard delete).
     */
    public function destroy(Event $event)
    {
        // Hapus gambar utama
        if ($event->gambar_utama) {
            Storage::disk('public')->delete($event->gambar_utama);
        }

        // Hapus semua galeri
        if ($event->galeri && is_array($event->galeri)) {
            foreach ($event->galeri as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $event->delete();

        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    /**
     * Optional: Hapus satu foto dari galeri (via AJAX atau form terpisah)
     */
    public function deleteGalleryImage(Request $request, Event $event)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $imagePath = $request->input('image');

        if (in_array($imagePath, $event->galeri ?? [])) {
            Storage::disk('public')->delete($imagePath);

            $updatedGaleri = array_filter($event->galeri, fn($path) => $path !== $imagePath);
            $event->update(['galeri' => array_values($updatedGaleri)]);

            return response()->json(['success' => true, 'message' => 'Foto galeri berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Foto tidak ditemukan'], 404);
    }
}