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
            $table->text('deskripsi')->nullable();           // deskripsi utama (wajib di form)

            // Kategori & Lokasi
            $table->string('kategori', 50)->nullable()->index(); // candi, balkondes, kuliner, dll
            $table->string('lokasi', 255)->nullable();

            // Jam & Fasilitas
            $table->string('jam_operasional', 255)->nullable();
            $table->text('fasilitas')->nullable();           // bebas, bisa pisah koma atau baris

            // Harga Tiket (satu kolom fleksibel)
            $table->string('harga_tiket', 100)->nullable();  // support format teks + catatan
            $table->text('info_tiket')->nullable();          // catatan tambahan tiket jika perlu

            // Peta Embed
            $table->string('peta_embed', 500)->nullable();   // src atau full iframe Google Maps

            // Media
            $table->string('gambar_utama', 255)->nullable();
            $table->json('galeri')->nullable();              // array path gambar tambahan

            // Statistik & Status
            $table->integer('views')->default(0);
            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();

            // Optional: bisa di-uncomment jika nanti butuh soft delete
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