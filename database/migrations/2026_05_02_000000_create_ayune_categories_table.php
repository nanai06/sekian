<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ayune_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama');          // nama kategori, ex: Skincare, Makeup
            $table->string('slug')->unique(); // buat URL, ex: skincare, makeup
            $table->string('ikon')->nullable(); // emoji atau nama icon
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // Langsung isi data kategori default biar ga kosong
        DB::table('ayune_categories')->insert([
            ['nama' => 'Skincare',      'slug' => 'skincare',      'ikon' => '🧴', 'is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Makeup',        'slug' => 'makeup',        'ikon' => '💄', 'is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Perawatan Tubuh','slug' => 'perawatan-tubuh','ikon' => '🛁','is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Perawatan Rambut','slug' => 'perawatan-rambut','ikon' => '💆','is_aktif' => true,'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Parfum',        'slug' => 'parfum',        'ikon' => '🌸', 'is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Alat Kecantikan','slug' => 'alat-kecantikan','ikon' => '✂️','is_aktif' => true,'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('ayune_categories');
    }
};