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
        Schema::create('puskesmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('rw');
            $table->string('nomor_telepon');
            $table->string('kepala');
            $table->integer('jumlah_posyandu');
            $table->unsignedBigInteger('koordinat_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('koordinat_id')->references('id')->on('koordinats');
        });

        // DB::table('puskesmas')->insert([
        //     'user_id' => 1, // ID pengguna (sesuaikan dengan ID pengguna yang sesuai)
        //     'nama' => 'Nama Puskesmas',
        //     'alamat' => 'Alamat Puskesmas',
        //     'nomor_telepon' => '1234567890',
        //     'jumlah_posyandu' => 5,
        //     'koordinat_id' => 1, // ID koordinat (sesuaikan dengan ID koordinat yang sesuai)
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puskesmas');
    }
};
