<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        $role = Role::find($user->role_id);
        $roleName = $role ? $role->nama : 'Unknown';

        // Periksa apakah peran pengguna ada di antara peran yang diizinkan
        if (!in_array($roleName, $roles)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
