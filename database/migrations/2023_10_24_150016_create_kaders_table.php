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
        Schema::create('kaders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posyandu_id');
            $table->string('nama');
            $table->enum("jabatan", ["Ketua", "Sekretaris", "Bendahara", "Anggota"]);
            $table->timestamps();

            $table->foreign('posyandu_id')->references('id')->on('posyandus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaders');
    }
};
