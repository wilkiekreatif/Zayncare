@extends('layout.admin')

@section('title','Resep Pasien Poliklinik')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<meta http-equiv="refresh" content="60">
@endsection

@section('konten')
  <div class="progress" style="height: 2px;">
    <div id="timerprogress" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
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
              {{-- <h3>{{$totalData = $trxReseps::whereDate('created_at',date('d'))->count(); }} <sup style="font-size: 20px">Resep</sup></h3> --}}
              <p>Resep hari ini</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-injured"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              {{-- <h3>{{$totalData = $trxPasiens->where('poli_id','1')->count();}} <sup style="font-size: 20px">Resep</sup></h3> --}}
              <p>Resep bulan ini</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-injured"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              {{-- <h3>{{$totalData = $trxPasiens->where('poli_id','2')->count();}} <sup style="font-size: 20px">Transaksi</sup></h3> --}}
              <p>Pembelian Umum</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-injured"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              {{-- <h3>{{$totalData = $trxPasiens->where('poli_id','3')->count();}} <sup style="font-size: 20px">Resep</sup></h3> --}}
              <p>Total Resep Hari ini</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-injured"></i>
            </div>
          </div>
        </div>
      </div>
      {{-- table pasien poli --}}
      <div class="card card-default">
          <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                    <i class="fa fa-layer-group"></i>
                    Tabel @yield('title')
                  </h3>
              </div>
          </div>
          <div class="card-body">
            <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">No</th>
                  <th style="background-color: rgb(120, 186, 196)" width="15%">ID PASIEN</th>
                  <th style="background-color: rgb(120, 186, 196)" width="50%">NAMA PASIEN</th>
                  <th style="background-color: rgb(120, 186, 196)" width="20%">POLIKLINIK</th>
                  <th style="background-color: rgb(120, 186, 196)" width="10%">ALERGI</th>
                  <th style="background-color: rgb(120, 186, 196)" >STATUS</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                @foreach ($trxReseps as $trxResep)
                  <tr>
                    <td>{{ $no}}</td>
                    <td>
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                          No Trx: <b>{{$trxResep->trx_id}}</b>
                        </li>
                        <li class="nav-item">
                          No RM: <b>{{$trxResep->no_rm}}</b>
                        </li>
                        <li class="nav-item">
                          @if ($trxResep->kelastarif == 1)
                              kelas tarif: <b>1</b>
                          @elseif ($trxResep->kelastarif == 2)
                              kelas tarif: <b>2</b>
                          @elseif ($trxResep->kelastarif == 3)
                              kelas tarif: <b>3</b>
                          @endif
                        </li>
                    </td>
                    <td>
                      <div style="width: 40%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                            {{ $trxResep->label }}. @if ($trxResep->gelardepan!= null)
                                {{$trxResep->gelardepan}}.
                            @endif<b>{{ $trxResep->pasien_nama }}</b> @if ($trxResep->gelarbelakang!=null)
                                ,{{$trxResep->gelarbelakang }}
                            @endif
                          </li>
                          <li class="nav-item">
                            @php
                              $tanggallahir = date('d-m-Y', strtotime($trxResep->tgllahir));
                              $usia = date_diff(date_create($trxResep->tgllahir),date_create(\Carbon\Carbon::now()))->y;
                            @endphp
                              {{$tanggallahir}}
                          </li>
                          <li class="nav-item">
                            <b>{{$usia}}</b>  Tahun
                          </li>
                          <li class="nav-item">
                            {{ $trxResep->jeniskelamin==0 ? 'Laki-laki' : 'Perempuan'}}
                          </li>
                        </ul>
                      </div>
                      <div style="width: 60%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              <i class="fa fa-home"> </i> {{$trxResep->alamat}}, Desa {{$trxResep->desa}} Kec. {{$trxResep->kecamatan}} {{$trxResep->kota}}
                          </li>
                          <li class="nav-item"><b>
                            @if ($trxResep->pendidikan==0)
                                Dibawah SD
                            @elseif ($trxResep->pendidikan==1)
                                SD Sederajat
                            @elseif ($trxResep->pendidikan==2)
                                SMP Sederajat
                            @elseif ($trxResep->pendidikan==3)
                                SMA Sederajat
                            @elseif ($trxResep->pendidikan==4)
                                D-III Sederajat
                            @elseif ($trxResep->pendidikan==5)
                                S-I Sederajat
                            @elseif ($trxResep->pendidikan==6)
                                S-II Sederajat
                            @elseif ($trxResep->pendidikan==7)
                                S-III Sederajat
                            @elseif ($trxResep->pendidikan==8)
                                Diatas S-III
                            @endif</b>
                          </li>
                          <li class="nav-item">
                              <i class="fa fa-user"> </i> @if ($trxResep->agama == 0)
                                                            Islam
                                                          @elseif ($trxResep->agama == 1)
                                                            Katolik
                                                          @elseif ($trxResep->agama == 2)
                                                            Protestan
                                                          @elseif ($trxResep->agama == 3)
                                                            Hindu
                                                          @elseif ($trxResep->agama == 4)
                                                            Buddha
                                                          @elseif ($trxResep->agama == 5)
                                                            Lainnya
                                                          @endif
                          </li>
                          <li class="nav-item">
                              <i class="fa fa-phone"> </i> <a href="https://api.whatsapp.com/send/?phone={{$trxResep->no_telp}}" target="blank" data-toggle="tooltip" data-placement="bottom" title="klik untuk CHAT WHATSAPP dengan no ini"> {{$trxResep->no_telp}}</a> 
                          </li>
                        </ul>
                      </div>
                    </td>
                    <td>
                      <div style="width: 100%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                            Poliklinik <b>{{$trxResep->poli_nama}}</b>
                          </li>
                          <li class="nav-item">
                            #Nama dokter pemeriksa
                          </li>
                        </ul>
                      </div>
                    </td>
                    @if ($trxResep->alergi != null)
                      <td style="background-color: rgb(255, 161, 161)"><h6>{{ $trxResep->alergi}}</h6></td>
                    @else
                      <td>-</td>
                    @endif
                    <td>
                      @if ($trxResep->statusResep == 0)
                        <h5><span class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="Resep belum verifikasi">Belum Verifikasi</span></h5>
                      @elseif ($trxResep->statusResep == 1)
                        <h5><span class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="Resep pasien ini sudah dibayar">Sudah Bayar</span></h5>
                      @elseif ($trxResep->statusResep == 2)
                        <h5><span class="badge badge-info" data-toggle="tooltip" data-placement="bottom" title="Resep pasien ini sudah diverifikasi dan tinggal dibayar k kasir">Sudah Verifikasi</span></h5>
                      @endif
                    </td>
                    <td>
                      <div class="btn-group" style="width: 100%">
                        <a href="{{route('apotek.verifresep',$trxResep->trx_id)}}" type="button" class="btn btn-sm btn-success {{ $trxResep->statusResep == '1' ? 'disabled' : ''}} {{ $trxResep->statusResep == '2' ? 'disabled' : ''}}" data-toggle="tooltip" data-placement="bottom" title="Verifikasi Resep Pasien"><i class="fas fa-pills"></i> Verifikasi</a>
                      </div>
                    </td>
                  </tr>
                  <?php $no++ ?>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>ID PASIEN</th>
                  <th>NAMA PASIEN</th>
                  <th>POLIKLINIK</th>
                  <th>ALERGI</th>
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
    function startTimer(seconds) {
        const timer = document.getElementById('timerprogress');
        // const startButton = document.getElementById('startButton');
        
        // startButton.disabled = true; // Matikan tombol saat timer berjalan
        
        timer.style.width = '0%';
        let currentTime = 0;
        
        const interval = setInterval(function() {
            if (currentTime >= seconds) {
                clearInterval(interval);
                startButton.disabled = false; // Aktifkan tombol setelah timer selesai
            } else {
                currentTime++;
                const percentage = (currentTime / seconds) * 100;
                timer.style.width = percentage + '%';
                timer.setAttribute('aria-valuenow', currentTime);
            }
        }, 990);
    }

    // Jalankan fungsi startTimer secara otomatis saat halaman dibuka
    window.onload = function() {
        startTimer(60);
    };
  </script>
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
  @if (Session::has('success'))
    <script>
      toastr.success("{{Session::get('success')}}","Success!");
      // toastr.info("{{Session::get('success')}}","Success!");
      // toastr.warning("{{Session::get('success')}}","Success!");
      // toastr.error("{{Session::get('success')}}","Success!");
    </script>
  @endif
@endsection