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
            ->when(request('type') === 'recurring', fn($q) => $q->where('event_type', 'recurring'))
            ->when(request('type') === 'upcoming',  fn($q) => $q->where('event_type', 'upcoming'))
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
            'judul'                 => 'required|string|max:255',
            'deskripsi'             => 'required|string',
            'event_type'            => 'required|in:upcoming,recurring',

            // Untuk upcoming → tanggal mulai wajib
            'tanggal_mulai'         => 'required_if:event_type,upcoming|nullable|date',
            'tanggal_selesai'       => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'             => 'nullable|string|date_format:H:i',
            'jam_selesai'           => 'nullable|string|date_format:H:i|after_or_equal:jam_mulai',

            'lokasi'                => 'nullable|string|max:255',
            'gambar_utama'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'              => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',

            // Untuk recurring → keterangan jadwal wajib
            'recurring_description' => 'required_if:event_type,recurring|nullable|string',

            // Field lama recurring (opsional, bisa diisi jika ingin tetap pakai pola structured)
            'is_recurring'          => 'sometimes|boolean',
            'recurrence_type'       => 'nullable|in:daily,weekly,monthly,yearly',
            'recurrence_interval'   => 'nullable|integer|min:1',
            'recurrence_end_date'   => 'nullable|date',
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

        // Logika utama berdasarkan event_type
        if ($validated['event_type'] === 'recurring') {
            $validated['is_recurring'] = true;
            // Kosongkan field tanggal & jam karena tidak relevan
            $validated['tanggal_mulai']   = null;
            $validated['tanggal_selesai'] = null;
            $validated['jam_mulai']       = null;
            $validated['jam_selesai']     = null;

            // Jika ingin tetap pakai pola structured → boleh diisi, tapi tidak wajib
            // Jika hanya pakai recurring_description → bisa null-kan semuanya
            if (empty($validated['recurrence_type'])) {
                $validated['recurrence_type']     = null;
                $validated['recurrence_interval'] = null;
                $validated['recurrence_end_date'] = null;
            }
        } else {
            // upcoming
            $validated['is_recurring']        = false;
            $validated['recurring_description'] = null;
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
     * Display the specified event (admin preview).
     */
    public function show(Event $event)
    {
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
            'judul'                 => 'required|string|max:255',
            'deskripsi'             => 'required|string',
            'event_type'            => 'required|in:upcoming,recurring',

            'tanggal_mulai'         => 'required_if:event_type,upcoming|nullable|date',
            'tanggal_selesai'       => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'             => 'nullable|string|date_format:H:i',
            'jam_selesai'           => 'nullable|string|date_format:H:i|after_or_equal:jam_mulai',

            'lokasi'                => 'nullable|string|max:255',
            'gambar_utama'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'              => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',

            'recurring_description' => 'required_if:event_type,recurring|nullable|string',

            'is_recurring'          => 'sometimes|boolean',
            'recurrence_type'       => 'nullable|in:daily,weekly,monthly,yearly',
            'recurrence_interval'   => 'nullable|integer|min:1',
            'recurrence_end_date'   => 'nullable|date',
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

        // Logika utama berdasarkan event_type (sama seperti store)
        if ($validated['event_type'] === 'recurring') {
            $validated['is_recurring'] = true;
            $validated['tanggal_mulai']   = null;
            $validated['tanggal_selesai'] = null;
            $validated['jam_mulai']       = null;
            $validated['jam_selesai']     = null;

            if (empty($validated['recurrence_type'])) {
                $validated['recurrence_type']     = null;
                $validated['recurrence_interval'] = null;
                $validated['recurrence_end_date'] = null;
            }
        } else {
            $validated['is_recurring']        = false;
            $validated['recurring_description'] = null;
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
        if ($event->gambar_utama) {
            Storage::disk('public')->delete($event->gambar_utama);
        }

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

        Storage::disk('public')->delete($imagePath);

        $updatedGaleri = array_values(array_filter($galeri, fn($path) => $path !== $imagePath));

        $event->update(['galeri' => $updatedGaleri]);

        return response()->json([
            'success'   => true,
            'message'   => 'Foto galeri berhasil dihapus',
            'remaining' => count($updatedGaleri)
        ]);
    }
}