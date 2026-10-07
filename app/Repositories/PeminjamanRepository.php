<?php

namespace App\Repositories;

use App\Models\Peminjaman;

class PeminjamanRepository
{
    public function getAll()
    {
        return Peminjaman::latest()->get();
    }

    public function getById($id)
    {
        return Peminjaman::findOrFail($id);
    }

    public function create(array $data)
    {
        return Peminjaman::create($data);
    }

    public function update($id, array $data)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($data);
        return $peminjaman;
    }

    public function delete($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
    }
}