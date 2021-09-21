<?php

namespace App\Http\Controllers\Superadmin;

use App\Helpers\NilaiMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Calendar;
use Illuminate\Http\Request;
use App\Models\Topikskripsi;
use App\Models\Mahasiswa;
use App\Models\NilaiPendadaran;
use App\Models\NilaiSemprop;
use App\Models\PertanyaanPendadaran;
use App\Models\SubPertanyaanPendadaran;
use App\Models\JadwalDosen;
use App\Models\DosenTerjadwal;
use App\Models\Penjadwalan;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Null_;
use Carbon\Carbon;
use App\Mail\EmailJadwalUjian;
use App\Models\GoogleMeet;
use Illuminate\Support\Facades\Mail as FacadesMail;

class PenjadwalanController extends Controller
{
    // Function untuk menampilkan data mahasiswa metopen dan skripsi include filter status mahasiswa
    public function dataMahasiswa(Request $request)
    {
        $statusMahasiswa = [
            '0' => 'On Progres Metopen',
            '1' => 'Ready to Schedule Semprop',
            '2' => 'On Progres Skripsi',
            '3' => 'Ready to Schedule Pendadaran'
        ];
        $topikSkripsi = Topikskripsi::where('status', 'Accept')
            ->whereNotNull('dosen_penguji_1')
            ->whereNotNull('dosen_penguji_2')
            ->orderBy('id', 'desc');
        $filter = $request->get('filter' ?? '');

        if (strlen($filter) > 0) {
            if (strlen($filter) > 0) $topikSkripsi
                ->where('status_mahasiswa', $filter)
                ->where('status', 'Accept');
        }
        $data = $topikSkripsi->get();
        return view('pages.superadmin.penjadwalan.dataMahasiswa', ['page' => 'Data Mahasiswa Metopen & Skripsi'], compact('data', 'filter', 'statusMahasiswa'));
    }

    // Funftion untuk menampilkan detail mahasiswa/i
    public function detailMahasiswa($id)
    {
        $data = Topikskripsi::findOrFail($id);
        // dd($data);
        return view('pages.superadmin.penjadwalan.detailMahasiswa', ['page' => 'Detail Mahasiswa Metopen & Skripsi'], compact('data'));
    }

    // Function untuk menampilkan kalendar penjadwalan seminar proposal
    public function jadwalSempropById($id)
    {
        $data = Topikskripsi::findOrFail($id);
        $linkGoogleMeetTerpakai = Penjadwalan::select('meet_room')
            ->where('date', '>=', date('Y-m-d'))
            ->get();
        $dataLink = [];
        foreach ($linkGoogleMeetTerpakai as $item) {
            $dataLink[] = $item->meet_room;
        }

        if (count($linkGoogleMeetTerpakai) > 0) {
            $linkGoogleMeetTersedia = GoogleMeet::whereNotIn('title_room', $dataLink)->get();
        } else {
            $linkGoogleMeetTersedia = GoogleMeet::all();
        }
        return view('pages.superadmin.penjadwalan.penjadwalanSempropById', ['page' => 'Tetapkan jadwal seminar proposal untuk'], compact('data', 'linkGoogleMeetTersedia'));
    }

    // Function untuk menampilkan kalendar penjadwalan pendadaran
    public function jadwalPendadaranById($id)
    {
        $data = Topikskripsi::findOrFail($id);
        $linkGoogleMeetTerpakai = Penjadwalan::select('meet_room')
            ->where('date', '>=', date('Y-m-d'))
            ->get();
        $dataLink = [];
        foreach ($linkGoogleMeetTerpakai as $item) {
            $dataLink[] = $item->meet_room;
        }

        if (count($linkGoogleMeetTerpakai) > 0) {
            $linkGoogleMeetTersedia = GoogleMeet::whereNotIn('title_room', $dataLink)->get();
        } else {
            $linkGoogleMeetTersedia = GoogleMeet::all();
        }
        return view('pages.superadmin.penjadwalan.penjadwalanPendadaranById', ['page' => 'Tetapkan jadwal pendadaran untuk'], compact('data', 'linkGoogleMeetTersedia'));
    }

    // Function untuk mengkonversi hari dari format kalendar ke format yang di buat dalam database
    public function GetHari(Request $request)
    {
        if (substr($request->hari, 0, 3) == 'Sun') {
            $hari      = 'minggu';
        } elseif (substr($request->hari, 0, 3) == 'Mon') {
            $hari       = 'senin';
        } elseif (substr($request->hari, 0, 3) == 'Tue') {
            $hari       = 'selasa';
        } elseif (substr($request->hari, 0, 3) == 'Wed') {
            $hari       = 'rabu';
        } elseif (substr($request->hari, 0, 3) == 'Thu') {
            $hari       = 'kamis';
        } elseif (substr($request->hari, 0, 3) == 'Fri') {
            $hari       = 'jumat';
        } elseif (substr($request->hari, 0, 3) == 'Sat') {
            $hari       = 'sabtu';
        }
        return $hari;
    }

    // Function untuk menampung array jam ujian
    public function arrayTime(Request $request)
    {
        $waktuMulai = array(
            '1'    => '07:00 - 07:50',
            '2'    => '07:50 - 08:40',
            '3'    => '08:45 - 09:35',
            '4'    => '09:35 - 10:25',
            '5'    => '10:30 - 11:20',
            '6'    => '11:20 - 12:10',
            '7'    => '12:30 - 13:20',
            '8'    => '13:20 - 14:10',
            '9'    => '14:15 - 15:05',
            '10'    => '15:15 - 16:05',
        );
        return $waktuMulai;
    }

