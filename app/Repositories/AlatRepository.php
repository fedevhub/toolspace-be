<?php

namespace App\Repositories;

use App\Models\Alat;

class AlatRepository
{
    public function getAll()
    {
        return Alat::latest()->get();
    }

    public function getById($id)
    {
        return Alat::findOrFail($id);
    }

    public function create(array $data)
    {
        return Alat::create($data);
    }

    public function update($id, array $data)
    {
        $alat = Alat::findOrFail($id);
        $alat->update($data);
        return $alat;
    }

    public function delete($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();
    }
}