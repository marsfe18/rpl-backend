<?php

namespace App\Http\Controllers;

use App\Models\Pengukuran;
use Illuminate\Http\Request;

class PengukuranController extends Controller
{
    public function index()
    {
        return response()->json(Pengukuran::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'balita_id' => 'required|exists:balitas,id',
            'tgl_input' => 'required|date',
            'umur' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'rambu_gizi' => 'required|in:N,T,B,O',
            'kms' => 'required|in:Hijau Atas,Hijau,Kuning,Merah',
            'status_tbu' => 'required|in:Sangat Pendek,Pendek,Normal,Tinggi',
            'status_bbu' => 'required|in:BB Sangat Kurang,BB Kurang,Normal,Resiko BB Lebih',
            'status_bbtb' => 'required|in:Gizi Buruk,Gizi Kurang,Normal,Resiko Lebih,Gizi Lebih,Obesitas',
            'posisi_balita' => 'required|in:Tidur,Berdiri',
            'validasi' => 'required|boolean',
        ]);

        $pengukuran = Pengukuran::create($request->all());
        return response()->json($pengukuran, 201);
    }

    public function show($id)
    {
        $pengukuran = Pengukuran::find($id);

        if (!$pengukuran) {
            return response()->json(['message' => 'Pengukuran not found'], 404);
        }

        return response()->json($pengukuran, 200);
    }

    public function update(Request $request, $id)
    {
        $pengukuran = Pengukuran::find($id);

        if (!$pengukuran) {
            return response()->json(['message' => 'Pengukuran not found'], 404);
        }

        $pengukuran->update($request->all());
        return response()->json($pengukuran, 200);
    }

    public function destroy($id)
    {
        $pengukuran = Pengukuran::find($id);

        if (!$pengukuran) {
            return response()->json(['message' => 'Pengukuran not found'], 404);
        }

        $pengukuran->delete();

        return response()->json(null, 204);
    }

    public function pengukuranByBalita($balita_id)
    {
        $pengukuran = Pengukuran::where('balita_id', '=', $balita_id)
            ->get();
        return response()->json($pengukuran);
    }

    public function pengukuranByUmurCat1($balita_id)
    {
        $pengukuran = Pengukuran::where('balita_id', '=', $balita_id)
            ->where('umur', '>=', 0)
            ->where('umur', '<=', 24)
            ->select('umur', 'tinggi_badan')
            ->get();

        return response()->json($pengukuran);
    }

    public function pengukuranByUmurCat2($balita_id)
    {
        $pengukuran = Pengukuran::where('balita_id', '=', $balita_id)
            ->where('umur', '>=', 24)
            ->where('umur', '<=', 60)
            ->select('umur', 'tinggi_badan')
            ->get();

        return response()->json($pengukuran);
    }

    public function pengukuranByUmur($balita_id, $umur)
    {
        $pengukuran = Pengukuran::where('balita_id', '=', $balita_id)
            ->where('umur', '=', $umur)
            ->select('berat_badan')
            ->get();

        return response()->json($pengukuran);
    }
}
