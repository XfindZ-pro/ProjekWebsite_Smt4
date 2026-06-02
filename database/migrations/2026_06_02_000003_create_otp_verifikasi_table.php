<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('otp_verifikasi')) {
            Schema::create('otp_verifikasi', function (Blueprint $table) {
                $table->increments('otp_id');
                $table->string('email', 100);
                $table->string('kode_otp', 6);
                $table->enum('status', ['aktif', 'terpakai'])->default('aktif');
                $table->timestamp('waktu_dibuat')->useCurrent();
                $table->timestamp('waktu_kadaluarsa')->nullable();

                // Foreign key pointing to email in akun table
                $table->foreign('email')->references('email')->on('akun')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_verifikasi');
    }
};
