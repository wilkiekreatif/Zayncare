<?php

namespace App\Http\Controllers;

use App\Models\m_obatalkes;
use App\Models\m_supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class obatalkesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obatalkess = m_obatalkes::with('supplier1')
                                    ->with('supplier2')
                                    ->with('supplier3')
                                    ->where('is_active','!=', '99')
                                    ->get();
        return view('gudangfarmasi.obatalkes.index',[ 'obatalkess' => $obatalkess]);
    }
    public function stok()
    {
        $obatalkess = m_obatalkes::with('supplier1')
                                    ->with('supplier2')
                                    ->with('supplier3')
                                    // ->where('is_active','1')
                                    ->get();
        //dd($obatalkess);
        return view('gudangfarmasi.obatalkes.stok',[ 'obatalkess' => $obatalkess]);
    }

    public function create()
    {
        $supplier   = m_supplier::where('is_active','1')->get();
        // dd($supplier);
        return view('gudangfarmasi.obatalkes.create',[
            'suppliers' => $supplier,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'obatalkesnama'     => 'required',
            'jenis'             => 'required',
            'supplier1'         => 'required',
            'satuan'            => 'required',
            'hargabeli'         => 'required',
            'margin1'           => 'required',
            'wajibresep'        => 'required',
        ],[
            'obatalkes.required'=> 'Kolom NAMA OBAT ALKES wajib diisi!',
            'jenis.required'    => 'Kolom JENIS OBAT ALKES wajib diisi!',
            'supplier1.required'=> 'Kolom SUPPLIER 1 wajib diisi!',
            'satuan.required'   => 'Kolom SATUAN wajib diisi!',
            'hargabeli.required'=> 'Kolom PERKIRAAN HARGA BELI wajib diisi!',
            'margin1.required'  => 'Kolom MARGIN 1 wajib diisi!',
            'wajibresep.required'  => 'Kolom WAJIB RESEP wajib diisi!',
        ]);

        $id = m_obatalkes::count();
        $id = $id+1;
        $formattedid = Str::padLeft($id, 5, '0');
        $id = 'OA-'.$formattedid;
        // dd($id);
        $newObatalkes   = [
            'obatalkes_id'      => $id,
            'obatalkes_jenis'   => $request->jenis,
            'obatalkes_nama'    => $request->obatalkesnama,
            'supplier1_id'      => $request->supplier1,
            'supplier2_id'      => $request->supplier2,
            'supplier3_id'      => $request->supplier3,
            'satuan'            => $request->satuan,
            'hargabeliterakhir' => $request->hargabeli,
            'margin1'           => $request->margin1,
            'margin2'           => $request->margin2,
            'margin3'           => $request->margin3,
            'wajibresep'        => $request->wajibresep,
            'user_id'           => 1,
        ];

        m_obatalkes::create($newObatalkes);
        return redirect()->route('obatalkes.index')->with('success','OBAT ALKES dengan nama '.$request->suppliernama.' disimpan!');
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
        $obatalkes = m_obatalkes::where('id',$id)->first();
        $suppliers = m_supplier::where('is_active','1')->get();
        return view('gudangfarmasi.obatalkes.edit',[
            'suppliers' => $suppliers
        ])->with('obatalkes',$obatalkes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis'             => 'required',
            'obatalkesnama'     => 'required',
            'supplier1'         => 'required',
            'satuan'            => 'required',
            'hargabeli'         => 'required',
            'margin1'           => 'required',
        ], [
            'jenis.required'            => 'Kolom JENIS OBAT ALKES wajib diisi!',
            'obatalkesnama.required'    => 'Kolom NAMA OBAT ALKES wajib diisi!',
            'supplier1.required'        => 'Kolom SUPPLIER 1 wajib diisi!',
            'satuan.required'           => 'Kolom SATUAN wajib diisi!',
            'hargabeli.required'        => 'Kolom HARGA BELI wajib diisi!',
            'margin1.required'          => 'Kolom MARGIN 1 wajib diisi!',
        ]);

        $newObatalkes = m_obatalkes::findOrFail($id);

        $obatAlkes = [
            'obatalkes_jenis'   => $request->jenis,
            'obatalkes_nama'    => $request->obatalkesnama,
            'supplier1_id'      => $request->supplier1,
            'supplier2_id'      => $request->supplier2,
            'supplier3_id'      => $request->supplier3,
            'satuan'            => $request->satuan,
            'hargabeliterakhir' => $request->hargabeli,
            'margin1'           => $request->margin1,
            'margin2'           => $request->margin2,
            'margin3'           => $request->margin3,
        ];

        m_obatalkes::where('id',$id)->update($obatAlkes);

        return redirect()->route('obatalkes.index')->with('success','Master Obat '.$request->obatalkesnama.' telah berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function nonaktif(string $id)
    {
        $update = ['is_active' =>  '0'];
        m_obatalkes::where('id',$id)->update($update);
        
        return redirect()->route('obatalkes.index')->with('success','Obat Alkes telah berhasil di Non-Aktifkan.');
    }
    
    public function aktif(string $id)
    {
        $update = ['is_active' =>  '1'];
        m_obatalkes::where('id',$id)->update($update);
        
        return redirect()->route('obatalkes.index')->with('success','Obat Alkes telah berhasil di Non-Aktifkan.');
    }
    
    public function delete(string $id)
    {
        $update = ['is_active' =>  '99'];
        m_obatalkes::where('id',$id)->update($update);
        
        return redirect()->route('obatalkes.index')->with('success','Obat Alkes telah berhasil di Non-Aktifkan.');
    }
    
    public function defekta()
    {
        $obatalkess = m_obatalkes::with('supplier1')
                                    ->with('supplier2')
                                    ->with('supplier3')
                                    ->where('is_active','!=', '99')
                                    ->get();
        return view('gudangfarmasi.obatalkes.defekta',[ 'obatalkess' => $obatalkess]);
    }
    public function defektabaru()
    {
        $supplier   = m_supplier::where('is_active','1')->get();
        return view('gudangfarmasi.obatalkes.defektabaru',['suppliers' => $supplier]);
    }
    public function stokopname()
    {
        return 'stok opname';
    }
}
