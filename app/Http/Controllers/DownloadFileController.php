<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    public function dowloadBuktiIzin(Request $req){
        // dd($req->nama);
        return Storage::download($req->btn,$req->nama.'.png');
    }
}
