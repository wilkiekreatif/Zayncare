@extends('layout.admin')

@section('title','Master Obat Alkes')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

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
            <li class="breadcrumb-item">Gudang Farmasi</li>
            <li class="breadcrumb-item">Obat Alkes</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content text-sm">
    <div class="container-fluid">
      <div class="card card-default">
          <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                    <i class="fa fa-layer-group"></i>
                    Tabel @yield('title')
                  </h3>
                  <div>
                    <a href="{{ route('obatalkes.create') }}" class="btn btn-success btn-sm"> <i class="fas fa-upload"> </i> Tambah @yield('title') Baru</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
            <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">No</th>
                  <th style="background-color: rgb(120, 186, 196)" width="6%">ID</th>
                  <th style="background-color: rgb(120, 186, 196)">NAMA OBAT ALKES</th>
                  <th style="background-color: rgb(120, 186, 196)" width="12%">SUPPLIER</th>
                  <th style="background-color: rgb(120, 186, 196)" width="10%">HARGA BELI TERAKHIR</th>
                  <th style="background-color: rgb(120, 186, 196)">MARGIN KEUNTUNGAN</th>
                  <th style="background-color: rgb(120, 186, 196)" width="6%">STOK</th>
                  <th style="background-color: rgb(120, 186, 196)"width="2%">STATUS</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1 ?>
                @foreach ($obatalkess as $obatalkes)
                  <tr>
                    <td @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                    @endif>{{ $no }}</td>
                    <td @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                    @endif>{{$obatalkes->obatalkes_id}}</td>
                    <td @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                    @endif><b>{{$obatalkes->obatalkes_nama}}</b></td>
                    <td @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                    @endif>
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <i class="fa fa-store-alt"></i> {{$obatalkes->supplier1->supplier_nama}}
                        </li>
                        <li class="nav-item">
                            <i class="fa fa-store-alt"></i> @if ($obatalkes->supplier2_id==null)
                                                              -
                                                            @else
                                                              {{$obatalkes->supplier2->supplier_nama}}
                                                            @endif
                        </li>
                        <li class="nav-item">
                            <i class="fa fa-store-alt"></i> @if ($obatalkes->supplier3_id==null)
                                                              -
                                                            @else
                                                              {{$obatalkes->supplier3->supplier_nama}}
                                                            @endif
                        </li>
                      </ul>
                    </td @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                    @endif>
                    <td @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                    @endif>Rp. <b>@php
                                  $hargabeli = $obatalkes->hargabeliterakhir;
                                  $hargabeliformated = number_format($hargabeli, 0, ',', '.');
                                  echo $hargabeliformated;
                                @endphp</b> / {{$obatalkes->satuan}}</td>
                    <td @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                    @endif>
                      <div style="width: 50%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              Margin 1: <b>{{$obatalkes->margin1}} %</b>
                          </li>
                          <li class="nav-item">
                              Margin 2: @if ($obatalkes->margin2==null)
                                          -
                                        @else
                                          <b>{{$obatalkes->margin2}} %</b>
                                        @endif
                          </li>
                          <li class="nav-item">
                              Margin 3: @if ($obatalkes->margin3==null)
                                          -
                                        @else
                                          <b>{{$obatalkes->margin3}} %</b>
                                        @endif
                          </li>
                        </ul>
                      </div>
                      <div style="width: 50%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              Harga Jual 1: <b> Rp. @php
                                  $hargajual = ($obatalkes->hargabeliterakhir * $obatalkes->margin1/100) + $obatalkes->hargabeliterakhir;
                                  $hargajualformated = number_format($hargajual, 0, ',', '.');
                                  echo $hargajualformated;
                                @endphp
                              </b>
                          </li>
                          <li class="nav-item">
                              Harga Jual 2: @if ($obatalkes->margin2==null)
                                          -
                                        @else
                                          <b>Rp. @php
                                  $hargajual = ($obatalkes->hargabeliterakhir * $obatalkes->margin2/100) + $obatalkes->hargabeliterakhir;
                                  $hargajualformated = number_format($hargajual, 0, ',', '.');
                                  echo $hargajualformated;
                                @endphp</b>
                                        @endif
                          </li>
                          <li class="nav-item">
                              Harga Jual 3: @if ($obatalkes->margin3==null)
                                          -
                                        @else
                                          <b>Rp. @php
                                  $hargajual = ($obatalkes->hargabeliterakhir * $obatalkes->margin3/100) + $obatalkes->hargabeliterakhir;
                                  $hargajualformated = number_format($hargajual, 0, ',', '.');
                                  echo $hargajualformated;
                                @endphp</b>
                                        @endif
                          </li>
                        </ul>
                      </div>
                    </td>
                    <td @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                      @else
                        style="background-color: rgb(203, 250, 190)"
                        @endif
                    ><b>
                      @if (($obatalkes->stok < 1))
                        0
                      @else
                        {{$obatalkes->stok}}
                      @endif</b> {{$obatalkes->satuan}}</td>
                    <td  @if ($obatalkes->is_active==0)
                        style="background-color: rgb(255, 225, 0)"
                    @endif
                    style="text-align: center">
                    
                    @if ($obatalkes->is_active==0)
                      <i class="fa fa-times"></i> Nonaktif
                    @else
                      <i class="fa fa-check"></i> Aktif
                    @endif
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="#" type="button" class="btn btn-success toastrDefaultError" data-toggle="tooltip" data-placement="bottom" title="Kartu Stok" ><i class="fas fa-list"></i></a>
                        <a href="{{ route('obatalkes.edit',$obatalkes->id)}}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Master Obat Alkes" ><i class="fas fa-edit"></i></a>
                        @if ($obatalkes->is_active==1)
                          <a href="{{ route('obatalkes.nonaktif',$obatalkes->id)}}" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Nonaktifkan Master Obat Alkes" onclick="return confirm('Apakah anda yakin ingin menonaktifkan Obat alkes ini?')"><i class="fas fa-times-circle"></i></a>
                          @else
                          <a href="{{ route('obatalkes.aktif',$obatalkes->id)}}" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Aktifkan Master Obat Alkes" onclick="return confirm('Apakah anda yakin ingin mengaktifkan Obat alkes ini?')"><i class="fas fa-check"></i></a>
                        @endif
                        <a href="{{ route('obatalkes.delete',$obatalkes->id)}}" type="button" class="btn btn-danger" data-placement="bottom" onclick="return confirm('Apakah anda yakin ingin menghapus Master Obat Alkes ini? Data tidak bisa dikembalikan dan STOK akan dianggap HILANG.')" title="Hapus Master Obat Alkes"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php $no++ ?>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>NAMA OBAT ALKES</th>
                  <th>SUPPLIER</th>
                  <th>HARGA BELI TERAKHIR</th>
                  <th>MARGIN KEUNTUNGAN</th>
                  <th>STOK </th>
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