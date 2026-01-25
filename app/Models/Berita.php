<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'penulis',
        'tanggal_publikasi',
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
        'tanggal_publikasi' => 'datetime:Y-m-d', // atau 'date' jika hanya tanggal tanpa waktu
        'galeri'            => 'array',
        'views'             => 'integer',
        'is_active'         => 'boolean',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // tambahkan jika ada field sensitif
    ];

    /**
     * Boot method untuk auto-generate slug saat create/update
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('judul')) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }

    // --------------------------------------------------
    // Accessors
    // --------------------------------------------------

    /**
     * Get excerpt (ringkasan otomatis dari isi jika ringkasan kosong)
     */
    public function getExcerptAttribute(): string
    {
        if ($this->ringkasan) {
            return $this->ringkasan;
        }

        return Str::limit(strip_tags($this->isi), 160, '...');
    }

    /**
     * Get full URL for gambar utama
     */
    public function getGambarUtamaUrlAttribute(): ?string
    {
        return $this->gambar_utama
            ? Storage::url($this->gambar_utama)
            : null;
    }

    /**
     * Get formatted tanggal publikasi (contoh: 15 Januari 2026)
     */
    public function getTanggalPublikasiFormattedAttribute(): ?string
    {
        return $this->tanggal_publikasi
            ? $this->tanggal_publikasi->translatedFormat('d F Y')
            : null;
    }

    // --------------------------------------------------
    // Scopes (untuk query yang sering dipakai)
    // --------------------------------------------------

    /**
     * Scope a query to only include published/aktif berita.
     */
    public function scopePublished($query)
    {
        return $query->where('is_active', true)
                     ->where(function ($q) {
                         $q->whereNull('tanggal_publikasi')
                           ->orWhere('tanggal_publikasi', '<=', now());
                     });
    }

    /**
     * Scope a query to get recent berita (terbaru).
     */
    public function scopeRecent($query, $limit = 5)
    {
        return $query->published()
                     ->latest('tanggal_publikasi')
                     ->limit($limit);
    }

    /**
     * Scope a query to search by judul or isi.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('judul', 'like', "%{$search}%")
                     ->orWhere('isi', 'like', "%{$search}%")
                     ->orWhere('ringkasan', 'like', "%{$search}%");
    }

    // --------------------------------------------------
    // Mutators (opsional)
    // --------------------------------------------------

    /**
     * Set slug secara otomatis jika kosong
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value ?: $this->judul);
    }

    // --------------------------------------------------
    // Relasi (jika nanti dibutuhkan)
    // --------------------------------------------------

    // Contoh: jika ada relasi ke kategori
    // public function kategori()
    // {
    //     return $this->belongsTo(Kategori::class);
    // }

    // Contoh: jika ada komentar
    // public function comments()
    // {
    //     return $this->morphMany(Comment::class, 'commentable');
    // }
}