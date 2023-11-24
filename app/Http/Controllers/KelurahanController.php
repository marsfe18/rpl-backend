<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index()
    {
        $kelurahan = Kelurahan::all()->first();

        return response()->json(
            $kelurahan
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'user_id' => 'required|integer',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string',
            'koordinat_id' => 'required|integer',
        ]);

        $kelurahan = Kelurahan::create($data);

        return response()->json([
            'message' => 'Kelurahan created successfully',
            'data' => $kelurahan
        ], 201);
    }

    public function show($id)
    {
        $kelurahan = Kelurahan::find($id);

        if (!$kelurahan) {
            return response()->json([
                'message' => 'Kelurahan not found',
            ], 404);
        }

        return response()->json(
            $kelurahan
        );
    }


    public function update(Request $request, Kelurahan $kelurahan)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'user_id' => 'required|integer',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string',
            'koordinat_id' => 'required|integer',
        ]);

        $kelurahan->update($data);

        return response()->json([
            'message' => 'Kelurahan updated successfully',
            'data' => $kelurahan
        ]);
    }
}
