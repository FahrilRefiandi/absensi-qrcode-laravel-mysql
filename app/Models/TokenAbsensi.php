<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenAbsensi extends Model
{
    use HasFactory;

    protected $table='token_absensi';
    protected $fillable=[
        'token_absensi_masuk',
        'token_absensi_keluar',
    ];
}
