<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Services\PengembalianService;

class PengembalianController extends Controller
{
    private PengembalianService $pengembalianService;

    public function __construct(PengembalianService $pengembalianService)
    {
        $this->pengembalianService = $pengembalianService;
    }

    public function index()
    {
        $pengembalians = $this->pengembalianService->getAllPengembalians();
        return response()->json($pengembalians);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id',
            'jumlah' => 'required|integer|min:1',
            'keperluan' => 'required|string|max:255',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'batas_pengembalian' => 'nullable|date|after_or_equal:tanggal_peminjaman',
            'keterlambatan' => 'nullable|integer|min:0',
            'kondisi_alat' => 'required|string|max:255',
            'denda' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $pengembalian = $this->pengembalianService->createPengembalian($validatedData);
        return response()->json($pengembalian, 201);
    }

    public function show($id)
    {
        $pengembalian = $this->pengembalianService->getPengembalianById($id);
        if (!$pengembalian) {
            return response()->json(['message' => 'Pengembalian not found'], 404);
        }
        return response()->json($pengembalian);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id',
            'jumlah' => 'required|integer|min:1',
            'keperluan' => 'required|string|max:255',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'batas_pengembalian' => 'nullable|date|after_or_equal:tanggal_peminjaman',
            'keterlambatan' => 'nullable|integer|min:0',
            'kondisi_alat' => 'required|string|max:255',
            'denda' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $updatedPengembalian = $this->pengembalianService->updatePengembalian($id, $validatedData);
        if (!$updatedPengembalian) {
            return response()->json(['message' => 'Pengembalian not found'], 404);
        }
        return response()->json($updatedPengembalian);
    }

    public function destroy($id)
    {
        $deleted = $this->pengembalianService->deletePengembalian($id);
        if (!$deleted) {
            return response()->json(['message' => 'Pengembalian not found'], 404);
        }
        return response()->json(['message' => 'Pengembalian deleted successfully']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $pengembalians = $this->pengembalianService->searchPengembalian($query);
        return response()->json($pengembalians);
    }
}
