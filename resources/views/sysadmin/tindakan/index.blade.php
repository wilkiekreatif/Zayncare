@extends('layout.admin')

@section('title','Master Tindakan')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
              <a href="{{route('tindakan.create')}}" class="btn btn-success btn-sm"> <i class="fas fa-upload"> </i> Tambah @yield('title') Baru</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">No</th>
                  <th style="background-color: rgb(120, 186, 196)">NAMA TINDAKAN</th>
                  <th style="background-color: rgb(120, 186, 196)">JENIS TINDAKAN</th>
                  <th style="background-color: rgb(120, 186, 196)">TARIF DASAR</th>
                  <th style="background-color: rgb(120, 186, 196)" width="20%">MARGIN</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">STATUS</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                @if ($tindakans->isNotEmpty())
                  @foreach ($tindakans as $tindakan)
                    <tr  
                      @if ($tindakan->is_active == 0)
                        style="background-color: rgb(253, 255, 150)" data-toggle="tooltip" data-placement="bottom" title="Tindakan nonaktif"
                      @endif >
                      <td>{{$loop->iteration}}</td>
                      <td>{{$tindakan->tindakan_nama}}</td>
                      <td>
                        @if ($tindakan->jenis== 0)
                            <h5><span class="badge badge-success">Pemeriksaan</span></h5>
                        @elseif ($tindakan->jenis== 1)
                            <h5><span class="badge badge-info">Tindakan Medis</span></h5>
                        @endif
                      </td>
                      @php
                          $tarifdasar  = number_format($tindakan->tarifdasar, 0, ',', '.');
                      @endphp
                      <td>Rp. <b>{{$tarifdasar}}</b></td>
                      <td>
                      <div style="width: 50%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              Margin 1: <b>{{$tindakan->margin1}} %</b>
                          </li>
                          <li class="nav-item">
                              Margin 2: @if ($tindakan->margin2==null)
                                          -
                                        @else
                                          <b>{{$tindakan->margin2}} %</b>
                                        @endif
                          </li>
                          <li class="nav-item">
                              Margin 3: @if ($tindakan->margin3==null)
                                          -
                                        @else
                                          <b>{{$tindakan->margin3}} %</b>
                                        @endif
                          </li>
                        </ul>
                      </div>
                      <div style="width: 50%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              Tarif 1: <b> Rp. @php
                                  $hargajual = ($tindakan->tarifdasar * $tindakan->margin1/100) + $tindakan->tarifdasar;
                                  $hargajualformated = number_format($hargajual, 0, ',', '.');
                                  echo $hargajualformated;
                                @endphp
                              </b>
                          </li>
                          <li class="nav-item">
                              Tarif 2: @if ($tindakan->margin2==null)
                                          -
                                        @else
                                          <b>Rp. @php
                                  $hargajual = ($tindakan->tarifdasar * $tindakan->margin2/100) + $tindakan->tarifdasar;
                                  $hargajualformated = number_format($hargajual, 0, ',', '.');
                                  echo $hargajualformated;
                                @endphp</b>
                                        @endif
                          </li>
                          <li class="nav-item">
                              Tarif 3: @if ($tindakan->margin3==null)
                                          -
                                        @else
                                          <b>Rp. @php
                                  $hargajual = ($tindakan->tarifdasar * $tindakan->margin3/100) + $tindakan->tarifdasar;
                                  $hargajualformated = number_format($hargajual, 0, ',', '.');
                                  echo $hargajualformated;
                                @endphp</b>
                                        @endif
                          </li>
                        </ul>
                      </div>
                    </td>
                      <td style="text-align: center">
                        @if ($tindakan->is_active == 1)
                          <i class="fa fa-check"></i> Aktif     
                        @else
                          <i class="fa fa-times"></i> Non-Aktif
                        @endif
                      </td>
                      <td>
                        <div class="btn-group" style="width: 100%">
                          <a href="" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit tindakan {{strtoUpper($tindakan->tindakan_nama)}}" ><i class="fas fa-edit"></i></a>
                          @if ($tindakan->is_active==1)
                            <a href="{{route('tindakan.nonaktif',$tindakan->id)}}" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Nonaktifkan tindakan {{strtoUpper($tindakan->tindakan_nama)}}" onclick="return confirm('Apakah anda yakin ingin menonaktifkan tindakan {{strtoUpper($tindakan->tindakan_nama)}}?')"><i class="fas fa-times-circle"></i></a>
                            @else
                            <a href="{{route('tindakan.aktifkan',$tindakan->id)}}" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Aktifkan tindakan {{strtoUpper($tindakan->tindakan_nama)}}" onclick="return confirm('Apakah anda yakin ingin mengaktifkan tindakan {{strtoUpper($tindakan->tindakan_nama)}}?')"><i class="fas fa-check"></i></a>
                          @endif
                          <a href="{{route('tindakan.hapus',$tindakan->id)}}" type="button" class="btn btn-danger" data-placement="bottom" onclick="return confirm('Apakah anda yakin ingin menghapus tindakan {{strtoUpper($tindakan->tindakan_nama)}}')" title="Hapus tindakan {{strtoUpper($tindakan->tindakan_nama)}}"><i class="fas fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>NAMA TINDAKAN</th>
                  <th>JENIS TINDAKAN</th>
                  <th>TARIF DASAR</th>
                  <th>MARGIN</th>
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
    // $('.toastrDefaultError').click(function() {
    //   toastr.error('Belum berfungsi yaa. Sabar masih proses develop..')
    // });
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
