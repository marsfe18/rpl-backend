<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('beritas')->insert([
            'tgl_berita' => '2023-01-15',
            'judul' => 'Judul Berita 1',
            'deskripsi' => 'Deskripsi Berita 1',
            'isi' => 'Ini adalah isi dari berita 1.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-01-11',
            'judul' => 'Judul Berita 2',
            'deskripsi' => 'Deskripsi Berita 2',
            'isi' => 'Ini adalah isi dari berita 2.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-02-14',
            'judul' => 'Judul Berita 3',
            'deskripsi' => 'Deskripsi Berita 3',
            'isi' => 'Ini adalah isi dari berita 3.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-03-13',
            'judul' => 'Judul Berita 4',
            'deskripsi' => 'Deskripsi Berita 4',
            'isi' => 'Ini adalah isi dari berita 4.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-04-16',
            'judul' => 'Judul Berita 5',
            'deskripsi' => 'Deskripsi Berita 5',
            'isi' => 'Ini adalah isi dari berita 5.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-05-21',
            'judul' => 'Judul Berita 6',
            'deskripsi' => 'Deskripsi Berita 6',
            'isi' => 'Ini adalah isi dari berita 6.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-06-23',
            'judul' => 'Judul Berita 7',
            'deskripsi' => 'Deskripsi Berita 7',
            'isi' => 'Ini adalah isi dari berita 7.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-07-21',
            'judul' => 'Judul Berita 8',
            'deskripsi' => 'Deskripsi Berita 8',
            'isi' => 'Ini adalah isi dari berita 8.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-08-23',
            'judul' => 'Judul Berita 9',
            'deskripsi' => 'Deskripsi Berita 9',
            'isi' => 'Ini adalah isi dari berita 9.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-09-11',
            'judul' => 'Judul Berita 10',
            'deskripsi' => 'Deskripsi Berita 10',
            'isi' => 'Ini adalah isi dari berita 10.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('beritas')->insert([
            'tgl_berita' => '2023-10-12',
            'judul' => 'Judul Berita 1',
            'deskripsi' => 'Deskripsi Berita 1',
            'isi' => 'Ini adalah isi dari berita 1.',
            'gambar' => 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=740&t=st=1701704915~exp=1701705515~hmac=c6a32f5ad552f433632af33422c86d90bd4acef5d0b128e97f1e65fb51090fa9',
            'tipe' => 'image/jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
