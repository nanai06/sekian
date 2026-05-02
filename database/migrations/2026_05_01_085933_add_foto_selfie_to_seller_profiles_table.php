<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seller_profiles', function (Blueprint $table) {
            // Tambah kolom foto_selfie kalau belum ada
            if (!Schema::hasColumn('seller_profiles', 'foto_selfie')) {
                $table->string('foto_selfie')->nullable()->after('foto_ktp');
            }
        });
    }

    public function down(): void
    {
        Schema::table('seller_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('seller_profiles', 'foto_selfie')) {
                $table->dropColumn('foto_selfie');
            }
        });
    }
};