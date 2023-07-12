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
        Schema::create('lap_anggota_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_penjualan')->nullable();
            $table->foreign('id_penjualan')->references('id')->on('penjualan');
            $table->unsignedBigInteger('id_lap_anggota')->nullable();
            $table->foreign('id_lap_anggota')->references('id')->on('lap_anggota');
            $table->bigInteger('total_bayar')->nullable();
            $table->bigInteger('credit')->nullable();
            $table->bigInteger('credit_masuk')->nullable();
            $table->bigInteger('credit_keluar')->nullable();
            $table->bigInteger('poin')->nullable();
            $table->bigInteger('poin_masuk')->nullable();
            $table->bigInteger('poin_keluar')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_anggota_detail');
    }
};
