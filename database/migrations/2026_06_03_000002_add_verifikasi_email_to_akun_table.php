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
        if (Schema::hasTable('akun')) {
            if (!Schema::hasColumn('akun', 'verifikasi_email')) {
                Schema::table('akun', function (Blueprint $table) {
                    $table->enum('verifikasi_email', ['belum_terverifikasi', 'terverifikasi'])
                          ->default('belum_terverifikasi')
                          ->after('status_verifikasi');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('akun')) {
            if (Schema::hasColumn('akun', 'verifikasi_email')) {
                Schema::table('akun', function (Blueprint $table) {
                    $table->dropColumn('verifikasi_email');
                });
            }
        }
    }
};
