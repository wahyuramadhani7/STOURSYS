<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\DestinasiController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\Frontend\PanduanController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\StoursysController;

// ===============================
// FRONTEND / PUBLIC ROUTES
// ===============================

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Destinasi
Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{destinasi}', [DestinasiController::class, 'show'])->name('destinasi.show');

// Event
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Panduan
Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan.index');
Route::get('/panduan/{panduan}', [PanduanController::class, 'show'])->name('panduan.show');

// Berita (PAKAI SLUG → AMAN & SEO)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita:slug}', [BeritaController::class, 'show'])->name('berita.show');



Route::get('/stoursys', [StoursysController::class, 'index'])->name('stoursys.index');

// ===============================
// DASHBOARD REDIRECT
// ===============================
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===============================
// ADMIN ROUTES (PROTECTED)
// ===============================
Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('backend.dashboard');
        })->name('dashboard');

        // Resource Admin (CRUD)
        Route::resource('destinasi', \App\Http\Controllers\Admin\DestinasiController::class);
        Route::resource('event', \App\Http\Controllers\Admin\EventController::class);
        Route::resource('panduan', \App\Http\Controllers\Admin\PanduanController::class);
        Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class);

        // Kontak Admin
        Route::get('kontak', [\App\Http\Controllers\Admin\KontakController::class, 'index'])
            ->name('kontak.index');

        Route::get('kontak/{pesanKontak}', [\App\Http\Controllers\Admin\KontakController::class, 'show'])
            ->name('kontak.show');

        Route::patch('kontak/{pesanKontak}', [\App\Http\Controllers\Admin\KontakController::class, 'updateStatus'])
            ->name('kontak.updateStatus');
    });

// ===============================
// PROFILE ROUTES
// ===============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
