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
        // tambahkan field lain jika ada, misal: 'views', 'category_id', dll
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'galeri'     => 'array',
        'is_active'  => 'boolean',
        'latitude'   => 'float',
        'longitude'  => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Default nilai atribut saat model dibuat.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => true,
        'galeri'    => '[]', // array kosong sebagai default
    ];

    // Accessor: URL gambar utama (modern style dengan Attribute)
    protected function gambarUtamaUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value = null) => $this->gambar_utama
                ? Storage::url($this->gambar_utama)
                : null,
        );
    }

    // Accessor: Daftar URL semua gambar galeri
    protected function galeriUrls(): Attribute
    {
        return Attribute::make(
            get: function (?array $value = null): array {
                $paths = $this->galeri ?? [];
                return collect($paths)
                    ->map(fn ($path) => $path ? Storage::url($path) : null)
                    ->filter()
                    ->values()
                    ->all();
            }
        );
    }

    // Optional: Mutator untuk memastikan galeri selalu array sebelum disimpan
    protected function galeri(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => is_array($value) ? $value : (array) $value,
        );
    }

    // Scope: hanya destinasi aktif (untuk frontend)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: urutkan berdasarkan terbaru atau views terbanyak, dll
    public function scopePopular($query)
    {
        return $query->orderByDesc('views')->active();
    }
}