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
        Schema::create('penjualan', function (Blueprint $table) {
            // $table->string('no_transaksi')->primary();
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->bigInteger('subtotal')->nullable();
            $table->bigInteger('diskon')->nullable();
            $table->bigInteger('total_bayar')->nullable();
            $table->bigInteger('kembalian')->nullable();
            $table->bigInteger('poin_tambah')->nullable();
            $table->bigInteger('poin_pakai')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
