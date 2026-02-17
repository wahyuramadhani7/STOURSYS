<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Tambah kolom recurrence_months (untuk menyimpan bulan-bulan yang berlaku)
            if (!Schema::hasColumn('events', 'recurrence_months')) {
                $table->json('recurrence_months')->nullable()->after('recurrence_end_date');
                // Contoh isi: [5] → hanya Mei setiap tahun
                // [1,4,7,10] → Januari, April, Juli, Oktober
            }

            // Opsional: tahun mulai recurring (anchor tahun pertama)
            if (!Schema::hasColumn('events', 'recurrence_start_year')) {
                $table->year('recurrence_start_year')->nullable()->after('recurrence_months');
                // Contoh: 2025 → mulai berulang dari tahun 2025
            }

            // Ubah kolom existing menjadi nullable (supaya boleh kosong untuk event "hanya bulan")
            // Pengecekan ini aman, hanya ubah kalau belum nullable
            if (Schema::hasColumn('events', 'tanggal_mulai') && Schema::getColumnType('events', 'tanggal_mulai') !== 'date') {
                // Skip kalau sudah nullable atau tipe salah
            } else {
                $table->date('tanggal_mulai')->nullable()->change();
            }

            if (Schema::hasColumn('events', 'tanggal_selesai')) {
                $table->date('tanggal_selesai')->nullable()->change();
            }

            if (Schema::hasColumn('events', 'jam_mulai')) {
                $table->time('jam_mulai')->nullable()->change();
            }

            if (Schema::hasColumn('events', 'jam_selesai')) {
                $table->time('jam_selesai')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Hati-hati rollback: kalau sudah ada data, ini bisa gagal kalau kolom tidak boleh nullable lagi
            // Biasanya tidak perlu rollback nullable → jadi dikomentari dulu
            // $table->date('tanggal_mulai')->nullable(false)->change();
            // $table->date('tanggal_selesai')->nullable(false)->change();
            // $table->time('jam_mulai')->nullable(false)->change();
            // $table->time('jam_selesai')->nullable(false)->change();

            // Hapus kolom baru kalau rollback
            $table->dropColumnIfExists('recurrence_months');
            $table->dropColumnIfExists('recurrence_start_year');
        });
    }
};