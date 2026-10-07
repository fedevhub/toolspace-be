<?php

namespace App\Repositories;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function getStats()
    {
        $today = Carbon::today();

        return [
            'total_peminjaman' => Peminjaman::whereDate('tanggal_peminjaman', $today)->count(),
            'total_pengembalian' => Pengembalian::whereDate('tanggal_pengembalian', $today)->count(),
            'total_anggota' => DB::table('users')->count(),
            'total_alat' => DB::table('alat')->count(),
        ];
    }

    public function getChartData()
    {
        $today = Carbon::today();
        $labels = [];
        $peminjamanData = [];
        $pengembalianData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $labels[] = $date->format('Y-m-d');

            $peminjamanCount = Peminjaman::whereDate('tanggal_peminjaman', $date)->count();
            $pengembalianCount = Pengembalian::whereDate('tanggal_pengembalian', $date)->count();

            $peminjamanData[] = $peminjamanCount;
            $pengembalianData[] = $pengembalianCount;
        }

        return [
            'labels' => $labels,
            'peminjaman' => $peminjamanData,
            'pengembalian' => $pengembalianData,
        ];
    }
}