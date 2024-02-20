<?php

namespace App\Http\Controllers;

use App\Models\trxObatalkes;
use App\Models\trxPasien;
use App\Models\trxPasienResep;
use App\Models\trxTindakanpasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        $today      = Carbon::now();
        // $year       = Carbon::now()->year;
        // $month      = Carbon::now()->month;
        $pxtoday    = trxPasien::where('status','!=','99')->whereDate('created_at',$today)->count('trx_id');
        $trxtoday   = trxPasienResep::distinct()
                        ->whereDate('created_at',$today)
                        ->whereRaw("SUBSTRING(trx_id, 1, 2) != 'PU'")
                        ->count('trx_id');
        $trxumumtoday   = trxPasienResep::distinct()
                        ->whereDate('created_at',$today)
                        ->whereRaw("SUBSTRING(trx_id, 1, 2) != 'RJ'")
                        ->count('trx_id');

        $omsetobat  = trxObatalkes::where('status','2')->orwhere('status','3')->whereDate('created_at',$today)->sum('total');
        $omsettindakan  = trxTindakanpasien::where('status','1')->whereDate('created_at',$today)->sum('total');
        $omsettoday = number_format($omsetobat + $omsettindakan,0,',','.');

        $datatrxumum    = trxPasienResep::distinct()
                        ->whereDate('created_at',$today)
                        ->whereRaw("SUBSTRING(trx_id, 1, 2) != 'RJ'")
                        ->get();
        
        $datatrxresep   = trxPasienResep::distinct()
                        ->whereDate('created_at',$today)
                        ->whereRaw("SUBSTRING(trx_id, 1, 2) != 'PU'")
                        ->get();
        $trxPasien      = trxPasien::with('mPasien')
                        ->where('status','!=','99')
                        ->whereDate('created_at',$today)
                        ->get();

        return view('dashboard.index',[
            'trxPasiens'=> $trxPasien,
            'trxumum'   => $datatrxumum,
            'trxresep'  => $datatrxresep,
            'omsettoday'=> $omsettoday,
            'pxtoday'   => $pxtoday,
            'trxtoday'  => $trxtoday,
            'trxumumtoday'  => $trxumumtoday,
        ]);
    }
}
