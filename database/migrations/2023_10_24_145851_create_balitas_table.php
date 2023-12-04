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
        Schema::create('balitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posyandu_id');
            $table->string('nik');
            $table->string('nama');
            $table->enum("jenis_kelamin", ["Laki-Laki", "Perempuan"]);
            $table->date('tgl_lahir');
            $table->integer('anak_ke');
            $table->integer('umur');
            $table->string('nama_ortu');
            $table->string('pekerjaan_ortu');
            $table->string('alamat');
            $table->string('rw');
            $table->enum("status_tbu", ["Sangat Pendek", "Pendek", "Normal", "Tinggi"]);
            $table->enum("status_bbu", ["BB Sangat Kurang", "BB Kurang", "Normal", "Resiko BB Lebih"]);
            $table->enum("status_bbtb", ["Gizi Buruk", "Gizi Kurang", "Normal", "Resiko Lebih", "Gizi Lebih", "Obesitas"]);
            $table->timestamps();

            $table->foreign('posyandu_id')->references('id')->on('posyandus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balitas');
    }
};
