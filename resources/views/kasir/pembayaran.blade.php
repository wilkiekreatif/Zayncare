@extends('layout.admin')

@section('title','Proses Pembayaran')

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
            <li class="breadcrumb-item">Kasir</li>
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
                    <a href="{{ route('kasir.index')}}" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-left"> </i> Kembali</a>
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
            <form action="{{ route('kasir.simpanBayar',$trxPasien->trx_id) }}" method="post">
              @csrf
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

      <div class="row">
        <div class="col-md-12">
          <div class="card card-info card-outline">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3"><i class="fa fa-user-injured"></i> Rincian Tagihan Pasien</h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <table class="table table-hover table-sm">
                <thead>
                <tr>
                  <th>No</th>
                  {{-- <th>Tanggal</th> --}}
                  <th>Tindakan</th>
                  <th>Tarif</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($trxTindakans as $tindakan)
                <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $tindakan->mTindakan->tindakan_nama }}</td>
                  <td>{{ $tindakan->tarif }}</td>
                  <td>{{ $tindakan->qty }}</td>
                  <td>{{ $tindakan->total }}</td>
                </tr>   
                @endforeach
              </tbody>
                <tr style="font-weight: bold ; font-size: 1rem">
                  <td colspan="4">Total</td>
                  <td>Rp. {{ $totalTindakan }}</td>
                </tr>
                <input style="border: none; font-weight: bold" type="number" name="totalTindakan" value="{{ $totalTindakan }}" hidden>
              <thead>
                <tr>
                  <th>No</th>
                  {{-- <th>Tanggal</th> --}}
                  <th>Obat dan Alkes</th>
                  <th>Tarif</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($trxObatAlkes as $tObatAlkes)
                <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $tObatAlkes->mObatAlkes->obatalkes_nama }}</td>
                  <td>{{ $tObatAlkes->tarif }}</td>
                  <td>{{ $tObatAlkes->qty }}</td>
                  <td>{{ $tObatAlkes->total }}</td>
                </tr>   
                @endforeach
              </tbody>
              <tfoot>
                <tr style="font-weight: bold ; font-size: 1rem">
                  <td colspan="4">Total</td>
                  <td name='totalObatAlkes'>{{ $totalObatAlkes }}</td>
                </tr>
                <input style="border: none; font-weight: bold" type="number" name="totalObatAlkes" value="{{ $totalObatAlkes }}" hidden>
                <hr>
                <tr style="font-weight: bold ; font-size: 1rem">
                  <td colspan="4">Total Pembayaran</td>
                  <td name='totalPembayaran'>Rp. {{ $totalBayar }}</td>
                  <input style="border: none; font-weight: bold" type="number" name="totalPembayaran" value="{{ $totalBayar }}" hidden>
                </tr>
              </tfoot>





              </table>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          

          </div>
          <div class="text-left">
            <button type="submit" onclick="return confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> </i> SIMPAN</button>
            <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i> Cancel</button>
          </div>
        </div>
      </div>
    </form>
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
      "positionClass": "toast-top-right",
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
      // toastr.error("{{Session::get('error')}}","Error!",{timeOut:10000});
    </script>
  @endif
@endsection