<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengukuran extends Model
{
    use HasFactory;
    protected $fillable = [
        'balita_id',
        'tgl_input',
        'tinggi_badan',
        'berat_badan',
        // 'bbu',
        // 'tbu',
        // 'bbtb',
        'umur',
        'rambu_gizi',
        'kms',
        'status_tbu',
        'status_bbu',
        'status_bbtb',
        'posisi_balita',
        'validasi'
    ];
}
