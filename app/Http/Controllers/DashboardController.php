<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){
        $id=Auth::Id();
        if (Auth::user()->hasRole('super_admin')) {          
            return view('pages.superadmin.dashboard');
        }elseif(Auth::user()->hasRole('dosen')){
            return view('pages.dosen.dashboard');
        }else{
            $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();

            return view('pages.mahasiswa.dashboard', compact('data_mahasiswa'));
        }
        
    }
}
