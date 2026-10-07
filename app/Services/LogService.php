<?php 

namespace App\Services;

use App\Models\LogAktivitas;

class LogService
{
    public static function log(int $userId, string $aktivitas): void
    {
        LogAktivitas::create([
            'user_id' => $userId,
            'aktivitas' => $aktivitas,
            'tanggal_aktivitas' => now(),
        ]); 
    }
}