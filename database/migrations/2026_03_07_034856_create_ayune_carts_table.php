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
        Schema::create('ayune_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //id sp yg masukin produk ke keanjang. kl user keapus keranjangny jg
            $table->foreignId('product_id')->constrained('ayune_products')->onDelete('cascade');
            //id produk yg masuk k keranjang
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            //id penjual produk, keranjang dipisah otomatis per seller
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayune_carts');
    }
};
