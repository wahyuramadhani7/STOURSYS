<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_publikasi' => 'date',
        'galeri'            => 'array',
        'views'             => 'integer',
        'is_active'         => 'boolean',
    ];

    // Optional: accessor untuk excerpt singkat
    public function getExcerptAttribute()
    {
        return substr(strip_tags($this->isi), 0, 150) . '...';
    }

    // Optional: URL gambar utama
    public function getGambarUtamaUrlAttribute()
    {
        return $this->gambar_utama ? \Storage::url($this->gambar_utama) : null;
    }
}