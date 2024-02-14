@extends('layout.admin')

@section('title','Tambah Defekta Baru')

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
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
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
      <div class="row">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                  </h3>
                  <div>
                    <a href="{{ route('obatalkes.defekta')}}" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-left"> </i> Kembali</a>
                  </div>
              </div>
            </div>
          </div>
          <div class="card card-default">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                    <i class="fa fa-layer-group"></i>
                    Form @yield('title')
                  </h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{ route('tambahdefekta') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="id">ID Defekta <a style="color:red">*</a></label>
                      <input readonly id="id" name="id" type="text" class="form-control" value="{{ $defekta_id }}">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="obatalkes_id">Obat Alkes <a style="color:red">*</a></label>
                      <select id="obatalkes_id" name="obatalkes_id" class="form-control select2bs4 {{ $errors->has('obatalkes_id') ? 'is-invalid' : '' }}" style="width: 100%;">
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        @foreach ($obatalkes as $item)
                          <option value="{{ $item->id }}" {{ old('obatalkes_id') == $item->id ? 'selected' : '' }} style="background-color: red">{{ $item->obatalkes_nama }} | {{$item->stok}} {{$item->satuan}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="supplier">Supplier<a style="color:red">*</a></label>
                      <select id="supplier" name="supplier" class="form-control select2bs4 {{ $errors->has('supplier') ? 'is-invalid' : '' }}" style="width: 100%;" required>
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        @foreach ($suppliers as $supplier)
                          <option value="{{ $supplier->id }}" {{ old('supplier') == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="qty">Qty <a style="color:red">*</a></label>
                      <input required id="qty" name="qty" type="number" class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" placeholder="Silahkan diisi..." maxlength="15" value="{{old('qty')}}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <button type="submit" onclick="return  confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> </i> SIMPAN</button>
                  <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i> RESET</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
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
  <script src="{{asset('adminlte')}}/dist/js/backtotop.js"></script>

  @if ($errors->any())
    <script>
      $(document).ready(function() {
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}', 'Kesalahan!',{timeOut:30000});
        @endforeach
      });
      // toastr.error("{{Session::get('error')}}","Error!",{timeOut:10000});
    </script>
  @endif
  @if (Session::has('success'))
    <script>
      toastr.success("{{Session::get('success')}}","Success!");
      // toastr.info("{{Session::get('success')}}","Success!");
      // toastr.warning("{{Session::get('success')}}","Success!");
      // toastr.error("{{Session::get('success')}}","Success!");
    </script>
  @endif
@endsection