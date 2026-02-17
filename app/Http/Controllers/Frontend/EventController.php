<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event aktif di frontend (upcoming + ongoing + recurring)
     * dengan fitur pencarian, filter (rutin, ongoing, upcoming, past), dan pagination.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Base query: hanya event aktif & relevan (upcoming, ongoing, recurring)
        $query->activeAndRelevant();

        // Terapkan filter khusus berdasarkan query string 'filter'
        $filter = $request->query('filter');

        if ($filter === 'rutin') {
            $query->where('is_recurring', true);
        } elseif ($filter === 'ongoing') {
            $query->ongoing();
        } elseif ($filter === 'upcoming') {
            $query->upcoming(); // default 365 hari ke depan
        } elseif ($filter === 'past') {
            // Event yang sudah selesai (hanya yang punya tanggal selesai)
            $query->where('is_active', true)
                  ->whereNotNull('tanggal_selesai')
                  ->where('tanggal_selesai', '<', Carbon::today());
        }
        // Jika tidak ada filter atau filter tidak dikenal → tetap pakai activeAndRelevant saja

        // Pencarian (judul, lokasi, deskripsi)
        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = trim($request->input('search'));
            $q->where(function ($sub) use ($search) {
                $sub->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        });

        // Urutkan berdasarkan tanggal mulai (ascending untuk upcoming & ongoing)
        // Untuk past, urut descending berdasarkan tanggal selesai
        if ($filter === 'past') {
            $query->orderBy('tanggal_selesai', 'desc');
        } else {
            $query->orderBy('tanggal_mulai', 'asc');
        }

        // Pagination: 9 item per halaman (cocok grid 3 kolom)
        $events = $query->paginate(9);

        // Pertahankan semua query string di pagination links (filter, search, page)
        $events->appends($request->query());

        return view('frontend.public.event.index', compact('events'));
    }

    /**
     * Menampilkan detail satu event berdasarkan slug (SEO friendly).
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)
            ->activeAndRelevant()   // pastikan event aktif / relevan
            ->firstOrFail();

        // Optional: load relation jika dibutuhkan nanti
        // $event->load(['comments', 'galeri']);

        return view('frontend.public.event.show', compact('event'));
    }

    /**
     * Halaman archive: menampilkan event yang sudah lewat
     */
    public function archive(Request $request)
    {
        $query = Event::query()
            ->where('is_active', true)
            ->whereNotNull('tanggal_selesai')
            ->where('tanggal_selesai', '<', Carbon::today())
            ->orderBy('tanggal_selesai', 'desc');

        // Optional: tambah search di archive jika diperlukan
        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = trim($request->input('search'));
            $q->where(function ($sub) use ($search) {
                $sub->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        });

        $events = $query->paginate(12);

        $events->appends($request->query());

        return view('frontend.public.event.archive', compact('events'));
    }
}