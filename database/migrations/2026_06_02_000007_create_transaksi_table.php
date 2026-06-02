<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('transaksi')) {
            Schema::create('transaksi', function (Blueprint $table) {
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';
                $table->string('transaksi_id', 13)->primary(); // Format: trx00001 (13 karakter)
                $table->string('order_id', 10);
                $table->enum('metode_pembayaran', ['transfer_bank', 'ewallet', 'cod']);
                $table->enum('status_pembayaran', ['belum_bayar', 'lunas', 'gagal', 'refund'])->default('belum_bayar');
                $table->integer('jumlah_bayar');
                $table->timestamp('waktu_bayar')->nullable();
                $table->timestamps();

                // Foreign Key
                $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            });

            // Simpan bukti pembayaran sebagai LONGBLOB untuk mendukung unggah bukti transfer gambar
            DB::statement("ALTER TABLE transaksi ADD bukti_pembayaran LONGBLOB NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
