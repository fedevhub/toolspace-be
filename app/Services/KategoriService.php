<?php

namespace App\Services;

use App\Repositories\KategoriRepository;

class KategoriService
{
    protected KategoriRepository $kategoriRepository;

    public function __construct(KategoriRepository $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function getAllKategoris()
    {
        return $this->kategoriRepository->getAll();
    }

    public function getKategoriById($id)
    {
        return $this->kategoriRepository->getById($id);
    }

    public function createKategori(array $data)
    {
        return $this->kategoriRepository->create($data);
    }

    public function updateKategori($id, array $data)
    {
        return $this->kategoriRepository->update($id, $data);
    }

    public function deleteKategori($id)
    {
        return $this->kategoriRepository->delete($id);
    }
}