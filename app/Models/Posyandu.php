<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'puskesmas_id',
        'alamat',
        'kepala',
        'rw',
        'nomor_telepon',
        'koordinat',
        'jumlah_balita',
        'user_id'
    ];

    public function puskesmas()
    {
        return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
    }

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
