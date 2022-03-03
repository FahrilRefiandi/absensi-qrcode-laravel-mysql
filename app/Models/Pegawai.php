<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table='pegawai';

    protected $fillable = [
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'gaji_per_jam',
        'no_tlpn',
        'user_id',
        'jabatan_id',
    ];
}
