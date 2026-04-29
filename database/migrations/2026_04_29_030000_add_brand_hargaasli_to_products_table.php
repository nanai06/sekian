<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tambah kolom brand & harga_asli ke ayune_products
     * + extend enum kategori agar bisa alat & isulang
     */
    public function up(): void
    {
        // Extend enum kategori: tambah 'alat' dan 'isulang'
        DB::statement("ALTER TABLE ayune_products MODIFY COLUMN kategori ENUM('skincare','makeup','alat','isulang')");

        Schema::table('ayune_products', function (Blueprint $table) {
            $table->string('brand', 100)->nullable()->after('nama_produk');
            //brand/merek produk, misal Wardah, Skintific

            $table->decimal('harga_asli', 10, 2)->nullable()->after('harga');
            //harga sebelum diskon, buat nampilin harga coret
        });
    }

    public function down(): void
    {
        Schema::table('ayune_products', function (Blueprint $table) {
            $table->dropColumn(['brand', 'harga_asli']);
        });

        DB::statement("ALTER TABLE ayune_products MODIFY COLUMN kategori ENUM('skincare','makeup')");
    }
};
