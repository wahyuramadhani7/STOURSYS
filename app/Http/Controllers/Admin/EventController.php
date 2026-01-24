<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view('backend.event.index', compact('events'));
    }

    public function create()
    {
        return view('backend.event.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai' => 'nullable',
            'jam_selesai' => 'nullable',
            'lokasi' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('events', 'public');
        }

        if ($request->hasFile('galeri')) {
            $galeri = [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('events/galeri', 'public');
            }
            $validated['galeri'] = $galeri;
        }

        $validated['slug'] = Str::slug($validated['judul']);
        Event::create($validated);

        return redirect()->route('admin.event.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('backend.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai' => 'nullable',
            'jam_selesai' => 'nullable',
            'lokasi' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            if ($event->gambar_utama) {
                Storage::disk('public')->delete($event->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('events', 'public');
        }

        // Galeri: tambah baru, tidak hapus lama kecuali ada logic khusus
        if ($request->hasFile('galeri')) {
            $galeri = $event->galeri ?? [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('events/galeri', 'public');
            }
            $validated['galeri'] = $galeri;
        }

        $validated['slug'] = Str::slug($validated['judul']);
        $event->update($validated);

        return redirect()->route('admin.event.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if ($event->gambar_utama) {
            Storage::disk('public')->delete($event->gambar_utama);
        }
        if ($event->galeri) {
            foreach ($event->galeri as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        $event->delete();

        return redirect()->route('admin.event.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}