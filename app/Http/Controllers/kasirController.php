<?php

namespace App\Http\Controllers;

use App\Models\mTindakan;
use App\Models\trxKasir;
use App\Models\trxObatalkes;
use App\Models\trxPasien;
use App\Models\trxTindakanpasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class kasirController extends Controller
{
    public function index(){
        $trxPasiens = trxPasien::all();
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
            'id_transaksi' => $req->trx_id,
            'tanggal_transaksi' => Carbon::now(),
            'no_rekmed' => $req->norm,
            'nama_pasien' => $req->pasiennama,
            'asal_poli' => $req->poliklinik,
            'kelas_tarif' => $req->kelastarif,
            'total_tindakan' => $req->totalTindakan,
            'total_obat_alkes' => $req->totalObatAlkes,
            'total_transaksi' => $req->totalPembayaran,
            'user_id'           => 1 
        ]);

        $pasien = trxPasien::with('mPasien')->where('trx_id',$id)->first();
        $pasien->status_bayar = 2;
        $pasien->save();

        return redirect('/kasir');
    }

    public function hitungKembalian(Request $req){
        $totalBayar = $req->totalBayar;
        $uangDiterima = $req->uangDiterima;
        dd($totalBayar);
        // $kembalian = $totalBayar - $uangDiterima;
        return view('kasir.pembayaran', compact('kembalian'));
    }

}
