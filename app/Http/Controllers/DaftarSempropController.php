<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Topikskripsi;
use App\Models\Mahasiswa;
use App\Models\SyaratUjian;
use App\Models\Syarat;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class DaftarSempropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $id=Auth::Id();

         //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();

        $data = Topikskripsi::where('nim_terpilih',$data_mahasiswa->nim)
        ->orWhere('nim_submit',$data_mahasiswa->nim)
        ->where('status','Accept')
        ->first();

        if($data){
            $syaratUjian=SyaratUjian::where('id_Skripsimahasiswa',$data->id)
            ->where('id_NamaUjian','1')
            ->pluck('id')
            ->first();
            

            $syarat_toefl=Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','1')
            ->first();

            $syarat_pembayaran=Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','3')
            ->first();

            // dd($syarat_pembayaran);

            $syarat_naskah=Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','2')
            ->first();

            $syarat_transkip=Syarat::where('id_SyaratUjian',$syaratUjian)
            ->where('id_NamaSyarat','5')
            ->first();
            
            
            return view('pages.mahasiswa.semprop.add-file',compact('data','syarat_toefl','syarat_pembayaran','syarat_naskah','syarat_transkip'));
            die;
        }
        return view('pages.mahasiswa.semprop.add-file',compact('data'));
       
        
    }

    public function view_file($id){
        $data=Syarat::find($id);
        // dd($data);      
        return view('pages.mahasiswa.semprop.view',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=Auth::Id();

         //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();
        $topik = Topikskripsi::where('nim_terpilih',$data_mahasiswa->nim)
        ->orWhere('nim_submit',$data_mahasiswa->nim)
        ->first();


        $getIdSyarat= SyaratUjian::where('id_Skripsimahasiswa',$topik->id)
        ->where('id_NamaUjian','1')
        ->pluck('id')
        ->first();
        

        $data['id_SyaratUjian'] = $getIdSyarat;
        $data['status'] = 1;
        // dd($getIdSyarat->id);

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


        }else{
            return redirect('/daftar-semprop/create')->with('alert-failed','Gagal Menambahkan data');
            die;
        }

        Syarat::create($data);
        return redirect('/daftar-semprop/create')->with('alert-success','Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        }else{
            return redirect('/daftar-semprop/create')->with('alert-failed','Gagal merubah file');
            die;
        }
        $data['status'] = '1';
        Syarat::whereid($id)
            ->update($data);
        return redirect('/daftar-semprop/create')->with('alert-success','File Berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
