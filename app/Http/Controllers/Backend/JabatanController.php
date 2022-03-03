<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JabatanModel;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=JabatanModel::latest()->get();
        return view('backend.jabatan',compact('data'));
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
            'jabatan' => 'required|unique:jabatan',
        ]);
        JabatanModel::create(['jabatan' => $request->jabatan]);

        return redirect('/jabatan')->with('status',"Data $request->jabatan Berhasil ditambahkan.!");
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

        // dd($request);
        $request->validate([
            'editJabatan' => "required|unique:jabatan,jabatan",
            'editId' => 'required',
        ]);

        JabatanModel::where('id',$request->editId)->update([
            'jabatan' => $request->editJabatan,
        ]);

        return redirect('/jabatan')->with('status',"Data $request->editJabatan Berhasil Diubah.!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JabatanModel::where('id',$id)->delete();
        return redirect('/jabatan')->with('status',"Data Berhasil Dihapus.!");
    }
}
