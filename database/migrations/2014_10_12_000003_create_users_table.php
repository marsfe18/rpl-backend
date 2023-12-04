<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });

        // DB::table('users')->insert([
        //     'role_id' => 1, // ID role yang sesuai (misalnya, 1 untuk 'POSYANDU')
        //     'name' => 'Admin',
        //     'username' => 'admin',
        //     'password' => Hash::make('admin'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