    // Function generate jadwal untuk mencari rekomendasi jadwal pendadaran yang dapat di gunakan
    public function generateJadwalPendadaran(Request $request)
    {
        $this->validate($request, [
            'id'        => 'required',
            'hari'      => 'required'
        ]);

        $data = TopikSkripsi::findOrFail($request->id);
        $hari = $this->GetHari($request);
        $waktuMulai = $this->arrayTime($request);

        // Ambil ID Dosen pembimbing yang akan di jadwalkan, relasi dari jadwal dosen dan topik skripsi
        $jadwalDosenPembimbing      = JadwalDosen::where('nipy', $data['nipy'])->get();
        $jadwalDosenPenguji1        = JadwalDosen::where('nipy', $data['dosen_penguji_1'])->get();
        $jadwalDosenPenguji2        = JadwalDosen::where('nipy', $data['dosen_penguji_2'])->get();

        // Eloquent ambil jadwal dosen yang sudah terdaftar pada tabel dosen terjadwal where date and id dosen
        $dosenPembimbingTerjadwal   = DosenTerjadwal::where('nipy', $data['nipy'])->where('date', $request->date)->get();
        $dosenPenguji1Terjadwal     = DosenTerjadwal::where('nipy', $data['dosen_penguji_1'])->where('date', $request->date)->get();
        $dosenPenguji2Terjadwal     = DosenTerjadwal::where('nipy', $data['dosen_penguji_2'])->where('date', $request->date)->get();

        $waktuTerpakai = array();
        // JADWAL DOSEN PENGUJI 1 TERJADWAL 
        foreach ($dosenPembimbingTerjadwal as $pembimbingTerjadwal) {
            $waktuTerpakai[$pembimbingTerjadwal->jam_ke]      = Null;
            $waktuTerpakai[$pembimbingTerjadwal->jam_ke + 1]  = Null;
            $waktuTerpakai[$pembimbingTerjadwal->jam_ke + 2]  = Null;
        }

        // JADWAL DOSEN PENGUJI 1 TERJADWAL 
        foreach ($dosenPenguji1Terjadwal as $penguji1Terjadwal) {
            $waktuTerpakai[$penguji1Terjadwal->jam_ke]      = Null;
            $waktuTerpakai[$penguji1Terjadwal->jam_ke + 1]  = Null;
            $waktuTerpakai[$penguji1Terjadwal->jam_ke + 2]  = Null;
        }

        // JADWAL DOSEN PENGUJI 2 TERJADWAL
        foreach ($dosenPenguji2Terjadwal as $penguji2Terjadwal) {
            $waktuTerpakai[$penguji2Terjadwal->jam_ke]      = Null;
            $waktuTerpakai[$penguji2Terjadwal->jam_ke + 1]  = Null;
            $waktuTerpakai[$penguji2Terjadwal->jam_ke + 2]  = Null;
        }

        // DOSEN PEMBIMBING
        foreach ($jadwalDosenPembimbing as $pembimbing) {
            if ($pembimbing->$hari == 1) {
                $waktuTerpakai[$pembimbing->jam_ke]  = Null;
            }
        }

        // DOSEN PENGUJI 1
        foreach ($jadwalDosenPenguji1 as $penguji1) {
            if ($penguji1->$hari == 1) {
                $waktuTerpakai[$penguji1->jam_ke]  = Null;
            }
        }

        // DOSEN PENGUJI 2
        foreach ($jadwalDosenPenguji2 as $penguji2) {
            if ($penguji2->$hari == 1) {
                $waktuTerpakai[$penguji2->jam_ke]  = Null;
            }
        }

        $waktuTersedia = array();
        foreach ($waktuTerpakai as $waktu => $value) {
            if ($waktu == 1) {
                $waktuTersedia[1]   = Null;
            }
            if ($waktu == 2) {
                $waktuTersedia[2]   = Null;
            }
            if ($waktu == 3) {
                $waktuTersedia[3]   = Null;
            }
            if ($waktu == 4) {
                $waktuTersedia[4]   = Null;
            }
            if ($waktu == 5) {
                $waktuTersedia[5]   = Null;
            }
            if ($waktu == 6) {
                $waktuTersedia[6]   = Null;
            }
            if ($waktu == 7) {
                $waktuTersedia[7]   = Null;
            }
            if ($waktu == 8) {
                $waktuTersedia[8]   = Null;
            }
            if ($waktu == 9) {
                $waktuTersedia[9]   = Null;
            }
            if ($waktu == 10) {
                $waktuTersedia[10]   = Null;
            }
        }

        $jadwalTersedia = array_diff_key($waktuMulai, $waktuTersedia);
        $tampungArray = [];
        foreach ($jadwalTersedia as $key => $value) {
            if (isset($jadwalTersedia[$key + 1]) && isset($jadwalTersedia[$key + 2])) {
                $tampungArray[$key] = $value;
            }
        }

        $option   = '<option value="">--Pilih Jam--</option>';
        foreach ($tampungArray as $key => $value) {
            $option .= '<option value="' . $key . '"> ' . substr($value, 0, 5)  . '</option>';
        }
        echo $option;
    }

