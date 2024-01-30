@extends('layout.admin')

@section('title','Master Pasien')

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
      <div class="card card-default">
          <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title">
                    <i class="fa fa-layer-group"></i>
                    Tabel @yield('title')
                  </h3>
                  <div>
                    <a href="{{ route('register.registered') }}" class="btn btn-info btn-sm"> <i class="fas fa-arrow-right"> </i> Pasien Terdaftar</a>
                    <a href="{{ route('register.create') }}" class="btn btn-success btn-sm"> <i class="fas fa-upload"> </i> Tambah @yield('title') Baru</a>
                  </div>
              </div>
          </div>
          <div class="card-body">
            <table id="datatable1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">No</th>
                  <th style="background-color: rgb(120, 186, 196)" width="2%">NO RM</th>
                  <th style="background-color: rgb(120, 186, 196)" width="25%">NAMA PASIEN</th>
                  <th style="background-color: rgb(120, 186, 196)" >KETERANGAN PASIEN</th>
                  
                  <th style="background-color: rgb(120, 186, 196)" width="2%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                @foreach ($mPasiens as $mPasien)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $mPasien->no_rm }}</td>
                    <td>
                      <div style="width: 70%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                            {{ $mPasien->label }}. @if ($mPasien->gelardepan!= null)
                                {{$mPasien->gelardepan}}.
                            @endif<b>{{ $mPasien->pasien_nama }}</b> @if ($mPasien->gelarbelakang!=null)
                                ,{{$mPasien->gelarbelakang }}
                            @endif
                          </li>
                          <li class="nav-item">
                            @php
                              $tanggallahir = date('d-m-Y', strtotime($mPasien->tgllahir));
                              $usia = date_diff(date_create($mPasien->tgllahir),date_create(\Carbon\Carbon::now()))->y;
                            @endphp
                              {{$tanggallahir}}
                          </li>
                          <li class="nav-item">
                            <b>{{$usia}}</b>  Tahun
                          </li>
                        </ul>
                      </div>
                      <div style="width: 30%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                            {{ $mPasien->jeniskelamin==0 ? 'Laki-laki' : 'Perempuan'}}
                          </li>
                          <li class="nav-item"><b>
                            @if ($mPasien->pendidikan==0)
                                Dibawah SD
                            @elseif ($mPasien->pendidikan==1)
                                SD Sederajat
                            @elseif ($mPasien->pendidikan==2)
                                SMP Sederajat
                            @elseif ($mPasien->pendidikan==3)
                                SMA Sederajat
                            @elseif ($mPasien->pendidikan==4)
                                D-III Sederajat
                            @elseif ($mPasien->pendidikan==5)
                                S-I Sederajat
                            @elseif ($mPasien->pendidikan==6)
                                S-II Sederajat
                            @elseif ($mPasien->pendidikan==7)
                                S-III Sederajat
                            @elseif ($mPasien->pendidikan==8)
                                Diatas S-III
                            @endif</b>
                          </li>
                          <li></li>
                        </ul>
                      </div>
                    </td>
                    <td>
                      <div style="width: 70%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              <i class="fa fa-home"> </i> {{$mPasien->alamat}}, Desa {{$mPasien->desa}} Kec. {{$mPasien->kecamatan}} {{$mPasien->kota}}
                          </li>
                          <li class="nav-item">
                              <i class="fa fa-user"> </i> @if ($mPasien->agama == 0)
                                                            Islam
                                                          @elseif ($mPasien->agama == 1)
                                                            Katolik
                                                          @elseif ($mPasien->agama == 2)
                                                            Protestan
                                                          @elseif ($mPasien->agama == 3)
                                                            Hindu
                                                          @elseif ($mPasien->agama == 4)
                                                            Buddha
                                                          @elseif ($mPasien->agama == 5)
                                                            Lainnya
                                                          @endif
                          </li>
                          <li class="nav-item">
                              <i class="fa fa-phone"> </i> <a href="https://api.whatsapp.com/send/?phone={{$mPasien->no_telp}}" target="blank" data-toggle="tooltip" data-placement="bottom" title="klik untuk CHAT WHATSAPP dengan no ini"> {{$mPasien->no_telp}}</a> 
                          </li>
                        </ul>
                      </div>
                      <div style="width: 30%; float: left;">
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                              <i class="fa fa-ambulance"> </i> JAMINAN 1: <b>{{$mPasien->asuransi1}}</b>
                          </li>
                          <li class="nav-item">
                              <i class="fa fa-ambulance"> </i> JAMINAN 2: <b>{{ $mPasien->asuransi2 == null ? '-' : $mPasien->asuransi2 }}</b>
                          </li>
                          <li class="nav-item">
                              <i class="fa fa-ambulance"> </i> JAMINAN 3: <b>{{ $mPasien->asuransi3 == null ? '-' : $mPasien->asuransi3 }}</b>
                          </li>
                          
                        </ul>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group" style="width: 100%">
                        <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#Modal-{{$mPasien->id}}" data-toggle="tooltip" data-placement="bottom" title="Daftarkan ke poliklinik"><i class="fas fa-check"></i> Daftar</a>
                        {{-- modal daftar poliklinik --}}
                        <div class="modal fade" id="Modal-{{$mPasien->id}}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="modal">PENDAFTARAN POLIKLINIK</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <form action="{{route('register.registpasien')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <input type="hidden" name="id" id="id" value="{{$mPasien->id}}">
                                          <div class="form-group">
                                            <label class="col-form-label" for="norm">No Rekam Medis</label>
                                            <input readonly type="text" class="form-control" name="norm" id="norm" value="{{$mPasien->no_rm}}">
                                          </div>
                                          <div class="form-group">
                                            <label class="col-form-label" for="usia">Usia</label>
                                            <input readonly type="text" class="form-control" name="usia" id="usia" value="{{$usia}} Tahun">
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <label class="col-form-label" for="pasiennama">Nama pasien</label>
                                            <input readonly type="text" class="form-control" name="pasiennama" id="pasiennama" value="{{$mPasien->pasien_nama}}">
                                          </div>
                                          <div class="form-group">
                                            <label class="col-form-label" for="jeniskelamin">Jenis kelamin</label>
                                            <input readonly type="text" class="form-control" name="jeniskelamin" id="jeniskelamin" value=" {{ $mPasien->jeniskelamin==0 ? 'Laki-laki' : 'Perempuan'}}">
                                          </div>
                                        </div>
                                      </div>
                                      <hr>
                                      <div class="form-group">
                                        <label class="col-form-label" for="poliklinik">Poliklinik <a style="color:red">*</a></label>
                                        <select id="poliklinik" name="poliklinik" class="form-control" style="width: 100%;">
                                          <option disabled selected="selected">-- Pilih salah satu --</option>
                                          @foreach ($mPolis as $mPoli)
                                            <option value="{{ $mPoli->id }}" {{ old('poliklinik') == $mPoli->id ? 'selected' : '' }}>Poliklinik {{ $mPoli->poli_nama }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-form-label" for="kelastarif">Kelas Tarif <a style="color:red">*</a></label>
                                        <select id="kelastarif" name="kelastarif" class="form-control" style="width: 100%;">
                                          <option disabled selected="selected">-- Pilih salah satu --</option>
                                          <option value="1">Kelas Tarif A (Margin 1)</option>
                                          <option value="2">Kelas Tarif B (Margin 2)</option>
                                          <option value="3">Kelas Tarif C (Margin 3)</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class='btn btn-sm btn-primary'> <i class="fa fa-save"> </i>  DAFTARKAN PASIEN</button>
                                      <button type="reset" class="btn btn-sm btn-danger"> <i class="fas fa-undo-alt"> </i>  RESET</button>
                                    </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                        {{-- tutup modal --}}
                        <a href="#" type="button" class="btn btn-info toastrDefaultError" data-toggle="tooltip" data-placement="bottom" title="Riwayat pasien"><i class="fas fa-file"></i>Riwayat</a>
                        <a href="#" type="button" class="btn btn-primary toastrDefaultError" data-toggle="tooltip" data-placement="bottom" title="Edit master pasien"><i class="fas fa-edit"></i> Edit</a>
                      </div>
                    </td>
                    <?php $no++ ?>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>NO RM</th>
                  <th>NAMA PASIEN</th>
                  <th>KETERANGAN PASIEN</th>

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