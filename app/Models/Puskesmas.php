<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'user_id',
        'alamat',
        'rw',
        'nomor_telepon',
        'kepala',
        'jumlah_posyandu',
        'koordinat_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function koordinat()
    {
        return $this->belongsTo(Koordinat::class, 'koordinat_id');
    }

    public function saveAlamat($alamat)
    {
        $filteredAttributes = array_filter($alamat); // Menghapus nilai kosong

        $this->alamat = implode(', ', $filteredAttributes);
    }
}