    // Function generate jadwal untuk mencari rekomendasi jadwal seminar proposal yang dapat di gunakan
    public function generateJadwalSemprop(Request $request)
    {
        $this->validate($request, [
            'id'        => 'required',
            'hari'      => 'required'
        ]);

        $data = TopikSkripsi::findOrFail($request->id);
        $hari = $this->GetHari($request);
        $waktuMulai = $this->arrayTime($request);

        // Ambil ID Dosen pembimbing yang akan di jadwalkan, relasi dari jadwal dosen dan topik skripsi
        $jadwalDosenPembimbing      = JadwalDosen::where('nipy', $data['nipy'])->get();
        $jadwalDosenPenguji1        = JadwalDosen::where('nipy', $data['dosen_penguji_1'])->get();

        // Eloquent ambil jadwal dosen yang sudah terdaftar pada tabel dosen terjadwal where date and id dosen
        $dosenPembimbingTerjadwal   = DosenTerjadwal::where('nipy', $data['nipy'])->where('date', $request->date)->get();
        $dosenPenguji1Terjadwal     = DosenTerjadwal::where('nipy', $data['dosen_penguji_1'])->where('date', $request->date)->get();

        $waktuTerpakai = array();
        // JADWAL DOSEN PENGUJI 1 TERJADWAL 
        foreach ($dosenPembimbingTerjadwal as $pembimbingTerjadwal) {
            $waktuTerpakai[$pembimbingTerjadwal->jam_ke]      = Null;
            $waktuTerpakai[$pembimbingTerjadwal->jam_ke + 1]  = Null;
            $waktuTerpakai[$pembimbingTerjadwal->jam_ke + 2]  = Null;
        }

        // JADWAL DOSEN PENGUJI 1 TERJADWAL 
        foreach ($dosenPenguji1Terjadwal as $penguji1Terjadwal) {
            $waktuTerpakai[$penguji1Terjadwal->jam_ke]      = Null;
            $waktuTerpakai[$penguji1Terjadwal->jam_ke + 1]  = Null;
            $waktuTerpakai[$penguji1Terjadwal->jam_ke + 2]  = Null;
        }

        // DOSEN PEMBIMBING
        foreach ($jadwalDosenPembimbing as $pembimbing) {
            if ($pembimbing->$hari == 1) {
                $waktuTerpakai[$pembimbing->jam_ke]  = Null;
            }
        }

        // DOSEN PENGUJI 1
        foreach ($jadwalDosenPenguji1 as $penguji) {
            if ($penguji->$hari == 1) {
                $waktuTerpakai[$penguji->jam_ke]  = Null;
            }
        }

        $waktuTersedia = array();
        foreach ($waktuTerpakai as $waktu => $value) {
            if ($waktu == 1) {
                $waktuTersedia[1]   = Null;
            }
            if ($waktu == 2) {
                $waktuTersedia[2]   = Null;
            }
            if ($waktu == 3) {
                $waktuTersedia[3]   = Null;
            }
            if ($waktu == 4) {
                $waktuTersedia[4]   = Null;
            }
            if ($waktu == 5) {
                $waktuTersedia[5]   = Null;
            }
            if ($waktu == 6) {
                $waktuTersedia[6]   = Null;
            }
            if ($waktu == 7) {
                $waktuTersedia[7]   = Null;
            }
            if ($waktu == 8) {
                $waktuTersedia[8]   = Null;
            }
            if ($waktu == 9) {
                $waktuTersedia[9]   = Null;
            }
            if ($waktu == 10) {
                $waktuTersedia[10]   = Null;
            }
        }

        $jadwalTersedia = array_diff_key($waktuMulai, $waktuTersedia);
        $tampungArray = [];
        foreach ($jadwalTersedia as $key => $value) {
            if (isset($jadwalTersedia[$key + 1]) && isset($jadwalTersedia[$key + 2])) {
                $tampungArray[$key] = $value;
            }
        }

        $option   = '<option value="">--Pilih Jam--</option>';
        foreach ($tampungArray as $key => $value) {
            $option .= '<option value="' . $key . '"> ' . substr($value, 0, 5)  . '</option>';
        }
        echo $option;
    }

