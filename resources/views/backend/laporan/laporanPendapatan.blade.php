@extends('backend.componen.layout')

@section('title',"Laporan Absensi")
@section('content')

<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Laporan Pendapatan Pegawai({{\Carbon\Carbon::parse($cari)->isoFormat('MMMM')}})</h4>
      <p class="card-description">
        Data diurutkan berdasarkan A-Z.
      </p>



        <div class="container-fluid mt-4 mb-4">
            <div class="row mt-4">
                <div class="col d-inline mb-4">
                    <form class="d-flex" style="width: 60%" method="POST" action="/laporan-pendapatan">
                        @csrf
                        <input type="month" class="form-control me-2" value="{{ substr(now()->subMonth(),0,7) }}" name="cari" placeholder="Cari berdasarkan hari.">
                        <button class="btn btn-outline-success btn-sm" type="submit">Cari.</button>
                      </form>
                </div>
                {{-- <div class="col mt-4 mb-4 d-inline"></div> --}}
                <div class="col">
                    @if ($data->count() >= 1)
                    <a href="/laporan-pendapatan/print/{{$cari}}" target="__blank" class="btn btn-dark btn-sm rounded-1  btn-icon-text" style=" float:right " >
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
          <thead>
            <tr class="text-center" >
              <th >No.</th>
              <th >Nama</th>
              <th >Jenis Kelamin</th>
              <th >Gaji/Jam</th>
              <th >Tunjangan</th>
              <th >Aksi</th>
              {{-- <th>Waktu</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr class="text-center" >
                <td  >{{ $loop->iteration }}.</td>
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
                    <p class="text-danger" >{{ $item->jabatan }}</p>
                    {{-- @else --}}
                    {{-- <p class="text-info">Administrator</p> --}}
                    {{-- @endif --}}
                  </div>
                </div>
              </td>

              <td  >
                    <h6>{{$item->jenis_kelamin}}</h6>
                    {{-- <p>{{\Carbon\Carbon::parse($item->absensi_masuk)->diffForHumans()}}</p> --}}
              </td>

              @if ($item->gaji_per_jam)
              <td  >
                  <h6>{{  number_format( $item->gaji_per_jam ,0,',','.') }} <strong class="text-danger">IDR </strong> </h6>
                  {{-- <p>Total Jam Kerja :{{ $jumlahJamKerja }}Jam</p> --}}
                </td>
                <td  >
                    <h6> {{  number_format( $item->gaji_per_jam  ,0,',','.') }}IDR </h6>
                </td>
                  @else
                  <td ><h6>-</h6></td>
                  <td ><h6>-</h6></td>
                  {{-- <p>-</p> --}}
                  @endif




                  <td  >
                    @if ($item->gaji_per_jam )
                    <a href="/absensi-pegawai/{{$item->user_id}}" class="btn btn-info btn-icon py-2"> <i class="ti-eye"></i> </a>
                    @endif
                  <a href="/pegawai/{{$item->id}}" class="btn btn-warning btn-icon py-2"> <i class="ti-pencil"></i> </a>
                  <form action="/pegawai/{{$item->id}}" class="d-inline" method="POST">
                      @method('DELETE')
                      @csrf
                      <button onclick="return confirm('Yakin data {{$item->nama}} akan dihapus.?')" type="submit" class="btn btn-danger btn-icon py-2"> <i class="ti-trash"></i> </button>
                  </form>
                    {{-- <a href="/pegawai/{{$item->id}}" class="btn btn-danger">Edit</a> --}}
                </td>


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
