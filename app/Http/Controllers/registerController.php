<?php

namespace App\Http\Controllers;

use App\Models\m_pasien;
use App\Models\m_poli;
use App\Models\trxPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class registerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mPoli = m_poli::where('is_active','1')->get();
        $mPasien = m_pasien::orderBY('no_rm','DESC')->get();
        return view('register.index',[
            'mPasiens' => $mPasien,
            'mPolis' => $mPoli
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tglskrg    = Carbon::now()->format('dmY');
        $today      = now()->toDateString();
        $norm = m_pasien::count();
        $norm++;

        $formattedNumber = Str::padLeft($norm, 6, '0');

        return view('register.create')->with('rm',$formattedNumber);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label'         => 'required',
            'nik'           => 'required|unique:m_pasiens,nik',
            'pasiennama'    => 'required',
            'tgllahir'      => 'required|date',
            'alamat'        => 'required',
            'desa'          => 'required',
            'kecamatan'     => 'required',
            'kota'          => 'required',
            'notelp'        => 'required',
            'jeniskelamin'  => 'required',
            'penjamin1'     => 'required',
        ],[
            'label.required'        => 'kolom PANGGILAN PASIEN wajib diisi',
            'nik.required'          => 'kolom NIP wajib diisi.',
            'nik.unique'            => 'NIP pasien sudah terdaftar, silahkan cek ulang master pasien.',
            'pasiennama.required'   => 'kolom NAMA PASIEN wajib diisi',
            'tgllahir.required'     => 'kolom TANGGAL LAHIR wajib diisi',
            'alamat.required'       => 'kolom ALAMAT PASIEN wajib diisi',
            'desa.required'         => 'kolom DESA wajib diisi',
            'kecamatan.required'    => 'kolom KECAMATAN wajib diisi',
            'kota.required'         => 'kolom KOTA wajib diisi',
            'notelp.required'       => 'kolom NO TELEPON wajib diisi',
            'jeniskelamin.required' => 'kolom JENIS KELAMIN wajib diisi',
            'penjamin1.required'    => 'kolom PENJAMIN PASIEN 1 wajib diisi',
        ]);

        $id = m_pasien::count();
        $id = $id+1;
        $formattedid = Str::padLeft($id, 6, '0');
        $id = $formattedid;
        
        $newPasien = [
            'no_rm'         => $id,
            'label'         => $request->label,
            'nik'           => $request->nik,
            'gelardepan'    => $request->gelardepan,
            'pasien_nama'   => $request->pasiennama,
            'gelarbelakang' => $request->gelarbelakang,
            'tgllahir'      => $request->tgllahir,
            'jeniskelamin'  => $request->jeniskelamin,
            'alamat'        => $request->alamat,
            'desa'          => $request->desa,
            'kecamatan'     => $request->kecamatan,
            'kota'          => $request->kota,
            'no_telp'        => '62'.$request->notelp,
            'agama'         => $request->agama,
            'pendidikan'    => $request->pendidikan,
            'asuransi1'     => $request->penjamin1,
            'asuransi2'     => $request->penjamin2,
            'asuransi3'     => $request->penjamin3,
            'user_id'       => 1,
        ];
        // dd($newPasien);
        m_pasien::create($newPasien);
        return redirect()->route('register.index')->with('success','Pasien dengan nama '.$request->pasiennama.' disimpan!');
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

    public function registpasien(Request $request)
    {
        $request->validate([
            'poliklinik'    => 'required',
            'kelastarif'    => 'required',
        ],[
            'poliklinik.required' => 'Pendaftaran pasien dengan nama '.strtoupper($request->pasiennama).' gagal dikarenakan anda tidak memilih POLIKLINIK TUJUAN. Silahkan ulangi kembali.',
            'kelastarif.required' => 'Pendaftaran pasien dengan nama '.strtoupper($request->pasiennama).' gagal dikarenakan anda tidak memilih KELAS TARIF. Silahkan ulangi kembali.',
        ]);
        
        
        $tglskrg    = Carbon::now()->format('dmY');
        $today      = now()->toDateString();
        $trxhariini = trxPasien::whereDate('created_at',$today)->count();
        $trxhariini++;

        $formattedNumber = Str::padLeft($trxhariini, 4, '0');
        
        $trx_id     = 'RJ'.$tglskrg.$formattedNumber;
        
        // dd($request, $trx_id);
        $newTrx = [
            'trx_id'    => $trx_id,
            'pasien_id' => $request->id,
            'poli_id'   => $request->poliklinik,
            'kelastarif'=> $request->kelastarif,
            'status'    => '1',
            'user_id'   => 1,
        ];

        trxPasien::create($newTrx);
        return redirect()->route('register.index')->with('success','Pasien dengan nama '.strtoupper($request->pasiennama).' telah berhasil didaftarkan ke Poliklinik!');
    }
    public function registered()
    {
        $trxPasien = trxPasien::with('mPasien')->with('mPoli')->where('status','!=',[0,4,5])->orderBy('status','ASC')->get();
        // dd($trxPasien);
        return view('register.registered',['trxPasiens' => $trxPasien]);
    }

    public function pulangkan(string $id)
    {
        $pulangkan   = [
            'status'     => '5',
        ];
        trxPasien::where('trx_id',$id)->update($pulangkan);
        
        return redirect()->route('register.registered')->with('success','Pasien telah berhasil dipulangkan!');
    }
    
    public function batalperiksa(string $id)
    {
        $batal   = [
            'status'     => '99',
        ];
        trxPasien::where('trx_id',$id)->update($batal);
        
        return redirect()->route('register.registered')->with('success','Pendaftaran pasien telah berhasil dibatalkan!');
    }
}
