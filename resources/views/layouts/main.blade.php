
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin Panel</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}">
    {{-- <link rel="stylesheet" href="../assets/plugins/chosen.css"> --}}

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
  <link rel="stylesheet" href="{{asset("assets/css/components.css")}}">
    <!-- CSS Libraries -->
<link rel="stylesheet" href="{{asset("assets/modules/izitoast/css/iziToast.min.css")}}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{asset("assets/img/avatar/avatar-1.png")}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{route("logout")}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      @include('partials.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('container')
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2025 {{env("APP_NAME") ?? ""}}. All rights reserved.
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script> --}}
  <!-- General JS Scripts -->
  <script src="{{asset("assets/modules/jquery.min.js")}}"></script>
  <script src="{{asset("assets/modules/popper.js")}}"></script>
  <script src="{{asset("assets/modules/popper.js")}}"></script>
  <script src="{{asset("assets/modules/bootstrap/js/bootstrap.min.js")}}"></script>
  <script src="{{asset("assets/modules/nicescroll/jquery.nicescroll.min.js")}}"></script>
  <script src="{{asset("assets/modules/moment.min.js")}}"></script>
  <script src="{{asset("assets/js/stisla.js")}}"></script>

  <!-- DataTables  & Plugins -->
<script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-buttons/js/buttons.html5.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-buttons/js/buttons.print.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-buttons/js/buttons.colVis.min.js")}}"></script>

  <!-- Template JS File -->
  <script src="{{asset("assets/js/scripts.js")}}"></script>
  <script src="{{asset("assets/js/custom.js")}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- JS Libraies -->
   <script src="{{asset("assets/modules/izitoast/js/iziToast.min.js")}}"></script>

   <!-- Page Specific JS File -->
   <script src="{{asset("assets/js/page/modules-toastr.js")}}"></script> <!-- Page Specific JS File -->
  {{-- <script src="../assets/js/page/index-0.js"></script> --}}

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>
  <script>
    @if ($errors->any())
       @foreach ($errors->all() as $error)
       iziToast.error({
        title: 'Error!!',
        message: '{{ $error }}',
        position: 'topRight'
        });
       @endforeach
   @endif
   @if (Session::has('error'))
            iziToast.error({
            title: 'error!!',
            message: '{{ Session::get('error') }}',
            position: 'topRight'
            });
        @endif
    @if (Session::has('success'))
       iziToast.success({
       title: 'Success!!',
       message: '{{ Session::get('success') }}',
       position: 'topRight'
       });
   @endif
</script>
  <script>
    $('.delete').click(function(){
        var users_id = $(this).attr('data-id')
        var users_name = $(this).attr('data-name')
        swal({
                  title: "Apakah Kamu Yakin?",
                  text: "Kamu Akan Menghapus data "+users_name+"!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                      window.location = "/admin/delete/"+users_id+""
                  }
              });
    })
  </script>
</body>
</html>
