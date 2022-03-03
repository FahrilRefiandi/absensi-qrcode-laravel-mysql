<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class AbsensiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req,$id)
    {
        $form=1;
        $auth=User::where('id',$id)->first();
        $sekarang=substr(now(),0,7);
        $req->cari= substr($req->cari,0,7);
        $gaji=Pegawai::where('user_id',$id)->first();
        $cari=now();
        if($req->cari){
            $data=DB::table('vw_tunjangan')->where('user_id',$id)->where('created_at','like',"$req->cari%")->orderBy('absensi_masuk','desc')->get();
            $jumlahTunjangan=DB::table('vw_tunjangan')->where('user_id',$auth->id)->where('created_at','like',"$req->cari%")->sum('durasi_kerja');
            $cari=$req->cari;
        }else{
            $data=DB::table('vw_tunjangan')->where('user_id',$id)->where('created_at','like',"$sekarang%")->orderBy('absensi_masuk','desc')->get();
            $jumlahTunjangan=DB::table('vw_tunjangan')->where('user_id',$auth->id)->where('created_at','like',"$sekarang%")->sum('durasi_kerja');
        }

        // dd($data);
        // dd($gaji);
        if($gaji == null){
            return redirect('/pegawai')->with('status',"Data tidak ditemukan.!");
        }
        return view('backend.absensi.tunjangan',compact('auth','data','gaji','jumlahTunjangan','form','cari'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
