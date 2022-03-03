@extends('backend.componen.layout')

@section('title',"Laporan Absensi")
@section('content')

<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Laporan Pendapatan Pegawai</h4>
      <p class="card-description">
        Data diurutkan berdasarkan A-Z.
      </p>


      <div class="table-responsive  mt-1">
        <table class="table select-table table-striped table-hover border " id="example" >
          <thead>
            <tr>
              <th class="text-center" >No.</th>
              <th>Nama</th>
              <th class="text-center" ></th>
              <th class="text-center" >Absensi Keluar</th>
              <th class="text-center" >Status</th>
              {{-- <th>Waktu</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
                <td class="text-center" >{{ $loop->iteration }}.</td>
              <td>
                <div class="d-flex ">
                    @if ($item->foto_profil)
                    <img src="{{Storage::url($item->foto_profil)}}" alt="">
                    @else
                    <img src="{{Storage::url('foto-profil/user.png')}}" alt="">
                    @endif
                  <div>
                    <h6>{{ $item->nama }}</h6>
                    {{-- @if ( $item->level == 0) --}}
                    {{-- <p class="text-danger" >Pegawai</p> --}}
                    {{-- @else --}}
                    <p class="text-info">{{$item->jabatan}}</p>
                    {{-- @endif --}}
                  </div>
                </div>
              </td>

              <td class="text-center" >
                  @if ($item->absensi_masuk)
                  <h6>{{\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i, d-m-Y') }}</h6>
                  <p>{{\Carbon\Carbon::parse($item->absensi_masuk)->diffForHumans()}}</p>
                  @else
                  <h6>-</h6>
                  {{-- <p>-</p> --}}
                  @endif
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
              <td class="text-center" ><div class="badge badge-opacity-danger bg-danger text-light "> Belum Absensi</div></td>
              @elseif (\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i') >= $pengaturan->waktu_masuk)
              <td class="text-center" ><div class="badge badge-opacity-warning bg-warning text-light ">Terlambat {{\Carbon\Carbon::parse($item->absensi_masuk)->diffForHumans($pengaturan->waktu_masuk) }} </div></td>
              @else
              <td class="text-center" ><div class="badge badge-opacity-danger bg-success text-light "> Berhasil Absensi </div></td>
              @endif

            </tr>
            @endforeach

          </tbody>
        </table>
      </div>



    </div>
  </div>
</div>
</div>

@endsection
