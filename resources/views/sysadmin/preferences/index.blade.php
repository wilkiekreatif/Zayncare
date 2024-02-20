@extends('layout.admin')

@section('title','System Preferences')

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
      <div class="card card-info card-outline">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">
              <i class="fa fa-layer-group"></i>
              Data Klinik
            </h3>
          </div>
        </div>
        <div class="card-body">
          <form action="{{route('preferences.update')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="nama">Nama Klinik <a style="color:red">*</a></label>
                  <input required id="nama" name="nama" type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" placeholder="Silahkan isi..." value="{{$info->klinik_nama}}">
                </div>
                <div class="form-group">
                  <label for="subnama">Subnama Klinik</label>
                  <input id="subnama" name="subnama" type="text" class="form-control {{ $errors->has('subnama') ? 'is-invalid' : '' }}" placeholder="Silahkan isi..." value="{{$info->klinik_subnama}}">
                </div>
                <div class="form-group">
                  <label for="sip">Ijin Praktek <a style="color:red">*</a></label>
                  <input required id="sip" name="sip" type="text" class="form-control {{ $errors->has('sip') ? 'is-invalid' : '' }}" placeholder="Silahkan isi..." value="{{$info->sip}}">
                </div>
                <div class="form-group">
                  <label for="tagline">Tagline Klinik</label>
                  <input required id="tagline" name="tagline" type="tagline" class="form-control {{ $errors->has('tagline') ? 'is-invalid' : '' }}" placeholder="Silahkan isi..." value="{{$info->tagline}}">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="email">Email Klinik</label>
                  <input id="email" name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Silahkan isi..." value="{{$info->email}}">
                </div>
                <div class="form-group">
                  <label for="notelp">Telepon Klinik<a style="color:red">*</a></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+62</span>
                    </div>
                    <input required id="notelp" name="notelp" type="notelp" class="form-control {{ $errors->has('notelp') ? 'is-invalid' : '' }}" placeholder="Silahkan isi..." value="{{$info->notelp}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="notelp2">Telepon Klinik 2</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+62</span>
                    </div>
                    <input id="notelp2" name="notelp2" type="notelp2" class="form-control {{ $errors->has('notelp2') ? 'is-invalid' : '' }}" placeholder="Silahkan isi..." value="{{$info->notelp2}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="website">Website</label>
                  <input id="website" name="website" type="website" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" placeholder="Silahkan isi..." value="{{$info->website}}">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="alamat">Alamat Klinik <a style="color:red">*</a></label>
                  <textarea required id="alamat" name="alamat" type="text" class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" rows="7"  placeholder="Silahkan isi...">{{$info->alamat}}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <button type="submit" onclick="return confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> </i> SIMPAN</button>
              <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i> RESET</button>
            </div>
          </form>
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