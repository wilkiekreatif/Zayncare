<?php

namespace App\Http\Controllers;

use App\Models\m_supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = m_supplier::where('is_active','!=', '99')->get();
        // dd($supplier);
        return view('gudangfarmasi.supplier.index',[ 'suppliers' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gudangfarmasi.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'suppliernama'      => 'required',
            'supplieralamat'    => 'required',
            'suppliertelp'      => 'required'
        ],[
            'suppliernama.required'     => 'Kolom NAMA SUPPLIER wajib diisi!',
            'supplieralamat.required'   => 'Kolom ALAMAT SUPPLIER wajib diisi!',
            'suppliertelp.required'     => 'Kolom NO TELEPON SUPPLIER wajib diisi!'
        ]);

        $newSupplier = [
            'supplier_nama'     => $request->suppliernama,
            'supplier_alamat'   => $request->supplieralamat,
            'supplier_telp'     => $request->suppliertelp
        ];

        m_supplier::create($newSupplier);
        return redirect()->route('supplier.index')->with('success','Supplier dengan nama '.$request->suppliernama.' disimpan!');
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
        $supplier = m_supplier::where('id',$id)->first();
        // dd($supplier);
        return view('gudangfarmasi.supplier.edit')->with('supplier',$supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'suppliernama'      => 'required|string|max:30',
            'supplieralamat'    => 'required|string',
            'suppliertelp'      => 'required|string',
        ], [
            'suppliernama.required'     => 'Kolom NAMA SUPPLIER wajib diisi!',
            'supplieralamat.required'   => 'Kolom ALAMAT SUPPLIER wajib diisi!',
            'suppliertelp.required'     => 'Kolom NO TELEPON SUPPLIER wajib diisi!',
        ]);

        $supplier = m_supplier::findOrFail($id);

        $supplier = [
            'supplier_nama'     => $request->suppliernama,
            'supplier_alamat'   => $request->supplieralamat,
            'supplier_telp'     => $request->suppliertelp
        ];

        m_supplier::where('id',$id)->update($supplier);
        return redirect()->route('supplier.index')->with('success','Supplier telah berhasil di Update');
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
        m_supplier::where('id',$id)->update($update);
        
        return redirect()->route('supplier.index')->with('success','Supplier telah berhasil di Non-aktifkan');
    }
    
    public function aktif(string $id)
    {
        $update = ['is_active' =>  '1'];
        m_supplier::where('id',$id)->update($update);
        
        return redirect()->route('supplier.index')->with('success','Supplier telah berhasil di Aktifkan');
    }
    public function delete(string $id)
    {
        $update = ['is_active' =>  '99'];
        m_supplier::where('id',$id)->update($update);
        
        return redirect()->route('supplier.index')->with('success','Supplier telah berhasil di Hapus.');
    }
}