    #Function untuk menyimpan jadwal pendadaran 
    public function storeJadwalSempropDanPendadaran(Request $request, $condition)
    {
        $this->validate($request, [
            'date'              => 'required',
            'topik_skripsi_id'  => 'required',
            'waktu_mulai'       => 'required',
        ]);

        $nipyDosenPembimbing    = $request->nipyDosenPembimbing;
        $nipyDosenPenguji1      = $request->nipyDosenPenguji1;
        $nipyDosenPenguji2      = $request->nipyDosenPenguji2;
        $jenisUjian             = $request->jenis_ujian;

        $validasiTopikTerdaftar = Penjadwalan::orderBy('id', 'DESC')->where('topik_skripsi_id', $request->topik_skripsi_id)->first();
        if ($validasiTopikTerdaftar != null && $validasiTopikTerdaftar->jenis_ujian == $jenisUjian) {
            return back()->with('alert-failed', 'Topik ini Telah Terdaftar Ujian');
        }

        // dd(strtotime($validasiTopikTerdaftar->date), strtotime($request->date));

        $validasiJamPenuh  = Penjadwalan::where('date', $request->date)->get();
        if (count($validasiJamPenuh) >= 4) {
            return back()->with('alert-failed', 'Jadwal Ujian pada hari tersebut telah terisi penuh');
        }

        // Set jam mulai berdasarkan inputan di calender
        if ($request->waktu_mulai == 1) {
            $waktuMulai    = '07:00';
        } elseif ($request->waktu_mulai == 2) {
            $waktuMulai    = '07:50';
        } elseif ($request->waktu_mulai == 3) {
            $waktuMulai    = '08:45';
        } elseif ($request->waktu_mulai == 4) {
            $waktuMulai    = '09:35';
        } elseif ($request->waktu_mulai == 5) {
            $waktuMulai    = '10:30';
        } elseif ($request->waktu_mulai == 6) {
            $waktuMulai    = '11:20';
        } elseif ($request->waktu_mulai == 7) {
            $waktuMulai    = '12:30';
        } elseif ($request->waktu_mulai == 8) {
            $waktuMulai   = '13:20';
        } elseif ($request->waktu_mulai == 9) {
            $waktuMulai    = '14:15';
        } elseif ($request->waktu_mulai == 10) {
            $waktuMulai    = '15:15';
        }

        // Set 3 jam untuk satu kali penjadwalan
        if ($request->waktu_mulai == 1) {
            $selesai   = 3;
            $waktuSelesai    = '09:35';
        }

        if ($request->waktu_mulai == 2) {
            $selesai   = 4;
            $waktuSelesai    = '10:25';
        }

        if ($request->waktu_mulai == 3) {
            $selesai   = 5;
            $waktuSelesai    = '11:20';
        }

        if ($request->waktu_mulai == 4) {
            $selesai   = 6;
            $waktuSelesai    = '12:10';
        }

        if ($request->waktu_mulai == 5) {
            $selesai   = 7;
            $waktuSelesai    = '13:20';
        }

        if ($request->waktu_mulai == 6) {
            $selesai   = 8;
            $waktuSelesai    = '14:10';
        }

        if ($request->waktu_mulai == 7) {
            $selesai   = 9;
            $waktuSelesai    = '15:05';
        }

        if ($request->waktu_mulai == 8) {
            $selesai   = 10;
            $waktuSelesai    = '16:05';
        }

        if ($request->waktu_mulai == 9) {
            $selesai   = 11;
            $waktuSelesai    = '17:00';
        }

        if ($request->waktu_mulai == 10) {
            $selesai   = 12;
            $waktuSelesai    = '17:50';
        }


        $condition == 'create' ? $data = new Penjadwalan : $data = Penjadwalan::findOrFail($request->id);
        $data->topik_skripsi_id = $request->topik_skripsi_id;
        $data->date             = $request->date;
        $data->kode_jam_mulai   = $request->waktu_mulai;
        $data->kode_jam_selesai = $selesai;
        $data->waktu_mulai      = $waktuMulai;
        $data->waktu_selesai    = $waktuSelesai;
        $data->jenis_ujian      = $jenisUjian;
        $data->meet_room        = $request->link;
        $data->save();

        $this->simpanJadwalDosenTerdaftar($nipyDosenPembimbing, $nipyDosenPenguji1, $nipyDosenPenguji2, $data);

        // $this->sendCalendarEvent($data);
        // $this->sendMailNotificationSchedule($data);

        return redirect('dataPenjadwalan')->with('alert-success', 'Jadwal Berhasil Ditetapkan');
    }

    #Function untuk menyimpan jadwal dosen yang telah terdaftr sebagai tim penguji semprop/pendadaran
    public function simpanJadwalDosenTerdaftar($nipyDosenPembimbing, $nipyDosenPenguji1, $nipyDosenPenguji2, $data)
    {
        $dosenTerjadwalSemprop = [
            ['nipy' => $nipyDosenPembimbing, 'penjadwalan_id' => $data->id, 'date' => $data->date, 'jam_ke' => $data->kode_jam_mulai],
            ['nipy' => $nipyDosenPenguji1,  'penjadwalan_id' => $data->id, 'date' => $data->date, 'jam_ke' => $data->kode_jam_mulai],
        ];

        $dosenTerjadwalPendaadaran = [
            ['nipy' => $nipyDosenPembimbing, 'penjadwalan_id' => $data->id, 'date' => $data->date, 'jam_ke' => $data->kode_jam_mulai],
            ['nipy' => $nipyDosenPenguji1,  'penjadwalan_id' => $data->id, 'date' => $data->date, 'jam_ke' => $data->kode_jam_mulai],
            ['nipy' => $nipyDosenPenguji2, 'penjadwalan_id' => $data->id, 'date' => $data->date, 'jam_ke' => $data->kode_jam_mulai]
        ];

        if ($data->jenis_ujian == 0) {
            DosenTerjadwal::insert($dosenTerjadwalSemprop);
        } else {
            DosenTerjadwal::insert($dosenTerjadwalPendaadaran);
        }
    }

    #Function untuk menampilkan data ujian di calendar penjadwalan seminar proposal
    public function eventUjianSemprop()
    {
        $data = Penjadwalan::where('jenis_ujian', 0)->get();
        $calendar = array();

        foreach ($data as $item) {
            $event = array(
                'title' => $item->topikSkripsi->mahasiswaSubmit->user->name,
                'start' => $item->date . 'T' . $item->waktu_mulai,
                'end'   => $item->date . 'T' . $item->waktu_selesai,
                'backgroundColor' => '#0073b7'
            );
            array_push($calendar, $event);
        }
        return json_encode($calendar);
    }

    #Function untuk menampilkan data ujian di calendar penjadwalan pendadaran
    public function eventUjianPendadaran()
    {
        $data = Penjadwalan::where('jenis_ujian', 1)->get();
        $calendar = array();

        foreach ($data as $item) {
            $event = array(
                'title' => $item->topikSkripsi->mahasiswaSubmit->user->name,
                'start' => $item->date . 'T' . $item->waktu_mulai,
                'end'   => $item->date . 'T' . $item->waktu_selesai,
                'backgroundColor' => '#0073b7'
            );
            array_push($calendar, $event);
        }
        return json_encode($calendar);
    }

    #Function untuk menampilkan data penjadwalan secara keseluruhan dengan filter jenis ujian (semprop/pendadaran)
    public function dataPenjadwalan(Request $request)
    {
        $status_ujian = [
            '0' => 'Ujian Seminar Proposal',
            '1' => 'Ujian Pendadaran Tugas Akhir'
        ];
        $dataPenjadwalan = Penjadwalan::orderBy('id', 'desc');
        $filter = $request->get('filter' ?? '');
        if (strlen($filter) > 0) {
            if (strlen($filter) > 0) $dataPenjadwalan->where('jenis_ujian', $filter);
        }
        $data = $dataPenjadwalan->get();

        return view('pages.superadmin.penjadwalan.dataPenjadwalan', ['page' => 'Data Penjadwalan'], compact('data', 'status_ujian', 'filter'));
    }

