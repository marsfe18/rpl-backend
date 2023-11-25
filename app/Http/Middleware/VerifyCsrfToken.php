<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/api/puskesmas*',
        '/api/posyandu*',
        '/api/login*',
        '/api/balitas*',
        '/api/Jadwals*',
        '/api/beritas*',
        '/api/dataTambahanBalitas*',
        '/api/kader*',
        '/api/kelurahan*',
        '/api/koordinat*',
        '/api/pengukurans*',
        '/api/user',
        '/api/puskesmas',
        '/api/posyandu',
        '/api/login',
        '/api/balitas',
        '/api/Jadwals',
        '/api/beritas',
        '/api/dataTambahanBalitas',
        '/api/kader',
        '/api/kelurahan',
        '/api/koordinat',
        '/api/pengukurans',
        '/api/user'
    ];
}
