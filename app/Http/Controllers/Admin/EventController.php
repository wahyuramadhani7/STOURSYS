<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index()
    {
        $events = Event::query()
            ->latest()
            ->when(request('type') === 'recurring', fn($q) => $q->where('is_recurring', true))
            ->when(request('type') === 'regular',   fn($q) => $q->where('is_recurring', false))
            ->paginate(12);

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
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'tanggal_mulai'       => 'required|date',
            'tanggal_selesai'     => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'           => 'nullable|string|date_format:H:i',
            'jam_selesai'         => 'nullable|string|date_format:H:i|after_or_equal:jam_mulai',
            'lokasi'              => 'nullable|string|max:255',
            'gambar_utama'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',

            // Recurring fields - hanya required jika is_recurring = true
            'is_recurring'        => 'sometimes|boolean',
            'recurrence_type'     => 'required_if:is_recurring,1|nullable|in:daily,weekly,monthly,yearly',
            'recurrence_interval' => 'required_if:is_recurring,1|nullable|integer|min:1',
            'recurrence_end_date' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        // Handle upload gambar utama
        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('events/utama', 'public');
        }

        // Handle multiple galeri uploads
        if ($request->hasFile('galeri')) {
            $galeriPaths = [];
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = $file->store('events/galeri', 'public');
            }
            $validated['galeri'] = $galeriPaths;
        }

        // Generate slug unik
        $baseSlug = Str::slug($validated['judul']);
        $slug = $baseSlug;
        $counter = 1;
        while (Event::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        // Set is_recurring & null-kan field recurring jika tidak aktif
        $validated['is_recurring'] = $request->boolean('is_recurring', false);

        if (!$validated['is_recurring']) {
            $validated['recurrence_type']     = null;
            $validated['recurrence_interval'] = null;
            $validated['recurrence_end_date'] = null;
        }

        Event::create($validated);

        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Display the specified event.
     * Catatan: Sebaiknya dipindahkan ke Frontend\EventController.
     * Jika hanya untuk admin preview, bisa ditambahkan middleware auth + role check.
     */
    public function show(Event $event)
    {
        // Alternatif: return redirect()->route('frontend.event.show', $event->slug);
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
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'tanggal_mulai'       => 'required|date',
            'tanggal_selesai'     => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'           => 'nullable|string|date_format:H:i',
            'jam_selesai'         => 'nullable|string|date_format:H:i|after_or_equal:jam_mulai',
            'lokasi'              => 'nullable|string|max:255',
            'gambar_utama'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',

            'is_recurring'        => 'sometimes|boolean',
            'recurrence_type'     => 'required_if:is_recurring,1|nullable|in:daily,weekly,monthly,yearly',
            'recurrence_interval' => 'required_if:is_recurring,1|nullable|integer|min:1',
            'recurrence_end_date' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        // Handle gambar utama - replace jika ada upload baru
        if ($request->hasFile('gambar_utama')) {
            if ($event->gambar_utama) {
                Storage::disk('public')->delete($event->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('events/utama', 'public');
        }

        // Handle galeri: tambah baru, existing tetap
        if ($request->hasFile('galeri')) {
            $existingGaleri = $event->galeri ?? [];
            $newGaleri = [];
            foreach ($request->file('galeri') as $file) {
                $newGaleri[] = $file->store('events/galeri', 'public');
            }
            $validated['galeri'] = array_merge($existingGaleri, $newGaleri);
        }

        // Update slug hanya jika judul berubah
        if ($validated['judul'] !== $event->judul) {
            $baseSlug = Str::slug($validated['judul']);
            $slug = $baseSlug;
            $counter = 1;
            while (Event::where('slug', $slug)->where('id', '!=', $event->id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $validated['slug'] = $slug;
        }

        // Penanganan recurring
        $validated['is_recurring'] = $request->boolean('is_recurring', false);

        if (!$validated['is_recurring']) {
            $validated['recurrence_type']     = null;
            $validated['recurrence_interval'] = null;
            $validated['recurrence_end_date'] = null;
        }

        $event->update($validated);

        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        // Hapus gambar utama jika ada
        if ($event->gambar_utama) {
            Storage::disk('public')->delete($event->gambar_utama);
        }

        // Hapus semua gambar galeri jika ada
        $galeri = $event->galeri ?? [];
        foreach ($galeri as $path) {
            Storage::disk('public')->delete($path);
        }

        $event->delete();

        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    /**
     * Hapus satu foto dari galeri via AJAX.
     */
    public function deleteGalleryImage(Request $request, Event $event)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $imagePath = $request->input('image');
        $galeri = $event->galeri ?? [];

        if (!in_array($imagePath, $galeri)) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan di galeri event ini'
            ], 404);
        }

        // Hapus file fisik
        Storage::disk('public')->delete($imagePath);

        // Update array galeri (hapus path yang sesuai)
        $updatedGaleri = array_values(array_filter($galeri, fn($path) => $path !== $imagePath));

        $event->update(['galeri' => $updatedGaleri]);

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil dihapus',
            'remaining' => count($updatedGaleri)
        ]);
    }
}