    #Function untuk menampilkan data penjadwalan secara detail
    public function detailDataPenjadwalan($id)
    {
        $data = Penjadwalan::findOrFail($id);

        $nilaiPenguji = NilaiSemprop::where('option', 'penguji1')
            ->where('id_penjadwalan', $id)
            ->pluck('nilai');
        $countArrPenguji = count($nilaiPenguji);

        $nilaiPembimbing = NilaiSemprop::where('option', 'pembimbing')
            ->where('id_penjadwalan', $id)
            ->pluck('nilai');
        $arrLengthValue = count($nilaiPembimbing);


        $penguji = new NilaiMahasiswa;
        $valuePenguji = $penguji->nilai_semprop($countArrPenguji, $nilaiPenguji) * 0.5;


        $pembimbing = new NilaiMahasiswa;
        $valuePembimbing = $pembimbing->nilai_semprop($arrLengthValue, $nilaiPembimbing) * 0.5;

        $totalNilaiSempro = $valuePembimbing + $valuePenguji;
        // dd($totalNilaiSempro);

        // ===========================Nilai Pendadaran==============================

        $bobotNilai = PertanyaanPendadaran::all()->pluck('bobot');

        $nilaiPembimbingPendadaran = NilaiPendadaran::where('option', 'pembimbing')
            ->where('id_penjadwalan', $id)
            ->pluck('nilai');
        $countArrPembimbing = count($nilaiPembimbingPendadaran);

        $nilaiPenguji1Pendadaran = NilaiPendadaran::where('option', 'penguji1')
            ->where('id_penjadwalan', $id)
            ->pluck('nilai');
        $countArrPenguji1 = count($nilaiPenguji1Pendadaran);

        $nilaiPenguji2Pendadaran = NilaiPendadaran::where('option', 'penguji2')
            ->where('id_penjadwalan', $id)
            ->pluck('nilai');
        $countArrPenguji2 = count($nilaiPenguji2Pendadaran);

        $hitungPembimbing   = new NilaiMahasiswa;
        $hitungPenguji1     = new NilaiMahasiswa;
        $hitungPenguji2     = new NilaiMahasiswa;

        $hasilNilaiPembimbing   = $hitungPembimbing->nilaiPendadaran($countArrPembimbing, $nilaiPembimbingPendadaran, $bobotNilai) * 0.5;
        $hasilNilaiPenguji1     = $hitungPenguji1->nilaiPendadaran($countArrPenguji1, $nilaiPenguji1Pendadaran, $bobotNilai) * 0.25;
        $hasilNilaiPenguji2     = $hitungPenguji2->nilaiPendadaran($countArrPenguji2, $nilaiPenguji2Pendadaran, $bobotNilai) * 0.25;

        $totalNilaiPendadaran = $hasilNilaiPembimbing + $hasilNilaiPenguji1 + $hasilNilaiPenguji2;
        return view('pages.superadmin.penjadwalan.detailDataPenjadwalan', ['page' => 'Detail Penjadwalan'], compact('data', 'totalNilaiPendadaran', 'totalNilaiSempro'));
    }

    #Function untuk menghapus data yang telah di jadwalkan
    public function deleteJadwal($id)
    {
        Penjadwalan::destroy($id);
        return redirect('/dataPenjadwalan/')->with('alert-success', 'Jadwal Berhasil Dihapus');
    }

    #Function untuk menampilkan jadwal seminar proposal yang akan di ubah by ID
    public function updateJadwalSemprop($id)
    {
        $data = Penjadwalan::find($id);
        $linkGoogleMeetTerpakai = Penjadwalan::select('meet_room')
            ->where('date', '>=', date('Y-m-d'))
            ->get();
        $dataLink = [];
        foreach ($linkGoogleMeetTerpakai as $item) {
            $dataLink[] = $item->meet_room;
        }

        if (count($linkGoogleMeetTerpakai) > 0) {
            $linkGoogleMeetTersedia = GoogleMeet::whereNotIn('title_room', $dataLink)->get();
        } else {
            $linkGoogleMeetTersedia = GoogleMeet::all();
        }
        return view('pages.superadmin.penjadwalan.updateJadwalSemprop', ['page' => 'Update jadwal ujian seminar proposal'], compact('data', 'linkGoogleMeetTersedia'));
    }

    #Function untuk menampilkan jadwal ujian pendadaran yang akan di ubah by ID
    public function updateJadwalPendadaran($id)
    {
        $data = Penjadwalan::find($id);
        $linkGoogleMeetTerpakai = Penjadwalan::select('meet_room')
            ->where('date', '>=', date('Y-m-d'))
            ->get();
        $dataLink = [];
        foreach ($linkGoogleMeetTerpakai as $item) {
            $dataLink[] = $item->meet_room;
        }

        if (count($linkGoogleMeetTerpakai) > 0) {
            $linkGoogleMeetTersedia = GoogleMeet::whereNotIn('title_room', $dataLink)->get();
        } else {
            $linkGoogleMeetTersedia = GoogleMeet::all();
        }
        return view('pages.superadmin.penjadwalan.updateJadwalPendadaran', ['page' => 'Update jadwal ujian Pendadaran'], compact('data', 'linkGoogleMeetTersedia'));
    }

