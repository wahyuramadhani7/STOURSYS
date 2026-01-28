<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Destinasi extends Model
{
    use HasFactory;

    /**
     * Gunakan slug untuk route model binding
     * contoh: /destinasi/candi-borobudur
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'deskripsi_panjang',
        'lokasi',
        'latitude',
        'longitude',
        'gambar_utama',
        'galeri',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active'  => 'boolean',
        'latitude'   => 'float',
        'longitude'  => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        // 'galeri' DIHAPUS dari casts karena kolom TEXT, bukan JSON
    ];

    /**
     * Default nilai atribut saat model dibuat.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => true,
        'galeri'    => '[]',  // tetap default JSON kosong sebagai string
    ];

    /**
     * Accessor: URL gambar utama
     */
    protected function gambarUtamaUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->gambar_utama
                ? Storage::url($this->gambar_utama)
                : null,
        );
    }

    /**
     * Accessor: URL semua galeri
     * Karena galeri disimpan sebagai JSON string di TEXT, kita decode dulu
     */
    protected function galeriUrls(): Attribute
    {
        return Attribute::make(
            get: function (): array {
                // Decode JSON string dari kolom TEXT
                $paths = json_decode($this->galeri ?? '[]', true) ?? [];

                return collect($paths)
                    ->map(fn ($path) => $path ? Storage::url($path) : null)
                    ->filter()
                    ->values()
                    ->all();
            }
        );
    }

    /**
     * Scope: hanya destinasi aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: destinasi populer
     * (asumsi ada kolom views, jika belum ada bisa dihapus scope ini)
     */
    public function scopePopular($query)
    {
        return $query->orderByDesc('views')->active();
    }
}