@extends('layout.admin')

@section('title','Master Supplier')

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
                    <a href="{{ route('supplier.create') }}" class="btn btn-success btn-sm"> <i class="fas fa-upload"> </i> Tambah @yield('title') Baru</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
            <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th>ID SUPPLIER</th>
                  <th>NAMA SUPPLIER</th>
                  <th>ALAMAT</th>
                  <th>NO TELEPON</th>
                  <th width="2%">STATUS</th>
                  <th width="2%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1 ?>
                @foreach ($suppliers as $supplier)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{$supplier->supplier_id}}</td>
                    <td><b>{{$supplier->supplier_nama}}</b></td>
                    <td>{{$supplier->supplier_alamat}}</td>
                    <td>{{$supplier->supplier_telp}}</td>
                    <td style="text-align: center">
                    @if ($supplier->is_active==0)
                      <i class="fa fa-times"></i> Nonaktif
                    @else
                      <i class="fa fa-check"></i> Aktif
                    @endif
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="{{ route('supplier.edit',$supplier->id)}}" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Edit Master Supplier"><i class="fas fa-edit"></i></a>
                        @if ($supplier->is_active==1)
                          <a href="{{route('supplier.nonaktif',$supplier->id)}}" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" onclick="return confirm('Apakah anda yakin ingin menonaktifkan supplier ini?')" title="Nonaktifkan Supplier"><i class="fas fa-times-circle"></i></a>
                          @else
                          <a href="{{route('supplier.aktif',$supplier->id)}}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" onclick="return confirm('Apakah anda yakin ingin mengaktifkan supplier ini?')" title="Aktifkan Supplier"><i class="fas fa-check"></i></a>
                        @endif
                        <a href="{{route('supplier.delete',$supplier->id)}}" type="button" class="btn btn-danger" data-placement="bottom" onclick="return confirm('Apakah anda yakin ingin menghapus supplier ini? Data tidak bisa dikembalikan.')"title="Hapus Supplier"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php $no++ ?>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th width="2%">No</th>
                  <th>ID SUPPLIER</th>
                  <th>NAMA SUPPLIER</th>
                  <th>ALAMAT</th>
                  <th>NO TELEPON</th>
                  <th width="2%">STATUS</th>
                  <th width="2%">ACTION</th>
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
@if (Session::has('success'))
    <script>
      toastr.success("{{Session::get('success')}}","Success!");
      // toastr.info("{{Session::get('success')}}","Success!");
      // toastr.warning("{{Session::get('success')}}","Success!");
      // toastr.error("{{Session::get('success')}}","Success!");
    </script>
  @endif
@endsection