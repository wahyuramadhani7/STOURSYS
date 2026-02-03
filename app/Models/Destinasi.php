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
     * Gunakan 'id' sebagai default route model binding
     * (karena slug sudah dihapus)
     */
    // public function getRouteKeyName()  ← tidak perlu override lagi, default ke 'id'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'lokasi',
        'jam_operasional',
        'fasilitas',
        'harga_tiket',       // ← kolom baru (string)
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
        'is_active'    => 'boolean',
        'views'        => 'integer',
        'galeri'       => 'array',     // lebih aman daripada json langsung
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    /**
     * Default nilai atribut saat model dibuat.
     *
     * @var array
     */
    protected $attributes = [
        'is_active'      => true,
        'views'          => 0,
        'galeri'         => '[]',       // JSON string kosong
        'fasilitas'      => null,
        'jam_operasional'=> null,
        'peta_embed'     => null,
        'info_tiket'     => null,
        'harga_tiket'    => null,
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
                : asset('images/placeholder-destinasi.jpg'),
        );
    }

    /**
     * Accessor: Array URL semua gambar di galeri
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
     * Accessor: Daftar fasilitas sebagai array (untuk tampilan list)
     */
    protected function fasilitasList(): Attribute
    {
        return Attribute::make(
            get: function (): array {
                if (empty($this->fasilitas)) {
                    return [];
                }

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
     * Accessor: Harga tiket yang sudah diformat (karena sekarang string bebas)
     * Menampilkan apa adanya, atau fallback jika kosong
     */
    protected function hargaTiketFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->harga_tiket
                ? $this->harga_tiket
                : 'Informasi harga tidak tersedia',
        );
    }

    /**
     * Accessor: Embed peta yang aman (hanya jika berasal dari Google Maps embed)
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
     * Scope: Cari berdasarkan nama atau lokasi atau deskripsi
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