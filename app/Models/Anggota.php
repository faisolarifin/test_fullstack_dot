<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $fillable = [
        'id_kk',
        'id_pkj',
        'nik',
        'nama',
        'jenkel',
        'tmp_lahir',
        'tgl_lahir',
        'status_kawin',
        'nm_ayah',
        'nm_ibu',
    ];

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pkj');
    }
    public function kk()
    {
        return $this->belongsTo(KK::class, 'id_kk');
    }
}
