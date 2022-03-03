<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanIzin extends Model
{
    use HasFactory;

    protected $table='pengajuan_izin';
    protected $fillable=[
        'keterangan','bukti_foto','user_id',
    ];
}
