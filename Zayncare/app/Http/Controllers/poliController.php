<?php

namespace App\Http\Controllers;

use App\Models\m_obatalkes;
use App\Models\mTindakan;
use App\Models\trxObatalkes;
use App\Models\trxPasien;
use App\Models\trxTindakanpasien;
use Illuminate\Http\Request;

class poliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trxPasien  = trxPasien::with('mPasien')->with('mPoli')->orderBy('status','ASC')->get();
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
        $pasien         = trxPasien::with('mPasien')->where('trx_id',$id)->first();
        $tindakan       = mTindakan::where('is_active','1')->get();
        $tindakanPasien = trxTindakanpasien::with('mTindakan')->get();
        //dd($tindakanPasien);
        return view('poliklinik.pemeriksaan',[
            'tindakans'     => $tindakan,
            'trxTindakans'   => $tindakanPasien
        ])->with('trxPasien',$pasien);
    }

    public function anamnesa(Request $request, string $id)
    {
        return 'anamnesa poli';
    }
    public function tindakan(Request $request, string $id)
    {
        $request->validate([
            'tindakan'  => 'required',
            'qty'       => 'required',
            'satuan'    => 'required',
        ],[
            'tindakan.required' => 'kolom TINDAKAN wajib diisi',
            'qty.required'      => 'kolom QTY wajib diisi',
            'satuan.required'   => 'kolom SATUAN wajib diisi',
        ]);

        dd($request);
        $tindakan = [
            'trx_id'        => $request->trx_id,
            'tindakan_id'   => $request->tindakan,
            'qty'           => $request->qty,
            'satuan'        => $request->satuan,
            'tarif'         => $request->tarif,
        ];
    }

    public function reseppoli($id)
    {
        $pasien         = trxPasien::with('mPasien')->where('trx_id',$id)->first();
        $trxobatalkes   = trxObatalkes::with('mObatalkes')->where('trx_id',$id)->get();
        $obatalkes      = m_obatalkes::where('is_active','1')->get();
        return view('apotek.reseppoli',[
            'obatalkess'    => $obatalkes,
            'trxobatalkess' => $trxobatalkes,
        ])->with('trxPasien',$pasien);
    }
    public function kembalikan($id)
    {
        $pulangkan   = [
            'status'     => '1',
        ];
        trxPasien::where('trx_id',$id)->update($pulangkan);
        
        return redirect()->route('poliklinik.index')->with('success','Pasien telah berhasil dipulangkan!');
    }
    public function pulangkan(string $id)
    {
        $pulangkan   = [
            'status'     => '5',
        ];
        trxPasien::where('trx_id',$id)->update($pulangkan);
        
        return redirect()->route('poliklinik.index')->with('success','Pasien telah berhasil dipulangkan!');
    }
    
    public function batalperiksa(string $id)
    {
        $batal   = [
            'status'     => '99',
        ];
        trxPasien::where('trx_id',$id)->update($batal);
        
        return redirect()->route('poliklinik.index')->with('success','Pendaftaran pasien telah berhasil dibatalkan!');
    }

    public function getTarifobat($id)
    {
        $tarif = m_obatalkes::where('id',$id)->get();
        return response()->json($tarif);
    }
    
    public function tambahobatalkes(Request $request, string $id)
    {
        // dd($request,$id);
        $request->validate([
            'obatalkes'     => 'required',
            'qty'           => 'required',
            'signa'         => 'required',
            'etiket'        => 'required',
        ],[
            'obatalkes.required'    => 'Kolom OBAT ALKES wajib diisi.',
            'qty.required'          => 'Kolom QTY wajib diisi.',
        ]);

        $total = $request->tarif*$request->qty;

        $tambahobat = [
            'trx_id'            => $id,
            'obatalkes_id'      => $request->obatalkes,
            'obatalkes_id'      => $request->obatalkes,
            'racikan'           => '0',
            'qty'               => $request->qty,
            'tarif'             => $request->tarif,
            'total'             => $total,
            'signa'             => $request->signa,
            'etiket'            => $request->etiket,
            'user_id'           => 1,
        ];

        trxObatalkes::create($tambahobat);

        return redirect()->back()->with('success','Item obat alkes telah berhasil ditambahkan!');
    }

    public function deleteobat(Request $request, string $trx_id)
    {
        // dd($request->id, $trx_id);
        $trxobatalkesId = $request->id;
        $trxobatalkes   = trxObatalkes::find($trxobatalkesId);

        if(!$trxobatalkes){
            return redirect()->back()->with('error', 'Data tidak ditemukan. coba anda lakukan refresh halaman ini.');
        }else{
            $trxobatalkes->delete();
            return redirect()->back()->with('success', 'Item obat berhasil dihapus.');
        }
    }

    public function doneresep(string $id)
    {
        $batal   = [
            'status'     => '3',
        ];
        trxPasien::where('trx_id',$id)->update($batal);
        
        return redirect()->route('poliklinik.index')->with('success','Terima kasih anda telah menyelesaikan pemeriksaan pasien. Silahkan arahkan pasien ke kasir untuk dilakukan pembayaran!');
    }
}
