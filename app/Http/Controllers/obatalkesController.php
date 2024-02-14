<?php

namespace App\Http\Controllers;

use App\Models\m_obatalkes;
use App\Models\m_supplier;
use App\Models\TrxPembelianFarmasi;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'user_id'           => Auth::user()->id,
        ];

        m_obatalkes::create($newObatalkes);
        return redirect()->route('obatalkes.index')->with('success','OBAT ALKES dengan nama '.$request->suppliernama.' disimpan!');
    }

    public function edit(string $id)
    {
        $obatalkes = m_obatalkes::where('id',$id)->first();
        $suppliers = m_supplier::where('is_active','1')->get();
        return view('gudangfarmasi.obatalkes.edit',[
            'suppliers' => $suppliers
        ])->with('obatalkes',$obatalkes);
    }

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
            'user_id'           => Auth::user()->id,
        ];  

        m_obatalkes::where('id',$id)->update($obatAlkes);

        return redirect()->route('obatalkes.index')->with('success','Master Obat '.$request->obatalkesnama.' telah berhasil di Update');
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
        $obatalkess = m_obatalkes::with('supplier1','supplier2','supplier3')
                                    ->where('is_active','!=', '99')
                                    ->get();
        $defekta = TrxPembelianFarmasi::with('supplier','obatalkes')
                                        ->where('is_active','!=', '99')
                                        ->get();
        return view('gudangfarmasi.obatalkes.defekta',[ 'obatalkess' => $obatalkess, 'defektas' => $defekta]);
    }

    public function defektabaru()
    {
        $tglskrg    = Carbon::now()->format('dmY');
        $today      = now()->toDateString();
        $trxhariini = TrxPembelianFarmasi::whereDate('created_at',$today)->count();
        $trxhariini++;

        $formattedNumber = Str::padLeft($trxhariini, 4, '0');
        
        $trx_id     = 'DEF'.$tglskrg.$formattedNumber;

        $supplier   = m_supplier::where('is_active','1')->get();
        $obatalkes  = m_obatalkes::where('is_active','1')->get();
        return view('gudangfarmasi.obatalkes.defektabaru',[
            'suppliers' => $supplier,
            'obatalkes' => $obatalkes,
            'defekta_id'=> $trx_id,
        ]);
    }
    public function tambahdefekta(Request $request)
    {
        $request->validate([
            'obatalkes_id'  => 'required',
            'supplier'      => 'required',
            'qty'           => 'required',
        ],[
            'obatalkes_id.required' => 'Kolom OBAT ALKES wajib diisi.',
            'supplier.required'     => 'Kolom SUPPLIER wajib diisi.',
            'qty.required'          => 'Kolom QTY wajib diisi.',
        ]);
        // dd($request->all());

        $masterObat = m_obatalkes::where('id',$request->obatalkes_id)->first();

        $hargabeli  = $masterObat->hargabeliterakhir;
        $totalharga = $hargabeli*$request->qty;

        $defektabaru = [
            'trx_id'        => $request->id,
            'obatalkes_id'  => $request->obatalkes_id,
            'supplier_id'   => $request->supplier,
            'hargabeli'     => $hargabeli,
            'qty'           => $request->qty,
            'totalbayar'    => $totalharga,
            'is_active'     => '1',
            'user_id'       => Auth::user()->id,
        ];

        TrxPembelianFarmasi::create($defektabaru);

        return redirect()->back()->with('success','Defekta berhasil dibuat.');
    }
    
    public function stokopname()
    {
        return 'stok opname';
    }

    public function bataldefekta(string $id)
    {
        $update = ['is_active' =>  '0'];
        TrxPembelianFarmasi::where('id',$id)->update($update);
        
        return redirect()->back()->with('success','Defekta berhasil dibatalkan.');
    }

    public function hapusdefekta(string $id)
    {
        $update = ['is_active' =>  '99'];
        TrxPembelianFarmasi::where('id',$id)->update($update);
        
        return redirect()->back()->with('success','Defekta berhasil dihapus.');
    }

    public function aktifkandefekta(string $id)
    {
        $update = ['is_active' =>  '1'];
        TrxPembelianFarmasi::where('id',$id)->update($update);
        
        return redirect()->back()->with('success','Defekta berhasil diaktifkan kembali.');
    }

    public function verifikasidefekta(Request $request, string $id)
    {
        // dd($request->all());

        // update m_obatalkes->hargabeliterakhir
        if($request->updatetarif== 'on'){
            $updateMobatalkes = ['hargabeliterakhir' =>  $request->hargasetelahfaktur];
            m_obatalkes::where('id', $request->obatalkes_id)->update($updateMobatalkes);
            $info   = 'serta harga beli';
        }else{
            $info   = '';
        }

        // Update trx_pembelian_farmasis
        $masterObat   = m_obatalkes::where('id',$request->obatalkes_id)->first();
        // dd($masterObat->stok);
        $stokawal   = $masterObat->stok;
        $updatestok = $stokawal+$request->qtysetelahfaktur;

        // totalbayarsetelahfaktur
        $totalbayarsetelahfaktur = (($request->hargasetelahfaktur*$request->qtysetelahfaktur)-$request->diskon)+$request->ppn;

        $faktur = [
            'nofaktur'                  => $request->nofaktur,
            'qtysetelahfaktur'          => $request->qtysetelahfaktur,
            'hargabelisetelahfaktur'    => $request->hargasetelahfaktur,
            'diskon'                    => $request->diskon,
            'ppn'                       => $request->ppn,
            'totalbayarsetelahfaktur'   => $totalbayarsetelahfaktur,
            'is_active'                 => '2',
            'user_id'                   => Auth::user()->id,
        ];

        m_obatalkes::where('id',$request->obatalkes_id)->update(['stok' => $updatestok]);
        TrxPembelianFarmasi::where('id',$id)->update($faktur);
        // TrxPembelianFarmasi::where('id',$id)->update($update);
        
        return redirect()->back()->with('success','Faktur berhasil diinput dan stok '.$info.'berhasil diupdate.');
    }
}
