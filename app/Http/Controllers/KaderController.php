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

        // Check if there is already a Kader with the specified jabatan in the same Posyandu
        $existingKader = Kader::where('posyandu_id', $request->posyandu_id)
            ->where('jabatan', $request->jabatan)
            ->first();

        if ($existingKader) {
            return response()->json([
                'message' => 'The specified role already exists in the Posyandu.',
            ], 422);
        }

        // Check if there is already a Kader with the roles Ketua, Sekretaris, Bendahara in the same Posyandu
        $existingRoles = Kader::where('posyandu_id', $request->posyandu_id)
            ->whereIn('jabatan', ['Ketua', 'Sekretaris', 'Bendahara'])
            ->count();

        // Allow adding new Kader only if there are no existing roles of Ketua, Sekretaris, Bendahara
        if ($existingRoles > 0 && in_array($request->jabatan, ['Ketua', 'Sekretaris', 'Bendahara'])) {
            return response()->json([
                'message' => 'Posyandu already has Ketua, Sekretaris, or Bendahara. Cannot add another.',
            ], 422);
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
        if ($request->has('jabatan') && $request->jabatan !== $kader->jabatan) {
            $existingKader = Kader::where('posyandu_id', $request->posyandu_id)
                ->where('jabatan', $request->jabatan)
                ->first();

            if ($request->jabatan !== 'Anggota' && $existingKader) {
                return response()->json([
                    'message' => 'The specified role already exists in the Posyandu.',
                ], 422);
            }

            $existingRoles = Kader::where('posyandu_id', $request->posyandu_id)
                ->whereIn('jabatan', ['Ketua', 'Sekretaris', 'Bendahara'])
                ->count();

            if ($existingRoles > 0 && in_array($request->jabatan, ['Ketua', 'Sekretaris', 'Bendahara'])) {
                return response()->json([
                    'message' => 'Posyandu already has Ketua, Sekretaris, or Bendahara. Cannot change to another of these roles.',
                ], 422);
            }
        }

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
