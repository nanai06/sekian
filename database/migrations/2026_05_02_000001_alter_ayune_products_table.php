<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ayune_products', function (Blueprint $table) {
            // Hapus kolom kategori lama (masih hardcode enum)
            $table->dropColumn('kategori');

            // Hapus kolom foto lama (cuma 1 foto)
            $table->dropColumn('foto');

            // Hapus kolom status lama
            $table->dropColumn('status');
        });

        Schema::table('ayune_products', function (Blueprint $table) {
            // Kategori sekarang pakai foreign key ke table categories
            $table->foreignId('category_id')
                ->nullable()
                ->after('user_id')
                ->constrained('ayune_categories')
                ->onDelete('set null');

            // Foto sekarang JSON array bisa simpan banyak foto
            $table->json('foto')->nullable()->after('deskripsi');

            // Kolom tambahan yang dibutuhin form
            $table->string('merek')->nullable()->after('nama_produk');
            $table->integer('berat_gram')->nullable()->after('harga');
            $table->integer('stok')->default(1)->after('berat_gram');
            $table->integer('persen_sisa')->nullable()->after('kondisi'); // buat produk bekas
            $table->string('catatan_kondisi')->nullable()->after('persen_sisa');

            // Status pakai enum baru sesuai alur penjual
            $table->enum('status', [
                'draft',
                'under_review',
                'aktif',
                'nonaktif',
                'terjual',
            ])->default('under_review')->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('ayune_products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id',
                'foto',
                'status',
                'merek',
                'berat_gram',
                'stok',
                'persen_sisa',
                'catatan_kondisi',
            ]);
        });

        Schema::table('ayune_products', function (Blueprint $table) {
            $table->enum('kategori', ['skincare', 'makeup'])->after('user_id');
            $table->string('foto')->after('deskripsi');
            $table->enum('status', ['tersedia', 'terjual'])->after('foto');
        });
    }
};