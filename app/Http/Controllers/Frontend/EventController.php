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
     * dengan fitur pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $query = Event::query()
            ->activeAndRelevant()           // menggunakan scope dari model
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = trim($request->input('search'));
                $q->where(function ($sub) use ($search) {
                    $sub->where('judul', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%");
                    // Opsional: tambah deskripsi jika diperlukan
                    // ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->orderBy('tanggal_mulai', 'asc');

        // Pagination: 9 item per halaman (cocok untuk grid 3 kolom)
        $events = $query->paginate(9);

        // Pertahankan query string (search, page, dll) di link pagination
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

        // Optional: bisa load relation di sini nanti (misal galeri, comments)
        // $event->load('comments');

        return view('frontend.public.event.show', compact('event'));
    }

    /**
     * Optional: Halaman archive / event yang sudah lewat (jika dibutuhkan nanti)
     */
    public function archive(Request $request)
    {
        $query = Event::query()
            ->where('is_active', true)
            ->whereNotNull('tanggal_selesai')
            ->where('tanggal_selesai', '<', Carbon::today())
            ->orderBy('tanggal_selesai', 'desc');

        $events = $query->paginate(12);

        return view('frontend.public.event.archive', compact('events'));
    }
}