    #Function untuk menyimpan jadwal seminar proposal & Pendadaran saat dilakukanya update
    public function simpanJadwalTerupdate(Request $request, $id)
    {
        $this->validate($request, [
            'date'              => 'required',
            'topik_skripsi_id'  => 'required',
            'waktu_mulai'       => 'required',
        ]);

        $nipyDosenPembimbing    = $request->nipyDosenPembimbing;
        $nipyDosenPenguji1      = $request->nipyDosenPenguji1;
        $nipyDosenPenguji2      = $request->nipyDosenPenguji2;
        $jenisUjian             = $request->jenis_ujian;

        $jadwalDay  = Penjadwalan::where('date', $request->date)->get();
        if (count($jadwalDay) >= 4) {
            return back()->with('alert-gagal', 'Maaf, Jadwal Ujian pada hari tersebut telah terisi penuh');
        }

        // Set jam mulai berdasarkan inputan di calender
        if ($request->waktu_mulai == 1) {
            $waktuMulai    = '07:00';
        } elseif ($request->waktu_mulai == 2) {
            $waktuMulai    = '07:50';
        } elseif ($request->waktu_mulai == 3) {
            $waktuMulai    = '08:45';
        } elseif ($request->waktu_mulai == 4) {
            $waktuMulai    = '09:35';
        } elseif ($request->waktu_mulai == 5) {
            $waktuMulai    = '10:30';
        } elseif ($request->waktu_mulai == 6) {
            $waktuMulai    = '11:20';
        } elseif ($request->waktu_mulai == 7) {
            $waktuMulai    = '12:30';
        } elseif ($request->waktu_mulai == 8) {
            $waktuMulai   = '13:20';
        } elseif ($request->waktu_mulai == 9) {
            $waktuMulai    = '14:15';
        } elseif ($request->waktu_mulai == 10) {
            $waktuMulai    = '15:15';
        }

        // Set 3 jam untuk satu kali penjadwalan
        if ($request->waktu_mulai == 1) {
            $selesai   = 3;
            $waktuSelesai    = '09:35';
        }

        if ($request->waktu_mulai == 2) {
            $selesai   = 4;
            $waktuSelesai    = '10:25';
        }

        if ($request->waktu_mulai == 3) {
            $selesai   = 5;
            $waktuSelesai    = '11:20';
        }

        if ($request->waktu_mulai == 4) {
            $selesai   = 6;
            $waktuSelesai    = '12:10';
        }

        if ($request->waktu_mulai == 5) {
            $selesai   = 7;
            $waktuSelesai    = '13:20';
        }

        if ($request->waktu_mulai == 6) {
            $selesai   = 8;
            $waktuSelesai    = '14:10';
        }

        if ($request->waktu_mulai == 7) {
            $selesai   = 9;
            $waktuSelesai    = '15:05';
        }

        if ($request->waktu_mulai == 8) {
            $selesai   = 10;
            $waktuSelesai    = '16:05';
        }

        if ($request->waktu_mulai == 9) {
            $selesai   = 11;
            $waktuSelesai    = '17:00';
        }

        if ($request->waktu_mulai == 10) {
            $selesai   = 12;
            $waktuSelesai    = '17:50';
        }

        $topikSkripsi   = Topikskripsi::find($request->topik_skripsi_id);
        $data           = $topikSkripsi->penjadwalan;

        $data->update([
            'date'              => $request->date,
            'waktu_mulai'       => $waktuMulai,
            'waktu_selesai'     => $waktuSelesai,
            'kode_jam_mulai'    => $request->waktu_mulai,
            'kode_jam_selesai'  => $selesai,
            'meet_room'         => $request->link,
            'jenis_ujian'       => $jenisUjian
        ]);

        DosenTerjadwal::where('penjadwalan_id', $data->id)->delete();

        $this->simpanJadwalDosenTerdaftar($nipyDosenPembimbing, $nipyDosenPenguji1, $nipyDosenPenguji2, $data);

        // $this->sendCalendarEvent($data);
        // $this->sendMailNotificationSchedule($data);

        return redirect('dataPenjadwalan')->with('alert-success', 'Jadwal Berhasil Diubah');
    }


