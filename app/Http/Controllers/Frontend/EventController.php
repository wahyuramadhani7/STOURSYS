<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)
            ->where(function ($query) {
                // Tampilkan event yang belum lewat atau sedang berlangsung
                $query->where('tanggal_selesai', '>=', now()->toDateString())
                      ->orWhereNull('tanggal_selesai');
            })
            ->orderBy('tanggal_mulai', 'asc')
            ->get();

        return view('frontend.public.event.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::where('is_active', true)
            ->findOrFail($id);

        return view('frontend.public.event.show', compact('event'));
    }
}