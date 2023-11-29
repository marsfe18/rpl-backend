<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Balita::all(), 200);
    }

    public function show($id)
    {
        $balita = Balita::find($id);

        if (!$balita) {
            return response()->json(['message' => 'Balita not found'], 404);
        }

        return response()->json($balita, 200);
    }

    public function sort($sort)
    {
        if ($sort === 'nama_asc') {
            $balitas = Balita::orderBy('nama', 'asc')->get();
        } elseif ($sort === 'nama_desc') {
            $balitas = Balita::orderBy('nama', 'desc')->get();
        } elseif ($sort === 'jk_asc') {
            $balitas = Balita::orderBy('jenis_kelamin', 'asc')->get();
        } elseif ($sort === 'jk_desc') {
            $balitas = Balita::orderBy('jenis_kelamin', 'desc')->get();
        } elseif ($sort === 'lahir_asc') {
            $balitas = Balita::orderBy('tgl_lahir', 'asc')->get();
        } elseif ($sort === 'lahir_desc') {
            $balitas = Balita::orderBy('tgl_lahir', 'desc')->get();
        } elseif ($sort === 'umur_asc') {
            $balitas = Balita::orderBy('umur', 'asc')->get();
        } elseif ($sort === 'umur_desc') {
            $balitas = Balita::orderBy('umur', 'desc')->get();
        } else {
            $balitas = Balita::all();
        }

        return response()->json($balitas);
    }


    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,id',
            'nik' => 'required|string',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tgl_lahir' => 'required|date',
            'anak_ke' => 'required|integer',
            'umur' => 'required|integer',
            'nama_ortu' => 'required|string',
            'pekerjaan_ortu' => 'required|string',
            'alamat' => 'required|string',
            'rw' => 'required|string',
            'status_tbu' => 'required|in:Sangat Pendek,Pendek,Normal,Tinggi',
            'status_bbu' => 'required|in:BB Sangat Kurang,BB Kurang,Normal,Resiko BB Lebih',
            'status_bbtb' => 'required|in:Gizi Buruk,Gizi Kurang,Normal,Resiko Lebih,Gizi Lebih,Obesitas',
        ]);

        $balita = Balita::create($request->all());
        return response()->json($balita, 201);
    }

    public function update(Request $request, $id)
    {
        $balita = Balita::find($id);

        if (!$balita) {
            return response()->json(['message' => 'Balita not found'], 404);
        }

        $balita->update($request->all());

        return response()->json($balita, 200);
    }

    public function destroy($id)
    {
        $balita = Balita::find($id);

        if (!$balita) {
            return response()->json(['message' => 'Balita not found'], 404);
        }

        $balita->delete();

        return response()->json(null, 204);
    }

    public function stat_doughnut()
    {
        $totalBalita = Balita::count();
        $total_stunting = Balita::whereIn('status_tbu', ['Pendek', 'Sangat Pendek'])->count();
        return response()->json([
            'total_balita' => $totalBalita,
            'totalStunting' => $total_stunting,
        ]);
    }

    public function stat_stack_bar()
    {
        $totalBalitaLakiStuntingCat1 = Balita::where('jenis_kelamin', 'Laki-Laki')
            ->where('umur', '>=', 0)
            ->where('umur', '<=', 24)
            ->whereIn('status_tbu', ['Pendek', 'Sangat Pendek'])
            ->count();
        $totalBalitaPerempuanStuntingCat1 = Balita::where('jenis_kelamin', 'Perempuan')
            ->where('umur', '>=', 0)
            ->where('umur', '<=', 24)
            ->whereIn('status_tbu', ['Pendek', 'Sangat Pendek'])
            ->count();
        $totalBalitaLakiStuntingCat2 = Balita::where('jenis_kelamin', 'Laki-Laki')
            ->where('umur', '>=', 25)
            ->where('umur', '<=', 60)
            ->whereIn('status_tbu', ['Pendek', 'Sangat Pendek'])
            ->count();
        $totalBalitaPerempuanStuntingCat2 = Balita::where('jenis_kelamin', 'Perempuan')
            ->where('umur', '>=', 25)
            ->where('umur', '<=', 60)
            ->whereIn('status_tbu', ['Pendek', 'Sangat Pendek'])
            ->count();

        return response()->json([
            'totalBalitaLakiStuntingCat1' => $totalBalitaLakiStuntingCat1,
            'totalBalitaPerempuanStuntingCat1' => $totalBalitaPerempuanStuntingCat1,
            'totalBalitaLakiStuntingCat2' => $totalBalitaLakiStuntingCat2,
            'totalBalitaPerempuanStuntingCat2' => $totalBalitaPerempuanStuntingCat2,
        ]);
    }

    public function stat_umum()
    {
        $totalBalita = Balita::count();
        $totalBalitaLakiLaki = Balita::where('jenis_kelamin', 'Laki-Laki')->count();
        $totalBalitaPerempuan = Balita::where('jenis_kelamin', 'Perempuan')->count();
        $total_stunting = Balita::whereIn('status_tbu', ['Pendek', 'Sangat Pendek'])->count();
        $total_underweight = Balita::whereIn('status_bbu', ['BB Sangat Kurang', 'BB Kurang'])->count();
        $total_gizi_buruk = Balita::whereIn('status_bbtb', ['Gizi Buruk', 'Gizi Kurang'])->count();
        $total_obesitas = Balita::whereIn('status_bbtb', ['Obesitas'])->count();
        return response()->json([
            'total_balita' => $totalBalita,
            'totalBalitaLakiLaki' => $totalBalitaLakiLaki,
            'totalBalitaPerempuan' => $totalBalitaPerempuan,
            'totalStunting' => $total_stunting,
            'total_underweight' => $total_underweight,
            'total_gizi_buruk' => $total_gizi_buruk,
            'total_obesitas' => $total_obesitas,
        ]);
    }

    public function getBalitaByPuskesmas($id_puskesmas)
    {
        $balitas = Balita::whereHas('posyandus', function ($query) use ($id_puskesmas) {
            $query->where('puskesmas_id', $id_puskesmas);
        })->get();

        return response()->json(['balitas' => $balitas], 200);
    }

    public function getBalitaByPosyandu($id_posyandu)
    {
        $balitas = Balita::where('posyandu_id', $id_posyandu)->get();

        return response()->json(['balitas' => $balitas], 200);
    }


    public function getBalitaStunting()
    {
        $balitas = Balita::whereIn('status_tbu', ['Pendek', 'Sangat Pendek'])->get();

        return response()->json(['balitas' => $balitas], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $balita = Balita::find($id);

        if (!$balita) {
            return response()->json(['message' => 'Balita not found'], 404);
        }

        $updateData = [
            'umur' => $request->input('umur'),
            'status_tbu' => $request->input('status_tbu'),
            'status_bbu' => $request->input('status_bbu'),
            'status_bbtb' => $request->input('status_bbtb')
        ];

        $balita->update($updateData);

        return response()->json($balita, 200);
    }
}
