<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;
    protected $table='pengaturan';
    protected $fillable=[
        'waktu_masuk',
        'akhir_waktu_masuk',
        'waktu_keluar',
        'akhir_waktu_keluar',
        'logo',
        'logo_kecil',
        'nama_aplikasi',
        'copyright',
    ];
}
