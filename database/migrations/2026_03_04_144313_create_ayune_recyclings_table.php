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
        Schema::create('ayune_recyclings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //yg resycle
            $table->foreignId('dropoff_location_id')->constrained('ayune_dropoff_locations')->onDelete('cascade');
            //id lokasi drop off yg dipilih user
            $table->json('jenis_kemasan');
            // Jenis-jenis kemasan yang ada di dalam tas
            // Bisa pilih lebih dari satu sekaligus
            // KENAPA JSON #ASK!!
            $table->integer('jumlah');
            $table->string('foto_kemasan');
            //yg disimpen nama file aja
            $table->integer('koin_didapat')->default(0);
            $table->boolean('sudah_scan')->default(false);
            $table->timestamp('waktu_scan')->nullable();
            //time stamp kpn drop off scan
            $table->text('catatan')->nullable();
            $table->enum('status', [
            'menunggu',
            'scan_qr',
            'selesai',
            'ditolak'
            ])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayune_recyclings');
    }
};
