@php
    use \App\Models\Pengaturan;
    $pengaturan=Pengaturan::first();
@endphp
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    <link rel="shortcut icon" href="{{asset('frontend/img/logo.png')}}" type="image/x-icon">

    <title> @yield('title') </title>
  </head>
  <body>


    <!-- navbar -->
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                @if ($pengaturan->logo_kecil)
                <img src="{{Storage::url($pengaturan->logo)}}"  height="40" alt="">
                @else
                <img src="https://authenticjobs.s3.amazonaws.com/uploads/logos/3bb6266c93016ec74c404e18365e00a8/RP_LogoColor.png" width="40" height="40" alt="">
                @endif

              {{-- <img src="img/logo.png" width="40" height="40" alt=""> --}}
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <!-- <li><a href="#" class="nav-link px-2 link-dark">Absensi</a></li>
              <li><a href="#" class="nav-link px-2 link-dark">Check in</a></li>
              <li><a href="#" class="nav-link px-2 link-dark">Check out</a></li> -->
            </ul>

            <div class="dropdown text-end anouncement ">
                @if (Auth::user())
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user()->foto_profil)
                    <img src="{{ Storage::url(Auth::user()->foto_profil) }}" alt="mdo" width="32" height="32" class="rounded-circle">
                    @else
                    <img src="{{ Storage::url('foto-profil/user.png') }}" alt="mdo" width="32" height="32" class="rounded-circle">
                    @endif
                  </a>
                  <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                      <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                      <li><a class="dropdown-item" href="/profil">Profil</a></li>
                      <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item" href="/logout">Logout</button>
                        </form>
                      </li>
                  </ul>
                @else

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/login" class="nav-link px-2 link-dark">Login</a></li>
                    <li><a href="/register" class="nav-link px-2 link-dark">Register</a></li>
                  </ul>

                @endif

            </div>

          </div>
        </div>
      </header>
    <!-- navbar -->

    @yield('content')




    <!-- wave -->
    <svg   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,128L80,149.3C160,171,320,213,480,218.7C640,224,800,192,960,170.7C1120,149,1280,139,1360,133.3L1440,128L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
    <!-- wave -->


    <!-- Footer -->
    <footer class="text-center text-white" style="background-color: #0099ff; bottom:0;">
      <!-- Grid container -->
      <div class="container p-4"></div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0);">
        <!-- Copyright © 2022 -->
        {{$pengaturan->copyright}}
        <a class="text-decoration-none" style="color: #415751"  href="https://www.instagram.com/farilannd/" target="__blank" > <b> {{$pengaturan->nama_aplikasi}}.</b></a>
        All Rights Reserved. <strong>App version 2.0.1</strong>

      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->



    <script src="{{ asset("frontend/js/bootstrap.bundle.js") }}"></script>
  </body>
</html>

{{-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> {{$pengaturan->nama_aplikasi}} </span>
<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">{{$pengaturan->copyright}}</span> --}}
