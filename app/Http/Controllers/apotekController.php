<?php

namespace App\Http\Controllers;

use App\Models\trxObatalkes;
use App\Models\trxPasienResep;
use Illuminate\Http\Request;

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
                                                    'status'

                                                    
                                                ])->distinct()->get();
        // dd($distinctTrxResep);

        return view('apotek.index',['trxReseps' => $distinctTrxResep]);
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
}
