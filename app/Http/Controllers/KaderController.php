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
        try {
            $this->validate($request, [
                'nama' => 'required',
                'jabatan' => 'required',
                'posyandu_id' => 'required',
            ]);

            $kader = Kader::create($request->all());

            return response()->json([
                'message' => 'Kader created successfully',
                'data' => $kader,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1452) {
                return response()->json([
                    'message' => 'Foreign key constraint violation. The specified posyandu_id does not exist.',
                ], 404);
            } else {
                // Handle other database-related errors
                return response()->json([
                    'message' => 'Database error',
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal sever error'
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'nama' => 'required',
                'jabatan' => 'required',
                'posyandu_id' => 'required',
            ]);

            $kader = Kader::find($id);

            if (!$kader) {
                return response()->json(['message' => 'Kader not found'], 404);
            }

            $kader->update($request->all());

            return response()->json([
                'message' => 'Kader updated successfully',
                'data' => $kader,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1452) {
                return response()->json([
                    'message' => 'Foreign key constraint violation. The specified fk_id does not exist.',
                ], 404);
            } else {
                return response()->json([
                    'message' => 'Database error',
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal sever error'
            ], 500);
        }
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
