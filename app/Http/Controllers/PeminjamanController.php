<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogService;
use App\Models\Peminjaman;
use App\Services\PeminjamanService;

class PeminjamanController extends Controller
{
    private PeminjamanService $peminjamanService;

    public function __construct(PeminjamanService $peminjamanService)
    {
        $this->peminjamanService = $peminjamanService;
    }

    public function index()
    {
        $peminjamans = $this->peminjamanService->getAllPeminjaman($request->get('searchPeminjaman'));
        return response()->json($peminjamans);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_alat' => 'required|exists:alat,id',
            'id_user' => 'required|exists:users,id',
            'jumlah' => 'required|integer|min:1',
            'keperluan' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'batas_pengembalian' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $peminjaman = $this->peminjamanService->createPeminjaman($validatedData);
        return response()->json($peminjaman, 201);
    }

    public function show($id)
    {
        $peminjaman = $this->peminjamanService->getPeminjamanById($id);
        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman not found'], 404);
        }
        return response()->json($peminjaman);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_alat' => 'required|exists:alat,id',
            'id_user' => 'required|exists:users,id',
            'jumlah' => 'required|integer|min:1',
            'keperluan' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'batas_pengembalian' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $updatedPeminjaman = $this->peminjamanService->updatePeminjaman($id, $validatedData);
        if (!$updatedPeminjaman) {
            return response()->json(['message' => 'Peminjaman not found'], 404);
        }
        return response()->json($updatedPeminjaman);
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->peminjamanService->deletePeminjaman($id);
            if (!$deleted) {
                return response()->json(['message' => 'Peminjaman not found'], 404);
            }
            return response()->json(['message' => 'Peminjaman deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Peminjaman', 'error' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $peminjamans = $this->peminjamanService->searchPeminjaman($query);
        return response()->json($peminjamans);
    }
}
