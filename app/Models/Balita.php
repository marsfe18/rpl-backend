<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;
    // protected $connection = 'tidb';
    // protected $table = 'db_dashboard_stunting.balitas';
    protected $fillable = [
        'posyandu_id',
        'nama',
        'nik',
        'jenis_kelamin',
        'tgl_lahir',
        'anak_ke',
        'umur',
        'nama_ortu',
        'pekerjaan_ortu',
        'alamat',
        'rw',
        'status_tbu',
        'status_bbu',
        'status_bbtb',
    ];

    public function posyandus()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id');
    }
}
