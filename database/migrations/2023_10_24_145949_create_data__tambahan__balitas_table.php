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
        Schema::create('data__tambahan__balitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('balita_id');
            $table->boolean('asi_eksklusif')->nullable();
            $table->boolean('imd')->nullable();
            $table->boolean('penyakit_penyerta')->nullable();
            $table->string('riwayat_sakit')->nullable();
            $table->boolean('riwayat_imunisasi')->nullable();
            $table->boolean('riwayat_ibu_hamil_kek')->nullable();
            $table->boolean('kepemilikan_jamban_sehat')->nullable();
            $table->enum("ktp", ["DKI", "Non DKI"])->nullable();
            $table->enum("jaminan_kesehatan", ["BPJS", "KIS", "JKn", "KAJ", "Tidak Ada"])->nullable();
            $table->boolean('akses_makanan_sehat')->nullable();
            $table->boolean('konfirmasi_dsa')->nullable();
            $table->timestamps();

            $table->foreign('balita_id')->references('id')->on('balitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data__tambahan__balitas');
    }
};
