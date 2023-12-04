<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => 3,
            'name' => 'Kelurahan Bidara Cina',
            'username' => 'bidcinkel',
            'password' => Hash::make('kel1pw'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'Puskemas 1',
            'username' => 'puskesbidcin1',
            'password' => Hash::make('puskes1pw'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Posyandu A',
            'username' => 'posyanbidcin1',
            'password' => Hash::make('posyan1pw'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Posyandu B',
            'username' => 'posyanbidcin2',
            'password' => Hash::make('posyan2pw'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
