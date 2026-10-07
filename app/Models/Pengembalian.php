<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengembalian extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_user',
        'id_alat',
        'jumlah',
        'keperluan',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'batas_pengembalian',
        'keterlambatan',
        'kondisi_alat',
        'denda',
        'catatan',
        'status',
    ];
}
