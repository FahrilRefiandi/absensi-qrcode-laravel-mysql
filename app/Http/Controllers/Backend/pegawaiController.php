<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JabatanModel;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class pegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $nama=User::orderBy('nama','asc')->where('id','!=',[2,1,3,4])->get();
        $pegawai=Pegawai::where('user_id','!=',null)->get();
        $jabatan=JabatanModel::latest()->get();
        $filter=[];
        foreach($pegawai as $id){
            array_push($filter,['id','!=',$id->user_id] );
        }

        $nama=User::where($filter)->orderBy('nama','asc')->get();
        $data=DB::table('vw_pegawai')->orderBy('nama','asc')->latest()->get();
        return view('backend.pegawaiAdmin',compact('data','nama','jabatan'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_tlpn' => 'numeric|required',
            'gaji_per_jam' => 'numeric|required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
        ]);

        Pegawai::create([
            'user_id' => $request->nama,
            'jabatan_id' => $request->jabatan,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_tlpn' => $request->nomor_tlpn,
            'gaji_per_jam' => $request->gaji_per_jam,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect('/pegawai')->with('status',"Data berhasil ditambahkan.!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = Pegawai::where('id',$id)->first();
        $data =DB::table('vw_pegawai')->where('id',$id)->first();
        $jabatan=JabatanModel::orderBy('jabatan','asc')->get();
        return view('backend.editPegawai',compact('data','jabatan'));
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
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_tlpn' => 'required',
            'jabatan' => 'required|numeric',
            'gaji_per_jam' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        Pegawai::where('id',$id)->update([
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_tlpn' => $request->nomor_tlpn,
            'jabatan_id' => $request->jabatan,
            'gaji_per_jam' => $request->gaji_per_jam,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        User::where('id',$request->user_id)->update([
            'nama' => $request->nama,
        ]);

        return redirect('/pegawai')->with('status',"Data $request->nama berhasil diubah.!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::where('id',$id)->delete();
        return redirect('/pegawai')->with('status','Data berhasil dihapus.!');
    }
}
