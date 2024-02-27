@extends('layout.admin')

@section('title','Dashboard')

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
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content text-sm">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$pxtoday}} <sup style="font-size: 20px">Pasien</sup></h3>
                <p>Pasien hari ini</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-injured"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$trxtoday}} <sup style="font-size: 20px">Resep</sup></h3>
                <p>Resep hari ini</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$trxumumtoday}} <sup style="font-size: 20px">Transaksi</sup></h3>
                <p>Pembelian hari ini</p>
              </div>
              <div class="icon">
                <i class="fas fa-cash-register"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><sup style="font-size: 20px">Rp. </sup>{{$omsettoday}}</h3>
                <p>Omset hari ini</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill-wave-alt"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                      <i class="fa fa-pills"></i>
                      Pasien hari ini
                    </h3>
                </div>
              </div>
              <div class="card-body">
                <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">ID TRX</th>
                  <th style="background-color: rgb(120, 186, 196)">DATA PASIEN</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">STATUS</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($trxPasiens as $trxPasien)
                  <tr>
                    {{-- <td>{{$no}}</td> --}}
                    <td>
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                          No Trx: <b>{{$trxPasien->trx_id}}</b>
                        </li>
                        <li class="nav-item">
                          No RM: <b>{{$trxPasien->mPasien->no_rm}}</b>
                        </li>
                        <li class="nav-item">
                          @if ($trxPasien->kelastarif == 1)
                              kelas tarif: <b>1</b>
                          @elseif ($trxPasien->kelastarif == 2)
                              kelas tarif: <b>2</b>
                          @elseif ($trxPasien->kelastarif == 3)
                              kelas tarif: <b>3</b>
                          @endif
                        </li>
                    </td>
                    <td>
                      <div style="width: 40%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                            {{ $trxPasien->mPasien->label }}. @if ($trxPasien->mPasien->gelardepan!= null)
                                {{$trxPasien->mPasien->gelardepan}}.
                            @endif<b>{{ $trxPasien->mPasien->pasien_nama }}</b> @if ($trxPasien->mPasien->gelarbelakang!=null)
                                ,{{$trxPasien->mPasien->gelarbelakang }}
                            @endif
                          </li>
                          <li class="nav-item">
                            @php
                              $tanggallahir = date('d-m-Y', strtotime($trxPasien->mPasien->tgllahir));
                              $usia = date_diff(date_create($trxPasien->mPasien->tgllahir),date_create(\Carbon\Carbon::now()))->y;
                            @endphp
                              {{$tanggallahir}}
                          </li>
                          <li class="nav-item">
                            <b>{{$usia}}</b>  Tahun
                          </li>
                          <li class="nav-item">
                            {{ $trxPasien->mPasien->jeniskelamin==0 ? 'Laki-laki' : 'Perempuan'}}
                          </li>
                        </ul>
                      </div>
                      <div style="width: 60%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              <i class="fa fa-home"> </i> {{$trxPasien->mPasien->alamat}}, Desa {{$trxPasien->mPasien->desa}} Kec. {{$trxPasien->mPasien->kecamatan}} {{$trxPasien->mPasien->kota}}
                          </li>
                          <li class="nav-item"><b>
                            @if ($trxPasien->mPasien->pendidikan==0)
                                Dibawah SD
                            @elseif ($trxPasien->mPasien->pendidikan==1)
                                SD Sederajat
                            @elseif ($trxPasien->mPasien->pendidikan==2)
                                SMP Sederajat
                            @elseif ($trxPasien->mPasien->pendidikan==3)
                                SMA Sederajat
                            @elseif ($trxPasien->mPasien->pendidikan==4)
                                D-III Sederajat
                            @elseif ($trxPasien->mPasien->pendidikan==5)
                                S-I Sederajat
                            @elseif ($trxPasien->mPasien->pendidikan==6)
                                S-II Sederajat
                            @elseif ($trxPasien->mPasien->pendidikan==7)
                                S-III Sederajat
                            @elseif ($trxPasien->mPasien->pendidikan==8)
                                Diatas S-III
                            @endif</b>
                          </li>
                          <li class="nav-item">
                              <i class="fa fa-user"> </i> @if ($trxPasien->mPasien->agama == 0)
                                                            Islam
                                                          @elseif ($trxPasien->mPasien->agama == 1)
                                                            Katolik
                                                          @elseif ($trxPasien->mPasien->agama == 2)
                                                            Protestan
                                                          @elseif ($trxPasien->mPasien->agama == 3)
                                                            Hindu
                                                          @elseif ($trxPasien->mPasien->agama == 4)
                                                            Buddha
                                                          @elseif ($trxPasien->mPasien->agama == 5)
                                                            Lainnya
                                                          @endif
                          </li>
                          <li class="nav-item">
                              <i class="fa fa-phone"> </i> <a href="https://api.whatsapp.com/send/?phone={{$trxPasien->mPasien->no_telp}}" target="blank" data-toggle="tooltip" data-placement="bottom" title="klik untuk CHAT WHATSAPP dengan no ini"> {{$trxPasien->mPasien->no_telp}}</a> 
                          </li>
                        </ul>
                      </div>
                    </td>
                    <td>
                      @if ($trxPasien->status == 99)
                        <h5><span class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="Pasien batal periksa">Batal Periksa</span></h5>
                      @elseif ($trxPasien->status == 1)
                        <h5><span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="Anda hanya perlu menginput tindakan dan anamnesa dan status pasien otomatis berubah menjadi: SEDANG PERIKSA">Antrian</span></h5>
                      @elseif ($trxPasien->status == 2)
                        <h5><span class="badge badge-secondary" data-toggle="tooltip" data-placement="bottom" title="Anda hanya perlu menginput resep dan status pasien otomatis berubah menjadi: SUDAH PERIKSA">Sedang Periksa</span></h5>
                      @elseif ($trxPasien->status == 3)
                        <h5><span class="badge badge-primary" data-toggle="tooltip" data-placement="bottom" title="Anda hanya perlu mengarahkan pasien untuk ke kasir dan apabila pasien telah berhasil melakukan pembayaran maka status pasien otomatis berubah menjadi: SUDAH BAYAR">Sudah Periksa</span></h5>
                      @elseif ($trxPasien->status == 4)
                        <h5><span class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="KASIR hanya perlu klik tombol PULANGKAN di kolom ACTION apabila pasien tidak ada resep, namun apabila ada resep silahkan anda arahkan pasien tersebut ke apotek untuk dilakukan transaksi penyerahan resep.">Sudah Bayar</span></h5>
                      @elseif ($trxPasien->status == 5)
                        <h5><span class="badge badge-info">Sudah Pulang</span></h5>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>ID TRX</th>
                  <th>DATA PASIEN</th>
                  <th>STATUS</th>
                </tr>
              </tfoot>
            </table>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-12">
            <div class="card card-success card-outline">
              <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                      <i class="fa fa-pills"></i>
                      Item Fast Moving
                    </h3>
                </div>
              </div>
              <div class="card-body">
                <table id="datatable1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="background-color: rgb(120, 186, 196)" width="2%">NO</th>
                      <th style="background-color: rgb(120, 186, 196)">DATA OBAT/ALKES</th>
                      <th style="background-color: rgb(120, 186, 196)" width="20%"> QTY TRX</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tfooter>
                    <tr>
                      <th>NO</th>
                      <th>DATA OBAT/ALKES</th>
                      <th> QTY TRX</th>
                    </tr>
                  </tfooter>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-12">
            <div class="card card-warning card-outline">
              <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                      <i class="fa fa-pills"></i>
                      Item Slow Moving
                    </h3>
                </div>
              </div>
              <div class="card-body">
                <table id="datatable1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="background-color: rgb(120, 186, 196)" width="2%">NO</th>
                      <th style="background-color: rgb(120, 186, 196)">DATA OBAT/ALKES</th>
                      <th style="background-color: rgb(120, 186, 196)" width="20%"> QTY TRX</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tfooter>
                    <tr>
                      <th>NO</th>
                      <th>DATA OBAT/ALKES</th>
                      <th> QTY TRX</th>
                    </tr>
                  </tfooter>
                </table>
              </div>
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
  <script>
    $(function () {
      $("#datatable1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#datatable1_wrapper .col-md-6:eq(0)');
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