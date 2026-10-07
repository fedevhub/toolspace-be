<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_user',
        'id_alat',
        'jumlah',
        'keperluan',
        'tanggal_pinjam',
        'batas_pengembalian',
        'status_peminjaman',
    ];
}
