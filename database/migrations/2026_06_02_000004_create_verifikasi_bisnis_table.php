<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('verifikasi_bisnis')) {
            Schema::create('verifikasi_bisnis', function (Blueprint $table) {
                $table->string('verifikasi_id', 25)->primary();
                $table->string('akun_id', 13);
                $table->enum('jenis_entitas', ['pabrik', 'umkm', 'komunitas', 'perorangan']);
                $table->string('nama_usaha', 150);
                $table->text('alamat_usaha');
                $table->string('nomor_telepon', 20);
                $table->timestamp('tanggal_pengajuan')->useCurrent();

                // Foreign key pointing to akun
                $table->foreign('akun_id')->references('akun_id')->on('akun')->onDelete('cascade');
            });

            // Simpan file sebagai LONGBLOB untuk mendukung dokumen scan/foto KTP besar
            DB::statement("ALTER TABLE verifikasi_bisnis ADD file_ktp LONGBLOB NULL");
            DB::statement("ALTER TABLE verifikasi_bisnis ADD file_izin_usaha LONGBLOB NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_bisnis');
    }
};
