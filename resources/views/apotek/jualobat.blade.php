@extends('layout.admin')

@section('title','Penjualan Umum')

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
            <li class="breadcrumb-item">Apotek</li>
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
          {{-- kolom tombol selesai input --}}
          <div class="card card-default">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                    <a href="" onclick="return  confirm('Apakah anda yakin?')" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="bottom" title="klik tombol ini untuk menyimpan Transaksi Penjualan Umum"> <i class="fas fa-save"> </i> Kirim Data Pembelian ke Kasir</a>
                  </h3>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <label for="obatalkes">NO TRANSAKSI</label>
                  <input readonly id="trx_id" name="trx_id" type="text" class="form-control" style="background-color: cornsilk; font-size: xx-large" value="{{$trx_id}}">
                </div>
                <div class="col-md-8">
                  <label for="obatalkes">TOTAL PEMBELIAN</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp.</span>
                    </div>
                    {{-- <input type="text" class="form-control" > --}}
                    <input readonly type="text" class="form-control form-control-lg" style="background-color: rgb(195, 255, 200); font-size: xx-large"  value="{{ $totalharga }}">
                    <input id="totalbayar" name="totalbayar" type="hidden" class="form-control" style="background-color: springgreen">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center">
                      <h3 class="card-title">
                        <i class="fa fa-file-medical-alt"></i>
                        Resep Pasien
                      </h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="datatable1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="background-color: rgb(120, 186, 196)" width="2%">No</th>
                        <th style="background-color: rgb(120, 186, 196)">NAMA OBAT ALKES</th>
                        <th style="background-color: rgb(120, 186, 196)">QTY</th>
                        <th style="background-color: rgb(120, 186, 196)">STOK GUDANG</th>
                        <th style="background-color: rgb(120, 186, 196)">HARGA</th>
                        <th style="background-color: rgb(120, 186, 196)">TOTAL</th>
                        <th style="background-color: rgb(120, 186, 196)">ETIKET</th>
                        <th style="background-color: rgb(120, 186, 196)" width="2%">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($itemobats->isNotEmpty())
                        @foreach ($itemobats as $itemobat)
                          <tr
                            @if ($itemobat->mObatalkes->stok < $itemobat->qty)
                              style="background-color: rgb(253, 255, 150)" data-toggle="tooltip" data-placement="bottom" title="Stok gudang {{ strtoUpper($itemobat->mObatalkes->obatalkes_nama)}} tidak mencukupi permintaan resep"
                            @endif
                          >
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$itemobat->mObatalkes->obatalkes_nama}}</td>
                            <td><b>{{$itemobat->qty}}</b> {{$itemobat->mObatalkes->satuan}}</td>
                            <td><b>{{$itemobat->mObatalkes->stok}}</b> {{$itemobat->mObatalkes->satuan}}</td>
                            <td><b>Rp. {{$itemobat->tarif}}</b>/ {{$itemobat->mObatalkes->satuan}}</td>
                            <td><b>Rp. {{$itemobat->total}}</b></td>
                            <td>
                              <div style="width: 100%; float: left;">
                                <ul class="nav nav-pills flex-column">
                                  <li class="nav-item">
                                    @empty($itemobat->signa)
                                      -
                                    @else
                                      {{$itemobat->signa}}
                                    @endempty
                                  </li>
                                  <li class="nav-item">
                                    @empty($itemobat->etiket)
                                      -
                                    @else
                                      {{$itemobat->etiket}}
                                    @endempty
                                  </li>
                                </ul>
                              </div>
                            </td>
                            <td>
                              <form method="POST" action="{{ route('poliklinik.deleteobat', ['trx_id' => $trx_id, 'id' => $itemobat->id]) }}">
                                @method('PUT') <!-- Menambahkan metode spoofing untuk PUT -->
                                @csrf
                                  <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Batalkan Obat Alkes">
                                    <i class="fas fa-trash"></i> Batal
                                  </button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                    <tfoot>
                      <tr>
                        <th width="2%">No</th>
                        <th> NAMA OBAT ALKES</th>
                        <th> QTY</th>
                        <th>STOK GUDANG</th>
                        <th>HARGA</th>
                        <th>TOTAL</th>
                        <th> ETIKET</th>
                        <th width="2%">#</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card card-info card-outline">
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
                  <form action="{{ route('poliklinik.tambahobatalkes',$trx_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- <div class="form-group">
                      <input readonly id="idresep" name="idresep" type="text" class="form-control">
                    </div> --}}
                    <div class="form-group">
                      <label for="obatalkes">Obat Alkes <a style="color:red">*</a></label>
                      <div class="row">
                        <div class="col-sm-10">
                          <select id="obatalkes" name="obatalkes" class="form-control select2bs4 {{ $errors->has('obatalkes') ? 'is-invalid' : '' }}" style="width: 100%;">
                            <option disabled selected="selected">-- Pilih salah satu --</option>
                            @foreach ($obatalkess as $obatalkes)
                              @php
                                $margin = $obatalkes->margin1;
                                $harga = ($obatalkes->hargabeliterakhir*$margin/100)+$obatalkes->hargabeliterakhir;
                                $hargaformated = number_format($harga, 0, ',', '.');
                              @endphp
                              <option value="{{ $obatalkes->id }}" {{ $obatalkes->stok == 0 ? 'disabled' : '' }} {{ old('obatalkes') == $obatalkes->id ? 'selected' : '' }}>{{ $obatalkes->obatalkes_nama }} | {{ $obatalkes->stok }} {{ $obatalkes->satuan }} | Rp. {{ $hargaformated }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-2">
                          <input readonly id="tarif" name="tarif" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="qty">Qty <a style="color:red">*</a></label>
                      <input id="qty" name="qty" type="number" class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" placeholder="Nama Obat Alkes..." maxlength="3" value="{{old('qty')}}">
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="signa">Signa</label>
                          <input id="signa" name="signa" type="text" class="form-control {{ $errors->has('signa') ? 'is-invalid' : '' }}" placeholder="Signa..." maxlength="10" value="{{old('signa')}}">
                        </div>
                      </div>
                      <div class="col-sm-9">
                        <div class="form-group">
                          <label for="etiket">Etiket</label>
                          <input id="etiket" name="etiket" type="text" class="form-control {{ $errors->has('etiket') ? 'is-invalid' : '' }}" placeholder="etiket..." maxlength="60" value="{{old('etiket')}}">
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="klik tombol ini untuk menambahkan item obat ke Resep Pasien"> <i class="fas fa-plus"> </i></button>
                  <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i></button>
                </div>
                </form>
              </div>
              {{-- <div class="card card-default">
                <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center">
                      <h3 class="card-title">
                      </h3>
                  </div>
                </div>
              </div> --}}
              {{--  --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

{{-- JS --------------------------------------------------------------------------------------------------------------------- --}}
@section('js')
{{-- insert tarif di dropdown select onchange --}}
<script>
  $(document).ready(function() {
    $('#obatalkes').on('change',function() {
      var id_obat = $(this).val();
      // console.log(id_obat);
      if (id_obat) {
        $.ajax({
          url:'/poliklinik/' + id_obat,
          type: 'GET',
          data: {
            '_token': '{{ csrf_token() }}' //code 261 berasal dari ini
          },
          dataType: 'json',
          success: function(data){
            // console.log(data);
            if(data){
              // console.log('kelas tarif:'+kelastarif);
              // console.log('margin1:'+data[0].margin2); //pemanggilan data menggunakan [0] karena data adalah array layer 1
              var margin = data[0].margin1;
              // console.log('margin: '+margin);
              var hargajual = (data[0].hargabeliterakhir * margin/100) + data[0].hargabeliterakhir;
              // console.log('harga jual: '+hargajual);
              $('#tarif').val(hargajual) //menginputkan perhitungan harga jual ke input tarif
            }
          }
        })
      } else {
        
      }
    });
  });
</script>
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
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#datatable1_wrapper');
    });
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
  @if (Session::has('success'))
    <script>
      toastr.success("{{Session::get('success')}}","Success!");
      // toastr.info("{{Session::get('success')}}","Success!");
      // toastr.warning("{{Session::get('success')}}","Success!");
      // toastr.error("{{Session::get('success')}}","Success!");
    </script>
  @endif
@endsection