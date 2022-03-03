@extends('backend.componen.layout')

@section('title',"Perizinan")
@section('content')

<style>
    .borderless tbody tr td{
        border: none;
    }
</style>

<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Pengajuan Perizinan</h4>
      <p class="card-description">
        Data diurutkan berdasarkan data terbaru.
      </p>


      @if (session('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif


      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover border" id="example">
          <thead class="thead-dark">
            <tr class="text-center">
              {{-- <th style="width: 7%">No</th> --}}
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>No Tlpn</th>
              <th>Jabatan</th>
              <th>Keterangan</th>
              <th>Bukti File</th>
              <th>Status</th>
              <th>Waktu</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr class="text-center">
              {{-- <td>{{ $loop->iteration }}.</td> --}}
              <td>{{ $item->nama }}</td>
              <td>{{ $item->jenis_kelamin }}</td>
              <td>{{ $item->no_tlpn }}</td>
              @if ($item->jabatan)
              <td>{{ $item->jabatan }}</td>
              @else
              <td>-</td>
              @endif
              @if (str_word_count($item->keterangan) >= 8)
              <td>
                  <a type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item->keterangan }}">{{ substr($item->keterangan, 0,35) }}...</a>
              </td>
              @else
              <td>{{$item->keterangan }}</td>
              @endif
              @if ($item->bukti_foto)
              <td>
                <a href="{{ Storage::url($item->bukti_foto ) }}" target="__blank" > <img src="{{ Storage::url($item->bukti_foto ) }}" class="rounded-2" alt="Bukti perizinan {{ Auth::user()->nama }}"> </a>
                <form action="/download" method="post" class="d-inline" >
                    @csrf
                    <input type="hidden" name="nama" value="Bukti Izin {{Auth::user()->nama .' '.\Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }} " >
                    <button type="submit" value="{{ $item->bukti_foto }}" name="btn" class="btn me-3 mt-2 " > <u>Download</u> </button>
                </form>
              </td>
              @else
              <td>-</td>
              @endif
              @if ($item->status == 0)
              <td> <strong class="bg-warning px-1 py-1 rounded-2" >Belum Dibaca</strong> </td>
              @elseif($item->status == 1)
              <td> <strong class="bg-danger px-1 py-1 rounded-2" >Ditolak</strong> </td>
              @else
              <td> <strong class="bg-success px-1 py-1 rounded-2" >Diterima</strong> </td>
              @endif
              <td class="">{{\Carbon\Carbon::parse($item->created_at)->isoFormat('dddd,DD MMMM YYYY') }}</td>
              <td>
                  <a  data-bs-toggle="modal" id="btn-perizinan" data-bs-target="#editPerizinan" data-id="{{$item->id }}" data-nama="{{$item->nama }}" data-jk="{{$item->jenis_kelamin }}"  data-tlpn="{{$item->no_tlpn }}"  data-keterangan="{{$item->keterangan }}"  data-jabatan="{{$item->jabatan }}"  data-waktu="{{$item->created_at }}"
                    class="btn btn-warning btn-icon py-2 px-2 "> <i class="ti-eye"></i> </a>
                <form action="/perizinan/acc" method="post" class="d-inline" >
                    @csrf
                    <input type="hidden" name="nama" value="{{ $item->nama }}" >
                    <input type="hidden" name="id" value="{{ $item->id }}" >
                    <button class="btn btn-success btn-icon py-2 px-2 " onclick="return confirm('Yakin Perizinan {{ $item->nama }} Diterima.?')"  type="submit"> <i class="ti-check-box" ></i> </button>
                </form>
                <form action="/perizinan/tolak" method="post" class="d-inline" >
                    @csrf
                    <input type="hidden" name="nama" value="{{ $item->nama }}" >
                    <input type="hidden" name="id" value="{{ $item->id }}" >
                    <button class="btn btn-danger btn-icon py-2 px-2 " onclick="return confirm('Yakin Perizinan {{ $item->nama }} Ditolak.?')" type="submit"> <i class="ti-na"></i> </button>
                </form>
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


{{-- ModalEdit --}}
<!-- Modal -->
<div class="modal fade" id="editPerizinan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"> <strong id="nama"></strong>  </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="" >

            <div class="table-responsive">
                <table class="table borderless">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td><strong id="nama1"></strong></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><strong id="jk"></strong></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td><strong id="jabatan"></strong></td>
                        </tr>
                        <tr>
                            <td>No Tlpn</td>
                            <td><strong id="tlpn"></strong></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><strong id="keterangan"></strong></td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td> <strong id="waktu"></strong>  </td>
                        </tr>

                    </tbody>
                  </table>
            </div>

        </div>
      </div>
    </div>
  </div>
{{-- ModalEdit --}}

@endsection
