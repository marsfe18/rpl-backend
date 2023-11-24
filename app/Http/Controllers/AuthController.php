<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Posyandu;
use App\Models\Puskesmas;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ]);

        $user = User::create($validated);

        $user->save();

        return response()->json([
            'data' => $user,
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $validated['username'];
        $password = $validated['password'];

        // Coba melakukan otentikasi pengguna
        if (!$token = Auth::attempt(['username' => $username, 'password' => $password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Dapatkan informasi pengguna yang diotentikasi
        $user = Auth::user();
        $role = Role::find($user->role_id);
        $roleName = $role ? $role->nama : 'Unknown';

        if ($roleName === 'PUSKESMAS' || $roleName === 'POSYANDU') {
            $instansi = ($roleName === 'PUSKESMAS') ? Puskesmas::where('user_id', $user->id)->first() : Posyandu::where('user_id', $user->id)->first();
            $instansiName = $instansi ? $instansi->nama : null;
            $payload = JWTFactory::sub($user->id)
                ->role($roleName)
                // ->user($user)
                ->user_id($user->id)
                ->username($user->username)
                ->instansi($instansiName)
                ->instansi_id($instansi->id)
                ->make();
        } else {
            $instansi = Kelurahan::where('user_id', $user->id)->first();
            $instansiName = $instansi ? $instansi->nama : null;
            $payload = JWTFactory::sub($user->id)
                ->role($roleName)
                ->user_id($user->id)
                ->username($user->username)
                ->instansi($instansiName)
                ->instansi_id($instansi->id)
                ->make();
        }

        // Generate token JWT dengan payload yang dibuat
        $token = JWTAuth::encode($payload);

        return response()->json([
            'access_token' => (string) $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'User logged out'], 200);
    }
}
