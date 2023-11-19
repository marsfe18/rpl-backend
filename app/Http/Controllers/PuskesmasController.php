<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuskesmasResource;
use App\Models\Koordinat;
use App\Models\Puskesmas;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDOException;

class PuskesmasController extends Controller
{
    public function index()
    {
        $puskesmas = Puskesmas::all();

        return response()->json([
            'data' => $puskesmas,
            'errors' => null,
        ]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'rw' => 'required',
            'kepala' => 'required',
            'nomor_telepon' => 'required',
            'koordinat_id' => 'required',
            'username' => 'required|min:4|unique:users',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6',
        ], [
            'password.same' => 'The password and confirm password must match.',
        ]);

        // print($request);

        $user = new User();
        $user->name = $request->input('nama');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 2;
        $user->save();

        // $koordinat = Koordinat::create($request->input('koordinat'));
        // $koordinat->save();

        $puskesmas = new Puskesmas();
        $puskesmas->nama = $request->input('nama');
        $puskesmas->user_id = $user->id;
        $puskesmas->alamat = $request->input('alamat');
        $puskesmas->rw = $request->input('rw');
        $puskesmas->kepala = $request->input('kepala');
        $puskesmas->nomor_telepon = $request->input('nomor_telepon');
        // $puskesmas->ketua = $request->input('ketua');
        $puskesmas->jumlah_posyandu = 0;
        $puskesmas->koordinat_id = $request->input('koordinat_id');
        $puskesmas->save();

        DB::commit();

        return response()->json([
            'message' => 'Puskesmas telah dibuat',
            'data' => $puskesmas
        ], 201);
    }



    public function show(string $id)
    {

        $puskesmas = Puskesmas::findOrFail($id);

        return response()->json([
            'message' => 'Puskesmas ditemukan',
            'data' => $puskesmas
        ], 200);
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
        DB::beginTransaction();
        $puskesmas = Puskesmas::findOrFail($id);

        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'rw' => 'required',
            'kepala' => 'required',
            'nomor_telepon' => 'required',
            // 'koordinat_id' => 'required',
        ]);

        $puskesmas->nama = $request->input('nama');
        $puskesmas->alamat = $request->input('alamat');
        $puskesmas->nomor_telepon = $request->input('nomor_telepon');
        $puskesmas->kepala = $request->input('kepala');
        $puskesmas->rw = $request->input('rw');

        if ($request->has('koordinat')) {
            $koordinat = $puskesmas->koordinat();
            $koordinat->update($request->input('koordinat'));
        }
        $puskesmas->update();
        DB::commit();

        return response()->json([
            'message' => 'Puskesmas telah diperbaraui',
            'data' => $puskesmas
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        $puskesmas = Puskesmas::findOrFail($id);
        $puskesmas->delete();

        return response()->json([
            'message' => 'Puskesmas deleted successfully',
        ], 200);
        DB::commit();
    }

    public function getPuskesmasByUsername(string $username)
    {
        $user = User::where('username', $username)->first();
        $puskesmas = Puskesmas::where('user_id', $user->id)->first();
        return response()->json(['data' => $puskesmas], 200);
    }
}
