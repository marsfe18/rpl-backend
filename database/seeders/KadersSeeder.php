<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KadersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kaders')->insert([
            'posyandu_id' => 1,
            'nama' => 'Nama Kader 1',
            'jabatan' => 'Ketua',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kaders')->insert([
            'posyandu_id' => 1,
            'nama' => 'Nama Kader 2',
            'jabatan' => 'Sekretaris',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kaders')->insert([
            'posyandu_id' => 1,
            'nama' => 'Nama Kader 3',
            'jabatan' => 'Bendahara',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kaders')->insert([
            'posyandu_id' => 1,
            'nama' => 'Nama Kader 4',
            'jabatan' => 'Anggota',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kaders')->insert([
            'posyandu_id' => 1,
            'nama' => 'Nama Kader 5',
            'jabatan' => 'Anggota',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kaders')->insert([
            'posyandu_id' => 1,
            'nama' => 'Nama Kader 6',
            'jabatan' => 'Anggota',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
