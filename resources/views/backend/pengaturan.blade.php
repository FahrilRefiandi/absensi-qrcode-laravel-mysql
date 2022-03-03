@extends('backend.componen.layout')

@section('title',"Pengaturan")
@section('content')

<style>
    .width{
        min-width: 14rem;
    }
</style>

<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pengaturan</h4>
        <p class="card-description">
          Edit atau lengkapi form berikut.
        </p>

        <form action="/pengaturan"  method="post">
            <div class="row g-2 mt-3 mb-3">
                 @csrf
                 <input type="hidden" name="check" value="1">
                <div class="col">
                <div class="form-floating">
                    <input type="text" class="form-control width" id="floatingInputGrid" placeholder="Nama Aplikasi" value="{{ $data->nama_aplikasi }}" name="nama_aplikasi" >
                    <label for="floatingInputGrid">Nama Aplikasi</label>
                </div>
                </div>
                <div class="col">
                <div class="form-floating">
                    <input type="text" class="form-control  width" id="floatingSelectGrid" value="{{ $data->copyright }}" placeholder="Copyright &copy; {{date('Y')}}" name="copyright" >
                    <label for="floatingSelectGrid">Copyright&copy; {{date('Y')}}</label>
                </div>
                </div>
            </div>
            <button class="btn btn-primary  width text-center" >Simpan</button>
        </form>


      </div>
    </div>
  </div>



  {{-- ---------------- --}}

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Waktu Absensi Masuk</h4>
        <p>Kosongkan Jam Masuk / Akhir Jam Masuk Jika Tidak Ada Batasan Waktu</p>


        <form action="/pengaturan"  method="post">
            <div class="row g-2 mt-3 mb-3">
                 @csrf
                 <input type="hidden" name="check" value="2">
                <div class="col">
                <div class="form-floating">
                    <input type="time" class="form-control  width" id="floatingInputGrid" value="{{ $data->waktu_masuk }}" name="jam_masuk" >
                    <label for="floatingInputGrid">Jam Masuk</label>
                </div>
                </div>
                <div class="col text-center">
                    <label class=" mt-4 width mb-4" for="floatingSelectGrid">Sampai</label>
                </div>
                <div class="col">
                <div class="form-floating">
                    <input type="time" class="form-control  width" id="floatingSelectGrid" value="{{ $data->akhir_waktu_masuk }}" name="akhir_jam_masuk" >
                    <label for="floatingSelectGrid">Akhir Jam Masuk</label>
                </div>
                </div>
            </div>
            <button class="btn btn-primary ml-2 width">Simpan</button>
        </form>


      </div>
    </div>
  </div>


   {{-- ---------------- --}}

   <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Waktu Absensi Keluar</h4>
        <p>Kosongkan Jam Keluar / Akhir Jam Keluar Jika Tidak Ada Batasan Waktu</p>


        <form action="/pengaturan"  method="post">
            <div class="row g-2 mt-3 mb-3">
                 @csrf
                 <input type="hidden" name="check" value="3">
                <div class="col">
                <div class="form-floating">
                    <input type="time" class="form-control  width" id="floatingInputGrid" value="{{ $data->waktu_keluar }}" name="jam_keluar" >
                    <label for="floatingInputGrid">Jam Keluar</label>
                </div>
                </div>
                <div class="col text-center">
                    <label class=" mt-4 width mb-4" for="floatingSelectGrid">Sampai</label>
                </div>
                <div class="col">
                <div class="form-floating">
                    <input type="time" class="form-control  width" id="floatingSelectGrid" value="{{ $data->akhir_waktu_keluar }}" name="akhir_jam_keluar" >
                    <label for="floatingSelectGrid">Akhir Jam Keluar</label>
                </div>
                </div>
            </div>
            <button class="btn btn-primary ml-2 width">Simpan</button>
        </form>


      </div>
    </div>
  </div>


  {{-- ----------------------- --}}

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Logo</h4>
        <p class="card-description">
          Gunakan logo perusahaan anda.
        </p>

        <form action="/pengaturan"  method="post" enctype="multipart/form-data" >
            <div class="row g-2 mt-3 mb-3">
                 @csrf
                 <input type="hidden" name="check" value="4">
                <div class="col">
                    @if ($data->logo)
                    <img src="{{ Storage::url($data->logo) }}" id="image" class="mb-2" width="400px" height="200px"  alt="">
                    @else
                    <img src="https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg" id="image" class="mb-2" width="400px" height="200px"  alt="">
                    @endif
                    <div>
                        <label for="formFileLg" class="form-label">Logo</label>
                        <input class="form-control form-control-lg" id="file" type="file" name="logo" >
                        @error('logo')
                            <small class="text-danger ml-2 " > {{$message}} </small>
                        @enderror
                      </div>
                </div>
                <div class="col">
                    @if ($data->logo)
                    <img src="{{ Storage::url($data->logo_kecil) }}" id="image2" class="mb-2" width="200px" height="200px"  alt="">
                    @else
                    <img src="https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg" id="image2" class="mb-2" width="200px" height="200px"  alt="">
                    @endif
                    <div>
                        <label for="formFileLg" class="form-label">Logo Kecil</label>
                        <input class="form-control form-control-lg" id="file2" type="file" name="logo_kecil" >
                        @error('logo_kecil')
                            <small class="text-danger ml-2 " > {{$message}} </small>
                        @enderror
                      </div>

                </div>
            </div>
            <button class="btn btn-primary  width text-center" >Simpan</button>
        </form>


      </div>
    </div>
  </div>





  </div>


  <script>
    document.getElementById("file").onchange = function () {
    var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("image").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
    document.getElementById("file2").onchange = function () {
    var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("image2").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
  </script>


@endsection
