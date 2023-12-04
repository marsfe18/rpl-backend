<?php

namespace App\Http\Controllers;

use App\Models\Koordinat;
use Illuminate\Http\Request;

class KoordinatController extends Controller
{
    public function show($id)
    {
        $koordinat = Koordinat::find($id);

        if (!$koordinat) {
            return response()->json([
                'message' => 'Koordinat not found',
            ], 404);
        }

        return response()->json($koordinat);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'longitut' => 'required',
            'latitude' => 'required',
        ]);

        $koordinat = Koordinat::create($data);

        return response()->json([
            'message' => 'Koordinat created successfully',
            'data' => $koordinat
        ], 201);
    }

    public function update(Request $request, Koordinat $koordinat)
    {
        $data = $request->validate([
            'longitut' => 'required',
            'latitude' => 'required',
        ]);

        $koordinat->update($data);

        return response()->json([
            'message' => 'Koordinat updated successfully',
            'data' => $koordinat
        ]);
    }
}
