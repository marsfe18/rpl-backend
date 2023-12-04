<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use App\Models\Koordinat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // $user = User::factory()->create();
        DB::table('kelurahans')->insert([
            'user_id' => 1,
            'nama' => 'Kelurahan Bidara Cina',
            'alamat' => 'Jl. Tanjung Lengkong, No. 30 RT 004/RW 07, Kecamatan Jatinegara, Kota Jakarta Timur',
            'nomor_telepon' => '021-8192371',
            'koordinat_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
