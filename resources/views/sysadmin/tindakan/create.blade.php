@extends('layout.admin')

@section('title','Tambah Master Tindakan Baru')

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
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
            <li class="breadcrumb-item">Master User</li>
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
                    <a href="{{ route('tindakan.index')}}" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-left"> </i> Kembali</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
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
            <form action="{{route('tindakan.store')}}" method="POST">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label class="col-form-label" for="nama">Nama <a style="color:red">*</a></label>
                      <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" name="nama" id="nama" placeholder="Silahkan isi ..." maxlength="60" value="{{old('nama')}}">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="jenis">Jenis <a style="color:red">*</a></label>
                      <select id="jenis" name="jenis" class="form-control select2bs4 {{ $errors->has('jenis') ? 'is-invalid' : '' }}">
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        <option value="0" {{ old('jenis') == '0' ? 'selected' : '' }}>Pemeriksaan</option>
                        <option value="1" {{ old('jenis') == '1' ? 'selected' : '' }}>Tindakan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="col-form-label" for="tarifdasar">Tarif Dasar <a style="color:red">*</a></label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            Rp. 
                          </div>
                        </div>
                        <input type="number" class="form-control {{ $errors->has('tarifdasar') ? 'is-invalid' : '' }}" name="tarifdasar" id="tarifdasar" placeholder="Silahkan isi ..." maxlength="60" value="{{old('tarifdasar')}}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-form-label" for="margin1">Margin 1 <a style="color:red">*</a></label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control {{ $errors->has('margin1') ? 'is-invalid' : '' }}" name="margin1" id="margin1" placeholder="Silahkan isi ..." maxlength="3" value="{{old('margin1')}}">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                % 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-form-label" for="margin2">Margin 2 <a style="color:red">*</a></label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control {{ $errors->has('margin2') ? 'is-invalid' : '' }}" name="margin2" id="margin2" placeholder="Silahkan isi ..." maxlength="3" value="{{old('margin2')}}">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                % 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-form-label" for="margin3">Margin 3 <a style="color:red">*</a></label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control {{ $errors->has('margin3') ? 'is-invalid' : '' }}" name="margin3" id="margin3" placeholder="Silahkan isi ..." maxlength="3" value="{{old('margin3')}}">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                % 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <button type="submit" onclick="return confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> </i> SIMPAN</button>
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
  @if ($errors->any())
    <script>
      $(document).ready(function() {
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}', 'Kesalahan!',{timeOut:10000});
        @endforeach
      });
      // toastr.error("{{Session::get('error')}}","Error!",{timeOut:10000});
    </script>
  @endif
@endsection