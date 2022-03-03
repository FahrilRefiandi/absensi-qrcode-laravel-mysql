<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(){
        $auth=Auth::user();
        $user= User::latest()->paginate(12);
        $count['user']=User::count();
        $count['pegawai']=Pegawai::count();
        $jk['laki']=Pegawai::where('jenis_kelamin','Laki-laki')->get();
        $jk['perempuan']=Pegawai::where('jenis_kelamin','Perempuan')->get();
        $rule['admin']=User::where('level',1)->get();
        // $data=DB::table('vw_absensi')->latest()->limit(8)->get();
        $data=DB::table('vw_absensi')->where('absensi_masuk','!=',null)->latest()->limit(8)->get();
        // dd($data);
        return view('backend.dashboard',compact('auth','user','count','jk','rule','data'));

    }


}
