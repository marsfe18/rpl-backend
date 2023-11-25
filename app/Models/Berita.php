<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_berita',
        'judul',
        'deskripsi',
        'isi',
        'gambar'
    ];
}