    #Function untuk mengirim event ujian seminar proposal atau pendadaran ke google calendar
    private function sendCalendarEvent($data)
    {
        $tanggal        = $data['date'];
        $waktuMulai     = $data['waktu_mulai'];
        $waktuSelesai   = $data['waktu_selesai'];

        $dataTopikSkripsi = TopikSkripsi::find($data->topik_skripsi_id);
        if (!$dataTopikSkripsi) {
            return false;
        }

        if ($dataTopikSkripsi->mahasiswaSubmit) {
            $emailMahasiswa = $dataTopikSkripsi->mahasiswaSubmit->user->email;
        } elseif ($dataTopikSkripsi->mahasiswaTerpilih) {
            $emailMahasiswa = $dataTopikSkripsi->mahasiswaTerpilih->user->email;
        }

        if ($dataTopikSkripsi->mahasiswaSubmit) {
            $namaMahasiswa = $dataTopikSkripsi->mahasiswaSubmit->user->name;
        } elseif ($dataTopikSkripsi->mahasiswaTerpilih) {
            $namaMahasiswa = $dataTopikSkripsi->mahasiswaTerpilih->user->name;
        }

        $dataSemprop = [
            'location' => $data->linkGoogleMeet->link_google_meet,
            'times' => [
                'start' => "{$tanggal}T{$waktuMulai}:00+07:00",
                'end' => "{$tanggal}T{$waktuSelesai}:00+07:00",
            ],
            'attendees' => [
                ['email' => $dataTopikSkripsi->dosen->user->email],
                ['email' => $dataTopikSkripsi->dosenPenguji1->user->email],
                ['email' => $emailMahasiswa],
            ],
            'description' => '<div><strong>Assalamualaikum Warahmatullahi Wabarakatuh</strong><br>' . "\n" .
                'Berikut terlampir data Seminar Proposal. Semprop dilaksanakan secara online dengan host utama Penguji.' . "\n" .
                'Mahasiswa dan Pembimbing dapat bergabung ke room Google Meet pada undangan ini secara bergantian sesuai dengan waktu yang tertera.' . "\n" .
                '</div>
                        <table border="0">
                            <tr>
                                <td><strong>Pembimbing</strong></td>
                                <td> : ' . $dataTopikSkripsi->dosen->user->name . '</td>
                            </tr>
                            <tr>
                                <td><strong>Penguji</strong></td>
                                <td> : ' . $dataTopikSkripsi->dosenPenguji1->user->name . '</td>
                            </tr>
                            <tr>
                                <td><strong>Mahasiswa</strong></td>
                                <td> : ' . $namaMahasiswa . '</td>
                            </tr>
                        </table>' . "\n" .
                '<div>Segala bentuk perubahan waktu pelaksanaan dan teknis menjadi tanggung jawab Pembimbing, Penguji dan Mahasiswa untuk mengatur jadwal yang disepakati bersama.<br>' . "\n" .
                'Demikian udangan ini disampaikan, agar dapat dilaksanakan sesuai ketentuan.<br>' . "\n" .
                'Wassalamualaikum Warahmatullahi Wabarakatuh</div>'
        ];

        $dataPendadaran = [
            'location' => $data->linkGoogleMeet->link_google_meet,
            'times' => [
                'start' => "{$tanggal}T{$waktuMulai}:00+07:00",
                'end' => "{$tanggal}T{$waktuSelesai}:00+07:00",
            ],
            'attendees' => [
                ['email' => $dataTopikSkripsi->dosen->user->email],
                ['email' => $dataTopikSkripsi->dosenPenguji1->user->email],
                ['email' => $dataTopikSkripsi->dosenPenguji2->user->email],
                ['email' => $emailMahasiswa],
            ],
            'attendees' => [
                ['email' => $dataTopikSkripsi->dosen->user->email],
                ['email' => $dataTopikSkripsi->dosenPenguji1->user->email],
                ['email' => $dataTopikSkripsi->dosenPenguji2->user->email],
                ['email' => $emailMahasiswa],
            ],
            'description' => '<div><strong>Assalamualaikum Warahmatullahi Wabarakatuh</strong><br>' . "\n" .
                'Berikut terlampir data Ujian Pendadaran Tugas Akhir. Pendadaran dilaksanakan secara online dengan host utama Penguji.' . "\n" .
                'Mahasiswa dan Pembimbing dapat bergabung ke room Google Meet pada undangan ini secara bergantian sesuai dengan waktu yang tertera.' . "\n" .
                '</div>
                        <table border="0">
                            <tr>
                                <td><strong>Pembimbing</strong></td>
                                <td> : ' . $dataTopikSkripsi->dosen->user->name . '</td>
                            </tr>
                            <tr>
                                <td><strong>Penguji 1</strong></td>
                                <td> : ' . $dataTopikSkripsi->dosenPenguji1->user->name . '</td>
                            </tr>
                            <tr>
                                <td><strong>Penguji 2</strong></td>
                                <td> : ' . $dataTopikSkripsi->dosenPenguji2->user->name . '</td>
                            </tr>
                            <tr>
                                <td><strong>Mahasiswa</strong></td>
                                <td> : ' . $namaMahasiswa . '</td>
                            </tr>
                        </table>' . "\n" .
                '<div>Segala bentuk perubahan waktu pelaksanaan dan teknis menjadi tanggung jawab Pembimbing, Penguji dan Mahasiswa untuk mengatur jadwal yang disepakati bersama.<br>' . "\n" .
                'Demikian udangan ini disampaikan, agar dapat dilaksanakan sesuai ketentuan.<br>' . "\n" .
                'Wassalamualaikum Warahmatullahi Wabarakatuh</div>'
        ];

        $calendar = new Calendar;

        if ($data->jenis_ujian == 0) {
            $calendar->sendEvent("Ujian Seminar Proposal", $dataSemprop);
        } elseif ($data->jenis_ujian == 1) {
            $calendar->sendEvent("Ujian Pendadaran Tugas Akhir", $dataPendadaran);
        }
    }

