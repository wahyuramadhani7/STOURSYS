<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_mulai'       => 'date:Y-m-d',
        'tanggal_selesai'     => 'date:Y-m-d',
        'jam_mulai'           => 'datetime:H:i',
        'jam_selesai'         => 'datetime:H:i',
        'galeri'              => 'array',
        'is_active'           => 'boolean',
        
        // Tambahan untuk recurring (jika sudah ditambah kolom via phpMyAdmin)
        'is_recurring'        => 'boolean',
        'recurrence_end_date' => 'date:Y-m-d',
        // recurrence_type     → string (daily, weekly, monthly, yearly)
        // recurrence_interval → integer
    ];

    /**
     * Default attributes values.
     *
     * @var array
     */
    protected $attributes = [
        'is_active'     => true,
        'is_recurring'  => false,
        'galeri'        => '[]', // default array kosong
    ];

    // -------------------------------------------------------------------------
    // Accessors (untuk memudahkan tampilan di blade)
    // -------------------------------------------------------------------------

    /**
     * Format rentang tanggal untuk tampilan (contoh: 15 - 18 Mei 2025)
     */
    public function getTanggalRangeAttribute(): string
    {
        if (!$this->tanggal_mulai) {
            return '-';
        }

        if ($this->tanggal_selesai && $this->tanggal_selesai->ne($this->tanggal_mulai)) {
            if ($this->tanggal_mulai->year === $this->tanggal_selesai->year) {
                return $this->tanggal_mulai->translatedFormat('j') . ' - ' .
                       $this->tanggal_selesai->translatedFormat('j F Y');
            }
            return $this->tanggal_mulai->translatedFormat('j F Y') . ' - ' .
                   $this->tanggal_selesai->translatedFormat('j F Y');
        }

        return $this->tanggal_mulai->translatedFormat('j F Y');
    }

    /**
     * Format jam lengkap (contoh: 08:00 - 16:30 WIB)
     */
    public function getJamRangeAttribute(): string
    {
        if (!$this->jam_mulai) {
            return '-';
        }

        $start = $this->jam_mulai->format('H:i');
        $end = $this->jam_selesai ? $this->jam_selesai->format('H:i') : null;

        return $end ? "$start - $end" : $start;
    }

    /**
     * Status teks sederhana untuk tampilan
     */
    public function getStatusAttribute(): string
    {
        if (!$this->is_active) {
            return 'Nonaktif';
        }

        $now = Carbon::now();

        if ($this->is_recurring) {
            return 'Rutin / Berulang';
        }

        if ($this->tanggal_selesai && $this->tanggal_selesai->lt($now)) {
            return 'Selesai';
        }

        if ($this->tanggal_mulai->gt($now)) {
            return 'Akan Datang';
        }

        return 'Sedang Berlangsung';
    }

    // -------------------------------------------------------------------------
    // Query Scopes (untuk dipakai di controller)
    // -------------------------------------------------------------------------

    /**
     * Scope untuk event yang aktif dan belum/ sedang berlangsung
     */
    public function scopeActiveAndRelevant($query)
    {
        $now = Carbon::today();

        return $query->where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('tanggal_selesai')
                  ->orWhere('tanggal_selesai', '>=', $now);
            })
            ->orWhere('is_recurring', true); // recurring dianggap relevan
    }

    /**
     * Scope untuk event mendatang (upcoming)
     */
    public function scopeUpcoming($query, $daysAhead = 365)
    {
        $future = Carbon::today()->addDays($daysAhead);

        return $query->where('tanggal_mulai', '>=', Carbon::today())
            ->where('tanggal_mulai', '<=', $future)
            ->orderBy('tanggal_mulai', 'asc');
    }

    /**
     * Scope untuk event yang sedang berlangsung
     */
    public function scopeOngoing($query)
    {
        $now = Carbon::now();

        return $query->where('is_active', true)
            ->where('tanggal_mulai', '<=', $now)
            ->where(function ($q) use ($now) {
                $q->whereNull('tanggal_selesai')
                  ->orWhere('tanggal_selesai', '>=', $now);
            });
    }

    // -------------------------------------------------------------------------
    // Helper Methods
    // -------------------------------------------------------------------------

    public function isUpcoming(): bool
    {
        return $this->tanggal_mulai->isFuture();
    }

    public function isOngoing(): bool
    {
        $now = Carbon::now();
        return $this->tanggal_mulai->lte($now) &&
               ($this->tanggal_selesai === null || $this->tanggal_selesai->gte($now));
    }

    public function hasEnded(): bool
    {
        return $this->tanggal_selesai && $this->tanggal_selesai->isPast();
    }

    public function isRecurring(): bool
    {
        return (bool) $this->is_recurring;
    }
}