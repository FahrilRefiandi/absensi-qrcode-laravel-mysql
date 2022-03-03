@extends('backend.componen.layout')

@section('title',"Data Jabatan")
@section('content')



<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data Jabatan</h4>
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
            <table class="table table-striped table-bordered table-hover" id="example">
              <thead class="thead-dark">
                <tr class="text-center">
                  <th style="width: 7%">No</th>
                  <th>Jabatan</th>
                  <th>Terakhir Diubah</th>
                  <th>Dibuat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                <tr class="text-center">
                  <td>{{ $loop->iteration }}.</td>
                  <td>{{ $item->jabatan }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y')}}</td>
                  <td>{{  \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                  <td>

                    <button type="button" class="btn btn-warning btn-icon py-2" data-bs-toggle="modal" id="btn-jabatan" data-bs-target="#editJabatan" data-id="{{$item->id }}" data-jabatan="{{$item->jabatan }}" >
                        <i class="ti-pencil"></i>
                    </button>
                    <form action="/jabatan/{{$item->id}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Yakin data {{$item->jabatan}} akan dihapus.?')" type="submit" class="btn btn-danger btn-icon py-2"> <i class="ti-trash"></i> </button>
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


{{-- ModalEdit --}}
<!-- Modal -->
<div class="modal fade" id="editJabatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit <strong id="modalKet"></strong> </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('jabatan.update' ,"update") }}" method="post">
            @method('PUT')
            @csrf

            <div class="form-floating mb-3">
                <input type="hidden" id="inputId" name="editId" >
                <input type="text" class="form-control" id="inputJabatan" placeholder="Jabatan" name="editJabatan" value="{{ old('editJabatan') }}">
                @error('editJabatan')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @section('modal')
                <script type="text/javascript">
                    var myModal = new bootstrap.Modal(document.getElementById("editJabatan"), {});
                    document.onreadystatechange = function () {
                    myModal.show();
                    };
                </script>
                @endsection
                @enderror
                <label for="jabatan">Jabatan</label>
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
{{-- ModalEdit --}}



  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah data pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/jabatan" method="post">
                @csrf

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Jabatan" name="jabatan" value="{{ old('jabatan') }}">
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
