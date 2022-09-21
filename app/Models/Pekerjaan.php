<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;
    protected $table = 'pekerjaan';
    protected $primaryKey = 'id_pkj';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'nm_pekerjaan',
    ];
}
