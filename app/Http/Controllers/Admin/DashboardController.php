<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Event;
use App\Models\Berita;
use App\Models\PesanKontak;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik
        $destinasiCount      = Destinasi::count(); // atau ::where('is_active', true)->count() kalau ada flag aktif
        $eventMendatangCount = Event::where('tanggal_mulai', '>=', now()->startOfDay())->count();
        $beritaCount         = Berita::count(); // atau ::where('is_active', true)->count()
        $pesanBaruCount      = PesanKontak::where('status', 'baru')->count();

        return view('backend.dashboard', compact(
            'destinasiCount',
            'eventMendatangCount',
            'beritaCount',
            'pesanBaruCount'
        ));
    }
}