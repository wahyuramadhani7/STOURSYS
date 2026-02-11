<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('panduans', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('slug');           // hotel, pemerintahan, rumah_sakit, dll
            $table->string('alamat')->nullable()->after('isi');
            $table->string('kontak')->nullable()->after('alamat');          // telp, WA, email
            $table->string('website')->nullable()->after('kontak');
        });
    }

    public function down(): void
    {
        Schema::table('panduans', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'alamat', 'kontak', 'website']);
        });
    }
};