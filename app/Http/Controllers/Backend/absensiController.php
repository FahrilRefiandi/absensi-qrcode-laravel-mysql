<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pengaturan;
use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;

class absensiController extends Controller
{
    public function index(Request $req){
        
        // makeAbsensi
        $kemaren=substr(now()->subDay(),0,10);
        $checkAbsen=Absensi::where('user_id',Auth::user()->id)->where('created_at','like',"$kemaren%")->get();
        // dd($checkAbsen);
        if($checkAbsen->count() == 0 ){
            Absensi::create([
                'user_id'    => Auth::user()->id,
                'updated_at' => now()->subDay(),
                'created_at' => now()->subDay()
            ]);
        }
        // makeAbsensi

        $auth=Auth::user();
        $sekarang=substr(now(),0,7);
        $req->cari=substr($req->cari,0,7);
        $cari=$req->cari;
        if ($req->cari) {
            $data=DB::table('vw_absensi')->where('user_id',$auth->id)->where('created_at',"like","$req->cari%")->latest()->get();
        } else {
            $data=DB::table('vw_absensi')->where('user_id',$auth->id)->where('created_at',"like","$sekarang%")->latest()->get();
        }

        return view('backend.absensi.absensiPribadi',compact('data','auth','cari'));

    }

    public function tunjangan(){
        $form=0;
        $cari=now();
        $auth=Auth::user();
        $pengaturan=Pengaturan::first();
        $lalu=substr(now(),0,7);

        // $data=DB::table('vw_absensi')->where('user_id',$auth->id)->where('created_at','like',"$lalu%")->latest()->get();
        $data=DB::table('vw_tunjangan')->where('user_id',$auth->id)->where('created_at','like',"$lalu%")->orderBy('absensi_masuk','desc')->get();
        $gaji=Pegawai::where('user_id',$auth->id)->first();
        $jumlahTunjangan=DB::table('vw_tunjangan')->where('user_id',$auth->id)->where('created_at','like',"$lalu%")->sum('durasi_kerja');
        // dd($data);
        if($gaji == null){
            return redirect('/profil')->with('status',"Lengkapi data berikut.!");
        }
        return view('backend.absensi.tunjangan',compact('data','auth','pengaturan','jumlahTunjangan','gaji','form','cari'));
    }
}
