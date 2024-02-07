<?php

namespace App\Http\Controllers;

use App\Models\m_obatalkes;
use App\Models\trxObatalkes;
use App\Models\trxUmum;
use App\Models\trxPasienResep;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class apotekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distinctTrxResep = trxPasienResep::select([
                                                    'trx_id',
                                                    'nik',
                                                    'no_rm',
                                                    'kelastarif',
                                                    'label',
                                                    'gelardepan',
                                                    'pasien_nama',
                                                    'gelarbelakang',
                                                    'tgllahir',
                                                    'alamat',
                                                    'desa',
                                                    'kecamatan',
                                                    'kota',
                                                    'no_telp',
                                                    'poli_nama',
                                                    'alergi',
                                                    'statusPasien',
                                                    'statusResep'
                                                ])->distinct()->where('no_rm','!=', Null)->orderBy('statusResep')->get();
        // dd($distinctTrxResep);

        return view('apotek.index',['trxReseps' => $distinctTrxResep]);
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

    public function verifresep(string $id)
    {
        $trxPasien = trxPasienResep::select([
                                            'trx_id',
                                            'nik',
                                            'no_rm',
                                            'kelastarif',
                                            'label',
                                            'gelardepan',
                                            'pasien_nama',
                                            'gelarbelakang',
                                            'tgllahir',
                                            'alamat',
                                            'desa',
                                            'kecamatan',
                                            'kota',
                                            'no_telp',
                                            'poli_nama',
                                            'alergi',
                                            'statusPasien',
                                            'statusResep'
                                        ])
                                        ->where('trx_id',$id)
                                        // ->where('statusPasien','3')
                                        ->distinct()
                                        ->first();
        $trxResep = trxPasienResep::where('trx_id', $id)->where('statusResep','0')->get();
        // dd($trxResep);
        $obatalkes = m_obatalkes::where('is_active','1')->get();
        // dd($trxPasien);

        return view('apotek.verifresep',[
            'trxReseps' => $trxResep,
            'obatalkess' => $obatalkes
            ])->with('trxPasien',$trxPasien);
        }
    public function jualumum()
    {
        $tglskrg    = Carbon::now()->format('dmY');
        $today      = now()->toDateString();
        $trxhariini = trxUmum::whereDate('created_at',$today)->count();
        $trxhariini++;

        $formattedNumber = Str::padLeft($trxhariini, 4, '0');
    
        $trx_id     = 'PU'.$tglskrg.$formattedNumber;
        // dd($trx_id);
        $obatalkes  = m_obatalkes::where('is_active','1')->where('wajibresep','0')->get();
        $itemobat   = trxObatalkes::with('mObatalkes')->where('trx_id',$trx_id)->get();
        $totalharga = trxObatalkes::where('trx_id',$trx_id)->sum('total');
        return view('apotek.jualobat',[
            'totalharga'    => $totalharga,
            'obatalkess'    => $obatalkes,
            'itemobats'     => $itemobat
        ])->with('trx_id', $trx_id);
    }
    public function resepvalidate($id)
    {
        $resepvalidate = [
            'status' => '2'
        ];
        
        trxObatalkes::where('trx_id',$id)->where('status','0')->update($resepvalidate);

        return redirect()->route('apotek.index')->with('success','Resep telah selesai di validasi. silahkan arah pasien ke kasir untuk dilakukan pembayaran!');
    }

    
}

