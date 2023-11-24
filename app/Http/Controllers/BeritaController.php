<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        return response()->json(Berita::all(), 200);
    }

    public function show($id)
    {
        $berita = Berita::find($id);
        if (!$berita) {
            return response()->json(['message' => 'Berita not found'], 404);
        }
        return response()->json(['berita' => $berita]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'isi' => 'required|string',
        ]);

        $berita = Berita::create($request->all());

        return response()->json($berita, 201);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);
        if (!$berita) {
            return response()->json(['message' => 'Berita not found'], 404);
        }

        $request->validate([]);

        $berita->update($request->all());

        return response()->json($berita, 200);
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);
        if (!$berita) {
            return response()->json(['message' => 'Berita not found'], 404);
        }

        $berita->delete();
        return response()->json(null, 204);
    }
}
