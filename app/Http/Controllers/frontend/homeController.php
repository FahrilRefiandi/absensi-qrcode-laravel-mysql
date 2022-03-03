<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use App\Models\TokenAbsensi;
use Carbon\Carbon;
use App\Models\Pengaturan;
use App\Models\Absensi;

class homeController extends Controller
{



    public function index(){
        $auth=Auth::user();
        $link= env('APP_URL');
        $hariIni=Carbon::now();
        $tokenHariIni=TokenAbsensi::first();
        $uuid = Str::uuid()->toString();

        // Make Token
        if($tokenHariIni == null){
            TokenAbsensi::create([
                'token_absensi_masuk' => Str::uuid()->toString(),
                'token_absensi_keluar' => Str::uuid()->toString(),
            ]);
        }elseif(substr($tokenHariIni->created_at,0,10) < substr($hariIni,0,10)){
            TokenAbsensi::first()->delete();

            TokenAbsensi::create([
                'token_absensi_masuk' => Str::uuid()->toString(),
                'token_absensi_keluar' => Str::uuid()->toString(),
            ]);
        }
        // make Token


        // CheckAbsensi
        $pengaturan=Pengaturan::first();
        $sekarang=substr(now(),11,5);
        $sekarang=explode(':',$sekarang);
        $sekarang=$sekarang[0] * 60 + $sekarang[1];

        $openTime=explode(':',$pengaturan->waktu_masuk);
        $openTime=$openTime[0] * 60 + $openTime[1];

        $closeTime=explode(':',$pengaturan->akhir_waktu_masuk);
        $closeTime=$closeTime[0] * 60 + $closeTime[1];

        // -----------------------------
        $openTimeKeluar=explode(':',$pengaturan->waktu_keluar);
        $openTimeKeluar=$openTimeKeluar[0] * 60 + $openTimeKeluar[1];

        $closeTimeKeluar=explode(':',$pengaturan->akhir_waktu_keluar);
        $closeTimeKeluar=$closeTimeKeluar[0] * 60 + $closeTimeKeluar[1];

        if($sekarang >= $openTime && $sekarang <= $closeTime  ){
            // masuk

            // make QrCode
            $qrcode = QrCode::size(385)->generate($link.'/absensi_masuk/'.$tokenHariIni->token_absensi_masuk);
            // make QrCode
            return view('frontend.absensi_masuk',compact('qrcode','auth'));

        }elseif($sekarang >= $openTimeKeluar && $sekarang <= $closeTimeKeluar){
            // keluar
            $qrcode = QrCode::size(385)->generate($link.'/absensi_keluar/'.$tokenHariIni->token_absensi_keluar);
            return view('frontend.absensi_keluar',compact('qrcode','auth'));
        }else{
            // jam kerja
            return view('frontend.waktuBekerja',compact('auth'));
        }
        // CheckAbsensi


    }

    public function absensiMasuk(){

        $auth=Auth::user();
        $link= env('APP_URL');
        $hariIni=Carbon::now();
        $tokenHariIni=TokenAbsensi::first();
        $uuid = Str::uuid()->toString();

        if($tokenHariIni == null){
            TokenAbsensi::create([
                'token_absensi_masuk' => Str::uuid()->toString(),
                'token_absensi_keluar' => Str::uuid()->toString(),
            ]);
        }elseif(substr($tokenHariIni->created_at,0,10) < substr($hariIni,0,10)){
            TokenAbsensi::first()->delete();

            TokenAbsensi::create([
                'token_absensi_masuk' => Str::uuid()->toString(),
                'token_absensi_keluar' => Str::uuid()->toString(),
            ]);
        }

        // dd($link.'/absensi_masuk/'.$tokenHariIni->token_absensi_masuk);
        $qrcode = QrCode::size(385)->generate($link.'/absensi_masuk/'.$tokenHariIni->token_absensi_masuk);


        return view('frontend.absensi_masuk',compact('qrcode','auth'));
    }

    public function absensiKeluar(){
        $auth=Auth::user();
        $link= env('APP_URL');
        $tokenHariIni=TokenAbsensi::first();
        $qrcode = QrCode::size(385)->generate($link.'/absensi_keluar/'.$tokenHariIni->token_absensi_keluar);
        return view('frontend.absensi_keluar',compact('qrcode','auth'));
    }



    // public function checkAbsensi($response){
    //     if($response == 101){
    //         return redirect('/absensi_keluar');
    //     }
    //     dd($response);
    // }

}
