<?php

namespace App\Http\Controllers;

use App\Models\mTindakan;
use App\Models\trxPasien;
use App\Models\trxTindakanpasien;
use Illuminate\Http\Request;

class kasirController extends Controller
{
    public function index(){
        $trxPasiens = trxPasien::all();
        return view('kasir.index', compact('trxPasiens'));
    }
    
    public function prosesBayar($id){
        $pasien         = trxPasien::with('mPasien')->where('trx_id',$id)->first();
        $tindakan       = mTindakan::where('is_active','1')->get();
        $tindakanPasien = trxTindakanpasien::with('mTindakan')->get();
        $total = trxTindakanpasien::sum('total');
        //dd($tindakanPasien);
        return view('kasir.pembayaran',[
            'tindakans'     => $tindakan,
            'trxTindakans'   => $tindakanPasien,
            'total' => $total
        ])->with('trxPasien',$pasien);

    }

}
