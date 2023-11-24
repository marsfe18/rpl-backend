<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Tambahan_Balita extends Model
{
    use HasFactory;
    protected $fillable = [
        'balita_id',
        'asi_eksklusif',
        'imd',
        'penyakit_penyerta',
        'riwayat_sakit',
        'riwayat_imunisasi',
        'riwayat_ibu_hamil_kek',
        'kepemilikan_jamban_sehat',
        'ktp',
        'jaminan_kesehatan',
        'akses_makanan_sehat',
        'konfirmasi_dsa'
    ];
}
