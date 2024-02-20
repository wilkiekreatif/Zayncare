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
        <div class="col-sm-12">
          <div class="card card-default">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                  </h3>
                  <div>
                    <a href="{{ route('kasir.pembayaranUmum')}}" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-left"> </i> Kembali</a>
                  </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-sm-8">
          <div class="card card-info card-outline">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3"><i class="fa fa-user-injured"></i> Rincian Transaksi</h3>
            </div><!-- /.card-header -->
           
          
            <div class="card-body">
              <table class="table table-hover table-sm">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Item</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($trxObatAlkesU as $ObatPasien)
                @php
                    $total = number_format($ObatPasien->total,0,',','.');
                    $tarif = number_format($ObatPasien->tarif,0,',','.');
                @endphp
                <form action="{{ route('kasir.simpanPembayaranUmum',$ObatPasien->trx_id) }}" method="post">
                  @csrf
                  <input hidden class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" maxlength="60" value="{{$ObatPasien->created_at}}">
                  <input hidden class="form-control" name="id_transaksi" id="trx_id" maxlength="60" value="{{$ObatPasien->trx_id}}">
                <input hidden class="form-control" name="total_transaksi" id="total_transaksi" maxlength="60" value="{{$ObatPasien->total}}">
                <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $ObatPasien->mObatalkes->obatalkes_nama }}</td>
                  <td>Rp. {{ $tarif }}</td>
                  <td>{{ $ObatPasien->qty }} {{$ObatPasien->mObatalkes->satuan}}</td>
                  <td>Rp. {{ $total }}</td>
                </tr>   
                @endforeach
              </tbody>
                <tr style="font-weight: bold ; font-size: 1rem">
                  <td colspan="2">Total</td><td></td><td></td>
                  <td>Rp. {{ $total }}</td>
                </tr>
              </table>
              <!-- /.tab-content -->
              <div class="text-left mt-2">
                <button type="submit" onclick="return confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> </i> SIMPAN</button>
                <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i> Cancel</button>
              </div>
            </div><!-- /.card-body -->
          </div>
        </div>
      </form>
        <div class="col-4">
          <div class="card card-info card-outline">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3"><i class="fa fa-user-injured"></i> Pembayaran Transaksi</h3>
            </div>
            <form action="">
            <div class="card-body">
              <div class="form-group">
                <label for="totalformat">Uang diterima</label>
                <input style="font-weight: bold;" name="total" id="total" type="hidden" class="form-control" value="{{$ObatPasien->total}}">
                <input readonly style="font-weight: bold;" name="totalformat" id="totalformat" type="number" class="form-control" value="{{$total}}">
              </div>
              <div class="form-group">
                <label for="uangDiterima">Uang diterima</label>
                <input name="uangDiterima" id="uangDiterima" type="number" class="form-control" placeholder="Silahkan isi...">
              </div>
              <div class="form-group">
                <label for="hasil">Kembalian</label>
                <input style="font-weight: bold;" type="number" name="kembalian" id="kembalian" class="form-control" readonly>
              </div>
            </div>
            {{-- <button onclick="pengurangan()" type="button" class="btn btn-success"> <i class="fas fa-save"> </i> lihat</button> --}}
          </form>
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
      }).buttons().container().appendTo('#datatable1_wrapper .col-sm-6:eq(0)');
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

  <script>
    $(document).ready(function() {
      $('#uangDiterima').on('input', function() {

        var uangditerima = parseFloat($(this).val());
        // if (uangditerima === null || uangditerima.trim() === '') {
        //   $('#kembalian').empty();
        // }else{
          var totalBayar = parseFloat($('#total').val());
          // console.log(totalBayar);
          var hasil         = uangditerima - totalBayar;
          
          if (!isNaN(uangditerima) && !isNaN(totalBayar)) {
            var hasil = uangditerima - totalBayar;
            console.log(hasil);
            $('#kembalian').val(hasil);
          } else {
            // Handle invalid input (e.g., display an error message)
            // console.log('Invalid input');
            $('#kembalian').val('');
          }
        // }
      });
    });
  </script>
@endsection