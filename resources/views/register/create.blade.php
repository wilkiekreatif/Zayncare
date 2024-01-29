@extends('layout.admin')

@section('title','Tambah Master Pasien Baru')

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
            <li class="breadcrumb-item">Master Pasien</li>
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
                    <a href="{{ route('register.index')}}" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-left"> </i> Kembali</a>
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
            <form action="{{route('register.store')}}" method="POST">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label class="col-form-label" for="label">Panggilan pasien <a style="color:red">*</a></label>
                      <select id="label" name="label" class="form-control select2bs4 {{ $errors->has('label') ? 'is-invalid' : '' }}">
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        <option value="Tn" {{ old('label') == 'Tn' ? 'selected' : '' }}>Tuan (Tn.)</option>
                        <option value="Ny" {{ old('label') == 'Ny' ? 'selected' : '' }}>Nyonya (Ny.)</option>
                        <option value="Nn" {{ old('label') == 'Nn' ? 'selected' : '' }}>Nona (Nn.)</option>
                        <option value="An" {{ old('label') == 'An' ? 'selected' : '' }}>Anak (An.)</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label class="col-form-label" for="gelardepan">Gelar depan</label>
                          <input type="text" class="form-control {{ $errors->has('gelardepan') ? 'is-invalid' : '' }}" name="gelardepan" id="gelardepan" placeholder="Silahkan isi ..." maxlength="60" value="{{old('gelardepan')}}">
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <label class="col-form-label" for="pasiennama">Nama pasien <a style="color:red">*</a></label>
                          <input type="text" class="form-control {{ $errors->has('pasiennama') ? 'is-invalid' : '' }}" name="pasiennama" id="pasiennama" placeholder="Silahkan isi ..." maxlength="60" value="{{old('pasiennama')}}">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="col-form-label" for="gelarbelakang">Gelar belakang</label>
                          <input type="text" class="form-control {{ $errors->has('gelarbelakang') ? 'is-invalid' : '' }}" name="gelarbelakang" id="gelarbelakang" placeholder="Silahkan isi ..." maxlength="60" value="{{old('gelarbelakang')}}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="alamat"> Alamat <a style="color:red">*</a></label>
                      <textarea type="text" class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" name="alamat" id="alamat" placeholder="Silahkan isi ..." maxlength="160" rows="4">{{old('alamat')}}</textarea>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-form-label" for="desa">Desa <a style="color:red">*</a></label>
                          <input type="text" class="form-control {{ $errors->has('desa') ? 'is-invalid' : '' }}" name="desa" id="desa" placeholder="Silahkan isi ..." maxlength="60" value="{{old('desa')}}">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-form-label" for="kecamatan">Kecamatan <a style="color:red">*</a></label>
                          <input type="text" class="form-control {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}" name="kecamatan" id="kecamatan" placeholder="Silahkan isi ..." maxlength="60" value="{{old('kecamatan')}}">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-form-label" for="kota">Kabupaten/ kota <a style="color:red">*</a></label>
                          <input type="text" class="form-control {{ $errors->has('kota') ? 'is-invalid' : '' }}" name="kota" id="kota" placeholder="Silahkan isi ..." maxlength="60" value="{{old('kota')}}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="notelp"> Nomor telepon yang bisa dihubungi <a style="color:red">*</a></label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">+62</span>
                        </div>
                        <input type="number" class="form-control {{ $errors->has('notelp') ? 'is-invalid' : '' }}" name="notelp" id="notelp" placeholder="Silahkan isi ..." maxlength="16" value="{{old('notelp')}}">
                      </div>                      
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="col-form-label" for="tgllahir"> Tanggal lahir <a style="color:red">*</a></label>
                      <input type="date" class="form-control {{ $errors->has('tgllahir') ? 'is-invalid' : '' }}" name="tgllahir" id="tgllahir" placeholder="Silahkan isi ..." maxlength="16" value="{{old('tgllahir')}}">                     
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="jeniskelamin">Jenis kelamin <a style="color:red">*</a></label>
                      <select id="jeniskelamin" name="jeniskelamin" class="form-control {{ $errors->has('jeniskelamin') ? 'is-invalid' : '' }}">
                        <option disabled selected="selected">-- Pilih salah satu --</option>
                        <option value="0" {{ old('jeniskelamin') == '0' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="1" {{ old('jeniskelamin') == '1' ? 'selected' : '' }}>perempuan</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-form-label" for="agama">Agama</label>
                          <select id="agama" name="agama" class="form-control">
                            <option disabled selected="selected">-- Pilih salah satu --</option>
                            <option value="0" {{ old('agama') == '0' ? 'selected' : '' }}>Islam</option>
                            <option value="1" {{ old('agama') == '1' ? 'selected' : '' }}>Katolik</option>
                            <option value="2" {{ old('agama') == '2' ? 'selected' : '' }}>Protestan</option>
                            <option value="3" {{ old('agama') == '3' ? 'selected' : '' }}>Hindu</option>
                            <option value="4" {{ old('agama') == '4' ? 'selected' : '' }}>Buddha</option>
                            <option value="5" {{ old('agama') == '5' ? 'selected' : '' }}>Lainnya</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-form-label" for="pendidikan">Pendidikan</label>
                          <select id="pendidikan" name="pendidikan" class="form-control">
                            <option disabled selected="selected">-- Pilih salah satu --</option>
                            <option value="0" {{ old('pendidikan') == '0' ? 'selected' : '' }}>Dibawah SD</option>
                            <option value="1" {{ old('pendidikan') == '1' ? 'selected' : '' }}>SD Sederajat</option>
                            <option value="2" {{ old('pendidikan') == '2' ? 'selected' : '' }}>SMP Sederajat</option>
                            <option value="3" {{ old('pendidikan') == '3' ? 'selected' : '' }}>SMA Sederajat</option>
                            <option value="4" {{ old('pendidikan') == '4' ? 'selected' : '' }}>D-III Sederajat</option>
                            <option value="5" {{ old('pendidikan') == '5' ? 'selected' : '' }}>S-I Sederajat</option>
                            <option value="6" {{ old('pendidikan') == '6' ? 'selected' : '' }}>S-II Sederajat</option>
                            <option value="7" {{ old('pendidikan') == '7' ? 'selected' : '' }}>S-III Sederajat</option>
                            <option value="8" {{ old('pendidikan') == '8' ? 'selected' : '' }}>Diatas S-III</option>
                            
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="penjamin1">Penjamin pasien 1 <a style="color:red">*</a></label>
                      <input type="text" class="form-control {{ $errors->has('penjamin1') ? 'is-invalid' : '' }}" name="penjamin1" id="penjamin1" placeholder="Silahkan isi ..." maxlength="60" value="{{old('penjamin1')}}">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="penjamin2">Penjamin pasien 2 </label>
                      <input type="text" class="form-control" name="penjamin2" id="penjamin2" placeholder="Silahkan isi ..." maxlength="60" value="{{old('penjamin2')}}">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="penjamin3">Penjamin pasien 3 </label>
                      <input type="text" class="form-control" name="penjamin3" id="penjamin3" placeholder="Silahkan isi ..." maxlength="60" value="{{old('penjamin3')}}">
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