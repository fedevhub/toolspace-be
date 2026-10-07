<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class log-aktivitas extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_user',
        'aktivitas',
        'tanggal_aktivitas',
    ];
}
