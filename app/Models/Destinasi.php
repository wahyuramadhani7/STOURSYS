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
        'galeri'    => '[]',
    ];

    /**
     * Accessor: URL gambar utama
     * Bisa dipanggil: $destinasi->gambar_utama_url
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
     * Bisa dipanggil: $destinasi->galeri_urls
     */
    protected function galeriUrls(): Attribute
    {
        return Attribute::make(
            get: function (): array {
                $paths = $this->galeri ?? [];

                return collect($paths)
                    ->map(fn ($path) => $path ? Storage::url($path) : null)
                    ->filter()
                    ->values()
                    ->all();
            }
        );
    }

    /**
     * Mutator: pastikan galeri selalu array saat disimpan
     */
    protected function galeri(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => is_array($value) ? $value : (array) $value,
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
     */
    public function scopePopular($query)
    {
        return $query->orderByDesc('views')->active();
    }
}