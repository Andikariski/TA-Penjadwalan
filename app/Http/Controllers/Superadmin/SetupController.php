<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setup;
use App\Models\GoogleMeet;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportDataMahasiswa;
use App\Models\Penjadwalan;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hari = Setup::all()->first();
        // dd($hari);
        return view('pages.superadmin.setup.index', compact('hari'));
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
        //
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
        $data = $request->all();
        $item = Setup::findOrFail($id);
        $item->update($data);

        $hari = Setup::all()->first();

        return redirect('/setup')->with('alert-success', 'Data Berhasil di ubah');
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

    public function getDataMahasiswa()
    {
        return view('pages.superadmin.setup.importDataMahasiswa');
    }

    public function importDataMahasiswa(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataMahasiswa', $namaFile);
        Excel::import(new ImportDataMahasiswa, public_path('/DataMahasiswa/' . $namaFile));
        // return redirect('/data-mahasiswa')->with('alert-success', 'Jadwal Berhasil Diimport');
    }

    // Function untuk mengambil semua data link google meet
    public function getlinkGoogleMeet()
    {
        $data   = GoogleMeet::all();
        // $data   = GoogleMeet::orderBy('id', 'DESC')->get();
        $id     = GoogleMeet::select('title_room')->orderBy('title_room', 'desc')->take(1)->first();
        if ($id == null) {
            $nextTitleGoogleMeet = 1;
        } else {
            $nextTitleGoogleMeet = $id['title_room'] + 1;
        }

        return view('pages.superadmin.setup.linkGoogleMeet', ['page' => 'Setup Google Meet'], compact('data', 'nextTitleGoogleMeet'));
    }

    // function untuk menyimpan link google meet yang di input oleh admin
    public function storeGoogleMeet(Request $request)
    {
        $this->validate($request, [
            'title_room'        => 'required',
            'link_google_meet'  => 'required',
        ]);

        $link = new GoogleMeet;
        $link->title_room = $request->title_room;
        $link->link_google_meet = $request->link_google_meet;
        $link->save();
        return redirect('linkGoogleMeet')->with('alert-success', 'Link Google Meet Berhasil Ditambahkan');
    }

    // Function untuk menghapus link google meet
    public function deleteLinkGoogleMeet($id)
    {
        GoogleMeet::destroy($id);
        return redirect('linkGoogleMeet')->with('alert-success', 'Link Google Meet Berhasil Dihapus');
    }
}
