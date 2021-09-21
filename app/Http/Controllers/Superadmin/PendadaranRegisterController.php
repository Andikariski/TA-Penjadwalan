<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topikskripsi;
use App\Models\Syarat;
use App\Models\SyaratUjian;

class PendadaranRegisterController extends Controller
{
    public function index(){
         $data=Topikskripsi::where('status_mahasiswa','2')
        ->get();

        // dd($data);
        
        return view('pages.superadmin.pendadaran-register.index',compact('data'));
    }

    public function show($id){
        $file = Syarat::where('id_SyaratUjian',$id)
        ->get();
        $prasyarat = SyaratUjian::where('id',$id)
        ->get();

         return view('pages.superadmin.pendadaran-register.detail-upload',compact('file','prasyarat'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'status' => 'required',       
        ]);
        if($request->status == 2){
            $data = $request->all();
            $updateStatus = Syarat::findOrFail($id);
            $updateStatus->update($data);
            return back()->with('alert-success','Data Berhasil di ubah');
        }elseif($request->status == 3){
            $data['keterangan'] = $request->keterangan;
            $data = $request->all();
            $updateStatus = Syarat::findOrFail($id);
            $updateStatus->update($data);
            return back()->with('alert-success','Data Berhasil di ubah');
        }else{
            return back()->with('alert-failed','Data gagal di ubah');
        }
    }
}
