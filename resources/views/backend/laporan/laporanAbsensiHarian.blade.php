@extends('backend.componen.layout')

@section('title',"Laporan Absensi")
@section('content')

<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Laporan Absensi Harian</h4>
      <p class="card-description">
        Data diurutkan berdasarkan A-Z.
      </p>



        <div class="container-fluid mt-4 mb-4">
            <div class="row mt-4">
                <div class="col d-inline mb-4">
                    <form class="d-flex" style="width: 60%" method="POST" action="/laporan-presensi-harian">
                        @csrf
                        <input type="date" class="form-control me-2" value="{{ substr(now()->subDay(),0,10) }}" name="cari" placeholder="Cari berdasarkan hari.">
                        <button class="btn btn-outline-success btn-sm" type="submit">Cari.</button>
                      </form>
                </div>
                {{-- <div class="col mt-4 mb-4 d-inline"></div> --}}
                <div class="col">
                    @if ($data->count() >= 1)
                    <a href="/laporan-presensi-harian/print/{{$cari}}" target="__blank" class="btn btn-dark btn-sm rounded-1  btn-icon-text" style=" float:right " >
                        <i class="ti-printer btn-icon-prepend"></i>
                        Print
                      </a>
                    @endif
                    {{-- <button class="btn btn-dark btn-sm rounded-0 d-flex" > Print </button> --}}
                </div>
              </div>
        </div>


      <div class="table-responsive  mt-1">
        <table class="table select-table table-striped table-hover border " id="example" >
          <thead class="thead-dark" >
            <tr class="text-center" >
              <th class="text-light">No.</th>
              <th class="text-light">Nama</th>
              <th class="text-light">Absensi Masuk</th>
              <th class="text-light">Absensi Keluar</th>
              <th class="text-light">Status</th>
              {{-- <th>Waktu</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            @if ($item->absensi_masuk)


            <tr class="text-center">
                <td>{{ $loop->iteration }}.</td>

                <td>
                    <div class="d-flex ">
                        @if ($item->foto_profil)
                        <img src="{{Storage::url($item->foto_profil)}}" alt="">
                        @else
                        <img src="{{Storage::url('foto-profil/user.png')}}" alt="">
                        @endif
                    <div>
                        <h6 class="text-left" >{{ $item->nama }}</h6>
                        {{-- @if ( $item->level == 0) --}}
                        <p class="text-danger text-left" >{{ $item->jabatan }}</p>
                        {{-- @else --}}
                        {{-- <p class="text-info">Administrator</p> --}}
                        {{-- @endif --}}
                    </div>
                    </div>
                </td>

                <td class="text-center" >
                    <h6>{{\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i, d-m-Y') }}</h6>
                    <p>{{\Carbon\Carbon::parse($item->absensi_masuk)->diffForHumans()}}</p>
                </td>

                <td class="text-center" >
                    @if ($item->absensi_keluar)
                    <h6>{{\Carbon\Carbon::parse($item->absensi_keluar)->format('H:i, d-m-Y') }}</h6>
                    <p>{{\Carbon\Carbon::parse($item->absensi_keluar)->diffForHumans()}}</p>
                    @else
                    <h6>-</h6>
                {{-- <p>-</p> --}}
                    @endif
                </td>


                @if ($item->absensi_masuk == null)
                <td class="text-center" ><div class="badge badge-opacity-danger bg-danger text-light "> Tidak Masuk</div></td>
                @elseif (\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i') >= $pengaturan->waktu_masuk)
                @php
                    $absmasuk=\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i');
                @endphp
                <td class="text-center" ><div class="badge badge-opacity-warning bg-secondary text-light ">Terlambat {{\Carbon\Carbon::parse($absmasuk)->diffForHumans($pengaturan->waktu_masuk) }} </div></td>
                @else
                <td class="text-center" ><div class="badge badge-opacity-danger bg-success text-light "> Berhasil Absensi </div></td>
                @endif
            </tr>

            @else

            <tr class="text-center">
                <td>{{ $loop->iteration }}.</td>
                <td>
                    <div class="d-flex ">
                        @if ($item->foto_profil)
                        <img src="{{Storage::url($item->foto_profil)}}" alt="">
                        @else
                        <img src="{{Storage::url('foto-profil/user.png')}}" alt="">
                        @endif
                    <div>
                        <h6 class="text-left" >{{ $item->nama }}</h6>
                        {{-- @if ( $item->level == 0) --}}
                        <p class="text-danger text-left" >{{ $item->jabatan }}</p>
                        {{-- @else --}}
                        {{-- <p class="text-info">Administrator</p> --}}
                        {{-- @endif --}}
                    </div>
                    </div>
                </td>
                <td colspan="2"> Tidak Masuk. </td>

                @if ($item->absensi_masuk == null)
                <td class="text-center" ><div class="badge badge-opacity-danger bg-danger text-light "> Tidak Masuk</div></td>
                @elseif (\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i') >= $pengaturan->waktu_masuk)
                @php
                    $absmasuk=\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i');
                @endphp
                <td class="text-center" ><div class="badge badge-opacity-warning bg-secondary text-light ">Terlambat {{\Carbon\Carbon::parse($absmasuk)->diffForHumans($pengaturan->waktu_masuk) }} </div></td>
                @else
                <td class="text-center" ><div class="badge badge-opacity-danger bg-success text-light "> Berhasil Absensi </div></td>
                @endif

            </tr>

            @endif
            @endforeach

          </tbody>
        </table>
      </div>





    </div>
  </div>
</div>
</div>




@endsection
