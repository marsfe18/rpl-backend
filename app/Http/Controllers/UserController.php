<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'password' => 'min:6|same:confirm_password',
            'confirm_password' => 'min:6',
        ], [
            'password.same' => 'The password and confirm password must match.',
        ]);

        $user = User::findOrFail($id);
        if ($request->username !== $user->username) {
            $this->validate($request, [
                'username' => 'required|min:4|unique:users',
            ]);
        }



        DB::beginTransaction();
        // Update data user
        // $user->name = $request->input('name');
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->username = $request->input('username');
        $user->update();

        DB::commit();

        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    public function updatePassword(string $id)
    {
    }

    public function findByUsername(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return response()->json([
            'message' => 'User telah ditemukan',
            'data' => $user,
        ], 200);
    }
}
