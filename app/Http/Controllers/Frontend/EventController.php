<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event aktif di frontend dengan pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $query = Event::query()
            ->where('is_active', true)
            ->where(function ($q) {
                // Event yang belum selesai atau tidak punya tanggal selesai
                $q->where('tanggal_selesai', '>=', Carbon::today()->toDateString())
                  ->orWhereNull('tanggal_selesai');
            })
            ->orderBy('tanggal_mulai', 'asc');

        // Fitur pencarian
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
                // Opsional: bisa ditambah deskripsi jika ingin
                // ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Pagination: 9 item per halaman (cocok grid 3 kolom)
        $events = $query->paginate(9);

        // Pertahankan parameter search di link pagination
        $events->appends($request->query());

        return view('frontend.public.event.index', compact('events'));
    }

    /**
     * Menampilkan detail satu event.
     */
    public function show($id)
    {
        $event = Event::where('is_active', true)
            ->findOrFail($id);

        return view('frontend.public.event.show', compact('event'));
    }
}