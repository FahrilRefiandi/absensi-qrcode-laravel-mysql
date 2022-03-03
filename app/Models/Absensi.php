<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table='absensi';
    protected $fillable=[
        'absensi_masuk',
        'absensi_keluar',
        'token_masuk',
        'token_keluar',
        'durasi_kerja',
        'user_id',
        'created_at',
        'updated_at',
    ];
}

