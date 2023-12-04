<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwals')->insert([
            'judul' => 'Jadwal 1',
            'deskripsi' => 'Deskripsi Jadwal 1',
            'tanggal' => '2023-10-30',
            'waktu' => '08:00 AM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('jadwals')->insert([
            'judul' => 'Jadwal 2',
            'deskripsi' => 'Deskripsi Jadwal 2',
            'tanggal' => '2023-11-05',
            'waktu' => '10:30 AM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('jadwals')->insert([
            'judul' => 'Jadwal 3',
            'deskripsi' => 'Deskripsi Jadwal 3',
            'tanggal' => '2023-12-11',
            'waktu' => '08:00 AM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('jadwals')->insert([
            'judul' => 'Jadwal 4',
            'deskripsi' => 'Deskripsi Jadwal 4',
            'tanggal' => '2023-12-24',
            'waktu' => '10:30 AM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('jadwals')->insert([
            'judul' => 'Jadwal 5',
            'deskripsi' => 'Deskripsi Jadwal 5',
            'tanggal' => '2023-12-26',
            'waktu' => '08:00 AM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
