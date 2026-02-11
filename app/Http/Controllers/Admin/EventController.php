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
        $events = Event::query()
            ->latest()
            ->when(request('type') === 'recurring', fn($q) => $q->where('is_recurring', true))
            ->when(request('type') === 'regular', fn($q) => $q->where('is_recurring', false))
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

            // Field recurring baru
            'is_recurring'        => 'sometimes|boolean',
            'recurrence_type'     => 'required_if:is_recurring,1|nullable|in:daily,weekly,monthly,yearly',
            'recurrence_interval' => 'required_if:is_recurring,1|nullable|integer|min:1',
            'recurrence_end_date' => 'nullable|date|after_or_equal:tanggal_mulai',
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

        // Generate slug unik
        $baseSlug = Str::slug($validated['judul']);
        $slug = $baseSlug;
        $counter = 1;
        while (Event::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        // Penanganan recurring
        $validated['is_recurring'] = $request->boolean('is_recurring', false);

        if (!$validated['is_recurring']) {
            $validated['recurrence_type'] = null;
            $validated['recurrence_interval'] = null;
            $validated['recurrence_end_date'] = null;
        }

        Event::create($validated);

        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Display the specified event (untuk frontend - dipindah ke Frontend\EventController lebih baik).
     * Method ini sebaiknya dihapus atau di-redirect jika hanya untuk admin preview.
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
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'tanggal_mulai'       => 'required|date',
            'tanggal_selesai'     => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'           => 'nullable|string|date_format:H:i',
            'jam_selesai'         => 'nullable|string|date_format:H:i|after_or_equal:jam_mulai',
            'lokasi'              => 'nullable|string|max:255',
            'gambar_utama'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'galeri.*'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',

            // Field recurring
            'is_recurring'        => 'sometimes|boolean',
            'recurrence_type'     => 'required_if:is_recurring,1|nullable|in:daily,weekly,monthly,yearly',
            'recurrence_interval' => 'required_if:is_recurring,1|nullable|integer|min:1',
            'recurrence_end_date' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        // Handle gambar utama (replace jika upload baru)
        if ($request->hasFile('gambar_utama')) {
            if ($event->gambar_utama) {
                Storage::disk('public')->delete($event->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('events/utama', 'public');
        }

        // Handle galeri: tambah baru, lama tetap
        if ($request->hasFile('galeri')) {
            $existingGaleri = $event->galeri ?? [];
            $newGaleri = [];
            foreach ($request->file('galeri') as $file) {
                $newGaleri[] = $file->store('events/galeri', 'public');
            }
            $validated['galeri'] = array_merge($existingGaleri, $newGaleri);
        }

        // Update slug jika judul berubah
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
            $validated['recurrence_type'] = null;
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
        // Hapus gambar utama
        if ($event->gambar_utama) {
            Storage::disk('public')->delete($event->gambar_utama);
        }

        // Hapus semua galeri
        if (is_array($event->galeri)) {
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
     * Hapus satu foto dari galeri (via AJAX).
     */
    public function deleteGalleryImage(Request $request, Event $event)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $imagePath = $request->input('image');

        $galeri = $event->galeri ?? [];

        if (in_array($imagePath, $galeri)) {
            Storage::disk('public')->delete($imagePath);

            $updatedGaleri = array_values(array_filter($galeri, fn($path) => $path !== $imagePath));
            $event->update(['galeri' => $updatedGaleri]);

            return response()->json(['success' => true, 'message' => 'Foto galeri berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Foto tidak ditemukan'], 404);
    }
}