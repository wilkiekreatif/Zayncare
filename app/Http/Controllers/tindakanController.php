<?php

namespace App\Http\Controllers;

use App\Models\mTindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tindakanController extends Controller
{
    public function index(){
        $tindakans = mTindakan::where('is_active','!=','99')->get();
        return view('sysadmin.tindakan.index',['tindakans' =>$tindakans]);
    }

    public function create(){
        return view('sysadmin.tindakan.create');
    }
    
    public function store(Request $request){
        $request->validate([
            'nama'      => 'required',
            'jenis'     => 'required',
            'tarifdasar'=> 'required|numeric',
            'margin1'   => 'required|numeric|max:100',
            'margin2'   => 'required|numeric|max:100',
            'margin3'   => 'required|numeric|max:100',
        ],[
            'nama.required'         => 'Kolom NAMA wajib diisi.',
            'jenis.required'        => 'Kolom JENIS wajib diisi.',
            'tarifdasar.required'   => 'Kolom TARIF DASAR wajib diisi.',
            'margin1.required'      => 'Kolom MARGIN 1 wajib diisi.',
            'margin1.max'           => 'persentase MARGIN 1 maksimal 100%.',
            'margin2.required'      => 'Kolom MARGIN 2 wajib diisi.',
            'margin2.max'           => 'persentase MARGIN 2 maksimal 100%.',
            'margin3.required'      => 'Kolom MARGIN 3 wajib diisi.',
            'margin3.max'           => 'persentase MARGIN 3 maksimal 100%.',
        ]);

        $tindakan = [
            'tindakan_nama' => $request->nama,
            'jenis'         => $request->jenis,
            'tarifdasar'    => $request->tarifdasar,
            'margin1'       => $request->margin1,
            'margin2'       => $request->margin2,
            'margin3'       => $request->margin3,
            'user_id'       => Auth::user()->id,
        ];

        mTindakan::create($tindakan);

        return redirect()->route('tindakan.index')->with('success','Tindakan baru dengan nama '.strtoupper($request->nama).' berhasil disimpan.');
    }

    public function nonaktif(string $id){
        $user = mTindakan::where('id',$id)->first();
        $user->is_active = '0';
        $user->user_id = Auth::user()->id;
        $user->update();

        return redirect()->back()->with('success','Tindakan telah berhasil di nonaktifkan.');
    }
    
    public function aktifkan(string $id){
        $user = mTindakan::where('id',$id)->first();
        $user->is_active = '1';
        $user->user_id = Auth::user()->id;
        $user->update();
        return redirect()->back()->with('success','Tindakan telah berhasil di aktifkan.');
    }
    
    public function hapus(string $id){
        $user = mTindakan::where('id',$id)->first();
        $user->is_active = '99';
        $user->user_id = Auth::user()->id;
        $user->update();
        return redirect()->back()->with('success','Tindakan telah berhasil di hapus.');
    }
}
