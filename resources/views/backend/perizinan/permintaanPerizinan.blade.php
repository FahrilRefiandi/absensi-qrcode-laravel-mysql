@extends('backend.componen.layout')

@section('title',"Absensi ")
@section('content')

<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Pengajuan Perizinan {{ Auth::user()->nama }}</h4>
      <p class="card-description">
        Menyertakan bukti foto/file agar cepat dikonfirmasi.
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



              @if ($data->count() == 0 )

              <button type="button" class="btn btn-dark btn-sm rounded-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah data
              </button>
                @elseif ( substr($data[0]->created_at, 0, 10) != substr(now(), 0, 10) )
                <button type="button" class="btn btn-dark btn-sm rounded-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah data
                  </button>





              {{--  --}}

              @endif
          </div>
        </nav>
      {{-- navbar --}}


      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="example">
          <thead class="thead-dark">
            <tr class="text-center">
              <th style="width: 7%">No</th>
              <th>Keterangan</th>
              <th>Bukti File</th>
              <th>Pengajuan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr class="text-center">
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $item->keterangan }}</td>

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
              <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM YYYY') }}</td>
              <td>
                  @if ($item->status == 0)
                  <strong class="bg-warning px-1 py-1 rounded-2" >Belum Dilihat</strong>
                  @elseif ($item->status == 1)
                  <strong class="bg-danger px-1 py-1 rounded-2" >Ditolak</strong>
                  @else
                  <strong class="bg-success px-1 py-1 rounded-2" >Diterima</strong>
                  @endif
              </td>
            </tr>

            @endforeach
        </tbody>
        </table>


    </div>
  </div>
</div>
</div>




                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajukan Perizinan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">


                                <form action="/pengajuan-izin" class="mt-4 " method="post" enctype="multipart/form-data">
                                    @csrf


                                    <label>Keterangan</label>
                                    <div class="form-floating mb-4 ">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="keterangan"> {{old('keterangan')}} </textarea>
                                        <label for="floatingTextarea2">Keterangan</label>
                                    </div>

                                    <div class="form-floating mt-2 mb-2 ">
                                        <img src="https://www.iabi-indonesia.org/assets/images/no_images.png" id="image" style="max-width: 300px" alt="No Image">
                                    </div>

                                    <label>Bukti File</label>
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="form" name="bukti_foto"  value="{{old('bukti_foto')}}">
                                    </div>





                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                {{-- modal --}}

                          {{--  --}}

                          <script>
                            document.getElementById("form").onchange = function () {
                            var reader = new FileReader();
                                reader.onload = function (e) {
                                    // get loaded data and render thumbnail.
                                    document.getElementById("image").src = e.target.result;
                                };

                                // read the image file as a data URL.
                                reader.readAsDataURL(this.files[0]);
                            };
                          </script>


@endsection















