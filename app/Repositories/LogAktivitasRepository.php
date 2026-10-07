<?php

namespace App\Repositories;

use App\Models\LogAktivitas;

class LogAktivitasRepository
{
    public function getAll($search = null)
    {
        $query = LogAktivitas::with('user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('aktivitas', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('nama_user', 'like', "%{$search}%");
                    });
            });
        }

        return $query->latest('tanggal_aktivitas')->paginate(20);
    }
}