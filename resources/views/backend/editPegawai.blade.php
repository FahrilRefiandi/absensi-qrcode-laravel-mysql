@extends('backend.componen.layout')

@section('title',"Edit Pegawai ")
@section('content')

<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Basic form elements</h4>
        <p class="card-description">
          Basic form elements
        </p>



  <form action="/pegawai/{{$data->id}}" method="post">
    @method('PUT')
    @csrf

    <input type="hidden" name="user_id" value="{{$data->user_id}}">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="Nama" name="nama" value="{{ $data->nama }}">
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
        <textarea class="form-control" placeholder="Alamat" id="floatingTextarea" name="alamat">{{ $data->alamat }}</textarea>
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
        <input type="text" class="form-control" id="floatingInput" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ $data->tempat_lahir }}">
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
        <input type="date" class="form-control" id="floatingInput" placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
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
        <input type="number" class="form-control" id="floatingInput" placeholder="Nomor Telephone" name="nomor_tlpn" value="{{ $data->no_tlpn }}">
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
            @if ($data->jabatan_id)
            <option value="{{ $data->jabatan_id }}" selected >{{ $data->jabatan }}</option>
            @else
            <option selected > -Pilih Jabatan- </option>
            @endif

            @foreach ($jabatan as $item)
                <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
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
        <input type="number" class="form-control" id="floatingInput" placeholder="Gaji Per Jam" name="gaji_per_jam" value="{{ $data->gaji_per_jam }}">
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
            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" id="flexRadioDefault1" @if ($data->jenis_kelamin == 'Laki-laki') checked @endif >
            <label class="form-check-label" for="flexRadioDefault1">
              Laki-laki
            </label>
          </div>
          <div class="form-check ml-4">
            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" id="flexRadioDefault2" @if ($data->jenis_kelamin == 'Perempuan') checked @endif  >
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

    <div class="form-floating mb-3 mt-4">
        <a href="/pegawai" class="btn btn-outline-danger me-2">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

      </form>

      </div>
    </div>
  </div>
  </div>

@endsection
