<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['nama']; // Tambahkan 'nama' ke dalam $fillable

    // Atur primary key sesuai dengan 'id' jika tidak sudah otomatis
    protected $primaryKey = 'id';

    // Tambahkan definisi kolom 'nama' dan 'id' jika perlu
    protected $table = 'roles'; // Sesuaikan dengan nama tabel yang sesuai
}
