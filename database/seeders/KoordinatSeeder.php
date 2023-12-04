<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KoordinatSeeder extends Seeder
{
    public function run()
    {
        DB::table('koordinats')->insert([
            'longitut' => '106.86737165836401',
            'latitude' => '-6.239964011536474',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('koordinats')->insert([
            'longitut' => '106.86737165836401',
            'latitude' => '-6.239964011536474',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('koordinats')->insert([
            'longitut' => '106.86737165836401',
            'latitude' => '-6.239964011536474',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('koordinats')->insert([
            'longitut' => '106.86737165836401',
            'latitude' => '-6.239964011536474',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
