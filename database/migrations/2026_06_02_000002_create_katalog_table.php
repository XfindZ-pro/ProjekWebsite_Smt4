<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('katalog')) {
            Schema::create('katalog', function (Blueprint $table) {
                $table->string('produk_id', 13)->primary();
                $table->string('penjual_id', 13);
                $table->string('nama_produk', 150);
                $table->string('kategori_limbah', 50);
                $table->integer('berat_tersedia');
                $table->integer('harga_per_kg');
                $table->integer('min_order');
                $table->string('lokasi_pickup', 100);
                $table->string('kondisi_harga', 50);
                $table->text('deskripsi')->nullable();
                $table->string('kondisi_fisik', 100);
                $table->string('metode_pengemasan', 100);
                $table->text('catatan_admin')->nullable();
                $table->enum('status_produk', ['draft', 'aktif', 'habis', 'ditangguhkan'])->default('aktif');
                $table->timestamps();

                // Foreign key pointing to akun
                $table->foreign('penjual_id')->references('akun_id')->on('akun')->onDelete('cascade');
            });

            // Simpan foto dan dokumen sebagai LONGBLOB untuk mendukung file besar
            DB::statement("ALTER TABLE katalog ADD foto_1 LONGBLOB NULL");
            DB::statement("ALTER TABLE katalog ADD foto_2 LONGBLOB NULL");
            DB::statement("ALTER TABLE katalog ADD foto_3 LONGBLOB NULL");
            DB::statement("ALTER TABLE katalog ADD dokumen_pendukung LONGBLOB NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katalog');
    }
};
