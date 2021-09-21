<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Mail\SimtakhirEmail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\TopikDosenJob;

use Illuminate\Http\Request;
use App\Models\Topikskripsi;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\MahasiswaRegisterTopikDosen;

class PenawaranController extends Controller
{
    public function index(){
        //memanggil id dari tabel user
        $id=Auth::Id();

        //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();
        
        // dd($data_mahasiswa);   

        $getRegister = MahasiswaRegisterTopikDosen::where('nim', $data_mahasiswa->nim)->where('status','Waiting')->first();

        //query untuk mengetahui kalau mahasiswa sedang menunggu dari dosen untuk acc/reject topik mahasiswa yang di ajukan
        $getMahasiswaMengajukan = Topikskripsi::where('nim_submit', $data_mahasiswa->nim)->whereNull('status')->first();

        //query untuk mengetahui kalau mahasiswa sudah memiliki topik dari topik dosen
        $getAcceptTopikDosen = Topikskripsi::where('nim_terpilih', $data_mahasiswa->nim)->where('status','Accept')->first();

        //query untuk mengetahui kalau mahasiswa sudah memiliki topik dari topik mahasiswa
        $getAcceptTopikMahasiswa = Topikskripsi::where('nim_submit', $data_mahasiswa->nim)->where('status','Accept')->first();
        // dd($getMahasiswaMengajukan);

            $judul = Topikskripsi::where('option_from','Dosen')
            ->whereNull('nim_terpilih')
            ->where('status','Open')
            ->get();
            
                return view('pages.mahasiswa.penawaran',compact(
                    'judul','getRegister','getAcceptTopikDosen','getAcceptTopikMahasiswa','data_mahasiswa','getMahasiswaMengajukan'
                ));
    
        
    }

    public function store(Request $request){
        $request->validate([
            'id_topikskripsi' => 'required',
            ]);
        $data = $request->all();

        //memanggil id dari tabel user
        $id=Auth::user()->id;
        $email=Auth::user()->email;
        // dd($email);

        //query topik skripsi
        $getJudul = Topikskripsi::whereid($request->id_topikskripsi)->first();

        

        //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();
        // dd($data_mahasiswa->user->name);

        $data['nim'] = $data_mahasiswa->nim;
        $data['status'] = 'Waiting';


        
        // dd($data);

        //email dosen
        // dd($getJudul->dosen->user->email);
        
        // $details=[
        //     'judul' =>$getJudul->judul_topik,
        //     'topik' =>$getJudul->topik->nama_topik,
        //     'nama' =>$data_mahasiswa->user->name,
        //     'nim' =>$data_mahasiswa->user->mahasiswa->nim
        // ];
        // Mail::to('muhammadnashir9@gmail.com')->send(new SimtakhirEmail($details));
        // return "email terkirim";
        // die;
        
        $mhs=MahasiswaRegisterTopikDosen::create($data);
        $mahasiswa=MahasiswaRegisterTopikDosen::where('id_topikskripsi',$mhs->id_topikskripsi)->first();
        //  $status=MahasiswaRegisterTopikDosen::where('id_topikskripsi',$mhs->id_topikskripsi)
        // ->pluck('status')
        // ->all();
        // if(in_array("Accept",$status)){
        //     echo "ada";
        // }else{
        //     echo "tidak ada";
        // }
        // die;
        // dd($mhs, $mahasiswa);

        
        // TopikDosenJob::dispatch($mhs)
        // ->delay($mahasiswa->created_at->addseconds(6));
        
 
        return redirect('/penawaran')->with('alert-success','Berhasil di ajukan');

        
    }

    public function topiksaya(){
        $id=Auth::Id();

        //query nim dari relasi tabel dosen dan user
        $data_mahasiswa=Mahasiswa::whereuser_id($id)->first();


        $topik_skripsi = Topikskripsi::where('nim_submit',$data_mahasiswa->nim)
        ->get();


         return view('pages.mahasiswa.showRequest',compact('topik_skripsi'));
    }


    
}
    