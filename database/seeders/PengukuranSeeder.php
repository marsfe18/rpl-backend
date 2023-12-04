<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PengukuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengukurans')->insert([
            'balita_id' => 1,
            'tgl_input' => '2023-10-25',
            'umur' => 12,
            'tinggi_badan' => 80.5,
            'berat_badan' => 10.2,
            'rambu_gizi' => 'N',
            'kms' => 'Hijau Atas',
            'status_tbu' => 'Normal',
            'status_bbu' => 'Normal',
            'status_bbtb' => 'Normal',
            'posisi_balita' => 'Tidur',
            'validasi' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($umur = 5; $umur <= 55; $umur++) {
            $this->createMeasurementData($umur);
        }
    }

    private function createMeasurementData(int $umur): void
    {
        DB::table('pengukurans')->insert([
            'balita_id' => 1,
            'tgl_input' => now()->subMonths(60 - $umur), // Subtracting from the current date to set the date accordingly
            'umur' => $umur,
            'tinggi_badan' => $this->generateRandomValueInRange(70, 110), // Adjust the range as needed
            'berat_badan' => $this->generateRandomValueInRange(8, 15), // Adjust the range as needed
            'rambu_gizi' => 'N',
            'kms' => 'Hijau Atas',
            'status_tbu' => 'Normal',
            'status_bbu' => 'Normal',
            'status_bbtb' => 'Normal',
            'posisi_balita' => 'Tidur',
            'validasi' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function generateRandomValueInRange(float $min, float $max): float
    {
        return round(random_int($min, $max), 1);
    }
}
