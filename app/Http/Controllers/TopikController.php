<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Mail\RequestJadiPembimbingEmail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\TolakJob;

use Illuminate\Http\Request;
use App\Models\TopikBidang;
use App\Models\Topikskripsi;
use App\Models\Dosen;
use App\Models\Periode;
use App\Models\Mahasiswa;
use App\Models\MahasiswaRegisterTopikDosen;

class TopikController extends Controller
{
    public function index()
    {
        $topik = TopikBidang::all();
        $dosen = Dosen::with('user')->get();
        $periode = Periode::where('status', '1')->get();

        //memanggil id dari tabel user
        $id = Auth::Id();

        //query nim dari relasi tabel dosen dan user
        $data_mahasiswa = Mahasiswa::whereuser_id($id)->first();

        //query untuk mengetahui kalau mahasiswa sudah memiliki topik dari topik mahasiswa
        $getAcceptTopikMahasiswa = Topikskripsi::where('nim_submit', $data_mahasiswa->nim)->where('status', 'Accept')->first();

        //query untuk mengetahui kalau mahasiswa sedang menunggu dari dosen untuk acc/reject topik mahasiswa yang di ajukan
        $getMahasiswaMengajukan = Topikskripsi::where('nim_submit', $data_mahasiswa->nim)->whereNull('status')->first();

        //query untuk menunggu acc/reject dari topik dosen yang ditawarkan
        $menungguAcc = MahasiswaRegisterTopikDosen::where('nim', $data_mahasiswa->nim)
            ->where('status', 'Waiting')->first();

        //query untuk mengetahui apakah mahasiswa sudah dapat judul, dari topik dosen
        $sudahDapatJudulDariDosen = Topikskripsi::where('nim_terpilih', $data_mahasiswa->nim)->where('status', 'Accept')->first();

        // dd($menungguAcc);
        return view('pages.mahasiswa.addTopik', compact('topik', 'dosen', 'periode', 'getMahasiswaMengajukan', 'getAcceptTopikMahasiswa', 'menungguAcc', 'sudahDapatJudulDariDosen'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'judul_topik' => 'required',
            'deskripsi' => 'required|min:10',
            'id_topikbidang' => 'required',
            'nipy' => 'required',
            'id_periode' => 'required',
        ]);
        $data = $request->all();

        //memanggil id dari tabel user
        $id = Auth::Id();

        //query nim dari relasi tabel dosen dan user
        $data_mahasiswa = Mahasiswa::whereuser_id($id)->first();


        $data['option_from'] = "Mahasiswa";
        $data['nim_submit'] = $data_mahasiswa->nim;

        $tanggal_hari_ini = date("Y-m-d");

        //pecah date
        $pecah_tanggal = explode("-", $tanggal_hari_ini);

        $duedate = mktime(0, 0, 0, $pecah_tanggal[1], $pecah_tanggal[2] + 7, $pecah_tanggal[0]);
        $tanggal_deadline = date('Y-m-d', $duedate);

        $data['duedate'] = $tanggal_deadline;
        // dd($data);

        $topikBidang = TopikBidang::whereid($request->id_topikbidang)->first();

        //query mengetahui email dosen
        $dataDosen=Dosen::wherenipy($request->nipy)->first();
        
    
        $details=[
            'judul' =>$request->judul_topik,
            'topik' =>$topikBidang->nama_topik,
            'nama' =>$data_mahasiswa->user->name,
            'nim' =>$data_mahasiswa->nim,
            
        ];
        // $dataDosen->user->email;


        try {
            Mail::to('nashirmuhammad117@gmail.com')->send(new RequestJadiPembimbingEmail($details));
        } catch (Exception $ex) {
            // Debug via $ex->getMessage();
            return "We've got errors!";
            die;
        }
           
        $topik=Topikskripsi::create($data);

        // TolakJob::dispatch($topik)
        // ->delay(now()->addseconds(40));
        // dd($topik);
        return redirect('/penawaran/topiksaya')->with('alert-success','Data Berhasil di tambah');

        // TolakJob::dispatch($topik)
        // ->delay(now()->addseconds(40));
        // dd($topik);
        return redirect('/penawaran/topiksaya')->with('alert-success', 'Data Berhasil di tambah');
    }
}
