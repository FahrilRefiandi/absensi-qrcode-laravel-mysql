@extends('backend.componen.layout')

@section('title',"Data pegawai")
@section('content')



<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data pegawai</h4>
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

        {{-- navbar --}}
        <nav class="navbar navbar-light bg-transparent mb-3">
            <div class="container-fluid justify-content-end">
                <button type="button" class="btn btn-dark btn-sm rounded-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah data
                  </button>
            </div>
          </nav>
        {{-- navbar --}}

              {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover border" id="example">
              <thead class="thead-dark">
                <tr class="text-center">
                  <th style="width: 7%">No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Jenis Kelamin</th>
                  <th>No Tlpn</th>
                  <th>TTL</th>
                  <th>Jabatan</th>
                  <th>Gaji/Jam</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                <tr class="text-center">
                  <td>{{ $loop->iteration }}.</td>
                  <td class="text-left">{{ $item->nama }}</td>
                  <td>{{ $item->alamat }}</td>
                  <td>{{ $item->jenis_kelamin }}</td>
                  <td>{{ $item->no_tlpn }}</td>
                  <td>{{ $item->tempat_lahir.','.\Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                  @if ($item->jabatan)
                  <td>{{ $item->jabatan }}</td>
                  @else
                  <td>-</td>
                  @endif
                  <td>{{ number_format($item->gaji_per_jam),0,',','.' }} <b class="text-danger" >IDR</b> </td>
                  <td>
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
        {{-- Table --}}

      </div>
    </div>
  </div>
  </div>

  {{-- modal --}}
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah data pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/pegawai" method="post">
                @csrf

                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="nama">
                        @foreach ($nama as $item)
                            <option @if ($loop->iteration == 1) selected @endif value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('nama')
                    <small class="text-danger ml-2"> {{ $message }} </small>
                    @section('modal')
                    <script type="text/javascript">
                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                        document.onreadystatechange = function () {
                        myModal.show();
                        };
                    </script>
                    @endsection
                    @enderror
                    <label for="floatingInput">Nama</label>
                  </div>

                  <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Alamat" id="floatingTextarea" name="alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <small class="text-danger ml-2"> {{ $message }} </small>
                    @section('modal')
                    <script type="text/javascript">
                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                        document.onreadystatechange = function () {
                        myModal.show();
                        };
                    </script>
                    @endsection
                    @enderror
                    <label for="floatingTextarea">Alamat</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')
                    <small class="text-danger ml-2"> {{ $message }} </small>
                    @section('modal')
                    <script type="text/javascript">
                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                        document.onreadystatechange = function () {
                        myModal.show();
                        };
                    </script>
                    @endsection
                    @enderror
                    <label for="floatingInput">Tempat Lahir</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingInput" placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                    <small class="text-danger ml-2"> {{ $message }} </small>
                    @section('modal')
                    <script type="text/javascript">
                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                        document.onreadystatechange = function () {
                        myModal.show();
                        };
                    </script>
                    @endsection
                    @enderror
                    <label for="floatingInput">Tanggal Lahir</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" placeholder="Nomor Telephone" name="nomor_tlpn" value="{{ old('nomor_tlpn') }}">
                    @error('nomor_tlpn')
                    <small class="text-danger ml-2"> {{ $message }} </small>
                    @section('modal')
                    <script type="text/javascript">
                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                        document.onreadystatechange = function () {
                        myModal.show();
                        };
                    </script>
                    @endsection
                    @enderror
                    <label for="floatingInput">Nomor Telephone</label>
                  </div>

                  <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="jabatan">
                        @foreach ($jabatan as $item)
                            <option @if ($loop->iteration == 1) selected @endif value="{{ $item->id }}">{{ $item->jabatan }}</option>
                        @endforeach
                    </select>
                    @error('jabatan')
                    <small class="text-danger ml-2"> {{ $message }} </small>
                    @section('modal')
                    <script type="text/javascript">
                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                        document.onreadystatechange = function () {
                        myModal.show();
                        };
                    </script>
                    @endsection
                    @enderror
                    <label for="floatingInput">Jabatan</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" placeholder="Gaji Per Jam" name="gaji_per_jam" value="{{ old('gaji_per_jam') }}">
                    @error('gaji_per_jam')
                    <small class="text-danger ml-2"> {{ $message }} </small>
                    @section('modal')
                    <script type="text/javascript">
                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                        document.onreadystatechange = function () {
                        myModal.show();
                        };
                    </script>
                    @endsection
                    @enderror
                    <label for="floatingInput">Gaji Per Jam</label>
                  </div>

                  <label for="">Jenis Kelamin</label>
                  <div class="form-floating mb-3">
                    <div class="form-check ml-4">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                          Laki-laki
                        </label>
                      </div>
                      <div class="form-check ml-4">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                          Perempuan
                        </label>
                      </div>
                      @error('jenis_kelamin')
                      <small class="text-danger ml-2"> {{ $message }} </small>
                      @section('modal')
                      <script type="text/javascript">
                          var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                          document.onreadystatechange = function () {
                          myModal.show();
                          };
                      </script>
                      @endsection
                      @enderror
                  </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  {{-- modal --}}

@endsection
