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
                    <a href="{{ url('/barang/create') }}" class="btn btn-success btn-sm"> <i class="fas fa-upload"> </i> Tambah @yield('title') Baru</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
            <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th>ID OBAT ALKES</th>
                  <th>NAMA OBAT ALKES</th>
                  <th>SUPPLIER</th>
                  <th>HARGA BELI TERAKHIR</th>
                  <th>MARGIN KEUNTUNGAN</th>
                  <th width="2%">STATUS</th>
                  <th width="2%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1 ?>
                @foreach ($obatalkess as $obatalkes)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{$obatalkes->obatalkes_id}}</td>
                    <td><b>{{$obatalkes->obatalkes_nama}}</b></td>
                    <td>
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
                    </td>
                    <td>Rp. {{$obatalkes->hargabeliterakhir}} / {{$obatalkes->satuan}}</td>
                    <td>
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
                          {{-- <li class="nav-item">
                              Margin 4: @if ($obatalkes->margin4==null)
                                          -
                                        @else
                                          <b>{{$obatalkes->margin4}} %</b>
                                        @endif
                          </li>
                          <li class="nav-item">
                              Margin 5: @if ($obatalkes->margin5==null)
                                          -
                                        @else
                                          <b>{{$obatalkes->margin5}} %</b>
                                        @endif
                          </li> --}}
                        </ul>
                      </div>
                      <div style="width: 50%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              Harga Jual 1: <b> Rp. {{ ($obatalkes->hargabeliterakhir * $obatalkes->margin1/100) + $obatalkes->hargabeliterakhir }}</b>
                          </li>
                          <li class="nav-item">
                              Harga Jual 2: @if ($obatalkes->margin2==null)
                                          -
                                        @else
                                          <b>Rp. {{ ($obatalkes->hargabeliterakhir * $obatalkes->margin2/100) + $obatalkes->hargabeliterakhir }}</b>
                                        @endif
                          </li>
                          <li class="nav-item">
                              Harga Jual 3: @if ($obatalkes->margin3==null)
                                          -
                                        @else
                                          <b>Rp. {{ ($obatalkes->hargabeliterakhir * $obatalkes->margin3/100) + $obatalkes->hargabeliterakhir }}</b>
                                        @endif
                          </li>
                          {{-- <li class="nav-item">
                              Harga Jual 4: @if ($obatalkes->margin4==null)
                                          -
                                        @else
                                          <b>Rp. {{ ($obatalkes->hargabeliterakhir * $obatalkes->margin4/100) + $obatalkes->hargabeliterakhir }}</b>
                                        @endif
                          </li>
                          <li class="nav-item">
                              Harga Jual 5: @if ($obatalkes->margin5==null)
                                          -
                                        @else
                                          <b>Rp. {{ ($obatalkes->hargabeliterakhir * $obatalkes->margin5/100) + $obatalkes->hargabeliterakhir }}</b>
                                        @endif
                          </li> --}}
                        </ul>
                      </div>
                    </td>
                    <td style="text-align: center">
                    @if ($obatalkes->is_active==0)
                      <i class="fa fa-times"></i> Nonaktif
                    @else
                      <i class="fa fa-check"></i> Aktif
                    @endif
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="#" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Edit bed: #"><i class="fas fa-edit"></i></a>
                        @if ($obatalkes->is_active==1)
                          <a href="{#" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Nonaktifkan bed: #"><i class="fas fa-times-circle"></i></a>
                          @else
                          <a href="#" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Aktifkan bed: #"><i class="fas fa-check"></i></a>
                        @endif
                        <a href="#" type="button" class="btn btn-danger" data-placement="bottom" title="Hapus bed: #"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php $no++ ?>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>ID OBAT ALKES</th>
                  <th>NAMA OBAT ALKES</th>
                  <th>SUPPLIER</th>
                  <th>HARGA BELI TERAKHIR</th>
                  <th>MARGIN KEUNTUNGAN</th>
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
</script>
@endsection