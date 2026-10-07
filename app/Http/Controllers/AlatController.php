<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Services\AlatService;

class AlatController extends Controller
{
    private AlatService $alatService;

    public function __construct(AlatService $alatService)
    {
        $this->alatService = $alatService;
    }

    public function index()
    {
        $alat = $this->alatService->getAllAlat();
        return response()->json($alat);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_alat' => 'required|string|max:255',
            'nama_alat' => 'required|string|max:255',
            'jumlah_alat' => 'required|integer',
            'kondisi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $alat = $this->alatService->createAlat($validatedData);

        return response()->json($alat, 201);
    }

    public function show($id)
    {
        $alat = $this->alatService->getAlatById($id);
        if (!$alat) {
            return response()->json(['message' => 'Alat not found'], 404);
        }
        return response()->json($alat);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_alat' => 'sometimes|required|string|max:255',
            'nama_alat' => 'sometimes|required|string|max:255',
            'jumlah_alat' => 'sometimes|required|integer',
            'kondisi' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'sometimes|required|boolean',
        ]);

        $alat = $this->alatService->updateAlat($id, $validatedData);

        if (!$alat) {
            return response()->json(['message' => 'Alat not found'], 404);
        }

        return response()->json($alat);
    }

    public function destroy($id)
    {
        $deleted = $this->alatService->deleteAlat($id);

        if (!$deleted) {
            return response()->json(['message' => 'Alat not found'], 404);
        }

        return response()->json(['message' => 'Alat deleted successfully']);
    }
}
