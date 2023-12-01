<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // DB::beginTransaction();
        $gambarName = time() . '_' . $request->file('gambar')->getClientOriginalExtension();

        $berita = Berita::create([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'isi' => $request->input('isi'),
            'gambar' => $gambarName,
            'tgl_berita' => date('Y-m-d H:i:s', time())
        ]);

        Storage::disk('public')->put($gambarName, file_get_contents($request->gambar));



        // DB::commit();

        return response()->json([
            'data' => $berita
        ], 201);
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
