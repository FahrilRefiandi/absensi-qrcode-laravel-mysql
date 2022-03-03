<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class profil extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Pegawai::where('user_id',Auth::user()->id)->first()){
            $data=DB::table('vw_user_pegawai')->where('user_id',Auth::user()->id)->first();
        }else{
            $data=User::where('id',Auth::user()->id)->first();
        }
        return view('backend.profil',compact('data'));
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
    public function show($id)
    {
        //
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

        $request->validate([
            'username' => ['regex:/^\S*$/u','required',Rule::unique('users')->ignore($id) ] ,
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_tlpn' => 'required',
            'jenis_kelamin' => 'required',
            'foto_profil' => 'image|file|max:4024',
        ]);
        if($request->foto_profil){
            $user=User::where('id',$id)->first();
            $file = $request->file('foto_profil')->store('foto-profil');
            Storage::delete($user->foto_profil);
            User::where('id',$id)->update([
                'foto_profil' => $file,
            ]);

        }else if($request->passSekarang){
            $request->validate([
                'passSekarang'=>'min:8',
                'passBaru'=>'min:8',
            ]);

            if (Hash::check($request->passSekarang, Auth::user()->password)) {
                    User::where('id',$id)->update([
                        'password' => Hash::make($request->passBaru),
                    ]);
                return redirect('/profil')->with('status','Password berhasil diubah');
            }else{
                return redirect('/profil')->with('gagal','Gagal Password salah');
            }

        }

        User::where('id',$id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
        ]);

        if(Pegawai::where('user_id',Auth::user()->id)->first()){
            Pegawai::where('user_id',$id)->update([
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_tlpn' => $request->nomor_tlpn,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
            return redirect('/profil')->with('status',"Data $request->nama Berhasil diubah");
        }else{
            Pegawai::create([
                'user_id' => Auth::user()->id,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_tlpn' => $request->nomor_tlpn,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
            return redirect('/profil')->with('status',"Data $request->nama Berhasil ditambahkan");
        }








        // ddd($request);
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
