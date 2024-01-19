@extends('layout.admin')

{{-- CSS -------------------------------------------------------------------------------------------------------------------- --}}
@section('css')
  {{-- auto refresh --}}
  <meta http-equiv="refresh" content="60">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

{{-- KONTEN ----------------------------------------------------------------------------------------------------------------- --}}
@section('konten')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>@yield('title')</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">404</li>
          </ol>
        </div>
      </div>
    </div>
  <!-- /.container-fluid -->
  </section>
    <section class="content text-sm">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Halaman tidak ditemukan.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="{{ url('dashboard')}}">return to dashboard</a> or other pages in the left menu.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  @endsection


{{-- JS --------------------------------------------------------------------------------------------------------------------- --}}
@section('js')
  <!-- DataTables  & Plugins -->
  <script src="{{asset('adminlte')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/jszip/jszip.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Select2 -->
  <script src="{{asset('adminlte')}}/plugins/select2/js/select2.full.min.js"></script>
@endsection