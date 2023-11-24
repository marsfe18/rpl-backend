<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Koordinat;
use App\Models\Posyandu;
use App\Models\Puskesmas;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDOException;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posyandu = Posyandu::all();

        return response()->json([
            'data' => $posyandu,
            'errors' => null,
        ]);
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

        DB::beginTransaction();
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'rw' => 'required',
            'nomor_telepon' => 'required',
            'kepala' => 'required',
            // 'koordinat' => 'required',
            'puskesmas_id' => 'required',
            'username' => 'required|min:4|unique:users',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6',
        ], [
            'password.same' => 'The password and confirm password must match.',
        ]);

        $puskesmas = Puskesmas::findOrFail($request->input('puskesmas_id'));

        $user = new User();
        $user->name = $request->input('nama');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 1;
        $user->save();

        // $koordinat = Koordinat::create($request->input('koordinat'));
        // $koordinat->save();

        $posyandu = new Posyandu();
        $posyandu->nama = $request->input('nama');
        $posyandu->puskesmas_id = $puskesmas->id;
        $posyandu->alamat = $request->input('alamat');
        $posyandu->rw = $request->input('rw');
        $posyandu->kepala = $request->input('kepala');
        $posyandu->nomor_telepon = $request->input('nomor_telepon');
        $posyandu->koordinat_id = $request->input('koordinat_id');
        $posyandu->user_id = $user->id;
        $posyandu->jumlah_balita = 0;
        $posyandu->save();

        DB::commit();

        return response()->json([
            'message' => 'Posyandu created successfully',
            'data' => $posyandu,
        ], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posyandu = Posyandu::findOrFail($id);
        return response()->json([
            'message' => 'Posyandu ditemukan',
            'data' => $posyandu,
            'error' => null
        ]);
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
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'rw' => 'required',
            'nomor_telepon' => 'required',
            'kepala' => 'required',
            // 'koordinat' => 'required',
            'puskesmas_id' => 'required',
        ]);

        $posyandu = Posyandu::findOrFail($id);

        $posyandu->nama = $request->input('nama');
        $posyandu->alamat = $request->input('alamat');
        $posyandu->rw = $request->input('rw');
        $posyandu->kepala = $request->input('kepala');
        $posyandu->nomor_telepon = $request->input('nomor_telepon');
        if ($request->has('puskesmas_id')) {
            $posyandu->puskesmas_id = $request->input('puskesmas_id');
        }

        if ($request->has('koordinat')) {
            $koordinat = $posyandu->koordinat();
            $koordinat->update($request->input('koordinat'));
        }
        $posyandu->update();

        DB::commit();

        return response()->json([
            'message' => 'Posyandu updated successfully',
            'data' => $posyandu,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        $posyandu = Posyandu::findOrFail($id);
        $posyandu->delete();
        DB::commit();

        return response()->json([
            'message' => 'Posyandu deleted successfully',
        ], 200);
    }

    public function getPosyanduByPuskesmasId(string $puskesmasId)
    {
        $posyandus = Posyandu::where('puskesmas_id', $puskesmasId)->get();

        return response()->json([
            'message' => 'Posyandu list retrieved successfully',
            'data' => $posyandus,
        ], 200);
    }

    public function getPosyanduByUsername(string $username)
    {
        $user = User::where('username', $username)->first();
        $puskesmas = Puskesmas::where('user_id', $user->id)->first();
        return response()->json([
            'data' => $puskesmas
        ], 200);
    }
}
