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
        Schema::create('destinasis', function (Blueprint $table) {
            $table->id();
            
            // Informasi dasar
            $table->string('nama', 255);
            $table->string('slug', 255)->unique()->index();
            $table->text('deskripsi')->nullable();
            $table->text('deskripsi_panjang')->nullable();
            
            // Kategori & Lokasi
            $table->string('kategori', 50)->nullable()->index(); // candi, balkondes, dll
            $table->string('lokasi', 255)->nullable();
            
            // Jam & Fasilitas
            $table->string('jam_operasional', 255)->nullable();
            $table->text('fasilitas')->nullable(); // textarea bebas, pisah koma/baris
            
            // Harga Tiket
            $table->integer('harga_dewasa_wni')->nullable()->default(null);
            $table->integer('harga_dewasa_wna')->nullable()->default(null);
            $table->integer('harga_anak_wni')->nullable()->default(null);
            $table->integer('harga_anak_wna')->nullable()->default(null);
            $table->text('info_tiket')->nullable(); // catatan tambahan tiket
            
            // Peta Embed
            $table->string('peta_embed', 500)->nullable(); // src iframe Google Maps
            
            // Media
            $table->string('gambar_utama', 255)->nullable();
            $table->json('galeri')->nullable(); // array path gambar tambahan
            
            // Statistik & Status
            $table->integer('views')->default(0);
            $table->boolean('is_active')->default(true)->index();
            
            $table->timestamps();
            
            // Optional: soft deletes jika suatu saat butuh
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasis');
    }
};