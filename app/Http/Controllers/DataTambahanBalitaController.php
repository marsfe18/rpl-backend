<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_Tambahan_Balita;

class DataTambahanBalitaController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Data_Tambahan_Balita::all(), 200);
    }

    // Endpoint untuk menyimpan data tambahan balita
    public function store(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'balita_id' => 'required|exists:balitas,id',
        ]);

        // Simpan data tambahan balita
        $dataTambahanBalitas = Data_Tambahan_Balita::create($request->all());

        return response()->json($dataTambahanBalitas, 201);
    }

    // Endpoint untuk menampilkan data tambahan balita berdasarkan ID balita
    public function show($id)
    {
        $dataTambahanBalitas = Data_Tambahan_Balita::where('id', $id)->first();

        if (!$dataTambahanBalitas) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($dataTambahanBalitas, 200);
    }

    // Endpoint untuk mengupdate data tambahan balita berdasarkan ID balita
    public function update(Request $request, $id)
    {
        // Validasi permintaan
        $request->validate([
            // Tambahkan validasi sesuai dengan kebutuhan Anda
        ]);

        $dataTambahanBalitas = Data_Tambahan_Balita::where('id', $id)->first();

        if (!$dataTambahanBalitas) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Perbarui data tambahan balita
        $dataTambahanBalitas->update($request->all());

        return response()->json($dataTambahanBalitas, 200);
    }

    // Endpoint untuk menghapus data tambahan balita berdasarkan ID balita
    public function destroy($id)
    {
        $dataTambahanBalitas = Data_Tambahan_Balita::where('id', $id)->first();

        if (!$dataTambahanBalitas) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Hapus data tambahan balita
        $dataTambahanBalitas->delete();

        return response()->json(null, 204);
    }

    public function getDataTambahanByBalita($balita_id)
    {
        $dataTambahanBalitas = Data_Tambahan_Balita::where('balita_id', $balita_id)->first();

        if (!$dataTambahanBalitas) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($dataTambahanBalitas, 200);
    }
}
