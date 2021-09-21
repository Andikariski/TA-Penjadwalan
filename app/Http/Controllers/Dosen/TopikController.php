<?php

namespace App\Http\Controllers\Dosen;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use App\Models\TopikBidang;
use App\Models\Topikskripsi;
use App\Models\Dosen;
use App\Models\User;
use App\Models\MahasiswaRegisterTopikDosen;

class TopikController extends Controller
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

        // $data_get_skripsi=MahasiswaRegisterTopikDosen::all();
        // dd($data_get_skripsi);

        // $jumlah_pemilih=MahasiswaRegisterTopikDosen::where('id_topikskripsi','');

        // //query nipy dari relasi tabel skripsi dan topik bidang
        $data= Topikskripsi::with('mahasiswaTerpilih')
        ->where('nipy',$data_dosen['nipy'])
        ->where('option_from','Dosen')
        ->get();
        // dd($data);

        return view('pages.dosen.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topik = TopikBidang::all();
        $periode = Periode::where('status','1')->get();
        return view('pages.dosen.addTopikDosen',compact('topik','periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_topik' => 'required',
            'deskripsi' => 'required|min:10',
            'id_topikbidang' => 'required',
            'id_periode' => 'required',
            ]);
        $data = $request->all();

        //memanggil id dari tabel user
        $id=Auth::Id();


        //query nipy dari relasi tabel dosen
        $data_dosen=Dosen::whereuser_id($id)->first();
        // dd($data_dosen->user->name);
        $data['option_from'] = "Dosen";
        $data['nipy'] = $data_dosen->nipy;
        $data['status'] = "Open";
        Topikskripsi::create($data);
        return redirect('/penelitian')->with('alert-success','Data Berhasil di tambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getTopik = MahasiswaRegisterTopikDosen::whereid_topikskripsi($id)->get();
        // dd($getTopik);
        return view('pages.dosen.showGetTopik',compact('getTopik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $periode = Periode::where('status','1')->get();
        // $skripsi = Topikskripsi::findOrFail($id);
        // $topik = TopikBidang::all();
        // // dd($topik);
        // return view('pages.dosen.editTopik',compact('topik','periode','skripsi'));
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
        //
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
