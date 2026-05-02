<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel alamat user (bisa punya banyak, satu yang utama)
     */
    public function up(): void
    {
        Schema::create('ayune_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //nyambung ke user pemilik alamat

            $table->text('alamat_lengkap');
            //alamat lengkap: jalan, RT/RW, kelurahan, kecamatan

            $table->string('kota', 100)->nullable();
            //kota/kabupaten

            $table->string('provinsi', 100)->nullable();
            //provinsi

            $table->string('kode_pos', 10)->nullable();
            //kode pos

            $table->boolean('is_primary')->default(false);
            //apakah ini alamat utama? cuma boleh satu yg true per user

            $table->timestamps();
        });
    }

    /**
     * Rollback: hapus tabel addresses
     */
    public function down(): void
    {
        Schema::dropIfExists('ayune_addresses');
    }
};
