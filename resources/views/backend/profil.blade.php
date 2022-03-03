@extends('backend.componen.layout')

@section('title',"Profil ".Auth::user()->nama)
@section('content')

<div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Profil {{Auth::user()->nama}}</h4>
        <p class="card-description">
            Lengkapi halaman ini agar kami dapat mengenali anda.
        </p>

        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{session('status')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        @if (session('gagal'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{session('gagal')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif


        <form action="/profil/{{Auth::user()->id}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" value="{{ $data->username }}">
                @error('username')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingInput">Username</label>
              </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Nama" name="nama" value="{{ $data->nama }}">
                @error('nama')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingInput">Nama</label>
              </div>

              <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Alamat" id="floatingTextarea" name="alamat">{{ $data->alamat }}</textarea>
                @error('alamat')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingTextarea">Alamat</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                @error('tempat_lahir')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingInput">Tempat Lahir</label>
              </div>

              <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
                @error('tanggal_lahir')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingInput">Tanggal Lahir</label>
              </div>

              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="Nomor Telephone" name="nomor_tlpn" value="{{ $data->no_tlpn }}">
                @error('nomor_tlpn')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingInput">Nomor Telephone</label>
              </div>

                <div class="form-floating  mb-3">
                    @if (Auth::user()->foto_profil)
                        <img class="img-thumbnail" width="300" height="300" id="image" src="{{ Storage::url(Auth::user()->foto_profil)  }}"  alt="">
                    @else
                        <img class="img-thumbnail" width="300" height="300" id="image" src="https://ojk.go.id/Style%20Library/ojk/img/no-preview-available.png"  alt="">
                    @endif
                </div>

              <label>Foto Profil</label>
              <div class="form-floating  mb-3">
                <input type="file" name="foto_profil" id="file" />
                @error('foto_profil')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput" placeholder="Password Sekarang" name="passSekarang">
                @error('passSekarang')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingInput">Password Sekarang</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput" placeholder="Password Baru" name="passBaru">
                @error('passBaru')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingInput">Password Baru</label>
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
              </script>



              {{-- <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="Gaji Per Jam" name="gaji_per_jam" value="{{ $data->gaji_per_jam }}">
                @error('gaji_per_jam')
                <small class="text-danger ml-2"> {{ $message }} </small>
                @enderror
                <label for="floatingInput">Gaji Per Jam</label>
              </div> --}}

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
