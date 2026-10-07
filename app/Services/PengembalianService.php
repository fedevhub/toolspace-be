<?php 

namespace App\Services;

use App\Repositories\PengembalianRepository;

class PengembalianService
{
    private PengembalianRepository $pengembalianRepository;

    public function __construct(PengembalianRepository $pengembalianRepository)
    {
        $this->pengembalianRepository = $pengembalianRepository;
    }

    public function getAllPengembalian()
    {
        return $this->pengembalianRepository->getAll();
    }

    public function getPengembalianById($id)
    {
        return $this->pengembalianRepository->getById($id);
    }

    public function createPengembalian(array $data)
    {
        return $this->pengembalianRepository->create($data);
    }

    public function updatePengembalian($id, array $data)
    {
        return $this->pengembalianRepository->update($id, $data);
    }

    public function deletePengembalian($id)
    {
        return $this->pengembalianRepository->delete($id);
    }
}