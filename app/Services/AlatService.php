<?php

namespace App\Services;

use App\Repositories\AlatRepository;

class AlatService
{
    private AlatRepository $alatRepository;

    public function __construct(AlatRepository $alatRepository)
    {
        $this->alatRepository = $alatRepository;
    }

    public function getAllAlat()
    {
        return $this->alatRepository->getAll();
    }

    public function getAlatById($id)
    {
        return $this->alatRepository->getById($id);
    }

    public function createAlat(array $data)
    {
        return $this->alatRepository->create($data);
    }

    public function updateAlat($id, array $data)
    {
        return $this->alatRepository->update($id, $data);
    }

    public function deleteAlat($id)
    {
        return $this->alatRepository->delete($id);
    }
}