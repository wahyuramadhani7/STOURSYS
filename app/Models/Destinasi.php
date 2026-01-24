<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'galeri' => 'array',
        'is_active' => 'boolean',
    ];

    // Optional: accessor untuk URL gambar
    public function getGambarUtamaUrlAttribute()
    {
        return $this->gambar_utama ? Storage::url($this->gambar_utama) : null;
    }
}