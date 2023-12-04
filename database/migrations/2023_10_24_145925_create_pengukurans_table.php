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
        Schema::create('pengukurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('balita_id');
            $table->date('tgl_input');
            $table->integer('umur');
            $table->float('tinggi_badan');
            $table->float('berat_badan');
            $table->enum("rambu_gizi", ["N", "T", "B", "O"]);
            $table->enum("kms", ["Hijau Atas", "Hijau", "Kuning", "Merah"]);
            $table->enum("status_tbu", ["Sangat Pendek", "Pendek", "Normal", "Tinggi"]);
            $table->enum("status_bbu", ["BB Sangat Kurang", "BB Kurang", "Normal", "Resiko BB Lebih"]);
            $table->enum("status_bbtb", ["Gizi Buruk", "Gizi Kurang", "Normal", "Resiko Lebih", "Gizi Lebih", "Obesitas"]);
            $table->enum("posisi_balita", ["Tidur", "Berdiri"]);
            $table->boolean('validasi');
            $table->timestamps();

            $table->foreign('balita_id')->references('id')->on('balitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukurans');
    }
};
