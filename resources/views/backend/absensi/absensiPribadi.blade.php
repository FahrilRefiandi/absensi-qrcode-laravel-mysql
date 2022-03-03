@extends('backend.componen.layout')

@section('title',"Absensi > $auth->nama")
@section('content')

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
        <h4 class="card-title fs-4">Data Absensi <strong>{{ $auth->nama }}</strong> </h4>
        <p class="card-description fs-6 mb-3">
          Data absensi yang ditampilkan merupakan data bulan ini. ({{\Carbon\Carbon::parse($cari)->isoFormat('MMMM') }})
        </p>


        <div class="container-fluid mt-4 mb-4">
            <form class="d-flex" style="width: 25%" method="POST" action="/absensi">
                @csrf
                <input type="month" class="form-control me-2" value="{{ substr(now()->subMonth(),0,7) }}" name="cari" placeholder="Cari berdasarkan bulan.">
                <button class="btn btn-outline-success btn-sm" type="submit">Cari.</button>
              </form>
        </div>



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
                </tr>

                @else

                <tr class="text-center" style=" background-color:rgba(255, 76, 48, 0.8)"  >
                    <td>{{ $loop->iteration }}.</td>
                    <td colspan="3"> Tidak Masuk. </td>
                    <td  class="">{{\Carbon\Carbon::parse($item->created_at)->isoFormat('dddd,DD MMMM YYYY') }}</td>

                </tr>

                @endif


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
