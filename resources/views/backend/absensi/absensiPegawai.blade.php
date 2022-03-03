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
        <h4 class="card-title fs-4">Data Absensi Pegawai </h4>
        <p class="card-description fs-6 mb-3">
          Data absensi diurutkan berdasarkan bulan.
        </p>



        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="example">
              <thead class="thead-dark">
                <tr class="text-center">
                  <th style="width: 6%">No</th>
                  <th style="width: 10%">Foto</th>
                  <th style="width: 25%">Nama</th>
                  <th style="width: 25%">TTL</th>
                  <th>Level</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}.</td>
                    <td><a href="{{ Storage::url($item->foto_profil) }}" target="__blank" ><img class="rounded-2" src="{{ Storage::url($item->foto_profil) }}" alt=""></a></td>
                    <td class="">{{ $item->nama}}</td>
                    <td>{{ $item->tempat_lahir.','.\Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                    @if ($item->level == 0)
                    <td class="">Pegawai</td>
                    @else
                    <td class="">Administrator</td>
                    @endif
                    
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
