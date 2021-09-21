<?php

namespace App\Http\Controllers\Dosen;
use Illuminate\Support\Facades\Auth;
use App\Helpers\NilaiMahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Topikskripsi;
use App\Models\Penjadwalan;
use App\Models\PertanyaanSemprop;
use App\Models\NilaiSemprop;
use App\Models\SyaratUjian;
use App\Models\Syarat;

class PenilaianSempropPengujiController extends Controller
{
    public function index(){
        $id=Auth::user()->id;

        //query nipy dari relasi tabel dosen
        $data_dosen=Dosen::whereuser_id($id)->first();

        $daftar_mahasiswa = Topikskripsi::where('dosen_penguji_1',$data_dosen->nipy)
        // ->where('status_mahasiswa','1')
        // ->orWhere('status_mahasiswa','0')
        ->get();

        return view('pages.dosen.semprop.penguji.index',compact('daftar_mahasiswa'));
    }

    public function show($id){
         $data_mahasiswa = Topikskripsi::where('id',$id)
        ->first();

        $date = Penjadwalan::where('topik_skripsi_id',$id)
        ->pluck('date')
        ->first();

        
        $pertanyaan_semprop = PertanyaanSemprop::where('isPenguji1', true)
        ->get();
        // dd($pertanyaan_semprop);


        $id_penjadwalan = Penjadwalan::where('topik_skripsi_id',$id)
        ->pluck('id')
        ->first();

        $isExistSemprop = NilaiSemprop::where('id_penjadwalan',$id_penjadwalan)
        ->where('option','penguji1')
        ->get();
        
        $countArr = count($isExistSemprop);


        return view('pages.dosen.semprop.penguji.penilaian',compact('data_mahasiswa','pertanyaan_semprop','date','countArr'));
    }

    public function update(Request $request, $id){
        $id_pertanyaan = PertanyaanSemprop::where('isPenguji1', true)
        ->pluck('id');

        $id_penjadwalan = Penjadwalan::where('topik_skripsi_id',$id)
        ->pluck('id')
        ->first();

        $data_skripsi = Topikskripsi::where('id',$id)
        ->first();

        $arrLengthID = count($id_pertanyaan);
        $arrLengthValue = count($request->pertanyaan);

        if ($arrLengthID == $arrLengthValue) {
            for($i = 0; $i<$arrLengthValue; $i++){
                NilaiSemprop::create([
                    "id_pertanyaanSemprop" => $id_pertanyaan[$i],
                    "id_penjadwalan" => $id_penjadwalan,
                    "nipy" => $data_skripsi->dosen_penguji_1,
                    "option" => "penguji1",
                    "nilai" => $request->pertanyaan[$i],
                ]);
            }
        }

        //cek apakah pemmbimbing sudah menginputkan nilai
        $isPembimbingNilai = NilaiSemprop::where('id_penjadwalan',$id_penjadwalan)
        ->where('option','pembimbing')
        ->get();

        $countArrPembimbing = count($isPembimbingNilai);

        if($countArrPembimbing == 0){
            return redirect('/semprop-penguji')->with('alert-success','Nilai berhasil di inputkan');
        }else{

            $nilaiPembimbing = NilaiSemprop::where('option','pembimbing')
            ->where('id_penjadwalan',$id_penjadwalan)
            ->pluck('nilai');

            $penguji = new NilaiMahasiswa;
            $valuePenguji = $penguji->nilai_semprop($arrLengthValue,$request->pertanyaan);

            $countNilaiPembimbing = count($nilaiPembimbing);
            
            $pembimbing = new NilaiMahasiswa;
            $valuePembimbing = $pembimbing->nilai_semprop($countNilaiPembimbing,$nilaiPembimbing);

            $lastValue = $valuePenguji+$valuePembimbing;

            if ($lastValue >= 62.50) {
                // lulus
                Topikskripsi::where('id',$id)
                ->update(['status_mahasiswa' =>'2']);

                SyaratUjian::create([
                    'id_Skripsimahasiswa' => $id,
                    'id_NamaUjian' => 2,
                ]);
                return redirect('/semprop-penguji')->with('alert-success','Nilai berhasil di inputkan');
            }else{
                //mengulang
                Topikskripsi::where('id',$id)
                ->update(['status_mahasiswa' =>'0']);

                $syarat_ID = SyaratUjian::where('id_Skripsimahasiswa', $id)
                ->where('id_NamaUjian','1')
                ->pluck('id')
                ->first();
                
                Syarat::where('id_SyaratUjian',$syarat_ID)
                ->update(
                    [
                        'status'=>'3',
                    ]
                    );
                return redirect('/semprop-penguji')->with('alert-success','Nilai berhasil di inputkan');
                
            }

        }
    }
}
