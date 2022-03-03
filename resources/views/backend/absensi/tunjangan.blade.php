@extends('backend.componen.layout')

@section('title',"Tunjangan > $auth->nama")
@section('content')

@php

    if(count($data)){
        $ket=\Carbon\Carbon::parse($cari)->isoFormat('MMMM');

    }else {
        $ket=\Carbon\Carbon::parse($cari)->isoFormat('MMMM');
    }

@endphp


<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          {{-- Alert --}}
          @if (session('sukses'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('sukses')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @elseif (session('gagal'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('gagal')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          {{-- Alert --}}
        <h4 class="card-title fs-4">Data Absensi dan Pendapatan <strong>{{ $auth->nama }}</strong> </h4>
        <p class="card-description fs-6 mb-3">

            Data yang ditampilkan merupakan data bulan {{ $ket }}
        </p>

        {{-- <nav class="navbar navbar-light bg-transparent mb-3"> --}}
            <div class="container-fluid mt-4 mb-4">
                <div class="row mt-4">
                    <div class="col d-inline mb-4">
                        @if ($form)
                        <form class="d-flex" style="width: 60%" method="POST" action="/absensi-pegawai/{{$auth->id}}">
                            @csrf
                            <input type="month" class="form-control me-2" value="{{ substr(now()->subMonth(),0,7) }}" name="cari" placeholder="Cari berdasarkan bulan.">
                            <button class="btn btn-outline-success btn-sm" type="submit">Cari.</button>
                          </form>
                        @endif
                    </div>
                    {{-- <div class="col mt-4 mb-4 d-inline"></div> --}}
                    <div class="col d-inline">
                        <h3 class="text-dark rounded-1 justify-content-end d-flex "> <strong class="bg-warning px-2 py-1 rounded-1" >Pendapatan Bulan {{$ket}} : {{ number_format( $jumlahTunjangan * $gaji->gaji_per_jam ,0,',','.')}} <b class="text-danger">IDR</b> </strong></h3>
                    </div>
                  </div>
            </div>
          {{-- </nav> --}}


        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="example">
              <thead class="thead-dark">
                <tr class="text-center">
                  <th style="width: 6%">No</th>
                  <th style="width: 25%">Absensi Masuk</th>
                  <th style="width: 25%">Absensi Keluar</th>
                  <th>Jam kerja</th>
                  <th>Waktu</th>
                  <th>Tunjangan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                @if ($item->absensi_masuk)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}.</td>
                    <td class="">
                        {{\Carbon\Carbon::parse($item->absensi_masuk)->diffForHumans()}},
                        <b>{{\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i') }}</b>
                    </td>
                    @if ($item->absensi_keluar)
                    <td class="">
                            {{\Carbon\Carbon::parse($item->absensi_keluar)->diffForHumans()}},
                            <b>{{\Carbon\Carbon::parse($item->absensi_keluar)->format('H:i') }}</b>
                    </td>

                    <td class="">
                        <b>{{ $item->durasi_kerja  }} Jam</b>
                    </td>
                    @else
                    <td class="">-</td>
                    <td class="">-</td>
                    @endif
                    <td class="">{{\Carbon\Carbon::parse($item->created_at)->isoFormat('dddd,DD MMMM YYYY') }}</td>
                    @if ($item->gaji_per_jam && $item->absensi_keluar)
                        <td class=""> {{ number_format( $item->gaji_per_jam * $item->durasi_kerja,0,',','.')}} <b class="text-danger">IDR</b>   </td>
                    @else
                        <td class=""> - </td>
                    @endif
                </tr>

                @else

                <tr class="text-center" style=" background-color:rgba(255, 76, 48, 0.8)"  >
                    <td>{{ $loop->iteration }}.</td>
                    <td colspan="3"> Tidak Masuk. </td>
                    <td  class="">{{\Carbon\Carbon::parse($item->created_at)->isoFormat('dddd,DD MMMM YYYY') }}</td>
                    <td>-</td>

                </tr>


                @endif


                {{-- <tr class="text-center">
                  <td>{{ $loop->iteration }}</td>
                <td class="">
                            {{\Carbon\Carbon::parse($item->absensi_masuk)->diffForHumans()}},
                           <b>{{\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i:s') }}</b>
                </td>
                  @if ($item->absensi_keluar)
                    <td class="">
                            {{\Carbon\Carbon::parse($item->absensi_keluar)->diffForHumans()}},
                            <b>{{\Carbon\Carbon::parse($item->absensi_keluar)->format('H:i:s') }}</b>
                    </td>

                    <td class="">
                        <b>{{ $item->durasi_kerja  }} Jam</b>
                    </td>
                  @else
                  <td class="">-</td>
                  <td class="">-</td>
                  @endif
                    <td class=""> <b>{{\Carbon\Carbon::parse($item->created_at)->isoFormat('dddd,D MMMM Y')}}</b> </td>

                    @if ($item->gaji_per_jam && $item->absensi_keluar)
                        <td class=""> {{ number_format( $item->gaji_per_jam * $item->durasi_kerja,0,',','.')}} <b class="text-danger">IDR</b>   </td>
                    @else
                        <td class=""> - </td>
                    @endif
 --}}


                </tr>
                @endforeach
            </tbody>
            </table>
          </div>
        {{-- Table --}}

      </div>
    </div>
  </div>
  </div>

  <script>
     $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>


@endsection
