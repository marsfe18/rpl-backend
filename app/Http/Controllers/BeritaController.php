<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Http\Response;
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

        DB::beginTransaction();
        $gambarName = time() . '_' . $request->file('gambar')->getClientOriginalName();

        $berita = Berita::create([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'isi' => $request->input('isi'),
            'gambar' => $gambarName,
            'tgl_berita' => date('Y-m-d H:i:s', time()),
            'tipe' => $request->file('gambar')->getClientMimeType()
        ]);

        Storage::disk('public')->put($gambarName, file_get_contents($request->gambar));
        DB::commit();

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

        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'isi' => 'required|string',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Jika ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($berita->gambar);

            $gambarName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            Storage::disk('public')->put($gambarName, file_get_contents($request->file('gambar')));
            $berita->gambar = $gambarName;
            $berita->tipe = $request->file('gambar')->getClientMimeType();
        }

        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->isi = $request->isi;
        $berita->tgl_berita = $request->tgl_berita;

        $berita->save();

        return response()->json([
            'data' => $berita
        ], 200);
    }



    public function destroy($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Berita not found'], 404);
        }
        $gambar = $berita->gambar;
        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }
        $berita->delete();
        return response()->json(['message' => 'Berita deleted successfully'], 200);
    }


    public function getGambar($gambarName)
    {

        $berita = Berita::where('gambar', $gambarName)->first();
        if (Storage::disk('public')->exists($gambarName)) {
            $file = Storage::disk('public')->get($gambarName);
            return new Response($file, 200, [
                'Content-Type' => $berita->tipe, // Sesuaikan dengan tipe file gambar yang benar
            ]);
        }
        return response()->json(['message' => 'File not found'], 404);
    }


    public function beritaGambar($id)
    {
        $berita = Berita::find($id);
        if (!$berita) {
            return response()->json(['message' => 'Berita not found'], 404);
        }
        $gambarName = $berita->gambar;
        $mime = $berita->tipe;
        if (Storage::disk('public')->exists($gambarName)) {
            $file = Storage::disk('public')->get($gambarName);
            return new Response($file, 200, [
                'Content-Type' => $mime, // Sesuaikan dengan tipe file gambar yang benar
            ]);
        }
        return response()->json(['message' => 'File not found'], 404);
    }
}
