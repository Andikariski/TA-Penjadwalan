<?php

namespace App\Http\Controllers\Dosen;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topikskripsi;
use App\Models\Dosen;
use App\Models\Logbook;
use App\Models\Syarat;
use App\Models\SyaratUjian;

class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //memanggil id dari tabel user
        $id=Auth::user()->id;
        
        //query nipy dari relasi tabel dosen
        $data_dosen=Dosen::whereuser_id($id)->first();
        
        $data=Topikskripsi::where('nipy',$data_dosen->nipy)
        ->where('status','Accept')
        ->get();

        // dd($data);

        return view('pages.dosen.bimbingan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logbook=Logbook::where('id_topikskripsi',$id)
        ->get();
        $data = Topikskripsi::whereid($id)->first();
        return view('pages.dosen.bimbingan.logbook',compact('logbook','data'));
    }

    public function view($id){
        $data=Logbook::find($id);   
        return view('pages.dosen.bimbingan.view-logbook',compact('data'));
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
        $status['status'] = 1;

        $item=Logbook::whereid($id)
        ->update($status);

        $lg=Logbook::where('id',$id)
        ->first();

        $id_skripsi = Logbook::where('id',$id)
        ->pluck('id_topikskripsi')
        ->first();
        
        $id_syaratUjian = SyaratUjian::where('id_Skripsimahasiswa',$id_skripsi)
        ->pluck('id');

        $semuaSyarat = Syarat::where('id_SyaratUjian',$id_syaratUjian)
        ->pluck('id_NamaSyarat');

        $logbook = Logbook::where('id_topikskripsi',$id_skripsi)
        ->where('status',1)
        ->pluck('status');

        $jumlahAccept= count($logbook);
        $temp = [];
        $tempStatus = [];
        $statusBerhasil = [2,2,2,2];

        foreach($semuaSyarat as $berkas){
            array_push($temp,$berkas);
        }
        $status = Syarat::where('id_SyaratUjian',$id_syaratUjian)
            ->pluck('status');
            foreach($status as $id_status){
                array_push($tempStatus,$id_status);
            }

            if(in_array("1",$temp)){
                if(in_array("2",$temp)){
                    if(in_array("3",$temp)){                   
                        if(in_array("5",$temp)){                           
                            if ($tempStatus == $statusBerhasil) {
                                if($jumlahAccept >= 2){
                                    SyaratUjian::where('id_Skripsimahasiswa',$id_skripsi)
                                    ->update(['status'=>1]);

                                    Topikskripsi::where('id',$id_skripsi)
                                    ->update(['status_mahasiswa'=>1]);
                                }
                            }
                        }
                    }
                }
            }

        //redirect topiksaya
        return redirect('/bimbingan/'.$lg->id_topikskripsi)->with('alert-success','Data Berhasil di ubah');;

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
