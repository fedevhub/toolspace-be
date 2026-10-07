<?php

namespace App\Repositories;

use App\Models\Kategori;

class KategoriRepository
{
    public function getAll()
    {
        return Kategori::latest()->get();
    }

    public function getById($id)
    {
        return Kategori::findOrFail($id);
    }

    public function create(array $data)
    {
        return Kategori::create($data);
    }

    public function update($id, array $data)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update($data);
        return $kategori;
    }

    public function delete($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
    }
}