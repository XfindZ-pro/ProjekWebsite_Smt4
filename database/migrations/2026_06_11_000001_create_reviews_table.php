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
        if (!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';
                $table->increments('id');
                $table->string('order_id', 10);
                $table->string('produk_id', 13);
                $table->string('pembeli_id', 13);
                $table->tinyInteger('rating')->unsigned(); // 1 to 5
                $table->text('komentar')->nullable();
                $table->timestamps();

                // Foreign Keys
                $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
                $table->foreign('produk_id')->references('produk_id')->on('katalog')->onDelete('cascade');
                $table->foreign('pembeli_id')->references('akun_id')->on('akun')->onDelete('cascade');

                // Unique constraint so a buyer can only rate a product once per order
                $table->unique(['order_id', 'produk_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
