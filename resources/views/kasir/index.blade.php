@extends('layout.admin')

@section('title','Pembayaran Pasien Poliklinik')

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
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalData = $trxPasiens->where('status', '!=', ['99','4','5'])->count(); }} <sup style="font-size: 20px">Pasien</sup></h3>
              <p>Pasien hari ini</p>
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
              <h3>{{$totalData = $trxPasiens->where('status','4')->count();}} <sup style="font-size: 20px">Pasien</sup></h3>
              <p>Pasien Sudah Bayar</p>
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
              <h3>{{$totalData = $trxPasiens->where('status','1')->count();}} <sup style="font-size: 20px">Pasien</sup></h3>
              <p>Pasien Belum Bayar</p>
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
              <h3><sup style="font-size: 20px">Rp. </sup>{{$totalData = $trxPasiens->where('status','1')->count();}}</h3>
              <p>Omset hari ini</p>
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
                @foreach ($trxPasiens as $trxPasien)
                  <tr>
                    <td>{{$no}}</td>
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
                      <div style="width: 100%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                            Poliklinik <b>{{$trxPasien->mPoli->poli_nama}}</b>
                          </li>
                          <li class="nav-item">
                            #Nama dokter pemeriksa
                          </li>
                        </ul>
                      </div>
                    </td>
                    @if ($trxPasien->mPasien->alergi != null)
                      <td style="background-color: rgb(255, 161, 161)"><h6>{{ $trxPasien->mPasien->alergi}}</h6></td>
                    @else
                      <td>-</td>
                    @endif
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
                    <td>
                      <div class="btn-group" style="width: 100%;">
                        <a href="{{ route('kasir.prosesBayar',$trxPasien->trx_id) }}" type="button" class="btn btn-sm btn-success {{ $trxPasien->status == '99' ? 'disabled' : ''}} {{ $trxPasien->status == '5' ? 'disabled' : ''}}  {{ $trxPasien->status == '4' ? 'disabled' : ''}}" data-toggle="tooltip" data-placement="bottom" title="Klik untuk pembayaran"><i class="fas fa-money-bill-wave"> </i><br>Bayar</a>
                        <a onclick="tracer()" type="button" class="btn btn-sm btn-warning toastrDefaultError {{ $trxPasien->status == '99' ? 'disabled' : ''}} {{ $trxPasien->status == '5' ? 'disabled' : ''}} {{ $trxPasien->status == '3' ? 'disabled' : ''}}" data-toggle="tooltip" data-placement="bottom" title="Print rincian pasien"><i class="fas fa-print"></i> Rincian</a>
                        <a onclick="print()" type="button" class="btn btn-sm btn-primary toastrDefaultError {{ $trxPasien->status <> '4' ? 'disabled' : ''}}" data-toggle="tooltip" data-placement="bottom" title="Print kwitansi pembayaran"><i class="fas fa-print"></i> Kwitansi</a>
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

@if (!$trxPasiens->isEmpty())
  <script>
    function print(){
      var url = "{{route('kasir.printKwitansi', $trxPasien->trx_id)}}";
      window.open(url, '_blank');
    }
    
    function tracer(){
      var url = "{{route('tracer', $trxPasien->trx_id)}}";
      window.open(url, '_blank');
    }
  </script>
@endif
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