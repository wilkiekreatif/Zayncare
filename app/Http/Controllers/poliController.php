<?php

namespace App\Http\Controllers;

use App\Models\mTindakan;
use App\Models\trxPasien;
use Illuminate\Http\Request;

class poliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trxPasien  = trxPasien::with('mPasien')->with('mPoli')->where('status','!=',[0,4,5])->orderBy('status','ASC')->get();
        $tindakan   = mTindakan::where('is_active','1')->get();
        return view('poliklinik.index',[
            'trxPasiens'=> $trxPasien,
            'tindakans'  => $tindakan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function periksa(string $id)
    {
        $pasien     = trxPasien::with('mPasien')->where('trx_id',$id)->first();
        $tindakan   = mTindakan::where('is_active','1')->get();
        return view('poliklinik.pemeriksaan',['tindakans'=> $tindakan])->with('trxPasien',$pasien);
    }

    public function anamnesa(Request $request, string $id)
    {
        return 'anamnesa poli';
    }
    public function tindakan(Request $request, string $id)
    {
        return 'tindakan poli';
    }
}
