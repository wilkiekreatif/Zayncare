@extends('layout.admin')

@section('title','Defekta')

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
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
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
      <div class="card card-default">
          <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                    <i class="fa fa-layer-group"></i>
                    Tabel @yield('title')
                  </h3>
                  <div>
                    <a href="{{ route('obatalkes.defektabaru') }}" class="btn btn-success btn-sm"> <i class="fas fa-upload"> </i> Tambah @yield('title') Baru</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
            <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="background-color: rgb(120, 186, 196)" width="1%">No</th>
                  <th style="background-color: rgb(120, 186, 196)">ID TRANSAKSI</th>
                  <th style="background-color: rgb(120, 186, 196)"> DATA OBAT/ALKES</th>
                  <th style="background-color: rgb(120, 186, 196)" width="15%">HARGA BELI</th>
                  <th style="background-color: rgb(120, 186, 196)" width="15%">QTY</th>
                  <th style="background-color: rgb(120, 186, 196)" width="15%">TOTAL HARGA</th>
                  <th style="background-color: rgb(120, 186, 196)" width="15%">DATA FAKTUR</th>
                  <th style="background-color: rgb(120, 186, 196)" width="15%">TANGGAL</th>
                  <th style="background-color: rgb(120, 186, 196)"width="2%">STATUS</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                @if ($defektas->isNotEmpty())
                  @foreach ($defektas as $defekta)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $defekta->trx_id }}</td>
                      <td>
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item"><b>{{ $defekta->obatalkes->obatalkes_nama }}</b></li>
                          <li class="nav-item">{{ $defekta->supplier->supplier_nama }}</li>
                      </td>
                      <td>
                        <ul class="nav nav-pills flex-column">
                          @php
                            $hargabeliformatted     = number_format($defekta->hargabeli, 0, ',', '.');
                            $setelahfakturformatted = number_format($defekta->hargabelisetelahfaktur, 0, ',', '.');
                            $qtyformatted = number_format($defekta->qty, 0, ',', '.');
                          @endphp
                          <li class="nav-item">Sebelum faktur: Rp.<b>{{ $hargabeliformatted}}</b></li>
                          <li class="nav-item">Setelah faktur: Rp.<b>{{ $setelahfakturformatted > 0 ? $setelahfakturformatted : '-'}}</li>
                        </ul>
                      </td>
                      <td>
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">Sebelum faktur: <b>{{ $qtyformatted }}</b> {{ $defekta->obatalkes->satuan }}</li>
                          <li class="nav-item">Setelah faktur: <b>{{ $defekta->qtysetelahfaktur }}</b> {{ $defekta->obatalkes->satuan }}</li>
                        </ul>
                      </td>
                      <td>
                        <ul class="nav nav-pills flex-column">
                          @php
                            $sebelumfaktur = number_format($defekta->totalbayar, 0, ',', '.');
                            $setelahfaktur = number_format($defekta->totalbayarsetelahfaktur, 0, ',', '.');
                          @endphp
                          <li class="nav-item">Sebelum faktur: Rp.<b>{{ $sebelumfaktur ?? '-'}}</b></li>
                          <li class="nav-item">Setelah faktur: Rp.<b>{{ $setelahfaktur ?? '-'}}</b></li>
                        </ul>
                      </td>
                      <td>
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">No Faktur: <b>{{ $defekta->nofaktur ?? '-' }}</b></li>
                          <li class="nav-item">Diskon: Rp.<b>{{ $defekta->diskon ?? '-' }}</b></li>
                          <li class="nav-item">Ppn: Rp.<b>{{ $defekta->ppn ?? '-' }}</li>
                        </ul>
                      </td>
                      <td>
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">Defekta: <b>{{ \Carbon\Carbon::parse($defekta->created_at)->format('d-m-Y | h:m:s') }}</b></li>
                          <li class="nav-item">Verifikasi: <b>{{ \Carbon\Carbon::parse($defekta->updated_at)->format('d-m-Y | h:m:s') }}</b></li>
                        </ul>
                      </td>
                      <td>
                        @if ($defekta->is_active == 0)
                          <h5><span class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="Defekta batal">Batal Defekta</span></h5>
                        @elseif ($defekta->is_active == 1)
                          <h5><span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="Menunggu PBF">Menunggu PBF</span></h5>
                        @elseif ($defekta->is_active== 2)
                          <h5><span class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="Defekta selesai">Selesai Defekta</span></h5>
                        @elseif ($defekta->is_active== 99)
                          <h5><span class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="Defekta selesai">HAPUS</span></h5>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group" style="width: 100%">
                          @if ($defekta->is_active==1)
                            <a type="button" data-toggle="modal" data-target="#Modal-{{$defekta->id}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Approve Defekta"><i class="fas fa-check"></i> Approve</a>
                            {{-- modal daftar poliklinik --}}
                            <div class="modal fade" id="Modal-{{$defekta->id}}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="modal">Approval Defekta <b>{{$defekta->trx_id}}</b></h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <form action="{{ route('verifikasidefekta', $defekta->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                          <input type="hidden" class="form-control" name="obatalkes_id"  id="obatalkes_id" value="{{$defekta->obatalkes_id}}">
                                          <div class="form-group">
                                            <label for="nofaktur">No. Faktur <a style="color:red">*</a></label>
                                            <input required type="text" class="form-control" name="nofaktur" id="nofaktur" placeholder="Silahkan isi...">
                                          </div>
                                          <div class="form-group">
                                            <label for="qtysetelahfaktur">Qty sesuai faktur <a style="color:red">*</a></label>
                                            <input required type="number" class="form-control" id="qtysetelahfaktur" name="qtysetelahfaktur" placeholder="Silahkan isi...">
                                          </div>
                                            <div class="form-group">
                                              <label for="hargasetelahfaktur">Harga sesuai faktur <a style="color:red">*</a></label>
                                              <input required type="number" class="form-control" id="hargasetelahfaktur" name="hargasetelahfaktur" placeholder="Silahkan isi...">
                                              <div class="form-check" style="padding-top:1%;padding-left:7%">
                                                <input type="checkbox" class="form-check-input" id="updatetarif" name="updatetarif">
                                                <label class="form-check-label" for="updatetarif">Ceklis jika harga dasar obat/alkes berubah. </label>
                                              </div>
                                            </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="diskon">Diskon (Rp.)</label>
                                                <input type="number" class="form-control" id="diskon" name="diskon" placeholder="Silahkan isi...">
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="ppn">Ppn (Rp.)</label>
                                                <input type="number" class="form-control" id="ppn" name="ppn" placeholder="Silahkan isi...">
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class='btn btn-sm btn-primary' onclick="return confirm('Apakah anda yakin? Stok '.{{strtoupper($defekta->obatalkes->obatalkes_nama)}}.' di gudang akan bertambah setelah disimpan.')"> <i class="fa fa-check"> </i>  APPROVE</button>
                                          <button type="reset" class="btn btn-sm btn-danger"> <i class="fas fa-undo-alt"> </i>  RESET</button>
                                        </div>
                                      </form>
                                  </div>
                              </div>
                            </div>
                            <a href="{{route('bataldefekta',$defekta->id)}}" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Batalkan Defekta" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-times"></i> Batal</a>
                          @elseif ($defekta->is_active==0)
                            <a href="{{route('aktifkandefekta',$defekta->id)}}" type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Aktifkan kembali Defekta" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-check"></i> aktifkan</a>
                            <a href="{{route('hapusdefekta',$defekta->id)}}" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus data defekta" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash"></i> Hapus</a>
                          @elseif ($defekta->is_active==2)
                            <a href="#" type="button" class="btn btn-sm btn-primary toastrDefaultError" data-toggle="tooltip" data-placement="bottom" title="Cetak Defekta"><i class="fas fa-print"></i> Laporan</a>
                            {{-- <a href="{{route('hapusdefekta',$defekta->id)}}" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus data defekta" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash"></i> Hapus</a> --}}
                          @endif
                      </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>ID TRANSAKSI</th>
                  <th>DATA OBAT/ALKES</th>
                  <th>HARGA BELI</th>
                  <th >QTY</th>
                  <th >TOTAL HARGA</th>
                  <th >DATA FAKTUR</th>
                  <th >TANGGAL</th>
                  <th>STATUS</th>
                  <th>ACTION</th>
                </tr>
              </tfoot>
            </table>
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