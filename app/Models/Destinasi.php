<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Destinasi extends Model
{
    use HasFactory;

    /**
     * Gunakan slug untuk route model binding
     * Contoh: /destinasi/candi-borobudur
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
        'kategori',
        'deskripsi',
        'deskripsi_panjang',
        'lokasi',
        'jam_operasional',
        'fasilitas',
        'harga_dewasa_wni',
        'harga_dewasa_wna',
        'harga_anak_wni',
        'harga_anak_wna',
        'info_tiket',
        'peta_embed',
        'gambar_utama',
        'galeri',
        'views',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active'         => 'boolean',
        'views'             => 'integer',
        'harga_dewasa_wni'  => 'integer',
        'harga_dewasa_wna'  => 'integer',
        'harga_anak_wni'    => 'integer',
        'harga_anak_wna'    => 'integer',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /**
     * Default nilai atribut saat model dibuat.
     *
     * @var array
     */
    protected $attributes = [
        'is_active'         => true,
        'views'             => 0,
        'galeri'            => '[]',          // JSON string kosong
        'fasilitas'         => null,
        'jam_operasional'   => null,
        'peta_embed'        => null,
        'info_tiket'        => null,
        'harga_dewasa_wni'  => null,
        'harga_dewasa_wna'  => null,
        'harga_anak_wni'    => null,
        'harga_anak_wna'    => null,
    ];

    // =======================================
    // Accessors
    // =======================================

    /**
     * Accessor: URL gambar utama (full public URL)
     */
    protected function gambarUtamaUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->gambar_utama
                ? Storage::url($this->gambar_utama)
                : asset('images/placeholder-destinasi.jpg'), // fallback jika kosong
        );
    }

    /**
     * Accessor: Array URL semua gambar di galeri
     */
    protected function galeriUrls(): Attribute
    {
        return Attribute::make(
            get: function (): array {
                $raw = $this->galeri ?? '[]';
                $paths = json_decode($raw, true);

                if (json_last_error() !== JSON_ERROR_NONE || !is_array($paths)) {
                    return [];
                }

                return collect($paths)
                    ->map(fn ($path) => $path ? Storage::url($path) : null)
                    ->filter()
                    ->values()
                    ->all();
            }
        );
    }

    /**
     * Accessor: Daftar fasilitas sebagai array (untuk tampilan list)
     */
    protected function fasilitasList(): Attribute
    {
        return Attribute::make(
            get: function (): array {
                if (empty($this->fasilitas)) {
                    return [];
                }

                // Pisah berdasarkan koma, titik koma, atau baris baru
                $items = preg_split('/[\r\n]+|[,;]\s*/', trim($this->fasilitas), -1, PREG_SPLIT_NO_EMPTY);

                return array_map(fn ($item) => ucfirst(trim($item)), $items);
            }
        );
    }

    /**
     * Accessor: Nama kategori yang lebih readable
     */
    protected function kategoriNama(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->kategori
                ? ucwords(str_replace('_', ' ', $this->kategori))
                : 'Tidak dikategorikan',
        );
    }

    /**
     * Accessor: Format harga tiket dewasa WNI (contoh: Rp 50.000)
     */
    protected function hargaDewasaWniFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->harga_dewasa_wni !== null
                ? 'Rp ' . number_format($this->harga_dewasa_wni, 0, ',', '.')
                : 'Gratis / Tidak tersedia',
        );
    }

    /**
     * Accessor: Embed peta yang aman (bisa langsung digunakan di iframe src)
     */
    protected function petaEmbedSafe(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->peta_embed && Str::startsWith($this->peta_embed, 'https://www.google.com/maps/embed')
                ? $this->peta_embed
                : null,
        );
    }

    // =======================================
    // Scopes
    // =======================================

    /**
     * Scope: Hanya destinasi aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Urutkan berdasarkan views terbanyak (populer)
     */
    public function scopePopular($query)
    {
        return $query->orderByDesc('views')->active();
    }

    /**
     * Scope: Filter berdasarkan kategori
     */
    public function scopeByKategori($query, string|array $kategori)
    {
        if (is_array($kategori)) {
            return $query->whereIn('kategori', $kategori);
        }
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope: Destinasi dengan harga terjangkau untuk WNI (dewasa < 100.000)
     */
    public function scopeTerjangkauWni($query)
    {
        return $query->where(function ($q) {
            $q->where('harga_dewasa_wni', '<=', 100000)
              ->orWhereNull('harga_dewasa_wni');
        })->active();
    }

    /**
     * Scope: Cari berdasarkan nama atau lokasi (untuk search sederhana)
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('lokasi', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }
}