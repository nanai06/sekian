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
        Schema::create('ayune_dropoff_locations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->text('alamat');
            $table->string('kota');
            $table->json('jenis_kemasan_diterima');
            // Jenis kemasan apa aja yang diterima di lokasi ini
            // json = bisa nyimpen banyak jenis sekaligus
            $table->string('qr_code')->unique();
            // Kode unik untuk tiap lokasi drop-off
            // unique() = tidak boleh ada dua lokasi dengan QR yang sama
            $table->string('foto_lokasi')->nullable();
            //null blh kosong
            $table->boolean('is_active')->default(true);
            //apkh masi aktif nerima 
            $table->decimal('latitude', 10, 8)->nullable();
            //koordinat latitude
            $table->decimal('longitude', 11, 8)->nullable();
            //koordinat longitude
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayune_dropoff_locations');
    }
};
