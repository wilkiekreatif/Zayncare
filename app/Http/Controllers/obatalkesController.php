<?php

namespace App\Http\Controllers;

use App\Models\m_obatalkes;
use App\Models\m_supplier;
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
                                    // ->where('is_active','1')
                                    ->get();
        //dd($obatalkess);
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gudangfarmasi.obatalkes.create');
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
