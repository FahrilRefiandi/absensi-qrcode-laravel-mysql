@php
      // ucapan
      $waktu=date('H');
        $ket=0;

        if($waktu >= 0 && $waktu <= 10){
            $ket="Selamat Pagi";
        }elseif($waktu >= 11 && $waktu <= 14){
            $ket="Selamat Siang";
        }elseif($waktu >= 15 && $waktu <= 18){
            $ket="Selamat Sore";
        }elseif($waktu >= 19 && $waktu <= 24){
            $ket="Selamat Malam";
        }


        // ucapan
@endphp

<style>

    @media only screen and (min-device-width : 0px) and (max-device-width : 850px){
        .ghosting{
            display : none;
        }
    }
</style>

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="/dashboard">
            @if ($pengaturan)
            <img src="{{ Storage::url($pengaturan->logo) }}" alt="logo" />
            @else
            <img src="{{ Storage::url('logo/logo.png') }}" alt="logo" />
            @endif

        </a>
        <a class="navbar-brand brand-logo-mini" href="/dashboard">
            @if ($pengaturan)
            <img src="{{ Storage::url($pengaturan->logo_kecil) }}" alt="logo" />
            @else
            <img src="{{ Storage::url('logo/logo-kecil.png') }}" alt="logo" />
            @endif
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text" contenteditable >{{$ket}}, <span class="text-black fw-bold">{{ Auth::user()->nama }}</span></h1>
          @if (Auth::user()->level == 1)
          <h3 class="welcome-sub-text">Administrator</h3>
          @else
            <h3 class="welcome-sub-text">Pegawai</h3>
          @endif
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        {{-- <li class="nav-item dropdown d-none d-lg-block">
          <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
            <a class="dropdown-item py-3" >
              <p class="mb-0 font-weight-medium float-left">Select category</p>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">Bootstrap Bundle </p>
                <p class="fw-light small-text mb-0">This is a Bundle featuring 16 unique dashboards</p>
              </div>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">Angular Bundle</p>
                <p class="fw-light small-text mb-0">Everything you’ll ever need for your Angular projects</p>
              </div>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">VUE Bundle</p>
                <p class="fw-light small-text mb-0">Bundle of 6 Premium Vue Admin Dashboard</p>
              </div>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">React Bundle</p>
                <p class="fw-light small-text mb-0">Bundle of 8 Premium React Admin Dashboard</p>
              </div>
            </a>
          </div>
        </li> --}}


        <script>
        window.onload = function() { jam(); }
        function jam() {
            var e = document.getElementById('jam'),
            d = new Date(), h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h +':'+ m +':'+ s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0'+ e : e;
            return e;
        }
        </script>




        <li class="nav-item ghosting ">
          <form class="search-form" action="#">
            {{-- <i class="icon-search"></i> --}}
            <h4> {{\Carbon\Carbon::parse(now())->isoFormat('dddd,DD MMMM YYYY') }}</h4>
          </form>
        </li>
        <li class="nav-item ghosting">
          <form class="search-form" action="#">
            {{-- <i class="icon-search"></i> --}}
            <h4> Pukul : <strong id="jam" ></strong> </h4>
          </form>
        </li>

        {{-- <li class="nav-item dropdown">
          <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
            <i class="icon-mail icon-lg"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
            <a class="dropdown-item py-3 border-bottom">
              <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
              <span class="badge badge-pill badge-primary float-right">View all</span>
            </a>
            <a class="dropdown-item preview-item py-3">
              <div class="preview-thumbnail">
                <i class="mdi mdi-alert m-auto text-primary"></i>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
                <p class="fw-light small-text mb-0"> Just now </p>
              </div>
            </a>
            <a class="dropdown-item preview-item py-3">
              <div class="preview-thumbnail">
                <i class="mdi mdi-settings m-auto text-primary"></i>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                <p class="fw-light small-text mb-0"> Private message </p>
              </div>
            </a>
            <a class="dropdown-item preview-item py-3">
              <div class="preview-thumbnail">
                <i class="mdi mdi-airballoon m-auto text-primary"></i>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                <p class="fw-light small-text mb-0"> 2 days ago </p>
              </div>
            </a>
          </div>
        </li> --}}
        {{-- <li class="nav-item dropdown">
            <button role="button" class=" btn btn-block btn-lg btn-dark" id="theme_toggle">Toggle</button>
        </li> --}}
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="icon-bell"></i>
            <span class="count"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
            <a class="dropdown-item py-3">
              <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
              <span class="badge badge-pill badge-primary float-right">View all</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
              </div>
              <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
              </div>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
              </div>
              <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
              </div>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
              </div>
              <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
              </div>
            </a>
          </div>
        </li>
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              @if (Auth::user()->foto_profil)
                <img class="img-xs rounded-circle" src="{{ Storage::url(Auth::user()->foto_profil)  }}" alt="Profile image"> </a>
              @else
                <img class="img-xs rounded-circle" src="https://cdn1.iconfinder.com/data/icons/flat-business-icons/128/user-512.png" alt="Profile image"> </a>
              @endif
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
            @if (Auth::user()->foto_profil)
                <img class="img-md rounded-circle" src="{{ Storage::url(Auth::user()->foto_profil)  }}" width="200" height="200" alt="Profile image">
            @else
                <img class="img-md rounded-circle" src="https://cdn1.iconfinder.com/data/icons/flat-business-icons/128/user-512.png" width="200" height="200" alt="Profile image">
            @endif
              <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->nama }}</p>
              <p class="fw-light text-muted mb-0">{{ Auth::user()->username }}</p>
            </div>
            <a href="/dashboard" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Dashboard</a>
            <a href="/profil" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Profil</a>
            <a href="/absensi_masuk" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Absensi Masuk</a>
            <a href="/absensi_keluar" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Absensi Keluar</a>
            <form action="/logout" method="post">
            @csrf
            <button type="submit" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Logout</button>
            </form>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>

