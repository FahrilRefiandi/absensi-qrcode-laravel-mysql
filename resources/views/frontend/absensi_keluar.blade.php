@extends('frontend.componen.layouts')

@section('title','ABSENSI KELUAR')
@section('content')

@php
    use \App\Models\Pengaturan;
    $pengaturan=Pengaturan::first();
@endphp
 <!-- content -->
 <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7  text-lg-start anouncement ">
        <h1 class="display-4 fw-bold lh-1 mb-3">Absensi Keluar</h1>
        <p class="col-lg-10 fs-4">
          <h5>Dibuka pukul {{$pengaturan->waktu_keluar}}-{{$pengaturan->akhir_waktu_keluar}}.</h5>
          <h6>
            <ul style="list-style:decimal; list-style-position: inside; "  >
                <li> Masukkan link <a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a> </li>
              <li> Login pada link tersebut. </li>
              <li> Scan barcode yang ada disamping. </li>
              <li> Anda berhasil melakukan absensi </li>
            </ul>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti pariatur, facere eveniet adipisci porro dolorem eius ratione exercitationem suscipit. Ipsum iure quisquam sed voluptatum iste eaque repellendus saepe dolorum distinctio.
          </h6>
          <small class="text-muted  mt-4">Jika ditemukan kesalahan silahkan hubungi admin.</small>
        </p>
      </div>
      <div class="col-md-10 mx-auto col-lg-4 mt-4 ">
          <div class="barcode p-4">
            {!! $qrcode !!}
            <!-- <small class="text-muted  mt-4">Scan qrcode for checkin</small> -->
          </div>
      </div>
    </div>
  </div>
<!-- content -->


@endsection
