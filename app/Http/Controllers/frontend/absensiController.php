<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\TokenAbsensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class absensiController extends Controller
{
    public function absensiMasuk($token){
        $tokenAbsensi=TokenAbsensi::first();
        $tokenDb=$tokenAbsensi->token_absensi_masuk;
        $auth=Auth::user();

        $sekarang= substr(Carbon::now(),0,10);
        $sekarangDiInsert=Carbon::now();

        $absensi=Absensi::where('user_id', $auth->id)->where('absensi_masuk','like',"$sekarang%")->where('absensi_keluar',null)->get();

        if($absensi->count() == 0){
            if($tokenDb != $token){
                return redirect('/absensi')->with('gagal','Gagal.! Token salah');
                // dd('Gagagl token salah');
            }else{
            Absensi::create([
                'absensi_masuk' => $sekarangDiInsert,
                'token_masuk' => $token,
                'user_id' =>  $auth->id,
            ]);
            return redirect('/absensi')->with('sukses',"$auth->nama Anda berhasil absensi");
        //    dd('Berhasil absen',$absensi);
            }
        }elseif($absensi->count() >= 1){
            return redirect('/absensi')->with('gagal','Gagal.! Anda sudah absen atau belum absen keluar');
            // dd('Anda sudah absen atau belum absen keluar',$absensi);
        }else{
            return redirect('/absensi')->with('gagal','Gagal.! Kesalahan pada sistem :(');
            // dd('Oops ada yang salah',$absensi);
        }

    }

    public function absensiKeluar($token){

        $tokenAbsensi=TokenAbsensi::first();
        $tokenDb=$tokenAbsensi->token_absensi_keluar;
        $auth=Auth::user();

        $sekarang= substr(Carbon::now(),0,10);
        $sekarangDiInsert=Carbon::now();

        $absensi=Absensi::where('user_id', $auth->id)->where('absensi_masuk','like',"$sekarang%")->where('absensi_keluar',null)->get();
        $cekDurasi=Absensi::where('user_id', $auth->id)->where('absensi_masuk','like',"$sekarang%")->where('absensi_keluar',null)->first();
        // dd(now()->subHour());



        if($absensi->count() >= 1){
            if($tokenDb != $token){
                return redirect('/absensi')->with('gagal','Gagal.! Token salah');
                // dd('Gagal!! Token salah');
            }else{
                // return redirect('/absensi')->with('gagal','sukses');
                $durasi=\Carbon\Carbon::parse($cekDurasi->absensi_masuk)->diffInHours($cekDurasi->absensi_keluar);
            Absensi::where('user_id',$auth->id)->where('absensi_keluar',null)->where('absensi_masuk','like',"$sekarang%")->update([
                'absensi_keluar' => $sekarangDiInsert,
                'token_keluar' => $token,
                'durasi_kerja' => $durasi,
            ]);
            return redirect('/absensi')->with('sukses',"$auth->nama Anda berhasil absensi");
        //    dd('Berhasil absen keluar',$absensi);
        }
        }elseif($absensi->count() == 0){
            return redirect('/absensi')->with('gagal','Gagal.! Anda belum absen masuk.!');
            // dd('Anda belum absen Masuk',$absensi);
        }else{
            return redirect('/absensi')->with('gagal','Gagal.! Kesalahan pada sistem :(');
            // dd('Oops ada yang salah',$absensi);
        }

    }
}
