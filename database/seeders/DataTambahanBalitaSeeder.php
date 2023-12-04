<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DataTambahanBalitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data__tambahan__balitas')->insert([
            'balita_id' => 1,
            'asi_eksklusif' => true,
            'imd' => false,
            'penyakit_penyerta' => true,
            'riwayat_sakit' => 'Flu',
            'riwayat_imunisasi' => true,
            'riwayat_ibu_hamil_kek' => false,
            'kepemilikan_jamban_sehat' => true,
            'ktp' => 'DKI',
            'jaminan_kesehatan' => 'BPJS',
            'akses_makanan_sehat' => true,
            'konfirmasi_dsa' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('data__tambahan__balitas')->insert([
            'balita_id' => 2,
            'asi_eksklusif' => true,
            'imd' => false,
            'penyakit_penyerta' => true,
            'riwayat_sakit' => 'Flu',
            'riwayat_imunisasi' => true,
            'riwayat_ibu_hamil_kek' => false,
            'kepemilikan_jamban_sehat' => true,
            'ktp' => 'DKI',
            'jaminan_kesehatan' => 'BPJS',
            'akses_makanan_sehat' => true,
            'konfirmasi_dsa' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('data__tambahan__balitas')->insert([
            'balita_id' => 3,
            'asi_eksklusif' => true,
            'imd' => false,
            'penyakit_penyerta' => true,
            'riwayat_sakit' => 'Flu',
            'riwayat_imunisasi' => true,
            'riwayat_ibu_hamil_kek' => false,
            'kepemilikan_jamban_sehat' => true,
            'ktp' => 'DKI',
            'jaminan_kesehatan' => 'BPJS',
            'akses_makanan_sehat' => true,
            'konfirmasi_dsa' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
