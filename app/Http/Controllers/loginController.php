<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function loginproses(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $data = [
            'username'  => $request->username,
            'password'  => $request->password,
        ];

        $user = User::where('username', $request->input('username'))->first();

        // if ($user) {
        //     // Mendapatkan password dari formulir login
        //     $inputPassword = $request->input('password');

        //     // Mendapatkan password yang di-hash dari database
        //     $hashedPassword = $user->password;

        //     // Membandingkan password
        //     if (Hash::check($inputPassword, $hashedPassword)) {
        //         // Password cocok
        //         return "Password cocok!";
        //     } else {
        //         // Password tidak cocok
        //         return "Password tidak cocok!";
        //     }
        // } else {
        //     // Pengguna tidak ditemukan
        //     return "Pengguna tidak ditemukan!";
        // }

        if(Auth::attempt($data)){
            return redirect()->route('dashboard.index')->with('success','Selamat datang '.strtoupper(Auth::user()->name).', di Zayncare Integrated Clinic System.');
        }else{
            
            return redirect()->back()->with('error','Username atau password salah. silahkan ulangi kembali.');
            dd($data);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
