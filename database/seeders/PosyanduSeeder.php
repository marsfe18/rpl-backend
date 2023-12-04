<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posyandus')->insert([
            'puskesmas_id' => 1,
            'user_id' => 3,
            'nama' => 'Posyandu A',
            'alamat' => 'Jl. Tanjung Lengkong No. 30, RT 04, RW 07',
            'nomor_telepon' => '08123456789',
            'kepala' => 'Marsay Febrianto',
            'rw' => '07',
            'jumlah_balita' => 50,
            'koordinat_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('posyandus')->insert([
            'puskesmas_id' => 2,
            'user_id' => 4,
            'nama' => 'Posyandu B',
            'alamat' => 'Jl. Tanjung Lengkong No. 33, RT 03, RW 05',
            'nomor_telepon' => '08123456789',
            'kepala' => 'Marsay Febrianto',
            'rw' => '05',
            'jumlah_balita' => 50,
            'koordinat_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
