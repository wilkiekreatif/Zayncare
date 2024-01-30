<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{config('app.name')}}</title>
    <link rel="icon" href="{{ asset('adminlte') }}/src/favicon.png" type="image/x-icon"/>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/adminlte.min.css">
    {{-- Back to Top --}}
    <link rel="stylesheet" href="{{asset('adminlte')}}/wildan/backtotop.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/toastr/toastr.min.css">
    <!-- Wildan -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/wildan/color.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link href="{{asset('adminlte')}}/src/icon.png" rel="shortcut icon">
    

    <!-- CSS--------------------------------------------------------------------------------------------------------------------------------- -->
    @yield('css')
    <!-- CSS-------------------------------------------------------------------------------------------------------------------------------- -->

  </head>
  <body class="hold-transition sidebar-mini sidebar-collapse layout-footer-fixed layout-navbar-fixed layout-fixed text-sm">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav"> 
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link user-panel" data-toggle="dropdown" href="#">
            <b>Wildan Auliana <i class="fas fa-angle-down"></i></b> 
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            {{-- <div class="user-panel mt-2 pb-2 mb-2 d-flex">
              <div class="image">
                <img src="{{asset('adminlte')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
            </div> --}}
            <a href="userprofile" class="dropdown-item">
              <i class="fas fa-user mr-1"></i> User Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-1"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('dashboard') }}" class="brand-link">
        <img src="{{asset('adminlte')}}/src/icon.png" alt="Bed management logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        {{-- <span class="brand-text font-weight-light">{{config('app.name')}}</span> --}}
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar menu ------------------------------------------------------------------------------------------------------------------------- -->
        @include('layout.sidebarmenu')
        <!-- /Sidebar menu ------------------------------------------------------------------------------------------------------------------------ -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content---------------------------------------------------------------------------------------------------------------------------- -->
      @yield('konten')
      <!-- /.content------------------------------------------------------------------------------------------------------------------------------- -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Modal ------------------------------------------------------------------------------------------------------------------------------------ -->
    @yield('modals')
    <!-- Modal ------------------------------------------------------------------------------------------------------------------------------------ -->

    <!-- Back to top ------------------------------------------------------------------------------------------------------------------------------ -->
    <a id="back-to-top" href="#content-header">
      <i class="fa fa-arrow-up"></i>
    </a>
    <!-- Back to top ------------------------------------------------------------------------------------------------------------------------------ -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>We play</b> with creativity | <b>Version</b> 1.0
      </div>
      <strong>Developed by <a href="https://instagram.com/w.auliaabdillah"><b>  @w.auliaabdillah</b></a> 2024</strong>. All rights reserved.
    </footer>

  </div>
  <!-- ./wrapper -->


  <!-- jQuery -->
  <script src="{{asset('adminlte')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('adminlte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('adminlte')}}/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('adminlte')}}/dist/js/demo.js"></script>
  {{-- Back to Top --}}
  <script src="{{asset('adminlte')}}/wildan/backtotop.js"></script>
  <!-- Toastr -->
  <script src="{{asset('adminlte')}}/plugins/toastr/toastr.min.js"></script>

  <!-- Select2 -->
  <script src="{{asset('adminlte')}}/plugins/select2/js/select2.full.min.js"></script>

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        width: '100%',
        // height: '100%',
        theme: 'bootstrap4'
      })
    });
  </script>

  <script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "15000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
    }
    // $('.toastrDefaultError').click(function() {
    //     toastr.error('Belum berfungsi yaa. Sabar masih proses develop..')
    //   });
  </script>

  <!-- jS--------------------------------------------------------------------------------------------------------------------------------- -->
  @yield('js')
  <!-- jS--------------------------------------------------------------------------------------------------------------------------------- -->

  </body>
</html>
