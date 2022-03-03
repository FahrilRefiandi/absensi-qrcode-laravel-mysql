@extends('backend.componen.layout')

@section('title',"Dashboard")
@section('content')

<style>
    div nav ul{
        justify-content: center;
    }
</style>


<div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        @if (session('status'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{session('status')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="home-tab">

          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
              <div class="row">
                <div class="col-sm-12">
                  <div class="statistics-details d-flex align-items-center justify-content-between">
                    <div>
                      <p class="statistics-title">User</p>
                      <h3 class="rate-percentage">{{$count['user']}}</h3>
                      {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span> {{$user->count() /100 * 10 }} %</span></p> --}}
                    </div>
                    <div>
                      <p class="statistics-title">Pegawai</p>
                      <h3 class="rate-percentage">{{$count['pegawai']}}</h3>
                      {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p> --}}
                    </div>
                    <div>
                      <p class="statistics-title">Laki-laki</p>
                      <h3 class="rate-percentage"> {{ $jk['laki']->count()}} </h3>
                      {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> --}}
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Perempuan</p>
                      <h3 class="rate-percentage">{{ $jk['perempuan']->count()}}</h3>
                      {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> --}}
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Administrator</p>
                      <h3 class="rate-percentage">{{$rule['admin']->count()}}</h3>
                      {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> --}}
                    </div>
                  </div>
                </div>
              </div>

              {{-- <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                  <div class="card card-rounded">
                    <div class="card-body">
                      <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title card-title-dash">Absensi Terbaru {{$auth->nama}}</h4>
                         <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>
                        </div>
                        <div>

                        </div>
                      </div> --}}

              <div class="row">

              <div class="row">

                <div class="col-lg-8 d-flex flex-column">


                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                              <h4 class="card-title card-title-dash">Absensi Terbaru</h4>
                             {{-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> --}}
                            </div>
                            <div>

                            </div>
                          </div>
                          <div class="table-responsive  mt-1" style="height: 88%" >
                            <table class="table select-table">
                              <thead>
                                <tr>
                                  <th>Nama</th>
                                  <th>Absensi Masuk</th>
                                  <th>Status</th>
                                  {{-- <th>Waktu</th> --}}
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($data as $item)
                                <tr>
                                  <td>
                                    <div class="d-flex ">
                                        @if ($item->foto_profil)
                                        <img src="{{Storage::url($item->foto_profil)}}" alt="">
                                        @else
                                        <img src="{{Storage::url('foto-profil/user.png')}}" alt="">
                                        @endif
                                      <div>
                                        <h6>{{ $item->nama }}</h6>
                                        @if ( $item->level == 0)
                                        <p class="text-danger" >Pegawai</p>
                                        @else
                                        <p class="text-info">Administrator</p>
                                        @endif
                                      </div>
                                    </div>
                                  </td>

                                  <td>
                                    <h6>{{\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i, d-m-Y') }}</h6>
                                    <p>{{\Carbon\Carbon::parse($item->absensi_masuk)->diffForHumans()}}</p>
                                  </td>
                                  {{-- <td>
                                    <div>
                                      <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                        <p class="text-success">65%</p>
                                        <p>85/162</p>
                                      </div>
                                      <div class="progress progress-md">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    </div>
                                  </td> --}}
                                  @if ($item->absensi_keluar == null)
                                  <td><div class="badge badge-opacity-warning">Sedang Bekerja</div></td>
                                  @else
                                  <td><div class="badge badge-opacity-success">Sedang Istirahat</div></td>
                                  @endif

                                </tr>
                                @endforeach

                              </tbody>
                            </table>
                          </div>


                        </div>
                      </div>
                    </div>
                  </div>

                </div>


                <div class="col-lg-4 d-flex flex-column">

                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title card-title-dash">Jenis Kelamin</h4>
                              </div>
                              <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                              <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                  <h4 class="card-title card-title-dash">Leave Report</h4>
                                </div>
                                <div>
                                  <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Month Wise </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                      <h6 class="dropdown-header">week Wise</h6>
                                      <a class="dropdown-item" href="#">Year Wise</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="mt-3">
                                <canvas id="leaveReport"></canvas>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                  {{-- <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                  <h4 class="card-title card-title-dash">Top Performer</h4>
                                </div>
                              </div>
                              <div class="mt-3">
                                <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                  <div class="d-flex">
                                    <img class="img-sm rounded-10" src="images/faces/face1.jpg" alt="profile">
                                    <div class="wrapper ms-3">
                                      <p class="ms-1 mb-1 fw-bold">Brandon Washington</p>
                                      <small class="text-muted mb-0">162543</small>
                                    </div>
                                  </div>
                                  <div class="text-muted text-small">
                                    1h ago
                                  </div>
                                </div>
                                <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                  <div class="d-flex">
                                    <img class="img-sm rounded-10" src="images/faces/face2.jpg" alt="profile">
                                    <div class="wrapper ms-3">
                                      <p class="ms-1 mb-1 fw-bold">Wayne Murphy</p>
                                      <small class="text-muted mb-0">162543</small>
                                    </div>
                                  </div>
                                  <div class="text-muted text-small">
                                    1h ago
                                  </div>
                                </div>
                                <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                  <div class="d-flex">
                                    <img class="img-sm rounded-10" src="images/faces/face3.jpg" alt="profile">
                                    <div class="wrapper ms-3">
                                      <p class="ms-1 mb-1 fw-bold">Katherine Butler</p>
                                      <small class="text-muted mb-0">162543</small>
                                    </div>
                                  </div>
                                  <div class="text-muted text-small">
                                    1h ago
                                  </div>
                                </div>
                                <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                  <div class="d-flex">
                                    <img class="img-sm rounded-10" src="images/faces/face4.jpg" alt="profile">
                                    <div class="wrapper ms-3">
                                      <p class="ms-1 mb-1 fw-bold">Matthew Bailey</p>
                                      <small class="text-muted mb-0">162543</small>
                                    </div>
                                  </div>
                                  <div class="text-muted text-small">
                                    1h ago
                                  </div>
                                </div>
                                <div class="wrapper d-flex align-items-center justify-content-between pt-2">
                                  <div class="d-flex">
                                    <img class="img-sm rounded-10" src="images/faces/face5.jpg" alt="profile">
                                    <div class="wrapper ms-3">
                                      <p class="ms-1 mb-1 fw-bold">Rafell John</p>
                                      <small class="text-muted mb-0">Alaska, USA</small>
                                    </div>
                                  </div>
                                  <div class="text-muted text-small">
                                    1h ago
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                </div>

                <div class="col-lg d-flex flex-column">
                    <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <div class="card-body">
                                <div class="card-header bg-transparent mb-3 border-bottom-0">
                                    <h4>Foto pegawai</h4>
                                </div>


                                <div class="row row-cols-1 row-cols-md-6 g-4">
                                    @foreach ($user as $item)
                                    <div class="col">
                                    <div class="card bg-white">
                                        @if ($item->foto_profil)
                                        <img src="{{Storage::url($item->foto_profil)}}" class="card-img-top" alt="Foto {{ $item->nama }}">
                                        @else
                                        <img src="{{Storage::url('foto-profil/user.png')}}" class="card-img-top" alt="Foto {{ $item->nama }}">
                                        @endif

                                        <div class="card-body">
                                            <h5 class="card-title text-center">{{ $item->nama }}</h5>
                                        </div>
                                    </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    {{ $user->links() }}

                                </div>

                            </div>

                        </div>

              </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
    var doughnutPieData = {
        datasets: [{
          data: [ {{$jk['laki']->count() }} ,  {{$jk['perempuan']->count() }} ],
          backgroundColor: [
            "#1F3BB3",
            "#81DADA"
          ],
          borderColor: [
            "#1F3BB3",
            "#81DADA"
          ],
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
          'Laki-laki',
          'Perempuan',
        ]
      };
</script>

@endsection
