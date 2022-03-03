<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PengajuanIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table('vw_pengajuan_izin')->latest()->get();
        return view('backend.perizinan.requestPerizinan',compact('data'));
    }

    public function pengajuanIzin(){
        $data=PengajuanIzin::where('user_id',Auth::user()->id)->latest()->get();
        return view('backend.perizinan.permintaanPerizinan',compact('data'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('bukti_foto')){
            $file = $request->file('bukti_foto')->store('bukti-foto');
        }else{
            $file = null;
        }
        PengajuanIzin::create([
            'keterangan' => $request->keterangan,
            'bukti_foto' => $file,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/pengajuan-izin')->with('status',"Perizinan Berhasil Dikirimkan");
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
    public function tolak(Request $request)
    {
        $id=$request->id;
        PengajuanIzin::where('id',$id)->update([
            'status' => 2,
        ]);
        return redirect('/perizinan')->with('status',"Pengajuan izin $request->nama Ditolak.!");
    }

    public function acc(Request $request)
    {
        // dd($request);
        $id=$request->id;
        PengajuanIzin::where('id',$id)->update([
            'status' => 3,
        ]);
        return redirect('/perizinan')->with('status',"Pengajuan izin $request->nama Diterima.!");
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
