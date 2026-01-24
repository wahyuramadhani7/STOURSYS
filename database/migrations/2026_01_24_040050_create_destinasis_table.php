<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                      // Nama destinasi (Candi Borobudur, Candi Mendut, dll)
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('deskripsi_panjang')->nullable();
            $table->string('lokasi')->nullable();        // Alamat / koordinat
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('gambar_utama')->nullable();  // path gambar utama
            $table->json('galeri')->nullable();          // array path gambar tambahan
            $table->integer('kategori_id')->nullable();  // jika nanti ada kategori
            $table->integer('views')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasis');
    }
};