<html>
<head>
    <title>Kwitansi Pembayaran</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;' onload="javascript:window.print()">
    <center>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <span style='font-size:12pt'><b>Zayncare Clinic</b></span></br>
                Alamat : Jl baru Jadi No 20020 </br>
                Telp : 0594094545
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>Nota Transaksi</span></b></br>
                Id Trans. : {{$trxPasien->trx_id}}</br>
                Tanggal dan waktu : {{ $tanggalTrx }} </br>
            </td>
        </table>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                Nama Pasien     : {{$trxPasien->mPasien->pasien_nama}} <br>
                No Rekam Medis  : {{$trxPasien->mPasien->no_rm}}
            </td>
        </table>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>

            <tr align='center' style="background-color: rgb(160, 160, 160)">
                <td width='2%'>No</td>
                <td width='20%'>Tindakan dan Obat</td>
                <td width='20%'>Jumlah</td>
                <td width='13%'>Harga</td>

            </tr>    
            @php
                $no=1;
            @endphp
           @foreach ($trxTindakans as $tindakan)
           @php
                $tarif = number_format($tindakan->tarif,0,',','.');
                $total = number_format($tindakan->total,0,',','.');
           @endphp
            <tr align="center">
                <td>{{ $no++ }}</td>
                <td>{{ $tindakan->mTindakan->tindakan_nama }}</td>
                <td>{{ $tindakan->qty }}</td>
                <td>Rp. {{ $tarif }}</td>
            </tr>
            @endforeach
            <tr>
                @php
                    $totalTindakans = number_format($totalTindakan,0,',','.');
                @endphp
                <td colspan='3'>
                    <div style='text-align:center; font-weight: bold; font-size: 0.7rem'>Total Tindakan</div>
                </td>
                <td style='text-align:center; font-weight: bold; font-size: 0.7rem'>Rp. {{ $totalTindakans }}</td>
            </tr>
            @foreach ($trxObatAlkes as $tObatAlkes)
            @php
                $tObatAl = number_format($tObatAlkes->total,0,',','.');
            @endphp
            <tr align="center">
                <td>{{ $no++ }}</td>
                <td>{{ $tObatAlkes->mObatAlkes->obatalkes_nama }}</td>
                <td>{{ $tObatAlkes->qty }}</td>
                <td>Rp. {{ $tObatAl }}</td>
            </tr>
            @endforeach
            <tr>
                @php
                    $totalObtAlks = number_format($totalObatAlkes,0,',','.');
                @endphp
                <td colspan='3'>
                    <div style='text-align:center; font-weight: bold; font-size: 0.7rem'>Total Obat dan Alkes</div>
                </td>
                <td style='text-align:center; font-weight: bold; font-size: 0.7rem'>Rp. {{ $totalObtAlks }}</td>
            </tr>

            <tr>
                @php
                    $totalByr = number_format($totalBayar,0,',','.');
                @endphp
                <td colspan='3'>
                    <div style='text-align:center; font-weight: bold; font-size: 0.7rem'>Total Pembayaran</div>
                </td>
                <td style='text-align:center; font-weight: bold; font-size: 0.7rem'>Rp. {{ $totalByr }}</td>
            </tr>

        </table>
        <br>

        <table style='width:700; font-size:7pt; margin-right: 100px' cellspacing='2'>
            <tr>
                <td align='center'>Diterima Oleh,</br></br><u>Pasien</u></td>
                {{-- <td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td> --}}
                <td align='center'>TTD,</br></br><u>Kasir</u></td>
            </tr>
        </table>
    </center>
</body>

</html>