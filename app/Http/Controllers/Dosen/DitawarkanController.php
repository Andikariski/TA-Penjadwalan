<?php

namespace App\Http\Controllers\Dosen;
use Illuminate\Support\Facades\Auth;
use App\Mail\TopikDosenEmail;
use App\Mail\TopikMahasiswaEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaRegisterTopikDosen;
use App\Models\Topikskripsi;
use App\Models\Dosen;
use App\Models\SyaratUjian;

class DitawarkanController extends Controller
{


    public function index(){
        //memanggil id dari tabel user
        $id=Auth::user()->id;
        
        //query nipy dari relasi tabel dosen
        $data_dosen=Dosen::whereuser_id($id)->first();


        // //query nipy dari relasi tabel skripsi dan topik bidang
        $data= Topikskripsi::where('nipy',$data_dosen['nipy'])
        ->where('option_from','Mahasiswa')
        ->get();
        
        // $wait= Topikskripsi::where('nipy',$data_dosen['nipy'])
        // ->where('option_from','Mahasiswa')
        // ->whereNull('status')
        // ->get();

        // if($wait){
        //     foreach($wait as $item){
        //         echo $item->created_at;
        //     }
        // }
        // die;
        return view('pages.dosen.requestMahasiswa',compact('data'));
    }


    //topik dari dosen
    public function update(Request $request, $id){
        // dd($request);
        $accept['status'] = 'Accept';
        $reject['status'] = 'Reject';
        $mahasiswa['nim_terpilih'] = $request->nim;
        
        
        //query where id
        $data = MahasiswaRegisterTopikDosen::whereid($id)->first();
        $details=[
            'judul' =>$data->getTopikSkripsi->judul_topik,
            'topik' =>$data->getTopikSkripsi->topik->nama_topik,
            'dosen' =>$data->getTopikSkripsi->dosen->user->name,
        ];
        // Mail::to('nashirmuhammad117@gmail.com')->send(new TopikDosenEmail($details,$accept['status']));
        // // dd($data->getTopikSkripsi->dosen->user->name); jangan dipakai
        // die;
        
        $item=MahasiswaRegisterTopikDosen::whereNotIn('id',[$id])
        ->whereid_topikskripsi($request->id_topikskripsi)->get();
        
        // if($item){
        //     foreach($item as $val){
        //     // dd($val->mahasiswa->user->email); jangan di pakai
        //     Mail::to('nashirmuhammad117@gmail.com')->send(new TopikDosenEmail($details,$reject['status']));
        //     }
        // }
        
        // die;

        //query status Accept
        $data = MahasiswaRegisterTopikDosen::whereid($id)->update($accept);

        //query status rejct
        $item=MahasiswaRegisterTopikDosen::whereNotIn('id',[$id])
        ->whereid_topikskripsi($request->id_topikskripsi)
        ->update($reject);

        //query pindah nim tb_getTopikSkripsi -> skripsi
        $row=Topikskripsi::whereid($request->id_topikskripsi)->update(
            [
                'nim_terpilih' => $request->nim,
                'status' => 'Accept',
                'status_mahasiswa' => '0'
                ]
        );

        SyaratUjian::create([
            'id_Skripsimahasiswa' => $request->id_topikskripsi,
            'id_NamaUjian' => 1,
        ]);


        //redirect topiksaya
        return redirect('/penelitian')->with('alert-success','Data Berhasil di simpan');;

    }

    //accept atau reject topik punya mahasiswa
    public function edit(Request $request){
        $id = $request->id;
        if ($request->type=='Accept') {
            $data['status'] = 'Accept';
            $data['status_mahasiswa']='0';
                $ujian=SyaratUjian::create([
                    'id_Skripsimahasiswa' => $id,
                    'id_NamaUjian' => 1,
                ]);
        }else{
            $data['status'] = 'Reject';
        }

        // return view('emails.topikDosen');
        // die;
        $dataMhs=Topikskripsi::whereid($id)->first();
        // dd($dataMhs->dosen->user->name); 

        // $details=[
        //     'judul' =>$dataMhs->judul_topik,
        //     'topik' =>$dataMhs->topik->nama_topik,
        //     'dosen' =>$dataMhs->dosen->user->name,
        //     'type' =>$request->type,
        // ];
        // Mail::to('nashirmuhammad117@gmail.com')->send(new TopikMahasiswaEmail($details));
        // return "email terkirim";
        // die;

          
        $item=Topikskripsi::where('id',$id)
        ->update($data);
        
       

        //redirect request mahasiswa
        return redirect('/mytopik')->with('alert-success','Request Berhasil di simpan');;
    }
}
