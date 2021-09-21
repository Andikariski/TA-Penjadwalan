<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\JadwalDosen;
use App\Models\Topikskripsi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImpotrJadwalDosen;
use Illuminate\Support\Arr;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Dosen::with(
            ['skripsi' => function ($query) {
                $query->where('status', 'Accept');
            }]
        )
            // ->where('status','Accept')
            ->get();
        // dd($dosen);
        $jumlah_bimbingan = Topikskripsi::where('status', 'Accept');
        // dd($dosen);
        return view('pages.superadmin.index', compact('dosen'));
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
        $data = Topikskripsi::where('nipy', $id)
            ->where('status', 'Accept')
            ->get();

        $dosen = Dosen::where('nipy', $id)->first();
        // dd($dosen->user->name);

        return view('pages.superadmin.viewMahasiswa', compact('data', 'dosen'));
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

    // Function list Dosen yang sudah memiliki jadwal 
    public function jadwalDosen()
    {
        $dosenTerjadwal = JadwalDosen::select('nipy')
            ->groupBy('nipy')->get();

        $data = Dosen::orderBy('nipy', 'desc')->get();
        return view('pages.superadmin.JadwalDosen.listJadwalDosen', compact('data', 'dosenTerjadwal'));
    }

    // Function import jadwal dosen dari file excel ke database program simtakhir
    public function importJadwalDosenExcel(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataJadwalDosen', $namaFile);
        Excel::import(new ImpotrJadwalDosen, public_path('/DataJadwalDosen/' . $namaFile));
        return redirect('/jadwalDosen')->with('alert-success', 'Jadwal Berhasil Diimport');
    }

    // Function add jadwal dosen secara satu persatu where not dosen terjadwal
    public function addJadwalDosen()
    {
        $dosenTerjadwal = JadwalDosen::select('nipy')
            ->groupBy('nipy')->get();

        foreach ($dosenTerjadwal as $item) {
            $data[] = $item->nipy;
        }
        $collection = Dosen::whereNotIn('nipy', $data)->get();
        return view('pages.superadmin.JadwalDosen.tambahJadwalDosen', ['page' => 'Tambah Jadwal Dosen'], compact('collection'));
    }

    // Function untuk menyimpan dan mengupdate data dosen yang di input pada page tambah jadwal dosen
    public function storeJadwalDosen(Request $request, $condition)
    {
        $this->validate($request, [
            'nipy'          => 'required',
            'senin'         => 'required',
            'selasa'        => 'required',
            'rabu'          => 'required',
            'kamis'         => 'required',
            'jumat'         => 'required',
            'sabtu'         => 'required',
        ]);

        $dosenTerjadwal = JadwalDosen::where('nipy', $request->nipy)->first();

        if ($condition == 'create') {
            if ($dosenTerjadwal != null) {
                return back()->with('alert-gagal', 'Jadwal Dosen Telah Ada');
            }
        }
        $countJamDalamSehari = count($request->jam_ke);
        for ($jam = 0; $jam < $countJamDalamSehari; $jam++) {
            $condition == 'create' ? $data = new JadwalDosen : $data = JadwalDosen::findOrFail($request->id[$jam]);
            $data->nipy = $request->nipy;
            $data->senin    = $request->senin[$jam];
            $data->selasa   = $request->selasa[$jam];
            $data->rabu     = $request->rabu[$jam];
            $data->kamis    = $request->kamis[$jam];
            $data->jumat    = $request->jumat[$jam];
            $data->sabtu    = $request->sabtu[$jam];
            $data->jam_ke   = $request->jam_ke[$jam];
            $data->save();
        }
        // dd($countJamDalamSehari);
        if ($condition == 'create') {
            return redirect('/jadwalDosen')->with('alert-success', 'Jadwal Dosen Berhasil Ditambahkan');
        } else {
            return redirect('/jadwalDosen')->with('alert-success', 'Jadwal Dosen Berhasil Diubah');
        }
    }

    // Function update jadwal dosen
    public function updateJadwalDosen($id)
    {
        $dataDosen = Dosen::findOrFail($id);
        $nipyDosen = $dataDosen->nipy;
        $collection = JadwalDosen::where('nipy', $nipyDosen)->get();
        return view('pages.superadmin.JadwalDosen.updateJadwalDosen', ['page' => 'Update Jadwal '], compact('dataDosen', 'collection'));
    }
}
