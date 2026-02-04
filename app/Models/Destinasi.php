<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Destinasi extends Model
{
    use HasFactory;

    /**
     * Gunakan 'id' sebagai default route model binding
     */
    // public function getRouteKeyName()  ← default 'id' sudah OK

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
        'harga_tiket',
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
        'galeri'       => 'array',
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
        'galeri'         => '[]',
        'fasilitas'      => null,
        'jam_operasional'=> null,
        'peta_embed'     => null,
        'info_tiket'     => null,
        'harga_tiket'    => null,
    ];

    // =======================================
    // Accessors
    // =======================================

    protected function gambarUtamaUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->gambar_utama
                ? Storage::url($this->gambar_utama)
                : asset('images/placeholder-destinasi.jpg'),
        );
    }

    protected function galeriUrls(): Attribute
    {
        return Attribute::make(
            get: function (): array {
                $raw = $this->getAttribute('galeri');

                if (is_array($raw)) {
                    $paths = $raw;
                } elseif (is_string($raw) && trim($raw) !== '') {
                    $decoded = json_decode($raw, true);
                    $paths = is_array($decoded) ? $decoded : [];

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        Log::warning("JSON galeri corrupt untuk destinasi ID {$this->id}", [
                            'raw'   => $raw,
                            'error' => json_last_error_msg(),
                        ]);
                    }
                } else {
                    $paths = [];
                }

                return collect($paths)
                    ->map(fn ($path) => is_string($path) && trim($path) !== '' ? Storage::url($path) : null)
                    ->filter()
                    ->values()
                    ->all();
            }
        );
    }

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

    protected function kategoriNama(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->kategori
                ? ucwords(str_replace('_', ' ', $this->kategori))
                : 'Tidak dikategorikan',
        );
    }

    protected function hargaTiketFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->harga_tiket
                ? $this->harga_tiket
                : 'Informasi harga tidak tersedia',
        );
    }

    /**
     * PERBAIKAN UTAMA: Accessor peta_embed_safe yang lebih longgar dan aman
     */
    protected function petaEmbedSafe(): Attribute
    {
        return Attribute::make(
            get: function () {
                $url = trim($this->peta_embed ?? '');

                if ($url === '') {
                    return null;
                }

                // Cek apakah ini embed Google Maps yang valid
                // Lebih fleksibel: cek https + google.com/maps/embed (menerima parameter pb= dll)
                if (
                    str_starts_with($url, 'https://') &&
                    str_contains($url, 'google.com/maps/embed')
                ) {
                    return $url;
                }

                // Optional: log jika URL mencurigakan (bantu debug)
                if ($this->peta_embed) {
                    Log::info("peta_embed tidak lolos filter untuk destinasi ID {$this->id}", [
                        'url' => $this->peta_embed,
                    ]);
                }

                return null;
            }
        );
    }

    // =======================================
    // Scopes
    // =======================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePopular($query)
    {
        return $query->orderByDesc('views')->active();
    }

    public function scopeByKategori($query, string|array $kategori)
    {
        if (is_array($kategori)) {
            return $query->whereIn('kategori', $kategori);
        }
        return $query->where('kategori', $kategori);
    }

    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('lokasi', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }
}