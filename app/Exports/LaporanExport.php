<?php

namespace App\Exports;

use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
use App\Models\Pengembalian;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Peminjaman::with(['alat', 'user', 'pengembalian'])
            ->whereBetween('tanggal_pinjam', [$this->startDate, $this->endDate])
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Peminjaman',
            'Nama Alat',
            'Nama Peminjam',
            'Jumlah',
            'Keperluan',
            'Tanggal Pinjam',
            'Batas Pengembalian',
            'Tanggal Kembali',
            'Status Peminjaman',
            'Status Pengembalian',
        ];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->id,
            $peminjaman->alat->nama_alat,
            $peminjaman->user->name,
            $peminjaman->jumlah,
            $peminjaman->keperluan,
            $peminjaman->tanggal_pinjam,
            $peminjaman->batas_pengembalian,
            optional($peminjaman->pengembalian)->tanggal_kembali,
            $peminjaman->status,
            optional($peminjaman->pengembalian)->status ?? 'Belum Dikembalikan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Bold the first row (headings)
        ];
    }
}