<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> @yield('title') </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('backend') }}/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('backend') }}/images/favicon.png" />

  {{-- DarkMode --}}
  {{-- <link rel="stylesheet" href="{{asset('darkmode/darkmode.css')}}"> --}}

  {{-- DarkMode --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style>
        td{
            font-family: 'Roboto', sans-serif;
        }
    </style>

</head>
<body class="" >

    @php
          use App\Models\Pengaturan;
        $pengaturan=Pengaturan::first();
    @endphp

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
   @include('backend.componen.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     @include('backend.componen.sidebar')
      <!-- partial -->
      <div class="main-panel">
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> {{$pengaturan->nama_aplikasi}} </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">{{$pengaturan->copyright}}</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->




  <script src="{{ asset('backend') }}/vendors/js/vendor.bundle.base.js"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
  </script>

  <script>
    $('#laporanHarian').dataTable( {
    "order": [[ 2, 'desc' ]]
} );
</script>


<script>
    $(document).on('click','#btn-jabatan' , function(event){
        var buttonEdit = $(event.relatedTarget)
        var id=$(this).data('id')
        var jabatan=$(this).data('jabatan')
        var modal=$(this)
        // modal.find('.modal-body #id').val(id)
        // modal.find('.modal-body #jabatan').val(jabatan)

        document.getElementById('modalKet').innerHTML=jabatan;
        document.getElementById('inputId').value=id;
        document.getElementById('inputJabatan').value=jabatan;
        // document.getElementById('modalKet').value=jabatan;

    })




    $(document).on('click','#btn-perizinan' , function(event){
        var buttonEdit = $(event.relatedTarget)
        var id=$(this).data('id')
        var nama=$(this).data('nama')
        var jk=$(this).data('jk')
        var tlpn=$(this).data('tlpn')
        var jabatan=$(this).data('jabatan')
        var keterangan=$(this).data('keterangan')
        var waktu=$(this).data('waktu')

        var modal=$(this)
        // modal.find('.modal-body #id').val(id)
        // modal.find('.modal-body #jabatan').val(jabatan)

        document.getElementById('nama').innerHTML=nama;
        document.getElementById('nama1').innerHTML=nama;
        document.getElementById('jk').innerHTML=jk;
        document.getElementById('tlpn').innerHTML=tlpn;
        document.getElementById('keterangan').innerHTML=keterangan;
        document.getElementById('jabatan').innerHTML=jabatan;
        document.getElementById('waktu').innerHTML=waktu;

        // document.getElementById('modalKet').value=jabatan;

    })



</script>
{{--
<script>
    $(document).on('click', '.button', function (e) {
  e.preventDefault();
  var id = $(this).data('id');


  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
  }

})


});
</script> --}}


{{-- <script src="{{asset('darkmode/darkmode.js')}} "></script> --}}

  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('backend') }}/vendors/chart.js/Chart.min.js"></script>
  <script src="{{ asset('backend') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="{{ asset('backend') }}/vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('backend') }}/js/off-canvas.js"></script>
  <script src="{{ asset('backend') }}/js/hoverable-collapse.js"></script>
  <script src="{{ asset('backend') }}/js/template.js"></script>
  <script src="{{ asset('backend') }}/js/settings.js"></script>
  <script src="{{ asset('backend') }}/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  {{-- <script src="{{ asset('backend') }}/js/jquery.cookie.js" type="text/javascript"></script> --}}
  <script src="{{ asset('backend') }}/js/dashboard.js"></script>
  {{-- <script src="{{ asset('backend') }}/js/Chart.roundedBarCharts.js"></script> --}}
  <!-- End custom js for this page-->



  {{-- show modal --}}
  @yield('modal')

</body>

</html>

