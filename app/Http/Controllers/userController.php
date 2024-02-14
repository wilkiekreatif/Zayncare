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
        $users = User::all();
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

        return redirect()->route('admin.users.index')->with('success','User dengan nama '.strtoupper($request->nama).' berhasil ditambahkan.');

    }

    public function cekpassword(Request $request)
    {
        dd('cek password');

        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            // Mendapatkan password dari formulir login
            $inputPassword = $request->input('password');

            // Mendapatkan password yang di-hash dari database
            $hashedPassword = $user->password;

            // Membandingkan password
            if (Hash::check($inputPassword, $hashedPassword)) {
                // Password cocok
                return "Password cocok!";
            } else {
                // Password tidak cocok
                return "Password tidak cocok!";
            }
        } else {
            // Pengguna tidak ditemukan
            return "Pengguna tidak ditemukan!";
        }
    }
}
