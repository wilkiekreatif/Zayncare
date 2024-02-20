<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zayncare</title>
    <link rel="stylesheet" href="{{asset('adminlte')}}/wildan/report.css">
  </head>
  <body>
    <div class="header">
      <h2><b>{{ $info->klinik_nama }}</b></h2>
      <h3><b>{{ $info->klinik_subnama }}</b></h3>
      <h5><b>{{ $info->sip }}</b></h5>
      <p>{{ $info->alamat }} | email: {{$info->email}}</p>
    </div>
    <hr>
    <div class="tracer-body">
      <div class="title"><b>Kunjungan Rawat Jalan</b></div>
      <table align="center">
        <tr>
          <td align="left">No Pendaftaran</td>
          <td>:</td>
          <td align="left"><b>{{$pasien->trx_id}}</b></td>
        </tr>
        <tr>
          <td align="left">No Rekam Medis</td>
          <td>:</td>
          <td align="left"><b>{{$pasien->mPasien->no_rm}}</b></td>
        </tr>
        <tr>
          <td align="left">Nama Pasien</td>
          <td>:</td>
          <td align="left">{{$pasien->mPasien->label}}. {{$pasien->mPasien->gelardepan}}<b>{{$pasien->mPasien->pasien_nama}}</b> @if ($pasien->mPasien->gelarbelakang!=null)
                              ,{{$pasien->mPasien->gelarbelakang }}
                          @endif
          </td>
        </tr>
        <tr>
          @php
            $tanggallahir = date('d-m-Y', strtotime($pasien->mPasien->tgllahir));
            $usia = date_diff(date_create($pasien->mPasien->tgllahir),date_create(\Carbon\Carbon::now()))->y;
          @endphp
          <td align="left">Tanggal Lahir</td>
          <td>:</td>
          <td align="left">{{ $tanggallahir}}</td>
        </tr>
        <tr>
          <td align="left">Usia</td>
          <td>:</td>
          <td align="left">{{ $usia}} Tahun</td>
        </tr>
        <tr>
          <td align="left">Poliklinik</td>
          <td>:</td>
          <td align="left">Umum</td>
        </tr>
        <tr>
          <td align="left">Dokter</td>
          <td>:</td>
          <td align="left">dr. <b>Dian Andriani Suwinda</b></td>
        </tr>
      </table>
      <div class="footer">{{$info->tagline}}</div>
      <hr>
      <div class="title1">zayncare.</div>
    </div>
    {{-- <script>
      window.print();
    </script> --}}
  </body>

</html>