<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Step 1 - Verifikasi Data Diri
            $table->enum('tipe_penjual', ['perorangan', 'perusahaan'])->default('perorangan');
            $table->string('nama_ktp', 100)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('foto_ktp')->nullable();           // path file
            $table->boolean('verifikasi_wajah')->default(false);
            $table->boolean('setuju_syarat')->default(false);

            // Status onboarding
            $table->enum('status_verifikasi', [
                'belum',        // belum mulai
                'step1_done',   // verifikasi diri selesai
                'step2_done',   // info toko selesai
                'aktif',        // sudah selesai onboarding
                'ditolak',      // ditolak admin
            ])->default('belum');

            $table->text('catatan_admin')->nullable(); // kalau ditolak
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_profiles');
    }
};