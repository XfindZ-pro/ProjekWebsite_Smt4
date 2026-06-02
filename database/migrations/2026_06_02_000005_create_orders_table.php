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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';
                $table->string('order_id', 10)->primary(); // Format: order00001 (10 karakter)
                $table->string('pembeli_id', 13);
                $table->integer('total_harga');
                $table->enum('status_order', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
                $table->text('alamat_pengiriman');
                $table->text('catatan')->nullable();
                $table->timestamps();

                // Foreign Key
                $table->foreign('pembeli_id')->references('akun_id')->on('akun')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
