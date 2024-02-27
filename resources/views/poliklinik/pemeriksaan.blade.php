@extends('layout.admin')

@section('title','Pemeriksaan Pasien')

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
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
            <li class="breadcrumb-item">Poliklinik</li>
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
            <div class="card-header card-info">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                  </h3>
                  <div>
                    <a href="{{ route('poliklinik.index')}}" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-left"> </i> Kembali</a>
                  </div>
              </div>
            </div>
          </div>
          <div class="card card-info">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                    <i class="fa fa-user-injured"></i>
                    Data Pasien
                  </h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label" for="norm">Nomor Rekam Medis</label>
                    <input readonly class="form-control" name="norm" id="norm" maxlength="60" value="{{$trxPasien->mPasien->no_rm}}">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="trx_id">Id Transaksi</label>
                    <input readonly class="form-control" name="trx_id" id="trx_id" maxlength="60" value="{{$trxPasien->trx_id}}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label" for="pasiennama">Nama Pasien</label>
                    <input readonly class="form-control" name="pasiennama" id="pasiennama" maxlength="60" value="{{$trxPasien->mPasien->pasien_nama}}">
                  </div>
                  <div class="form-group">
                    @php
                      $tanggallahir = date('d-m-Y', strtotime($trxPasien->mPasien->tgllahir));
                      $usia = date_diff(date_create($trxPasien->mPasien->tgllahir),date_create(\Carbon\Carbon::now()))->y;
                    @endphp
                    <label class="col-form-label" for="usia">Usia</label>
                    <input readonly class="form-control" name="usia" id="usia" maxlength="60" value="{{$usia}} Tahun">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label" for="poliklinik">Poliklinik</label>
                    <input readonly class="form-control" name="poliklinik" id="poliklinik" maxlength="60" value="Poliklinik {{$trxPasien->mPoli->poli_nama}}">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="kelastarif">Kelas Tarif</label>
                    <input readonly class="form-control" name="kelastarif" id="kelastarif" maxlength="60" value="Margin {{$trxPasien->kelastarif}}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-info card-outline">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3"><i class="fa fa-user-injured"></i> form Input Pemeriksaan Pasien</h3>
          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link {{ request()->query('tab') == 'tindakan' ? 'active' : '' }}" href="#tab_1" data-toggle="tab"><b>Tindakan</b></a></li>
            <li class="nav-item"><a class="nav-link {{ request()->query('tab') == 'anamnesa' ? 'active' : '' }}" href="#tab_2" data-toggle="tab"><b>Anamnesa</b></a></li>
            <li class="nav-item"><a class="nav-link {{ request()->query('tab') == 'diagnosa' ? 'active' : '' }}" href="#tab_3" data-toggle="tab"><b>Diagnosa</b></a></li>
            <li class="nav-item"><a class="nav-link {{ request()->query('tab') == 'keterangan' ? 'active' : '' }}" href="#tab_4" data-toggle="tab"><b>Keterangan</b></a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane {{ request()->query('tab') == 'tindakan' ? 'active' : '' }}" id="tab_1">
              @include('poliklinik.tindakan')
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane {{ request()->query('tab') == 'anamnesa' ? 'active' : '' }}" id="tab_2">
              @include('poliklinik.anamnesa')
            </div>

            <div class="tab-pane {{ request()->query('tab') == 'diagnosa' ? 'active' : '' }}" id="tab_3">
              @include('poliklinik.diagnosa')
            </div>

            <div class="tab-pane {{ request()->query('tab') == 'keterangan' ? 'active' : '' }}" id="tab_4">
              @include('poliklinik.keterangan')
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
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

  <script>
    $(document).ready(function() {
    $('#tindakan').on('change', function() {
        var kode_tindakan = $(this).val();
        console.log(kode_tindakan);
        if(kode_tindakan) {
            $.ajax({
                url:'/poliklinik/'+ kode_tindakan,
                type: 'GET',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataType:'json',
                success: function(data){
                    // console.log(data);
                    if(data){
      
                    var kelastarif = {{ $trxPasien->kelastarif }};
                    if(kelastarif === 1){
                      var margin = data[0].margin1;
                    }else if(kelastarif === 2){
                      var margin = data[0].margin2;
                    }else if(kelastarif === 3){
                      var margin = data[0].margin3;
                    }                       
                    
                    var hargajual = (data[0].tarifdasar * margin/100) + data[0].tarifdasar;
                    $('#tarif').val(hargajual);
                    }else{
                        $('#harga').empty();
                    }
                }
            });    
        }else{
            $('#harga').empty();
        }
    });
});
</script>
  {{-- Menampilkan Message menggunakan library Toastr --}}
  <script>
    $(function () {
      $("#datatable1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#datatable1_wrapper .col-md-6:eq(0)');
    });

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
    }
  </script>

  @if ($errors->any())
    <script>
      $(document).ready(function() {
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}', 'Kesalahan!',{timeOut:30000});
        @endforeach
      });
    </script>
  @endif 

  @if ($errors->any())
    <script>
      $(document).ready(function() {
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}', 'Kesalahan!',{timeOut:30000});
        @endforeach
      });
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