<?php

namespace App\Http\Controllers;

use App\Models\m_obatalkes;
use App\Models\trxObatalkes;
use App\Models\trxUmum;
use App\Models\trxPasienResep;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class apotekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today      = Carbon::now();
        $year       = Carbon::now()->year;
        $month      = Carbon::now()->month;

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
                                                    'statusResep',
                                                    'created_at'
                                                ])->distinct()->where('no_rm','!=', Null)->whereDate('created_at',$today)->orderBy('statusResep')->get();
        

        $trxtoday   = trxPasienResep::distinct()
                        ->whereDate('created_at',$today)
                        ->whereRaw("SUBSTRING(trx_id, 1, 2) != 'PU'")
                        ->count('trx_id');
                        
        $trxmonth   = trxPasienResep::distinct()->whereYear('created_at',$year)->whereMonth('created_at',$month)->whereRaw("SUBSTRING(trx_id, 1, 2) != 'PU'")
                        ->count('trx_id');
                        // ->get();
        // dd($trxmonth);
        
        $omsettoday = trxObatalkes::whereDate('created_at',$today)
                        ->whereRaw("SUBSTRING(trx_id, 1, 2) != 'PU'")
                        ->sum('total');
                        
        $omsetmonth   = trxObatalkes::whereYear('created_at',$year)
                        ->whereMonth('created_at',$month)
                        ->whereRaw("SUBSTRING(trx_id, 1, 2) != 'PU'")
                        ->sum('total');

        $omsettoday1 = number_format($omsettoday,0,',','.');
        $omsetmonth1 = number_format($omsetmonth,0,',','.');
                        
        return view('apotek.index',[
            'trxReseps' => $distinctTrxResep,
            'trxtoday'  => $trxtoday,
            'trxmonth'  => $trxmonth,
            'omsettoday'=> $omsettoday1,
            'omsetmonth'=> $omsetmonth1,
        ]);
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

    public function sendtokasir(string $id)
    {
        $total = trxObatalkes::where('trx_id',$id)->where('status','0')->sum('total');
        // dd($total);
        $trxUmum = [
            'trx_id'    => $id,
            'total'     => $total,
            'status'    => '0',
            'user_id'   => Auth::user()->id,
        ];

        trxUmum::create($trxUmum);

        return redirect()->route('apotek.pu')->with('success','Resep telah berhasil dikirim ke Kasir. silahkan arah pasien ke kasir untuk dilakukan pembayaran!');
    }

    public function pu()
    {
        $trxUmum    = trxUmum::all();

        $today      = Carbon::now();
        $year       = Carbon::now()->year;
        $month      = Carbon::now()->month;

        $trxtoday   = trxUmum::whereDate('created_at',$today)
                        ->where('status','!=','2')
                        ->count();

        $trxmonth   = trxUmum::whereYear('created_at',$year)
                        ->whereMonth('created_at',$month)
                        ->where('status','!=','2')
                        ->count();
        
        $omsettoday = trxUmum::whereDate('created_at',$today)
                        ->where('status','!=','2')
                        ->sum('total');

        $omsetmonth   = trxUmum::whereYear('created_at',$year)
                        ->whereMonth('created_at',$month)
                        ->where('status','!=','2')
                        ->sum('total');

        return view('apotek.pu',[
            'trxumums'  => $trxUmum,
            'trxtoday'  => $trxtoday,
            'trxmonth'  => $trxmonth,
            'omsettoday'=> $omsettoday,
            'omsetmonth'=> $omsetmonth,
        ]);
    }
    public function deleteobatalkes(Request $request)
    {
        $jmldata = trxObatalkes::where('trx_id',$request->trx_id)->count();
        
        if($jmldata == 1){
            return redirect()->back()->with('error', 'tabel ini tidak boleh kosong. anda harus input item obat yang sesuai baru anda bisa menghapus data pada tabel ini.');
        }
        $trxobatalkesId = $request->id;
        $trxobatalkes   = trxObatalkes::find($trxobatalkesId);

        // dd($trxobatalkes);
        if(!$trxobatalkes){
            return redirect()->back()->with('error', 'Data tidak ditemukan. coba anda lakukan refresh halaman ini.');
        }else{
            // dd($trxobatalkes);
            $trxobatalkes->delete();
            return redirect()->back()->with('success', 'Item obat berhasil dihapus.');
        }
    }

    public function serahresep(string $id){
        $reseps = trxObatalkes::where('trx_id',$id)->where('status','2')->get();
        // pengurangan stok gudang
        foreach($reseps as $item){
            $qty = $item->qty;
            $stok= m_obatalkes::where('id',$item->obatalkes_id)->first();
            
            $updatestok = $stok->stok - $qty;
            
            // simpan data pengurangan ke master gudang
            $stok->stok = $updatestok;
            $stok->save();

            // simpan status penyerahan obat
            $item->status = '3';
            $item->save();

        }
        return redirect()->back()->with('success', 'Resep telah diserahkan dan stok gudang telah berkurang.');
    }
    public function serahresepumum(string $id){
        $reseps = trxObatalkes::where('trx_id',$id)->where('status','1')->get();
        // pengurangan stok gudang
        foreach($reseps as $item){
            $qty = $item->qty;
            $stok= m_obatalkes::where('id',$item->obatalkes_id)->first();
            
            $updatestok = $stok->stok - $qty;
            
            // simpan data pengurangan ke master gudang
            $stok->stok = $updatestok;
            $stok->save();

            // simpan status penyerahan obat
            $item->status = '3';
            $item->save();

        }
        $updateTrxumum = trxUmum::where('trx_id',$id)->where('status','1')->first();
        // dd($updateTrxumum);
        $updateTrxumum->status = '3';
        $updateTrxumum->save();
        return redirect()->back()->with('success', 'Resep telah diserahkan dan stok gudang telah berkurang.');
    }
}

