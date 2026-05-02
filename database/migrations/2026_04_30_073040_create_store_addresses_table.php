<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');

            $table->string('label', 50)->default('Alamat Utama'); // "Gudang", "Rumah", dll
            $table->string('nama_penerima');
            $table->string('no_hp', 20);
            $table->text('alamat_lengkap');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos', 10);

            $table->boolean('is_primary')->default(true); // alamat utama pickup
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_addresses');
    }
};