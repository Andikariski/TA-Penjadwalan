<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Topikskripsi;
use App\Models\SyaratUjian;
use App\Models\Syarat;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DaftarPendadaranController extends Controller
{
    public function index(){

    }

    public function create(){
        $id=Auth::Id();

         //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();

        $data = Topikskripsi::where('nim_terpilih',$data_mahasiswa->nim)
        ->orWhere('nim_submit',$data_mahasiswa->nim)
        ->where('status','Accept')
        ->where('status_mahasiswa','2')
        ->first();

        if($data){
            $syaratUjian=SyaratUjian::where('id_Skripsimahasiswa',$data->id)
            ->where('id_NamaUjian','2')
            ->pluck('id')
            ->first();
            

            $syarat_toefl=Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','1')
            ->first();

            $syarat_pembayaran=Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','3')
            ->first();

            $syarat_naskah=Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','2')
            ->first();

            $syarat_transkip=Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','5')
            ->first();

            $syarat_bebas_spp = Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','4')
            ->first();
            
            
            return view('pages.mahasiswa.pendadaran.register',compact('data','syarat_toefl','syarat_pembayaran','syarat_naskah','syarat_transkip','syarat_bebas_spp'));
            die;
        }
        
        return view('pages.mahasiswa.pendadaran.register',compact('data'));
    }

    public function store(Request $request){
         $id=Auth::Id();

         //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();

        $topik = Topikskripsi::where('nim_terpilih',$data_mahasiswa->nim)
        ->orWhere('nim_submit',$data_mahasiswa->nim)
        ->where('status','Accept')
        ->first();

        $getIdSyarat= SyaratUjian::where('id_Skripsimahasiswa',$topik->id)
        ->where('id_NamaUjian','2')
        ->pluck('id')
        ->first();
        

        $data['id_SyaratUjian'] = $getIdSyarat;
        $data['status'] = 1;


        if ($request->pembayaran) {
            $request->validate([
            'pembayaran' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('pembayaran')->store(
            'exam','public'
            );
            
            $data['id_NamaSyarat'] = 3;
            
        }elseif($request->toefl){
            $request->validate([
            'toefl' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('toefl')->store(
            'exam','public'
            );
            
            $data['id_NamaSyarat'] = 1;



        }elseif($request->naskah){
            $request->validate([
            'naskah' => 'required|mimes:docx,doc,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('naskah')->store(
            'exam','public'
            );
            
            $data['id_NamaSyarat'] = 2;


        }elseif($request->transkip){
            $request->validate([
            'transkip' => 'required|mimes:docx,doc,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('transkip')->store(
            'exam','public'
            );
            
            $data['id_NamaSyarat'] = 5;

        
        }elseif($request->bebas_spp){
            $request->validate([
            'bebas_spp' => 'required|mimes:docx,doc,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('bebas_spp')->store(
            'exam','public'
            );
            
            $data['id_NamaSyarat'] = 4;
        }
        else{
            return redirect('/daftar-pendadaran/create')->with('alert-failed','Gagal Menambahkan data');
            die;
        }

        Syarat::create($data);
        return redirect('/daftar-pendadaran/create')->with('alert-success','Berhasil menambahkan data');
        
    }

    public function update(Request $request, $id)
    {
        if ($request->pembayaran) {
            $request->validate([
            'pembayaran' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('pembayaran')->store(
            'exam','public'
            );

            
            $filepath=Syarat::whereid($id)
            ->pluck('NamaSyaratFile')
            ->first();
           
            Storage::delete('public/'.$filepath);       
        }elseif($request->toefl){
            $request->validate([
            'toefl' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('toefl')->store(
            'exam','public'
            );

            $filepath=Syarat::whereid($id)
            ->pluck('NamaSyaratFile')
            ->first();
           
            Storage::delete('public/'.$filepath);   

        }elseif($request->naskah){
            $request->validate([
            'naskah' => 'required|mimes:docx,doc,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('naskah')->store(
            'exam','public'
            );

            $filepath=Syarat::whereid($id)
            ->pluck('NamaSyaratFile')
            ->first();
           
            Storage::delete('public/'.$filepath);   

        }elseif($request->transkip){
            $request->validate([
            'transkip' => 'required|mimes:docx,doc,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('transkip')->store(
            'exam','public'
            );

            $filepath=Syarat::whereid($id)
            ->pluck('NamaSyaratFile')
            ->first();
           
            Storage::delete('public/'.$filepath);   
        }elseif($request->bebas_spp){
             $request->validate([
            'bebas_spp' => 'required|mimes:docx,doc,pdf|max:2048'
            ]);

            $data['NamaSyaratFile']=$request->file('bebas_spp')->store(
            'exam','public'
            );

            $filepath=Syarat::whereid($id)
            ->pluck('NamaSyaratFile')
            ->first();
           
            Storage::delete('public/'.$filepath); 
        }
        else{
            return redirect('/daftar-pendadaran/create')->with('alert-failed','Gagal merubah file');
            die;
        }
        $data['status'] = '1';
        Syarat::whereid($id)
            ->update($data);
        return redirect('/daftar-pendadaran/create')->with('alert-success','File Berhasil di ubah');
    }
}
