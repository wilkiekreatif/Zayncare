<?php

namespace App\Http\Controllers;

use App\Models\infoKlinik;
use App\Models\trxPasien;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function tracer(string $id){
        $info       = infoKlinik::where('id',1)->first();
        $trxPasien  = trxPasien::where('trx_id',$id)->first();
        return view('report.tracer',[
            'info'   => $info,
            'pasien' => $trxPasien,
        ]);
    }
}