    // Function untuk mengirim email undangan notifikasi ujian seminar proposal dan ujian pendadaran
    private function sendMailNotificationSchedule($data)
    {
        $dataTopikSkripsi = Topikskripsi::find($data->topik_skripsi_id);
        if (!$dataTopikSkripsi) {
            return false;
        }

        if ($dataTopikSkripsi->mahasiswaSubmit) {
            $emailMahasiswa = $dataTopikSkripsi->mahasiswaSubmit->user->email;
        } elseif ($dataTopikSkripsi->mahasiswaTerpilih) {
            $emailMahasiswa = $dataTopikSkripsi->mahasiswaTerpilih->user->email;
        }

        if ($dataTopikSkripsi->mahasiswaSubmit) {
            $namaMahasiswa = $dataTopikSkripsi->mahasiswaSubmit->user->name;
        } elseif ($dataTopikSkripsi->mahasiswaTerpilih) {
            $namaMahasiswa = $dataTopikSkripsi->mahasiswaTerpilih->user->name;
        }

        if ($dataTopikSkripsi->mahasiswaSubmit) {
            $nimMahasiswa = $dataTopikSkripsi->nim_submit;
        } elseif ($dataTopikSkripsi->mahasiswaTerpilih) {
            $nimMahasiswa = $dataTopikSkripsi->nim_terpilih;
        }

        $emailDosenPembimbing    = $dataTopikSkripsi->dosen->user->email;
        $emailDosenPenguji1      = $dataTopikSkripsi->dosenPenguji1->user->email;
        $emailDosenPenguji2      = $dataTopikSkripsi->dosenPenguji2->user->email;
        // dd($emailDosenPembimbing, $emailDosenPenguji1, $emailDosenPenguji2);
        $tanggal                 = $data['date'];
        $tanggal = Carbon::createFromFormat('Y-m-d', $tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY');

        // Send Mail to Mahasiswa
        Mail::to($emailMahasiswa)->send(new EmailJadwalUjian([
            'status'            => 'Mahasiswa',
            'kepada'            => $namaMahasiswa,
            'nim'               => $nimMahasiswa,
            'tanggal'           => $tanggal,
            'nama_mahasiswa'    => $namaMahasiswa,
            'judul_skripsi'     => $dataTopikSkripsi->judul_topik,
            'topik_skripsi'     => $dataTopikSkripsi->topik->nama_topik,
            'periode'           => $dataTopikSkripsi->periode->tahun_periode,
            'waktu_mulai'       => $data->waktu_mulai,
            'waktu_selesai'     => $data->waktu_selesai,
            'ruang_pertemuan'   => $data->meet_room,
            'dosen_pembimbing'  => $dataTopikSkripsi->dosen->user->name,
            'dosen_penguji_1'   => $dataTopikSkripsi->dosenPenguji1->user->name,
            'dosen_penguji_2'   => $dataTopikSkripsi->dosenPenguji2->user->name,
            'link_meet'         => $data->linkGoogleMeet->link_google_meet,
            'jenis_ujian'       => $data->jenis_ujian
        ]));

        // Send Mail to dosen pembimbing
        Mail::to($emailDosenPembimbing)->send(new EmailJadwalUjian([
            'status'            => 'Dosen Pembimbing',
            'kepada'            => $dataTopikSkripsi->dosen->user->name,
            'nim'               => $nimMahasiswa,
            'tanggal'           => $tanggal,
            'nama_mahasiswa'    => $namaMahasiswa,
            'judul_skripsi'     => $dataTopikSkripsi->judul_topik,
            'topik_skripsi'     => $dataTopikSkripsi->topik->nama_topik,
            'periode'           => $dataTopikSkripsi->periode->tahun_periode,
            'waktu_mulai'       => $data->waktu_mulai,
            'waktu_selesai'     => $data->waktu_selesai,
            'ruang_pertemuan'   => $data->meet_room,
            'dosen_pembimbing'  => $dataTopikSkripsi->dosen->user->name,
            'dosen_penguji_1'   => $dataTopikSkripsi->dosenPenguji1->user->name,
            'dosen_penguji_2'   => $dataTopikSkripsi->dosenPenguji2->user->name,
            'link_meet'         => $data->linkGoogleMeet->link_google_meet,
            'jenis_ujian'       => $data->jenis_ujian
        ]));

        // Send Mail to dosen penguji 1
        Mail::to($emailDosenPenguji1)->send(new EmailJadwalUjian([
            'status'            => 'Dosen Penguji 1',
            'kepada'            => $dataTopikSkripsi->dosenPenguji1->user->name,
            'nim'               => $nimMahasiswa,
            'tanggal'           => $tanggal,
            'nama_mahasiswa'    => $namaMahasiswa,
            'judul_skripsi'     => $dataTopikSkripsi->judul_topik,
            'topik_skripsi'     => $dataTopikSkripsi->topik->nama_topik,
            'periode'           => $dataTopikSkripsi->periode->tahun_periode,
            'waktu_mulai'       => $data->waktu_mulai,
            'waktu_selesai'     => $data->waktu_selesai,
            'ruang_pertemuan'   => $data->meet_room,
            'dosen_pembimbing'  => $dataTopikSkripsi->dosen->user->name,
            'dosen_penguji_1'   => $dataTopikSkripsi->dosenPenguji1->user->name,
            'dosen_penguji_2'   => $dataTopikSkripsi->dosenPenguji2->user->name,
            'link_meet'         => $data->linkGoogleMeet->link_google_meet,
            'jenis_ujian'       => $data->jenis_ujian
        ]));

        // Send Mail to dosen penguji 2
        if ($data->jenis_ujian == 1) {
            Mail::to($emailDosenPenguji2)->send(new EmailJadwalUjian([
                'status'            => 'Dosen Penguji 2',
                'kepada'            => $dataTopikSkripsi->dosenPenguji2->user->name,
                'nim'               => $nimMahasiswa,
                'tanggal'           => $tanggal,
                'nama_mahasiswa'    => $namaMahasiswa,
                'judul_skripsi'     => $dataTopikSkripsi->judul_topik,
                'topik_skripsi'     => $dataTopikSkripsi->topik->nama_topik,
                'periode'           => $dataTopikSkripsi->periode->tahun_periode,
                'waktu_mulai'       => $data->waktu_mulai,
                'waktu_selesai'     => $data->waktu_selesai,
                'ruang_pertemuan'   => $data->meet_room,
                'dosen_pembimbing'  => $dataTopikSkripsi->dosen->user->name,
                'dosen_penguji_1'   => $dataTopikSkripsi->dosenPenguji1->user->name,
                'dosen_penguji_2'   => $dataTopikSkripsi->dosenPenguji2->user->name,
                'link_meet'         => $data->linkGoogleMeet->link_google_meet,
                'jenis_ujian'       => $data->jenis_ujian
            ]));
        }
        return true;
    }

    public function tesEmail()
    {
        return view('emails.tesEmail1');
    }
}
