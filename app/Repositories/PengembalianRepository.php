<?php

namespace App\Repositories;

use App\Models\Pengembalian;

class PengembalianRepository
{
    public function getAll()
    {
        return Pengembalian::latest()->get();
    }

    public function getById($id)
    {
        return Pengembalian::findOrFail($id);
    }

    public function create(array $data)
    {
        return Pengembalian::create($data);
    }

    public function update($id, array $data)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update($data);
        return $pengembalian;
    }

    public function delete($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();
    }
}