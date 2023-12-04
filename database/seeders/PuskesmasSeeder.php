<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuskesmasSeeder extends Seeder
{
    public function run()
    {
        DB::table('puskesmas')->insert([
            'user_id' => 2,
            'nama' => 'Puskesmas A',
            'alamat' => 'Jl. Tanjung Lengkong No. 28, RT 03, RW 02',
            'nomor_telepon' => '1234567890',
            'rw' => '02',
            'kepala' => 'Yulius',
            'jumlah_posyandu' => 2,
            'koordinat_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
