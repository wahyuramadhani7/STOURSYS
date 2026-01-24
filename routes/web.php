<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\DestinasiController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\Frontend\PanduanController;
use App\Http\Controllers\Frontend\BeritaController;

// Route Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route Frontend Public (dapat diakses tanpa login)
Route::prefix('')->group(function () {
    // Destinasi
    Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
    Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.show');
    
    // Event
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
    
    // Kontak
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
    
    // Panduan
    Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan.index');
    Route::get('/panduan/{id}', [PanduanController::class, 'show'])->name('panduan.show');
    
    // Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
});

// Route Dashboard untuk Admin (perlu login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ... route frontend tetap

// Admin Routes (protected)
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    // Destinasi Admin
    Route::resource('destinasi', \App\Http\Controllers\Admin\DestinasiController::class);

    // Event Admin
    Route::resource('event', \App\Http\Controllers\Admin\EventController::class);

    // Panduan Admin
    Route::resource('panduan', \App\Http\Controllers\Admin\PanduanController::class);

    // Berita Admin
    Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class);

    // Kontak (hanya index + show + update status)
    Route::get('kontak', [\App\Http\Controllers\Admin\KontakController::class, 'index'])->name('kontak.index');
    Route::get('kontak/{pesanKontak}', [\App\Http\Controllers\Admin\KontakController::class, 'show'])->name('kontak.show');
    Route::patch('kontak/{pesanKontak}', [\App\Http\Controllers\Admin\KontakController::class, 'updateStatus'])->name('kontak.updateStatus');
});

// Route Profile (perlu login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';