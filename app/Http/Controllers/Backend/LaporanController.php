<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class LaporanController extends Controller
{
    public function laporanAbsensiHarian(Request $req){
        $now=substr(now(),0,10);
        $cari=substr($req->cari,0,10);
        if($req->cari){
            $data = DB::table('vw_absensi')->latest()->where('created_at',"like","$cari%")->get();
        }else{
            $data = DB::table('vw_absensi')->latest()->where('created_at',"like","$now%")->get();
            // $data = DB::table('users')->leftJoin('absensi','users.id','absensi.user_id')->where('absensi.created_at',"like","$now%")->get();
            $cari=$now;
        }



        $pengaturan=Pengaturan::first();
        return view('backend.laporan.laporanAbsensiHarian',compact('data','pengaturan','cari'));
    }

    public function laporanAbsensiHarianPrint($tgl){
        $data = DB::table('vw_absensi')->latest()->where('created_at',"like","$tgl%")->get();
        $pengaturan=Pengaturan::first();
        return view('backend.laporan.printAbsensiHarian',compact('data','tgl','pengaturan'));

    }

    public function laporanAbsensiBulanan(Request $req){
        $now=substr(now(),0,7);
        $cari=substr($req->cari,0,7);
        if($req->cari){
            $data = DB::table('vw_absensi')->latest()->where('created_at',"like","$cari%")->get();
        }else{
            $data = DB::table('vw_absensi')->latest()->where('created_at',"like","$now%")->get();
            // $data = DB::table('users')->leftJoin('absensi','users.id','absensi.user_id')->where('absensi.created_at',"like","$now%")->get();
            $cari=$now;
        }

        $pengaturan=Pengaturan::first();
        return view('backend.laporan.laporanAbsensiBulanan',compact('data','pengaturan','cari'));
    }

    public function laporanAbsensiBulananPrint($tgl){
        $data = DB::table('vw_absensi')->latest()->where('created_at',"like","$tgl%")->get();
        $pengaturan=Pengaturan::first();
        return view('backend.laporan.printAbsensiBulanan',compact('data','tgl','pengaturan'));

    }



    public function laporanPendapatan(Request $req){
        $now=substr(now(),0,7);
        $cari=substr($req->cari,0,7);
        if($req->cari){
            $data = DB::table('vw_user_pegawai')->where('created_at',"like","$cari%")->orderBy('nama','asc')->get();
            // $jumlahJamKerja = DB::table('vw_tunjangan')->latest()->where('created_at',"like","$cari%")->sum('durasi_kerja');
        }else{
            $data = DB::table('vw_user_pegawai')->where('created_at',"like","$now%")->orderBy('nama','asc')->get();
            $jumlahJamKerja = DB::table('vw_absensi')->where('created_at',"like","$now%")->get();
            // $data = DB::table('users')->leftJoin('absensi','users.id','absensi.user_id')->where('absensi.created_at',"like","$now%")->get();
            $cari=$now;
        }

        // dd($data);
        dd( count($jumlahJamKerja->durasi_kerja) );

        $pengaturan=Pengaturan::first();
        return view('backend.laporan.laporanPendapatan',compact('data','pengaturan','cari'));
    }
}
