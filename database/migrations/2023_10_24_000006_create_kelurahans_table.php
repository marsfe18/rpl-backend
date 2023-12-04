<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('user_id');
            $table->string('alamat');
            $table->string('nomor_telepon');
            $table->unsignedBigInteger('koordinat_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('koordinat_id')->references('id')->on('koordinats');
        });

        // DB::table('kelurahans')->insert([
        //     [
        //         'nama' => 'Bidara Cina',
        //         'user_id' => 1,
        //         'alamat' => 'Jalan blabla',
        //         'nomor_telepon' => '23123123',
        //         'koordinat_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelurahans');
    }
};
