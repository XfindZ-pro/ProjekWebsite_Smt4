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
        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';
                $table->increments('id');
                $table->string('order_id', 10);
                $table->string('produk_id', 13);
                $table->decimal('jumlah', 10, 2); // Jumlah pembelian dalam kg (bisa desimal)
                $table->integer('harga_satuan');  // Harga per kg
                $table->integer('subtotal');
                $table->timestamps();

                // Foreign Keys
                $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
                $table->foreign('produk_id')->references('produk_id')->on('katalog')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
