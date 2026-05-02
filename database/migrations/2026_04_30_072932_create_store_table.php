<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('seller_profile_id')->constrained()->onDelete('cascade');

            // Step 2 - Informasi Toko
            $table->string('nama_toko', 30);
            $table->string('slug')->unique();               // ayune.id/nama-toko
            $table->string('email_toko')->nullable();
            $table->string('nomor_hp', 20);
            $table->string('foto_toko')->nullable();        // avatar toko

            // Alamat toko (disimpan terpisah di store_addresses)
            // Jasa pengiriman pilihan (JSON array)
            $table->json('jasa_pengiriman')->nullable();    // ['JNE','J&T','SiCepat']

            $table->enum('status', ['aktif', 'nonaktif', 'suspend'])->default('aktif');
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->unsignedInteger('total_penjualan')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};