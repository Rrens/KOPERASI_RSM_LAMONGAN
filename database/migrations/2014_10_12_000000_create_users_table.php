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
        Schema::create('users', function (Blueprint $table) {
            // $table->string('id')->primary();
            $table->id();
            $table->string('name');
            $table->string('pin');
            $table->integer('phone');
            $table->string('address');
            $table->string('nik');
            $table->string('gender');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->integer('credit')->nullable()->default(0);
            $table->integer('poin')->nullable()->default(0);
            $table->integer('role');
            $table->string('status_pernikahan')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
