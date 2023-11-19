<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'user_id',
        'alamat',
        'nomor_telepon',
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
}
