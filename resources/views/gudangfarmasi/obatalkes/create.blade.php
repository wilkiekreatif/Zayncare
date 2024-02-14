@extends('layout.admin')

@section('title','Tambah Master Obat Alkes Baru')

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
                    <a href="{{ route('obatalkes.index')}}" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-left"> </i> Kembali</a>
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
              <form action="{{ route('obatalkes.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="jenis">Jenis Obat Alkes <a style="color:red">*</a></label>
                      <select id="jenis" name="jenis" class="form-control select2bs4 {{ $errors->has('jenis') ? 'is-invalid' : '' }}" style="width: 100%;">
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        <option value="0" {{ old('jenis') == '0' ? 'selected' : '' }}>Obat</option>
                        <option value="1" {{ old('jenis') == '1' ? 'selected' : '' }}>Alkes</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="obatalkesnama">Nama Obat Alkes <a style="color:red">*</a></label>
                      <input required id="obatalkesnama" name="obatalkesnama" type="text" class="form-control {{ $errors->has('obatalkesnama') ? 'is-invalid' : '' }}" placeholder="Nama Obat Alkes..." maxlength="30" value="{{old('obatalkesnama')}}">
                    </div>
                    <div class="form-group">
                      <label for="supplier1">Supplier 1 <a style="color:red">*</a></label>
                      <select id="supplier1" name="supplier1" class="form-control select2bs4 {{ $errors->has('supplier1') ? 'is-invalid' : '' }}" style="width: 100%;" required>
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier1') == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="supplier2">Supplier 2</label>
                      <select id="supplier2" name="supplier2" class="form-control select2bs4" style="width: 100%;">
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier2') == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="supplier3">Supplier 3</label>
                      <select id="supplier3" name="supplier3" class="form-control select2bs4" style="width: 100%;">
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier3') == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_nama }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="satuan">Satuan <a style="color:red">*</a></label>
                      <input required id="satuan" name="satuan" type="text" class="form-control {{ $errors->has('satuan') ? 'is-invalid' : '' }}" placeholder="Satuan..." maxlength="15" value="{{old('satuan')}}">
                    </div>
                    <div class="form-group">
                      <label for="hargabeli">Perkiraan Harga Beli <a style="color:red">*</a></label>
                      <input required id="hargabeli" name="hargabeli" type="text" class="form-control {{ $errors->has('hargabeli') ? 'is-invalid' : '' }}" placeholder="hargabeli..." maxlength="15" value="{{old('hargabeli')}}">
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="margin1">Margin 1 <a style="color:red">*</a></label>
                          <input required id="margin1" name="margin1" type="number" class="form-control {{ $errors->has('margin1') ? 'is-invalid' : '' }}" placeholder="margin 1..." maxlength="3" value="{{old('margin1')}}">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="margin2">Margin 2</label>
                          <input id="margin2" name="margin2" type="number" class="form-control" placeholder="margin 2..." maxlength="3" value="{{old('margin2')}}">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="margin3">Margin 3</label>
                          <input id="margin3" name="margin3" type="number" class="form-control" placeholder="margin 3..." maxlength="3" value="{{old('margin3')}}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="wajibresep">Wajib Resep <a style="color:red">*</a></label>
                      <select id="wajibresep" name="wajibresep" class="form-control select2bs4 {{ $errors->has('wajibresep') ? 'is-invalid' : '' }}" style="width: 100%;">
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        <option value="0" {{ old('wajibresep') == '0' ? 'selected' : '' }}>Tidak perlu disertai Resep Dokter</option>
                        <option value="1" {{ old('wajibresep') == '1' ? 'selected' : '' }}>Harus disertai Resep Dokter</option>
                      </select>
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
@endsection