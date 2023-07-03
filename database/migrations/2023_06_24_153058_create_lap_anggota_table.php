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
        Schema::create('lap_anggota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjualan')->nullable();
            $table->foreign('id_penjualan')->references('id')->on('penjualan');
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_anggota');
    }
};
