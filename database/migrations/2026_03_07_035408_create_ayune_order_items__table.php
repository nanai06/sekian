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
        Schema::create('ayune_order_items_', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('ayune_orders')->onDelete('cascade');
            //nyambung ke order mana item ni masuk, cnth item A masuk ke order nomor 2
            $table->foreignId('product_id')->constrained('ayune_products')->onDelete('cascade');
            //produk apeni yg dipesen
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            //id penjual produk produk ne
            $table->decimal('harga', 10, 2);
            //harga produk saat di pesan jd ntr kl haga livenya berubah yg dipesen ini ga brubah jg
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayune_order_items_');
    }
};
