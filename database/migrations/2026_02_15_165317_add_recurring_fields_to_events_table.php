<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Kolom utama recurring (jika belum ada)
            if (!Schema::hasColumn('events', 'is_recurring')) {
                $table->boolean('is_recurring')->default(false)->after('galeri');
            }

            // Tipe pengulangan (diperluas)
            if (!Schema::hasColumn('events', 'recurrence_type')) {
                $table->string('recurrence_type')->nullable()->after('is_recurring');
            }

            // Interval (setiap berapa)
            if (!Schema::hasColumn('events', 'recurrence_interval')) {
                $table->unsignedInteger('recurrence_interval')->nullable()->default(1)->after('recurrence_type');
            }

            // Khusus untuk yearly hanya bulan tertentu
            if (!Schema::hasColumn('events', 'recurrence_months')) {
                $table->json('recurrence_months')->nullable()->after('recurrence_interval');
                // Contoh isi: [5] → Mei setiap tahun, atau [1,4,7,10] → Januari, April, Juli, Oktober
            }

            // Opsional: tanggal dalam bulan untuk monthly
            if (!Schema::hasColumn('events', 'recurrence_day_of_month')) {
                $table->unsignedTinyInteger('recurrence_day_of_month')->nullable()->after('recurrence_months');
                // 1 sampai 31
            }

            // Tanggal akhir pengulangan (jika belum ada)
            if (!Schema::hasColumn('events', 'recurrence_end_date')) {
                $table->date('recurrence_end_date')->nullable()->after('recurrence_day_of_month');
            }

            // Opsional: jika nanti butuh hari dalam minggu
            // $table->json('recurrence_days_of_week')->nullable()->after('recurrence_end_date');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Hati-hati: jangan hapus kalau data sudah banyak
            // $table->dropColumn(['recurrence_months', 'recurrence_day_of_month', ...]);
        });
    }
};