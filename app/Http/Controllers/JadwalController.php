<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::orderBy('tanggal', 'asc')->get();
        return response()->json($jadwal, 200);
    }

    public function show($id)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal not found'], 404);
        }
        return response()->json($jadwal, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
        ]);

        $jadwal = Jadwal::create($request->all());
        return response()->json($jadwal, 201);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal not found'], 404);
        }

        $request->validate([]);

        $jadwal->update($request->all());
        return response()->json($jadwal, 200);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal not found'], 404);
        }

        $jadwal->delete();
        return response()->json(null, 204);
    }
}
