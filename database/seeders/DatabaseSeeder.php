<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PuskesmasSeeder;
use Database\Seeders\KoordinatSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PosyanduSeeder;
use Database\Seeders\BalitaSeeder;
use Database\Seeders\BeritaSeeder;
use Database\Seeders\DataTambahanBalitaSeeder;
use Database\Seeders\JadwalSeeder;
use Database\Seeders\KadersSeeder;
use Database\Seeders\PengukuranSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            KoordinatSeeder::class,
            UserSeeder::class,
            KelurahanSeeder::class,
            PuskesmasSeeder::class,
            PosyanduSeeder::class,
            KadersSeeder::class,
            BalitaSeeder::class,
            PengukuranSeeder::class,
            DataTambahanBalitaSeeder::class,
            JadwalSeeder::class,
            BeritaSeeder::class
        ]);
    }
}
