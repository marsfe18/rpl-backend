<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class KaderController extends Controller
{
    public function index()
    {
        $kaders = Kader::all();

        return response()->json([
            'data' => $kaders,
            'errors' => null,
        ]);
    }

    public function show(string $id)
    {
        try {
            $kader = Kader::findOrFail($id);

            return response()->json([
                'data' => $kader,
                'errors' => null,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Kader not found'
            ], 404);
        }
    }


    public function getKaderByPosyanduId(string $posyanduId)
    {
        try {
            $kaders = Kader::where('posyandu_id', $posyanduId)->get();

            return response()->json([
                'message' => 'Kader list retrieved successfully',
                'data' => $kaders,
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Foreign key constraint violation. The specified posyandu_id does not exist.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => ['required', 'in:Ketua,Sekretaris,Bendahara,Anggota'],
            'posyandu_id' => 'required',
        ]);

        if ($request->jabatan !== 'Anggota') {
            $exist = Kader::where('posyandu_id', $request->posyandu_id)
                ->where('jabatan', $request->jabatan)
                ->count();
            if ($exist > 0) {
                return response()->json(['message' => 'Posyandu ini telah memiliki seorang ' . $request->jabatan]);
            }
        }


        $kader = Kader::create($request->all());

        return response()->json([
            'message' => 'Kader created successfully',
            'data' => $kader,
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => ['required', 'in:Ketua,Sekretaris,Bendahara,Anggota'],
            'posyandu_id' => 'required',
        ]);

        $kader = Kader::find($id);

        if (!$kader) {
            return response()->json(['message' => 'Kader not found'], 404);
        }

        if (!($kader->jabatan === $request->jabatan) && !($request->jabatan === 'Anggota')) {
            $exist = Kader::where('posyandu_id', $request->posyandu_id)
                ->where('jabatan', $request->jabatan)
                ->count();
            if ($exist > 0) {
                return response()->json(['message' => 'Posyandu ini telah memiliki seorang ' . $request->jabatan], 409);
            }
        }

        $kader->jabatan = $request->jabatan;
        $kader->nama = $request->nama;
        $kader->posyandu_id = $request->posyandu_id;


        $kader->update($request->all());

        return response()->json([
            'message' => 'Kader updated successfully',
            'data' => $kader,
        ], 200);
    }



    public function destroy(string $id)
    {
        $kader = Kader::find($id);
        if (!$kader) {
            return response()->json(['message' => 'Kader not found'], 404);
        }
        $kader->delete();
        return response()->json(['message' => 'Kader deleted successfully'], 200);
    }
}
