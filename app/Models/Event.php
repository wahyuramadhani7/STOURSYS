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
        'is_recurring'        => 'boolean',
        'recurrence_end_date' => 'date:Y-m-d',
    ];

    /**
     * Default attributes values.
     *
     * @var array
     */
    protected $attributes = [
        'is_active'     => true,
        'is_recurring'  => false,
        'galeri'        => '[]',
    ];

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    /**
     * Tanggal mulai dalam format Indonesia (contoh: 16 Februari 2026)
     */
    public function getTanggalMulaiFormattedAttribute(): string
    {
        return $this->tanggal_mulai
            ? $this->tanggal_mulai->locale('id_ID')->translatedFormat('d F Y')
            : '-';
    }

    /**
     * Tanggal selesai dalam format Indonesia (atau kosong jika tidak ada)
     */
    public function getTanggalSelesaiFormattedAttribute(): string
    {
        return $this->tanggal_selesai
            ? $this->tanggal_selesai->locale('id_ID')->translatedFormat('d F Y')
            : '';
    }

    /**
     * Rentang tanggal untuk tampilan (diperbaiki agar bulan & tahun mulai selalu jelas)
     * Contoh output:
     * - 15 - 18 Februari 2026
     * - 28 Desember 2025 - 5 Januari 2026
     * - 20 Desember 2025 - 10 Januari 2027
     * - 5 Maret 2026 (single day)
     */
    public function getTanggalRangeAttribute(): string
    {
        if (!$this->tanggal_mulai) {
            return '-';
        }

        $mulai = $this->tanggal_mulai->locale('id_ID');

        // Kasus single day atau tidak ada tanggal selesai
        if (!$this->tanggal_selesai || $this->tanggal_selesai->equalTo($this->tanggal_mulai)) {
            return $mulai->translatedFormat('d F Y');
        }

        $selesai = $this->tanggal_selesai->locale('id_ID');

        $formatMulai   = 'd F Y';   // default: selalu tampilkan bulan & tahun di mulai
        $formatSelesai = 'd F Y';

        // Optimasi ringkas jika tahun sama
        if ($mulai->year === $selesai->year) {
            $formatMulai = 'd F';     // hilangkan tahun di mulai (tahun ada di selesai)

            // Jika bulan juga sama → hanya hari di selesai
            if ($mulai->month === $selesai->month) {
                $formatSelesai = 'd F Y';
            }
        }

        // Jika tahun berbeda → tetap full di kedua sisi
        return $mulai->translatedFormat($formatMulai)
               . ' - '
               . $selesai->translatedFormat($formatSelesai);
    }

    /**
     * Format jam lengkap (contoh: 08:00 - 16:30)
     */
    public function getJamRangeAttribute(): string
    {
        if (!$this->jam_mulai) {
            return '-';
        }

        $start = $this->jam_mulai->format('H:i');

        if (!$this->jam_selesai) {
            return $start;
        }

        return $start . ' - ' . $this->jam_selesai->format('H:i');
    }

    /**
     * Status event dalam bahasa Indonesia
     * (disesuaikan agar lebih akurat dengan tanggal saat ini: 17 Februari 2026)
     */
    public function getStatusAttribute(): string
    {
        if (!$this->is_active) {
            return 'Nonaktif';
        }

        if ($this->is_recurring) {
            return 'Rutin / Berulang';
        }

        $now = Carbon::today();  // hari ini: 17 Februari 2026

        if (!$this->tanggal_mulai) {
            return 'Tanggal belum ditentukan';
        }

        if ($this->tanggal_mulai->gt($now)) {
            return 'Akan Datang';
        }

        if ($this->tanggal_selesai) {
            if ($this->tanggal_selesai->lt($now)) {
                return 'Telah Berakhir';
            }

            // Mulai ≤ hari ini DAN selesai ≥ hari ini → sedang berlangsung
            if ($this->tanggal_mulai->lte($now) && $this->tanggal_selesai->gte($now)) {
                return 'Sedang Berlangsung';
            }
        } else {
            // Tidak ada tanggal selesai → berlangsung jika sudah mulai
            if ($this->tanggal_mulai->lte($now)) {
                return 'Sedang Berlangsung';
            }
        }

        return 'Tidak diketahui';
    }

    // -------------------------------------------------------------------------
    // Query Scopes
    // -------------------------------------------------------------------------

    public function scopeActiveAndRelevant($query)
    {
        $today = Carbon::today();

        return $query->where('is_active', true)
            ->where(function ($q) use ($today) {
                // Event sekali pakai yang belum selesai atau tidak punya tanggal selesai
                $q->whereNull('tanggal_selesai')
                  ->orWhere('tanggal_selesai', '>=', $today);
            })
            ->orWhere('is_recurring', true);
    }

    public function scopeUpcoming($query, $daysAhead = 365)
    {
        $future = Carbon::today()->addDays($daysAhead);

        return $query->where('tanggal_mulai', '>=', Carbon::today())
                     ->where('tanggal_mulai', '<=', $future)
                     ->orderBy('tanggal_mulai', 'asc');
    }

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
        return $this->tanggal_mulai && $this->tanggal_mulai->isFuture();
    }

    public function isOngoing(): bool
    {
        $now = Carbon::now();

        if (!$this->tanggal_mulai || $this->tanggal_mulai->isFuture()) {
            return false;
        }

        if ($this->tanggal_selesai) {
            return $this->tanggal_selesai->gte($now);
        }

        return true; // tanpa tanggal selesai → dianggap ongoing setelah mulai
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