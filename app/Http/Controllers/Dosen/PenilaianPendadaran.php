<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Support\Facades\Auth;
use App\Helpers\NilaiMahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topikskripsi;
use App\Models\Dosen;
use App\Models\NilaiPendadaran;
use App\Models\Penjadwalan;
use App\Models\PertanyaanSemprop;
use App\Models\PertanyaanPendadaran;
use App\Models\SubPertanyaanPendadaran;
use App\Models\NilaiSemprop;
use App\Models\SyaratUjian;
use App\Models\Syarat;

class PenilaianPendadaran extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        //query nipy dari relasi tabel dosen
        $data_dosen = Dosen::whereuser_id($id)->first();

        $daftar_mahasiswa = Topikskripsi::where('dosen_penguji_1', $data_dosen->nipy)
            // ->where('status_mahasiswa','1')
            // ->orWhere('status_mahasiswa','0')
            ->get();

        return view('pages.dosen.pendadaran.dataPembimbing', compact('daftar_mahasiswa'));
    }

    public function showPenilaianPendadaran($id)
    {
        // $id = Auth::user()->id;

        // $data_dosen = Dosen::whereuser_id($id)->first();

        $data_mahasiswa = Topikskripsi::where('id', $id)
            ->first();

        $date = Penjadwalan::where('topik_skripsi_id', $id)
            ->pluck('date')
            ->first();

        $pertanyaan_pendadaran = PertanyaanPendadaran::all();
        // dd($pertanyaan_semprop);

        $pertanyaan_sub_pendadaran = SubPertanyaanPendadaran::all();

        // dd($pertanyaan_sub_pendadaran);
        $id_penjadwalan = Penjadwalan::where('topik_skripsi_id', $id)
            ->pluck('id')
            ->first();

        // $isExistSemprop = NilaiSemprop::where('id_penjadwalan', $id_penjadwalan)
        //     ->where('option', 'penguji1')
        //     ->get();

        // $countArr = count($isExistSemprop);

        // $status_penilaian = NilaiPendadaran::where('nipy', $data_dosen->nipy)->first();
        // dd($status_penilaian);

        // dd($id);
        return view('pages.dosen.pendadaran.penilaian', compact('data_mahasiswa', 'pertanyaan_pendadaran', 'date', 'pertanyaan_sub_pendadaran'));
    }

    public function update(Request $request, $id)
    {
        // $nilaiDosenPenguji = Auth::user()->id;
        $nilaiDosenPenguji = Auth::user()->id;

        $filterArrLengthValue = $request->all();

        for ($i = 0; $i < 2; $i++) {
            $filter = array_shift($filterArrLengthValue);
        }

        $id_pertanyaan = PertanyaanPendadaran::all()->pluck('id');

        $id_penjadwalan = Penjadwalan::where('topik_skripsi_id', $id)
            ->pluck('id')
            ->first();

        $data_skripsi = Topikskripsi::where('id', $id)
            ->first();

        $arrLengthID = count($id_pertanyaan);
        $arrLengthValue = count($filterArrLengthValue);

        $option_pembimbing = Topikskripsi::where('nipy', $data_skripsi->nipy)
            ->first();

        $option_penguji1 = Topikskripsi::where('dosen_penguji_1', $data_skripsi->dosen_penguji_1)
            ->first();

        $option_penguji2 = Topikskripsi::where('dosen_penguji_2', $data_skripsi->dosen_penguji_2)
            ->first();

        if ($option_pembimbing->dosen->user->id == $nilaiDosenPenguji) {
            $option = "pembimbing";
            $nipy   =  $data_skripsi->nipy;
        } elseif ($option_penguji1->dosenPenguji1->user->id == $nilaiDosenPenguji) {
            $option = "penguji1";
            $nipy   = $data_skripsi->dosen_penguji_1;
        } elseif ($option_penguji2->dosenPenguji2->user->id == $nilaiDosenPenguji) {
            $option = "penguji2";
            $nipy   = $data_skripsi->dosen_penguji_2;
        }

        $p = 1;
        if ($arrLengthID == $arrLengthValue) {
            for ($i = 0; $i < $arrLengthValue; $i++) {
                NilaiPendadaran::create([
                    "id_subPertanyaanPendadaran" => $id_pertanyaan[$i],
                    "id_penjadwalan" => $id_penjadwalan,
                    "nipy" => $nipy,
                    "option" => $option,
                    "nilai" => $filterArrLengthValue['pertanyaan' . $p++],
                ]);
            }
        }
        if ($option_pembimbing->dosen->user->id == $nilaiDosenPenguji) {
            return redirect('bimbingan')->with('alert-success', 'Nilai Berhasil Diinput');
        } else {
            return redirect('data-penilaian-pendadaran')->with('alert-success', 'Nilai Berhasil Diinput');
        }
    }


    public function dataNilaianPenguji()
    {
        $id = Auth::user()->id;

        //query nipy dari relasi tabel dosen
        $data_dosen = Dosen::whereuser_id($id)->first();

        $daftar_mahasiswa = Topikskripsi::where('dosen_penguji_1', $data_dosen->nipy)
            ->orWhere('dosen_penguji_2', $data_dosen->nipy)
            ->Where('status_mahasiswa', 3)
            ->get();

        $status_penilaian = NilaiPendadaran::where('nipy', $data_dosen->nipy)->get();
        $countArr = count($status_penilaian);

        return view('pages.dosen.pendadaran.index', compact('daftar_mahasiswa', 'status_penilaian', 'data_dosen'));
    }

    public function nilaiHasilUjian()
    {
        $id_penjadwalan = 2;
        $bobotNilai = PertanyaanPendadaran::all()->pluck('bobot');

        $nilaiPembimbing = NilaiPendadaran::where('option', 'pembimbing')
            ->where('id_penjadwalan', $id_penjadwalan)
            ->pluck('nilai');
        $countArrPembimbing = count($nilaiPembimbing);

        $nilaiPenguji1 = NilaiPendadaran::where('option', 'penguji1')
            ->where('id_penjadwalan', $id_penjadwalan)
            ->pluck('nilai');
        $countArrPenguji1 = count($nilaiPenguji1);

        $nilaiPenguji2 = NilaiPendadaran::where('option', 'penguji2')
            ->where('id_penjadwalan', $id_penjadwalan)
            ->pluck('nilai');
        $countArrPenguji2 = count($nilaiPenguji2);

        $hitungPembimbing   = new NilaiMahasiswa;
        $hitungPenguji1     = new NilaiMahasiswa;
        $hitungPenguji2     = new NilaiMahasiswa;

        $hasilNilaiPembimbing   = $hitungPembimbing->nilaiPendadaran($countArrPembimbing, $nilaiPembimbing, $bobotNilai) * 0.5;
        $hasilNilaiPenguji1     = $hitungPenguji1->nilaiPendadaran($countArrPenguji1, $nilaiPenguji1, $bobotNilai) * 0.25;
        $hasilNilaiPenguji2     = $hitungPenguji2->nilaiPendadaran($countArrPenguji2, $nilaiPenguji2, $bobotNilai) * 0.25;

        $totalNilai = $hasilNilaiPembimbing + $hasilNilaiPenguji1 + $hasilNilaiPenguji2;
        dd($totalNilai);
    }
}
