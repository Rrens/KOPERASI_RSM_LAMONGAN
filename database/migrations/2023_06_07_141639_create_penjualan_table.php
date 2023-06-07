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
            $table->string('no_transaksi')->primary();
            $table->string('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->float('subtotal')->nullable();
            $table->float('diskon')->nullable();
            $table->float('total_bayar')->nullable();
            $table->float('kembalian')->nullable();
            $table->float('poin_tambah')->nullable();
            $table->string('metode_pembayaran')->nullable();
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
