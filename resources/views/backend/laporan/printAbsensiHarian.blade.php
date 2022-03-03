<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Laporan Absensi {{\Carbon\Carbon::parse($tgl)->isoFormat('dddd,DD MMMM YYYY') }} </title>
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">



</head>
<body class="bg-image">

    <div class="text-center mt-3 mb-5 ">
        <h1> <u>Laporan Absensi {{\Carbon\Carbon::parse($tgl)->isoFormat('dddd,DD MMMM YYYY') }} </u></h1>
        <h6>Dicetak oleh : {{ Auth::user()->nama }} <strong class="m-2" >Pada Hari/Tanggal : {{\Carbon\Carbon::parse(now())->isoFormat('dddd,DD MMMM YYYY') }}</strong> </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover border table-bordered ">
                <thead>
                  <tr>
                    <th class="text-center" >No.</th>
                    <th class="text-center" >Nama</th>
                    <th class="text-center" >Absensi Masuk</th>
                    <th class="text-center" >Absensi Keluar</th>
                    <th class="text-center" >Durasi Kerja</th>
                    <th class="text-center" >Jabatan</th>
                    <th class="text-center" >Hari/Tanggal</th>
                    <th class="text-center" >Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    @if ($item->absensi_masuk)


                    <tr class="text-center">
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $item->nama}}</td>

                      <td class="">
                                 <b>{{\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i:s') }}</b>
                      </td>
                        @if ($item->absensi_keluar)
                          <td class="">
                                  <b>{{\Carbon\Carbon::parse($item->absensi_keluar)->format('H:i:s') }}</b>
                          </td>

                          <td class="">
                              <b>{{ $item->durasi_kerja  }} Jam</b>
                          </td>
                        @else
                        <td class="">-</td>
                        <td class="">-</td>
                        @endif
                        <td class="">{{ $item->jabatan }}</td>
                        <td class="">{{\Carbon\Carbon::parse($item->created_at)->isoFormat('dddd,DD MMMM YYYY') }}</td>

                          @if ($item->absensi_masuk == null)
                          <td class="text-center" ><div class="badge badge-opacity-danger bg-danger text-light "> Tidak Masuk</div></td>
                          @elseif (\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i') >= $pengaturan->waktu_masuk)
                          @php
                              $absmasuk=\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i');
                          @endphp
                          <td class="text-center" ><div class="badge badge-opacity-warning bg-secondary text-light ">Terlambat {{\Carbon\Carbon::parse($absmasuk)->diffForHumans($pengaturan->waktu_masuk) }} </div></td>
                          @else
                          <td class="text-center" ><div class="badge badge-opacity-danger bg-success text-light "> Berhasil Absensi </div></td>
                          @endif
                      </tr>

                    @else

                    <tr class="text-center">
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $item->nama }}</td>
                        <td colspan="3"> Tidak Masuk. </td>
                        <td>{{ $item->jabatan }}</td>
                        <td  class="">{{\Carbon\Carbon::parse($item->created_at)->isoFormat('dddd,DD MMMM YYYY') }}</td>
                        @if ($item->absensi_masuk == null)
                        <td class="text-center" ><div class="badge badge-opacity-danger bg-danger text-light "> Tidak Masuk</div></td>
                        @elseif (\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i') >= $pengaturan->waktu_masuk)
                        @php
                            $absmasuk=\Carbon\Carbon::parse($item->absensi_masuk)->format('H:i');
                        @endphp
                        <td class="text-center" ><div class="badge badge-opacity-warning bg-secondary text-light ">Terlambat {{\Carbon\Carbon::parse($absmasuk)->diffForHumans($pengaturan->waktu_masuk) }} </div></td>
                        @else
                        <td class="text-center" ><div class="badge badge-opacity-danger bg-success text-light "> Berhasil Absensi </div></td>
                        @endif

                    </tr>

                    @endif

                    @endforeach

                </tbody>

          </table>
    </div>

    <script>

        print();
        window.onafterprint = window.close;
    </script>
    <script src="{{ asset("frontend/js/bootstrap.bundle.js") }}"></script>
</body>
</html>
