<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Services\KategoriService;

class KategoriController extends Controller
{
    private KategoriService $kategoriService;

    public function __construct(KategoriService $kategoriService)
    {
        $this->kategoriService = $kategoriService;
    }

    public function index()
    {
        $kategoris = $this->kategoriService->getAllKategoris();
        return response()->json($kategoris);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = $this->kategoriService->createKategori($validatedData);
        return response()->json($kategori, 201);
    }

    public function show($id)
    {
        $kategori = $this->kategoriService->getKategoriById($id);
        if (!$kategori) {
            return response()->json(['message' => 'Kategori not found'], 404);
        }
        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $updatedKategori = $this->kategoriService->updateKategori($id, $validatedData);
        if (!$updatedKategori) {
            return response()->json(['message' => 'Kategori not found'], 404);
        }
        return response()->json($updatedKategori);
    }

    public function destroy($id)
    {
        $deleted = $this->kategoriService->deleteKategori($id);
        if (!$deleted) {
            return response()->json(['message' => 'Kategori not found'], 404);
        }
        return response()->json(['message' => 'Kategori deleted successfully']);
    }
}