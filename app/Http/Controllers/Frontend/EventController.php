<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event aktif di halaman utama frontend
     * (upcoming + ongoing + recurring)
     * dengan fitur pencarian, filter, dan pagination.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Base query: hanya event aktif & relevan
        $query->activeAndRelevant();

        // Filter berdasarkan query string 'filter'
        $filter = $request->query('filter');

        if ($filter === 'rutin' || $filter === 'recurring') {
            $query->where('event_type', 'recurring');
        } elseif ($filter === 'ongoing') {
            $query->ongoing();
        } elseif ($filter === 'upcoming') {
            $query->upcoming(); // default 365 hari ke depan
        } elseif ($filter === 'past') {
            // Event non-recurring yang sudah selesai
            $query->where('event_type', '!=', 'recurring')
                  ->whereNotNull('tanggal_selesai')
                  ->where('tanggal_selesai', '<', Carbon::today());
        }
        // Jika filter tidak dikenal atau kosong → tetap tampilkan semua active & relevant

        // Pencarian pada judul, lokasi, deskripsi
        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = '%' . trim($request->input('search')) . '%';
            $q->where(function ($sub) use ($search) {
                $sub->where('judul', 'like', $search)
                    ->orWhere('lokasi', 'like', $search)
                    ->orWhere('deskripsi', 'like', $search)
                    ->orWhere('recurring_description', 'like', $search);
            });
        });

        // Urutan
        if ($filter === 'past') {
            $query->orderBy('tanggal_selesai', 'desc');
        } else {
            // Upcoming & ongoing: urut tanggal mulai ascending
            // Recurring: tetap ikut ascending tanggal_mulai (jika ada), atau default latest
            $query->orderBy('tanggal_mulai', 'asc');
        }

        // Pagination: 9 per halaman (cocok grid 3 kolom di frontend)
        $events = $query->paginate(9);

        // Pertahankan query string di link pagination (filter, search, page)
        $events->appends($request->query());

        return view('frontend.public.event.index', compact('events'));
    }

    /**
     * Menampilkan detail satu event berdasarkan slug (SEO friendly).
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)
            ->activeAndRelevant()
            ->firstOrFail();

        return view('frontend.public.event.show', compact('event'));
    }

    /**
     * Halaman arsip: hanya menampilkan event non-recurring yang sudah berakhir.
     */
    public function archive(Request $request)
    {
        $query = Event::query()
            ->where('is_active', true)
            ->where('event_type', '!=', 'recurring') // recurring biasanya tidak masuk arsip
            ->whereNotNull('tanggal_selesai')
            ->where('tanggal_selesai', '<', Carbon::today())
            ->orderBy('tanggal_selesai', 'desc');

        // Pencarian opsional di arsip
        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = '%' . trim($request->input('search')) . '%';
            $q->where(function ($sub) use ($search) {
                $sub->where('judul', 'like', $search)
                    ->orWhere('lokasi', 'like', $search)
                    ->orWhere('deskripsi', 'like', $search);
            });
        });

        $events = $query->paginate(12);

        $events->appends($request->query());

        return view('frontend.public.event.archive', compact('events'));
    }
}