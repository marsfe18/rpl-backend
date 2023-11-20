<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\Puskesmas;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;


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

    // public function login(Request $request)
    // {
    //     $validated = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);
    //     $username = $validated['username'];
    //     $password = $validated['password'];

    //     if (Auth::attempt(['username' => $username, 'password' => $password])) {
    //         $user = Auth::user();
    //         $role = Role::find($user->role_id);
    //         $roleName = $role ? $role->nama : 'Unknown';

    //         $request->session()->put('username', $user->username);
    //         $request->session()->put('role', $roleName);
    //         $apiToken = $user->createToken('api_token')->plainTextToken;

    //         return response()->json([
    //             'access_token' => $apiToken,
    //             'token_type' => 'Bearer',
    //             'role' => $roleName,
    //         ], 201);
    //     } else {
    //         return response()->json(['error' => 'Username atau password salah'], 401);
    //     }
    // }

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

        // Buat payload untuk token JWT
        $payload = [
            'sub' => $user->id,
            'role' => $roleName,
        ];

        // Jika peran adalah PUSKESMAS atau POSYANDU, tambahkan instansi ke payload
        if ($roleName === 'PUSKESMAS' || $roleName === 'POSYANDU') {
            $instansi = ($roleName === 'PUSKESMAS') ? Puskesmas::where('user_id', $user->id)->first() : Posyandu::where('user_id', $user->id)->first();
            $idInstansi = $instansi ? $instansi->id : null;
            $payload['instansi'] = $idInstansi;
        }

        $payload = JWTFactory::sub($user->id)
            ->myCustomString('Foo Bar')
            ->myCustomArray(['Apples', 'Oranges'])
            ->myCustomObject($user)
            ->make();


        // Generate token JWT dengan payload yang dibuat
        $token = JWTAuth::encode($payload);

        // return response()->json(['token' => $token]);
        // $token = JWTAuth::fromUser($user, $payload);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }


    // public function login(Request $request)
    // {
    //     $validated = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);
    //     $username = $validated['username'];
    //     $password = $validated['password'];

    //     if (Auth::attempt(['username' => $username, 'password' => $password])) {
    //         $user = Auth::user();
    //         $role = Role::find($user->role_id);
    //         $roleName = $role ? $role->nama : 'Unknown';

    //         if ($roleName === 'PUSKESMAS') {
    //             $instansi = Puskesmas::where('user_id', $user->id)->first();
    //             $idInstansi = $instansi ? $instansi->id : null;
    //             $payload = [
    //                 'sub' => $user->id,
    //                 'role' => $roleName,
    //                 'instansi' => $idInstansi,
    //             ];
    //         } else if ($roleName === 'POSYANDU') {
    //             $instansi = Posyandu::where('user_id', $user->id)->first();
    //             $idInstansi = $instansi ? $instansi->id : null;
    //             $payload = [
    //                 'sub' => $user->id,
    //                 'role' => $roleName,
    //                 'instansi' => $idInstansi,
    //             ];
    //         } else {
    //             $payload = [
    //                 'sub' => $user->id,
    //                 'role' => $roleName,
    //             ];
    //         }

    //         $secretKey = 'fiNFINrsnlDifnwpnp';

    //         $token = JWT::encode($payload, $secretKey, 'HS256');


    //         return response()->json([
    //             'access_token' => $token,
    //             'token_type' => 'Bearer',
    //         ], 201);
    //     } else {
    //         return response()->json(['error' => 'Username atau password salah'], 401);
    //     }
    // }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'User logged out'], 200);
    }
}
