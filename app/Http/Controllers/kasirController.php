<?php

namespace App\Http\Controllers;

use App\Models\mTindakan;
use App\Models\trx_kasir_umum;
use App\Models\trxKasir;
use App\Models\trxObatalkes;
use App\Models\trxPasien;
use App\Models\trxTindakanpasien;
use App\Models\trxUmum;
use Carbon\Carbon;
use Illuminate\Http\Request;

class kasirController extends Controller
{
    public function index(){
        $trxPasiens = trxPasien::orderby('status','ASC')->get();
        return view('kasir.index', compact('trxPasiens'));
    }
    
    public function prosesBayar(Request $req, $id){
        $pasien         = trxPasien::with('mPasien')->where('trx_id',$id)->first();
        $tindakan       = mTindakan::where('is_active','1')->get();
        $tindakanPasien = trxTindakanpasien::with('mTindakan')->where('trx_id',$id)->get();
        $trxObatAlkes   = trxObatalkes::with('mObatalkes')->where('trx_id',$id)->where('status','2')->get();
        $totalTindakan = trxTindakanpasien::totalTindakan($id);
        $totalObatAlkes = trxObatalkes::totalObatAlkes($id);
        $totalBayar = $totalTindakan + $totalObatAlkes;
        //dd($tindakanPasien);
        return view('kasir.pembayaran',[
            'tindakans'     => $tindakan,
            'trxTindakans'   => $tindakanPasien,
            'trxObatAlkes' => $trxObatAlkes,
            'totalTindakan' => $totalTindakan,
            'totalObatAlkes' => $totalObatAlkes,
            'totalBayar' => $totalBayar
        ])->with('trxPasien',$pasien);

    }

    public function simpanPembayaran(Request $req, $id){

        trxKasir::create([
            'id_transaksi'      => $req->trx_id,
            'tanggal_transaksi' => Carbon::now(),
            'no_rekmed'         => $req->norm,
            'nama_pasien'       => $req->pasiennama,
            'asal_poli'         => $req->poliklinik,
            'kelas_tarif'       => $req->kelastarif,
            'total_tindakan'    => $req->totalTindakan,
            'total_obat_alkes'  => $req->totalObatAlkes,
            'total_transaksi'   => $req->totalPembayaran,
            'user_id'           => 1 
        ]);

        $pasien = trxPasien::with('mPasien')->where('trx_id',$id)->first();
        $pasien->status = 4;
        $pasien->save();

        return redirect()->route('kasir.index')->with('success','Transaksi telah berhasil disimpan. silahkan print tanda terima apabila dibutuhkan.');

    }

    public function hitungKembalian(Request $req){
        $totalBayar = $req->totalBayar;
        $uangDiterima = $req->uangDiterima;
        dd($totalBayar);
        // $kembalian = $totalBayar - $uangDiterima;
        return view('kasir.pembayaran', compact('kembalian'));
    }

    public function pembayranUmum(){
        $trxUmum = trxUmum::all();

        $today      = Carbon::now();
        $year       = Carbon::now()->year;
        $month      = Carbon::now()->month;

        $trxtoday   = trxUmum::whereDate('created_at',$today)
                        ->where('status','!=','2')
                        ->count();

        $trxmonth   = trxUmum::whereYear('created_at',$year)
                        ->whereMonth('created_at',$month)
                        ->where('status','!=','2')
                        ->count();
        
        $omsettoday = trxUmum::whereDate('created_at',$today)
                        ->where('status','!=','2')
                        ->sum('total');

        $omsetmonth   = trxUmum::whereYear('created_at',$year)
                        ->whereMonth('created_at',$month)
                        ->where('status','!=','2')
                        ->sum('total');
        return view('kasir.pembayaran_umum',[
            'trxumum'  => $trxUmum,
            'trxtoday'  => $trxtoday,
            'trxmonth'  => $trxmonth,
            'omsettoday'  => $omsettoday,
            'omsetmonth'  => $omsetmonth,
        ]);
    }

    public function prosesbayarUmum($id){
        $trxObatAlkesU = trxUmum::where('trx_id',$id)->get();
        // $trxObatAlkesU   = trxUmum::with('mObatalkes')->where('trx_id',$id)->get();
        return view('kasir.proses_bayar_umum', compact('trxObatAlkesU'));
    }

    public function simpanPembayaranUmum($id, Request $req) {
        trx_kasir_umum::create([
            'id_transaksi' => $req->id_transaksi,
            'tanggal_transaksi' => $req->tanggal_transaksi,
            'total_transaksi' => $req->total_transaksi,
            'user_id'           => 1 
        ]);

        $pasien = trxUmum::where('trx_id',$id)->update(['status' => '1']);
        // $pasien->status = 1;
        // $pasien->save();
        

        return redirect('kasir/pembayaran_umum')->with('success','Data transaksi berhasil disimpan');;
    }

    public function printKwitansi($id){
        $pasien         = trxPasien::with('mPasien')->where('trx_id',$id)->first();
        $tindakan       = mTindakan::where('is_active','1')->get();
        $tindakanPasien = trxTindakanpasien::with('mTindakan')->where('trx_id',$id)->get();
        $trxObatAlkes   = trxObatalkes::with('mObatalkes')->where('trx_id',$id)->where('status','2')->get();
        $totalTindakan = trxTindakanpasien::totalTindakan($id);
        $totalObatAlkes = trxObatalkes::totalObatAlkes($id);
        $totalBayar = $totalTindakan + $totalObatAlkes;
        $tgl_transaksi      = Carbon::now();
        //dd($tindakanPasien);
        return view('kasir.kwitansi',[
            'tindakans'     => $tindakan,
            'trxTindakans'   => $tindakanPasien,
            'trxObatAlkes' => $trxObatAlkes,
            'totalTindakan' => $totalTindakan,
            'totalObatAlkes' => $totalObatAlkes,
            'totalBayar' => $totalBayar,
            'tanggalTrx' => $tgl_transaksi
        ])->with('trxPasien',$pasien);
    }

}
