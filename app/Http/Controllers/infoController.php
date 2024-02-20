<?php

namespace App\Http\Controllers;

use App\Models\infoKlinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class infoController extends Controller
{
    public function index(){
        $info   = infoKlinik::where('id', 1)->first();
        return view('sysadmin.preferences.index',['info' => $info]);
    }

    public function update(Request $request){
        // dd($request->all(), $id);
        $request->validate([
            'nama'  => 'required',
            'sip'   => 'required',
            'alamat'=> 'required',
            'notelp'=> 'required|numeric',
        ],[
            'nama.required'     => 'Kolom NAMA KLINIK wajib diisi.',
            'sip.required'      => 'Kolom IJIN PRAKTEK wajib diisi.',
            'alamat.required'   => 'Kolom ALAMAT wajib diisi.',
            'notelp.required'   => 'Kolom NO TELEPON wajib diisi.',
            'notelp.numeric'    => 'Kolom NO TELEPON harus berisi angka.',
        ]);

        $update = [
            'klinik_nama'   => $request->nama,
            'klinik_subnama'=> $request->subnama,
            'sip'           => $request->sip,
            'alamat'        => $request->alamat,
            'tagline'       => $request->tagline,
            'email'         => $request->email,
            'notelp'        => $request->notelp,
            'notelp2'       => $request->notelp2,
            'website'       => $request->website,
            'user_id'       => Auth::user()->id,
        ];

        infoKlinik::where('id',1)->update($update);

        return redirect()->back()->with('success','Data klinik berhasil disimpan.');
    }
}
