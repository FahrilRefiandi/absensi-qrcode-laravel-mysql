<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Pengaturan::first();
        return view('backend.pengaturan',compact('data'));
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
        $db= Pengaturan::all();

            if($request->check == 1){
                $request->validate([
                    'nama_aplikasi' => 'required|string',
                    'copyright' => 'required',
                ]);

                if($db->count() == 0 ){
                    Pengaturan::create(['nama_aplikasi' => $request->nama_aplikasi, 'copyright' => $request->copyright ]);
                }else{
                    Pengaturan::where('id',1)->update(['nama_aplikasi' => $request->nama_aplikasi, 'copyright' => $request->copyright ]);
                }
                // -------------------
            }elseif($request->check == 2){


                if($db->count() == 0 ){
                    Pengaturan::create(['waktu_masuk' => $request->jam_masuk, 'akhir_waktu_masuk' => $request->akhir_jam_masuk ]);
                }else{
                    Pengaturan::where('id',1)->update(['waktu_masuk' => $request->jam_masuk, 'akhir_waktu_masuk' => $request->akhir_jam_masuk]);
                }
                // ----------------------
            }elseif($request->check == 3){


                if($db->count() == 0 ){
                    Pengaturan::create(['waktu_keluar' => $request->jam_keluar, 'akhir_waktu_keluar' => $request->akhir_jam_keluar ]);
                }else{
                    Pengaturan::where('id',1)->update(['waktu_keluar' => $request->jam_keluar, 'akhir_waktu_keluar' => $request->akhir_jam_keluar]);
                }
                // ---------------------
            }elseif($request->check == 4){
                if($request->logo && $request->logo_kecil){
                    $file = $request->file('logo')->store('logo');
                    $fileKecil = $request->file('logo_kecil')->store('logo');
                }

                if($db->count() == 0 ){
                    Pengaturan::create([
                        'logo' => $file,
                        'logo_kecil' => $fileKecil
                    ]);
                }else{
                    Storage::delete($db[0]->logo);
                    Storage::delete($db[0]->logo_kecil);
                    Pengaturan::where('id',1)->update([
                        'logo' => $file,
                        'logo_kecil' => $fileKecil
                     ]);
                }
            }


        return redirect('/pengaturan');
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
