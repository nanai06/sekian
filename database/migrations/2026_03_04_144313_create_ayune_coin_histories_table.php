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
        Schema::create('ayune_coin_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Id user yang punya riwayat koin ini
            $table->integer('jumlah');
            // Berapa koin yang bertambah atau berkurang
            $table->enum('tipe', ['masuk', 'keluar']);
            $table->enum('sumber', [
            'daur_ulang',
            'belanja',
            'penukaran']);
            // Penukaram kyk diskon gt
            $table->string('keterangan')->nullable();
            // Penjelasan tambahan transaksi koin ini
            //kyk digunakan untuk diskon pembelian nani kora
            $table->integer('saldo_sebelum');
            // Saldo koin sebelum transaksi ini terjadi
            //cth sblm dpt 25 dia 225
            $table->integer('saldo_sesudah');
            // contoh sblmny td 225, stlh dpt jd 250
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayune_coin_histories');
    }
};
