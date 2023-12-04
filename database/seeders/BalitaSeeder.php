<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BalitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('balitas')->insert([
            'posyandu_id' => 1,
            'nik' => '1234567891',
            'nama' => 'Balita A',
            'jenis_kelamin' => 'Laki-Laki',
            'tgl_lahir' => '2021-01-15',
            'anak_ke' => 1,
            'umur' => 36,
            'nama_ortu' => 'Orang Tua A',
            'pekerjaan_ortu' => 'Pekerja',
            'alamat' => 'Masjid, RT 01, RW 02',
            'rw' => '01',
            'status_tbu' => 'Sangat Pendek',
            'status_bbu' => 'BB Kurang',
            'status_bbtb' => 'Gizi Kurang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('balitas')->insert([
            'posyandu_id' => 1,
            'nik' => '1234567892',
            'nama' => 'Balita B',
            'jenis_kelamin' => 'Perempuan',
            'tgl_lahir' => '2020-02-15',
            'anak_ke' => 2,
            'umur' => 48,
            'nama_ortu' => 'Orang Tua B',
            'pekerjaan_ortu' => 'Pekerja',
            'alamat' => 'Masjid, RT 01, RW 02',
            'rw' => '01',
            'status_tbu' => 'Pendek',
            'status_bbu' => 'BB Kurang',
            'status_bbtb' => 'Normal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('balitas')->insert([
            'posyandu_id' => 2,
            'nik' => '1234567893',
            'nama' => 'Balita C',
            'jenis_kelamin' => 'Perempuan',
            'tgl_lahir' => '2022-02-11',
            'anak_ke' => 3,
            'umur' => 24,
            'nama_ortu' => 'Orang Tua C',
            'pekerjaan_ortu' => 'Pekerja',
            'alamat' => 'Masjid, RT 01, RW 02',
            'rw' => '01',
            'status_tbu' => 'Normal',
            'status_bbu' => 'Normal',
            'status_bbtb' => 'Normal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('balitas')->insert([
            'posyandu_id' => 2,
            'nik' => '1234567894',
            'nama' => 'Balita D',
            'jenis_kelamin' => 'Laki-Laki',
            'tgl_lahir' => '2021-03-12',
            'anak_ke' => 4,
            'umur' => 37,
            'nama_ortu' => 'Orang Tua D',
            'pekerjaan_ortu' => 'Pekerja',
            'alamat' => 'Masjid, RT 01, RW 02',
            'rw' => '01',
            'status_tbu' => 'Normal',
            'status_bbu' => 'BB Kurang',
            'status_bbtb' => 'Gizi Kurang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('balitas')->insert([
            'posyandu_id' => 2,
            'nik' => '1234567895',
            'nama' => 'Balita E',
            'jenis_kelamin' => 'Perempuan',
            'tgl_lahir' => '2023-01-15',
            'anak_ke' => 5,
            'umur' => 11,
            'nama_ortu' => 'Orang Tua E',
            'pekerjaan_ortu' => 'Pekerja',
            'alamat' => 'Masjid, RT 01, RW 02',
            'rw' => '01',
            'status_tbu' => 'Pendek',
            'status_bbu' => 'Normal',
            'status_bbtb' => 'Normal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
