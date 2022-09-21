<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KK extends Model
{
    use HasFactory;
    protected $table = 'kartu_keluarga';
    protected $primaryKey = 'id_kk';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'no_kk',
        'nm_kepala',
        'alamat',
        'rt_rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'kodepos',
        'provinsi',
    ];
}
