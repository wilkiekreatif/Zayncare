@extends('layout.admin')

@section('title','Tambah Master User Baru')

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
                    <a href="{{ route('users.index')}}" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-left"> </i> Kembali</a>
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
            <form action="{{route('users.store')}}" method="POST">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label class="col-form-label" for="nama">Nama Lengkap <a style="color:red">*</a></label>
                      <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" name="nama" id="nama" placeholder="Silahkan isi ..." maxlength="60" value="{{old('nama')}}">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="username">Username <a style="color:red">*</a></label>
                      <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" id="username" placeholder="Silahkan isi ..." maxlength="60" value="{{old('username')}}">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="password">Password <a style="color:red">*</a></label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password" placeholder="Silahkan isi ..." maxlength="60" value="{{old('password')}}">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="col-form-label" for="email">Email</label>
                      <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" placeholder="Silahkan isi ..." maxlength="60" value="{{old('email')}}">
                    </div>
                    <label class="col-form-label" for="email">Hak Akses User</label>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="sysadmin" name="sysadmin" {{old('sysadmin') == 'on' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="sysadmin">System Administrator</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="gudangfarmasi" name="gudangfarmasi" {{old('gudangfarmasi') == 'on' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="gudangfarmasi">Gudang Farmasi</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="register" name="register" {{old('register') == 'on' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="register">Pendaftaran</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="poliklinik" name="poliklinik" {{old('poliklinik') == 'on' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="poliklinik">Poliklinik</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="apotek" name="apotek" {{old('apotek') == 'on' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="apotek">Apotek</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="kasir" name="kasir" {{old('kasir') == 'on' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="kasir">Kasir</label>
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