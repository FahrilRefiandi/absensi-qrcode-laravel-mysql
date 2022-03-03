@extends('backend.componen.layout')

@section('title',"Data Users")
@section('content')



<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data Users</h4>
        <p class="card-description">
          Data diurutkan berdasarkan A-Z.
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
        {{-- <nav class="navbar navbar-light bg-transparent mb-3">
            <div class="container-fluid justify-content-end">
                <button type="button" class="btn btn-dark btn-sm rounded-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah data
                  </button>
            </div>
          </nav> --}}
        {{-- navbar --}}

              {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover border " id="example">
              <thead class="thead-dark">
                <tr class="text-center">
                  <th style="width: 7%">No</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Level</th>
                  <th>Bergabung sejak</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                <tr class="text-center">
                  <td>{{ $loop->iteration }}.</td>
                  @if ($item->foto_profil)
                  <td><a href="{{ Storage::url($item->foto_profil) }}" target="__blank" ><img class="rounded-2" src="{{ Storage::url($item->foto_profil) }}" alt=""></a></td>
                  @else
                  <td><a href="{{ Storage::url('/foto-profil/user.png') }}" target="__blank" ><img class="rounded-2" src="{{ Storage::url('/foto-profil/user.png') }}" alt=""></a></td>
                  @endif
                  <td class="text-left">{{ $item->nama }}</td>
                  <td>{{ $item->username }}</td>

                  @php
                      if($item->level == 0){
                          $value=1;
                          $button='btn-danger';
                          $ket='Pegawai';

                      }else {
                          $value=0;
                          $button='btn-success';
                          $ket='Administrator';
                      }
                  @endphp

                <td>
                    <form action="/users-level/{{$item->id}}" method="post">
                    @csrf
                        <button type="submit" value="{{$value}}" name="level" onclick="return confirm('Yakin {{$item->nama}} Akan dirubah hak aksesnya.?')" class="btn {{$button}} rounded-2 py-1 px-1 fs-6 ">{{$ket}}</button>
                    </form>
                </td>


                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                  <td>
                    {{-- <a href="/users/{{$item->id}}" class="btn btn-warning btn-icon py-2"> <i class="ti-pencil"></i> </a> --}}
                    <form action="/users/{{$item->id}}" class="d-inline" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="nama" value="{{$item->nama}}">
                        <button onclick="return confirm('Yakin password {{$item->nama}} akan direset.? Pasword default : 1-8')" type="submit" class="btn btn-warning btn-icon py-2 me-1"> <i class="ti-reload"></i> </button>
                    </form>
                    <form action="/users/{{$item->id}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Yakin data {{$item->nama}} akan dihapus.?')" type="submit" class="btn btn-danger btn-icon py-2"> <i class="ti-trash"></i> </button>
                        {{-- <button type="submit" class="btn btn-danger btn-icon py-2 button" data-id="{{$item->id}}"> <i class="ti-trash"></i> </button> --}}
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


  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endsection
