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
        Schema::create('posyandus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('puskesmas_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('rw');
            $table->string('kepala');
            $table->string('nomor_telepon');
            $table->integer('jumlah_balita');
            $table->unsignedBigInteger('koordinat_id');
            $table->timestamps();

            $table->foreign('puskesmas_id')->references('id')->on('puskesmas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('koordinat_id')->references('id')->on('koordinats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandus');
    }
};
