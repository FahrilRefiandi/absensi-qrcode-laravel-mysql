<?php

namespace App\Http\Middleware;

use App\Models\Pengaturan;
use Closure;
use Illuminate\Http\Request;

class absensi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);

        $pengaturan=Pengaturan::first();
        $sekarang=substr(now(),11,5);
        $sekarang=explode(':',$sekarang);
        $sekarang=$sekarang[0] * 60 + $sekarang[1];

        $openTime=explode(':',$pengaturan->waktu_masuk);
        $openTime=$openTime[0] * 60 + $openTime[1];

        $closeTime=explode(':',$pengaturan->akhir_waktu_masuk);
        $closeTime=$closeTime[0] * 60 + $closeTime[1];

        // -----------------------------
        $openTimeKeluar=explode(':',$pengaturan->waktu_keluar);
        $openTimeKeluar=$openTimeKeluar[0] * 60 + $openTimeKeluar[1];

        $closeTimeKeluar=explode(':',$pengaturan->akhir_waktu_keluar);
        $closeTimeKeluar=$closeTimeKeluar[0] * 60 + $closeTimeKeluar[1];

        if($sekarang >= $openTime && $sekarang <= $closeTime  ){
            return redirect('/100');
        }elseif($sekarang >= $openTimeKeluar && $sekarang <= $closeTimeKeluar){
            return redirect('/101');
        }else{
            return redirect('/102');
        }

    }
}
