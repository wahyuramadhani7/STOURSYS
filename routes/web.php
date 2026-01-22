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

// Route Profile (perlu login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';