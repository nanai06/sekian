<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * nih buat apesi?
     */
    public function up(): void
    {
        Schema::create('ayune_products', function (Blueprint $table) {
            $table->id(); //bikin kolom id otomatis n unik
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); //yg ini buat nyimpen id siapa ynk jualan, foreign = nymbung ke table user, constrain=wajib ada, ondelete=kalau user hpus ini jg
            $table->string('nama_produk'); //nama produk
            $table->enum('kategori', ['skincare', 'makeup']); //kategori pilihan skinker mekupzz
            $table->enum('kondisi', ['baru', 'bekas']); //enum=pilihan terbatas cmn yg dikasi aja
            $table->text('deskripsi'); //desc produk
            $table->decimal('harga',10, 2); //maks 10 digit total, 2 angka diblkng koma. ex: 85,000.00 
            $table->string('foto'); //nyimpen nma file foto bkn fotonya
            $table->enum('status', ['tersedia', 'terjual']);
            $table->timestamps(); //tau kpn produk di up ketauan dr laravelnya man
        });
    }

    /**
     * Reverse the migrations.
     * nih buat apesi?
     */
    public function down(): void
    {
        Schema::dropIfExists('ayune_products');
    }
};
