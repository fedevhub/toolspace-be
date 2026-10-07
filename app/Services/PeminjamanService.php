<?php

namespace App\Services;

use App\Repositories\PeminjamanRepository;

class PeminjamanService
{
    private PeminjamanRepository $peminjamanRepository;

    public function __construct(PeminjamanRepository $peminjamanRepository)
    {
        $this->peminjamanRepository = $peminjamanRepository;
    }

    public function getAllPeminjaman()
    {
        return $this->peminjamanRepository->getAll();
    }

    public function getPeminjamanById($id)
    {
        return $this->peminjamanRepository->getById($id);
    }

    public function createPeminjaman(array $data)
    {
        return $this->peminjamanRepository->create($data);
    }

    public function updatePeminjaman($id, array $data)
    {
        return $this->peminjamanRepository->update($id, $data);
    }

    public function deletePeminjaman($id)
    {
        return $this->peminjamanRepository->delete($id);
    }
}