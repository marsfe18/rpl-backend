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
        Schema::create('koordinats', function (Blueprint $table) {
            $table->id();
            $table->string('longitut');
            $table->string('latitude');
            $table->timestamps();
        });

        // DB::table('koordinats')->insert([
        //     'longitut' => '123.456',
        //     'latitude' => '78.910',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koordinats');
    }
};
