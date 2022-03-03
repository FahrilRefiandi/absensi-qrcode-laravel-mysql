@php
    use \App\Models\PengajuanIzin;
    $jumPengajuan=PengajuanIzin::where('status',null)->get();
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      {{-- <li class="nav-item nav-category">Absensi</li> --}}
      <li class="nav-item">
        {{-- <a class="nav-link" data-bs-toggle="collapse" href="#Data-Absensi" aria-expanded="false" aria-controls="Data-Absensi">
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">Absensi</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="Data-Absensi">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/absensi">Absensi</a></li>
            <li class="nav-item"> <a class="nav-link" href="/tunjangan">Tunjangan</a></li>
          </ul>
        </div> --}}

        <li class="nav-item">
            <a class="nav-link" href="/absensi">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">Absensi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/tunjangan">
              <i class="menu-icon mdi mdi-cash"></i>
              <span class="menu-title">Tunjangan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/pengajuan-izin">
              <i class="menu-icon mdi mdi-archive"></i>
              <span class="menu-title">Pengajuan Perizinan</span>
            </a>
        </li>

      </li>

      {{-- Menu admin --}}
      @if (Auth::user()->level == 1)

        <li class="nav-item nav-category">Administrator</li>

        <li class="nav-item">
         <a class="nav-link" data-bs-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">Laporan</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="laporan">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/laporan-presensi-harian">Laporan Absensi Harian</a></li>
            <li class="nav-item"> <a class="nav-link" href="/laporan-presensi-bulanan">Laporan Absensi</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="/laporan-pendapatan">Laporan Tunjangan</a></li> --}}
          </ul>
        </div>
        </li>



        <li class="nav-item">
            <a class="nav-link" href="/perizinan">
              <i class="menu-icon mdi mdi-account-multiple-check"></i>
              <span class="menu-title">Perizinan @if (count($jumPengajuan)) <span class="bg-danger px-1 py-1 rounded-pill me-2 text-light "> {{count($jumPengajuan)}} </span> @endif </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/pegawai">
              <i class="menu-icon mdi mdi-human-male-female"></i>
              <span class="menu-title">Pegawai</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/users">
              <i class="menu-icon mdi mdi-account-multiple-outline"></i>
              <span class="menu-title">Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/jabatan">
              <i class="menu-icon mdi mdi-book"></i>
              <span class="menu-title">Jabatan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/pengaturan">
              <i class="menu-icon mdi mdi-cogs"></i>
              <span class="menu-title">Pengaturan</span>
            </a>
        </li>

        @endif
        {{-- Menu admin --}}

      {{-- <li class="nav-item nav-category">pages</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
          </ul>
        </div>
      </li> --}}

      <li class="nav-item nav-category">Akun</li>
      <li class="nav-item">
        <a class="nav-link" href="/profil">
          <i class="menu-icon mdi mdi-account"></i>
          <span class="menu-title">Profil</span>
        </a>
      </li>
      <li class="nav-item">
        <form  method="POST" action="{{ route('logout') }}">
            @csrf
        <button type="submit" class="nav-link w-100 hov bg-transparent ">
          <i class="menu-icon mdi mdi-power"></i>
          <span class="menu-title">Logout</span>
        </button>
        </form>
      </li>
    </ul>
  </nav>



<style>
    .hov{
        border: 0;
    }
</style>
