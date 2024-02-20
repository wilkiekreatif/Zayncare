<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $users = User::where('is_active','!=','99')->get();
        // dd(Auth::user());
        return view('sysadmin.users.index',['users' => $users]);
    }

    public function create()
    {
        // dd('create');
        return view('sysadmin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'username'  => 'required|unique:users,username',
        ],[
            'nama.required'     => 'Kolom NAMA LENGKAP Wajib diisi.',
            'username.required' => 'Kolom USERNAME Wajib diisi.',
            'username.unique'   => 'USERNAME sudah digunakan, Silahkan cari USERNAME lain.',
        ]);

        $data['name']       = $request->nama;
        $data['username']   = $request->username;
        $data['password']   = Hash::make($request->password);
        $data['email']      = $request->email;
        $data['role']       = 'user';
        $data['sysadmin']      = $request->sysadmin;
        $data['gudangfarmasi'] = $request->gudangfarmasi;
        $data['register']      = $request->register;
        $data['poliklinik']    = $request->poliklinik;
        $data['apotek']        = $request->apotek;
        $data['kasir']         = $request->kasir;
        $data['is_active']     = '1';
        User::create($data);

        return redirect()->route('users.index')->with('success','User dengan nama '.strtoupper($request->nama).' berhasil ditambahkan.');
    }

    public function nonaktif(string $id){
        $user = User::where('id',$id)->first();
        $user->is_active = '0';
        $user->update();

        return redirect()->back()->with('success','User telah berhasil di nonaktifkan.');
    }
    
    public function aktifkan(string $id){
        $user = User::where('id',$id)->first();
        $user->is_active = '1';
        $user->update();
        return redirect()->back()->with('success','User telah berhasil di aktifkan.');
    }
    
    public function hapus(string $id){
        $user = User::where('id',$id)->first();
        $user->is_active = '99';
        $user->update();
        return redirect()->back()->with('success','User telah berhasil di hapus.');
    }
}
