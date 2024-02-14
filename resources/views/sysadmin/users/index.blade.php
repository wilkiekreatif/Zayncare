@extends('layout.admin')

@section('title','Users')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<meta http-equiv="refresh" content="60">
@endsection

@section('konten')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>@yield('title')</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item">sysadmin</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content text-sm">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">
              <i class="fa fa-layer-group"></i>
              Tabel Master @yield('title')
            </h3>
            <div>
              <a href="{{route('users.create')}}" class="btn btn-success btn-sm"> <i class="fas fa-upload"> </i> Tambah @yield('title') Baru</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">No</th>
                  <th style="background-color: rgb(120, 186, 196)" width="15%">USERNAME</th>
                  <th style="background-color: rgb(120, 186, 196)" width="50%">NAMA LENGKAP</th>
                  <th style="background-color: rgb(120, 186, 196)" width="20%">ROLE</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">SYSADMIN</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">GUDANG FARMASI</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">PENDAFTARAN</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">POLIKLINIK</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">APOTEK</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">KASIR</th>
                  <th style="background-color: rgb(120, 186, 196)" >STATUS</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                @if ($users->isNotEmpty())
                  @foreach ($users as $user)
                    <tr>
                      <td style="text-align: center">{{$loop->iteration}}</td>
                      <td>{{$user->username}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->role}}</td>
                      @if ($user->sysadmin == 'on')
                        <td style="text-align: center; background-color: rgb(203, 250, 190)" data-toggle="tooltip" data-placement="bottom" title="Mendapat akses System Administrator">
                          <i class="fa fa-check"></i>       
                        </td>
                      @else
                        <td style="text-align: center; background-color: rgb(255, 164, 164)" data-toggle="tooltip" data-placement="bottom" title="Tidak mendapat akses System Administrator">
                          <i class="fa fa-times"></i>
                        </td>
                      @endif
                      @if ($user->gudangfarmasi == 'on')
                        <td style="text-align: center; background-color: rgb(203, 250, 190)" data-toggle="tooltip" data-placement="bottom" title="Mendapat akses Gudang Farmasi">
                          <i class="fa fa-check"></i>       
                        </td>
                      @else
                        <td style="text-align: center; background-color: rgb(255, 164, 164)" data-toggle="tooltip" data-placement="bottom" title="Tidak mendapat akses Gudang Farmasi">
                          <i class="fa fa-times"></i>
                        </td>
                      @endif
                      @if ($user->register == 'on')
                        <td style="text-align: center; background-color: rgb(203, 250, 190)" data-toggle="tooltip" data-placement="bottom" title="Mendapat akses Pendaftaran">
                          <i class="fa fa-check"></i>       
                        </td>
                      @else
                        <td style="text-align: center; background-color: rgb(255, 164, 164)" data-toggle="tooltip" data-placement="bottom" title="Tidak mendapat akses Pendaftaran">
                          <i class="fa fa-times"></i>
                        </td>
                      @endif
                      @if ($user->poliklinik == 'on')
                        <td style="text-align: center; background-color: rgb(203, 250, 190)" data-toggle="tooltip" data-placement="bottom" title="Mendapat akses Poliklinik">
                          <i class="fa fa-check"></i>       
                        </td>
                      @else
                        <td style="text-align: center; background-color: rgb(255, 164, 164)" data-toggle="tooltip" data-placement="bottom" title="Tidak mendapat akses Poliklinik">
                          <i class="fa fa-times"></i>
                        </td>
                      @endif
                      @if ($user->apotek == 'on')
                        <td style="text-align: center; background-color: rgb(203, 250, 190)" data-toggle="tooltip" data-placement="bottom" title="Mendapat akses Apotek">
                          <i class="fa fa-check"></i>       
                        </td>
                      @else
                        <td style="text-align: center; background-color: rgb(255, 164, 164)" data-toggle="tooltip" data-placement="bottom" title="Tidak mendapat akses Apotek">
                          <i class="fa fa-times"></i>
                        </td>
                      @endif
                      @if ($user->kasir == 'on')
                        <td style="text-align: center; background-color: rgb(203, 250, 190)" data-toggle="tooltip" data-placement="bottom" title="Mendapat akses Kasir">
                          <i class="fa fa-check"></i>       
                        </td>
                      @else
                        <td style="text-align: center; background-color: rgb(255, 164, 164)" data-toggle="tooltip" data-placement="bottom" title="Tidak mendapat akses kasir">
                          <i class="fa fa-times"></i>
                        </td>
                      @endif
                      <td style="text-align: center">
                        @if ($user->is_active == 1)
                          <i class="fa fa-check"></i> Aktif     
                        @else
                          <i class="fa fa-times"></i> Non-Aktif
                        @endif
                      </td>
                      <td>
                        <div class="btn-group" style="width: 100%">
                          <a href="" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit user {{strtoUpper($user->name)}}" ><i class="fas fa-edit"></i></a>
                          @if ($user->is_active==1)
                            <a href="" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Nonaktifkan user {{strtoUpper($user->name)}}" onclick="return confirm('Apakah anda yakin ingin menonaktifkan user {{strtoUpper($user->name)}}?')"><i class="fas fa-times-circle"></i></a>
                            @else
                            <a href="" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Aktifkan user {{strtoUpper($user->name)}}" onclick="return confirm('Apakah anda yakin ingin mengaktifkan user {{strtoUpper($user->name)}}?')"><i class="fas fa-check"></i></a>
                          @endif
                          <a href="" type="button" class="btn btn-danger" data-placement="bottom" onclick="return confirm('Apakah anda yakin ingin menghapus user {{strtoUpper($user->name)}}')" title="Hapus user {{strtoUpper($user->name)}}"><i class="fas fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>USERNAME</th>
                  <th>NAMA LENGKAP</th>
                  <th>ROLE</th>
                  <th>SYSADMIN</th>
                  <th>GUDANG FARMASI</th>
                  <th>PENDAFTARAN</th>
                  <th>POLIKLINIK</th>
                  <th>APOTEK</th>
                  <th>KASIR</th>
                  <th>STATUS</th>
                  <th>ACTION</th>
                </tr>
              </tfoot>
            </table>
        </div>
      </div>
    </div>
  </section>
@endsection

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
  <script>
    $(function () {
      $("#datatable1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#datatable1_wrapper .col-md-6:eq(0)');
    });
    $('.toastrDefaultError').click(function() {
        toastr.error('Belum berfungsi yaa. Sabar masih proses develop..')
      });
</script>
@if (Session::has('success'))
    <script>
      toastr.success("{{Session::get('success')}}","Success!");
      // toastr.info("{{Session::get('success')}}","Success!");
      // toastr.warning("{{Session::get('success')}}","Success!");
      // toastr.error("{{Session::get('success')}}","Success!");
    </script>
  @endif
@endsection
