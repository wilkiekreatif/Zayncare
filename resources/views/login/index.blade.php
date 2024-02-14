
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | {{config('app.name')}}</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/wildan/login.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-info">
      <img src="{{asset('adminlte')}}/src/logo.png" alt="Bed management logo" class="brand-image" style="opacity: .8; padding-left: 6%; padding-right: 6%; padding-top: 6%; animation: zoomAnimation 15s infinite alternate;">
      {{-- <div class="card-header text-center">
        <a href="#" class="h1">{{config('app.name')}}</a>
      </div> --}}
      <div class="card-body">
        {{-- <p class="login-box-msg">

        </p> --}}
        <form action="{{route('login.proses')}}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="username" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" placeholder="username..." value="{{old('username')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-info btn-block">Log In</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <footer class="footer">
    Developed by <a href="https://instagram.com/w.auliaabdillah"><b>  Wilkie Creative Works</b></a> 2023 . All rights reserved.
    <div>
      <b>We play</b> with creativity | <b>Version</b> 1.0
    </div>
      </footer>

  <!-- jQuery -->
  <script src="{{asset('adminlte')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('adminlte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('adminlte')}}/dist/js/adminlte.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/toastr/toastr.min.js"></script>
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
  @if (Session::has('error'))
      <script>
        // toastr.success("{{Session::get('success')}}","Success!");
        // toastr.info("{{Session::get('success')}}","Success!");
        // toastr.warning("{{Session::get('success')}}","Success!");
        toastr.error("{{Session::get('error')}}","Kesalahan!");
      </script>
    @endif
  </body>
</html>
