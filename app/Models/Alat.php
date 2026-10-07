<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'jumlah_alat',
        'kondisi',
        'deskripsi',
        'gambar',
        'status',
        'created_by',
        'updated_by',
    ];
}
