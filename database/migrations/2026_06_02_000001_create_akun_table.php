<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('akun')) {
            Schema::create('akun', function (Blueprint $table) {
                $table->string('akun_id', 13)->primary();
                $table->string('nama', 100);
                $table->string('email', 100)->unique();
                $table->string('password', 255);
                $table->enum('peran', ['admin', 'pengguna', 'pabrik', 'produsen', 'umkm', 'industri_kreatif', 'pelaku_daur_ulang'])->default('pengguna');
                $table->enum('status_verifikasi', ['tanpa_verifikasi', 'menunggu', 'disetujui', 'ditolak'])->default('tanpa_verifikasi');
                $table->timestamps();
            });

            // Simpan foto sebagai LONGBLOB untuk mendukung file biner gambar berukuran besar
            DB::statement("ALTER TABLE akun ADD foto_profil LONGBLOB NULL");
            DB::statement("ALTER TABLE akun ADD foto_banner LONGBLOB NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
