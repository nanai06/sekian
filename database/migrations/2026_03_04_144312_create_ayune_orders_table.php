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
        Schema::create('ayune_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            //nyimpen id sp yg beli cons ke table users
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            //nyimpen id sp yg jual cons ke table users (ad yg jual/beli)
            $table->text('alamat_pengiriman');
            //tipe text buat nyimpen alamt
            $table->string('metode_pengiriman');
            $table->decimal('total_harga', 10, 2);
            //sblm diskon
            $table->decimal('koin_digunakan', 10, 2)->default(0);
            //koin dipke buat diskon, default 0=kl ga pake koin ya otomats 0
            $table->decimal('diskon', 10, 2)->default(0);
            //nominal diskon misal 100 koin diskon 10.000
            $table->decimal('total_bayar', 10, 2);
            //stlh diskon dg rumus=total_harga - diskon
            $table->text('catatan')->nullable();
            //catatan pembeli ke pnjual
            $table->enum('status', [
            'menunggu_pembayaran',
            'dibayar',
            'diproses',
            'dikirim',
            'selesai',
            'dibatalkan'
            ])->default('menunggu_pembayaran');
            //status pesanan, default = waktu pertama ya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayune_orders');
    }
};
