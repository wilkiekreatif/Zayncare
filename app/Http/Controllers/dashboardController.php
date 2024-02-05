<?php

namespace App\Http\Controllers;

use App\Models\trxPasien;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        // $chart = trxPasien::where('status','!=','99')->get();

        return view('dashboard.index');
    }
}
