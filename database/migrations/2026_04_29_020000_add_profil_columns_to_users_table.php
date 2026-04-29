<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom-kolom profil ke tabel users
     * username, no_hp, foto_profil, bio, kota, poin_eco, rating_pembeli
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('name');
            //username unik buat tiap user, nullable krn user lama blm punya

            $table->string('no_hp', 20)->nullable()->after('email');
            //nomor HP, maks 20 char (cukup buat +62xxx)

            $table->string('foto_profil')->nullable()->after('no_hp');
            //path file foto profil di storage

            $table->text('bio')->nullable()->after('foto_profil');
            //bio singkat user, bisa kosong

            $table->string('kota', 100)->nullable()->after('bio');
            //kota domisili user

            $table->unsignedInteger('poin_eco')->default(0)->after('kota');
            //poin eco dari aktivitas daur ulang dll

            $table->decimal('rating_pembeli', 2, 1)->default(0.0)->after('poin_eco');
            //rating sebagai pembeli, misal 4.5 dari 5.0
        });
    }

    /**
     * Rollback: hapus semua kolom profil
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'no_hp',
                'foto_profil',
                'bio',
                'kota',
                'poin_eco',
                'rating_pembeli',
            ]);
        });
    }
};
