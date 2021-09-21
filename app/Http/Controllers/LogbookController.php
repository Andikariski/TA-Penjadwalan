<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Upload;

use App\Models\Topikskripsi;
use App\Models\Mahasiswa;
use App\Models\Logbook;
use PDF;

class LogbookController extends Controller
{
    public function index(){
        $id=Auth::Id();

         //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();

        $data = Topikskripsi::where('nim_terpilih',$data_mahasiswa->nim)
        ->orWhere('nim_submit',$data_mahasiswa->nim)
        ->where('status','Accept')
        ->first();
        if($data){
                $logbook = Logbook::where('id_topikskripsi',$data->id)
            ->get();
            return view('pages.mahasiswa.logbook.index',compact('data','logbook'));
        }
        return view('pages.mahasiswa.logbook.index',compact('data'));
    }

    public function create(){
        $id=Auth::Id();

         //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();

        $data = Topikskripsi::where('nim_terpilih',$data_mahasiswa->nim)
        ->orWhere('nim_submit',$data_mahasiswa->nim)
        ->where('status','Accept')
        ->first();
        return view('pages.mahasiswa.logbook.create',compact('data'));
    }

    public function log($id){
        
      $data=Logbook::find($id);

      
      return view('pages.mahasiswa.logbook.view',compact('data'));
    }


    public function store(Request $request){
        // dd($request->file);
        $id=Auth::Id();
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();

        $topik = Topikskripsi::where('nim_terpilih',$data_mahasiswa->nim)
        ->orWhere('nim_submit',$data_mahasiswa->nim)
        ->first();

        $request->validate([
            'kegiatan' => 'required',
            'catatan_kemajuan' => 'required|min:10',
            ]);
        $data = $request->all();
        $data['status'] = 0;
        $data['id_topikskripsi'] = $topik->id;

        if($request->file){
            $data['file']=$request->file('file')->store(
            'files','public'
        );
        }
        
        Logbook::create($data);
        return redirect('/logbook')->with('alert-success','Data Berhasil di tambah');
    }

    public function show($id){
       $logbook = Logbook::where('id_topikskripsi',$id)
        ->get();
        $biodata = Topikskripsi::where('id',$id)
        ->first();
        // dd($biodata);
        // dd($logbook);

        // share data to view
        // view()->share('employee',$data);
        // return view('pages.mahasiswa.logbook.pdf-logbook');
        // die;
        $pdf = PDF::loadView('pages.mahasiswa.logbook.pdf-logbook', [
            'logbook'=>$logbook,
            'biodata'=>$biodata,
            ])->setPaper('a4','landscape')->setWarnings(false);
                return $pdf->download('logbook.pdf');
    }

    
}
