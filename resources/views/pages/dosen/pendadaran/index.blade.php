@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
                @include('layouts/error')
                
                {{--  --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Mahasiswa Ujian Pendadaran Tugas Akhir</div>
                                <small class="text-primary">NILAI SEBAGAI PENGUJI</small>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Nomor</th>
                                                <th width="15%">Nama</th>
                                                <th width="10%">Nim</th>
                                                <th width= 30%>Judul</th>
                                                <th width= 10%>Keterangan</th>
                                                <th width= 10%>Nilai</th>
                                                <th width= 5%>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($daftar_mahasiswa as $item)

                                                <tr>
                                                    <th>{{$loop->iteration}}</th>
                                                    <td>
                                                        @if ($item->nim_submit)
                                                            {{ $item->mahasiswaSubmit->user->name}}
                                                        @elseif($item->nim_terpilih)
                                                            {{ $item->mahasiswaTerpilih->user->name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->nim_submit)
                                                            {{ $item->nim_submit}}
                                                        @elseif($item->nim_terpilih)
                                                            {{ $item->nim_terpilih}}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->judul_topik}}</td>
                                                    <td>
                                                        @if ($item->status_mahasiswa == 0)
                                                            <span class="badge badge-secondary">Metopen</span>
                                                        @elseif($item->status_mahasiswa == 1)
                                                            <span class="badge badge-success">Siap Seminar Proposal 
                                                            {{-- @if ($item->penjadwalan->date)
                                                                <b> {{ $item->penjadwalan->date }} </b>
                                                        @endif --}}
                                                            </span>
                                                        
                                                        @elseif($item->status_mahasiswa == 2)
                                                            <span class="badge badge-secondary">Skripsi</span>
                                                        @elseif($item->status_mahasiswa == 3)
                                                            <span class="badge badge-success">Siap Pendadaran
                                                            @if ($item->penjadwalan)
                                                                <b> {{ '/ '.$item->penjadwalan->date }} </b>
                                                            </span>
                                                            @else
                                                                <b>/ Belum Terjadwal</b>
                                                        @endif
                                                        @endif                                                                                
                                                    </td>
                                                    <td>
                                                        @if (in_array($item->penjadwalan->id ?? null,Auth::user()->dosen->dosentoPendadaran->pluck('id_penjadwalan')->toArray() ?? []))
                                                        <span class="badge badge-success">
                                                            <b>Sudah dinilai</b>
                                                        </span>
                                                        @else
                                                        <span class="badge badge-warning">
                                                            <b>Belum dinilai</b>
                                                        </span>
                                                        @endif
                                                        {{-- {{dd($item->dosenPenguji1->user->dosen->dosentoPendadaran->count()) }} --}}
                                                        {{-- {{dd($item->dosenPenguji2->user->dosen->dosentoPendadaran->count()) }} --}}
                                                        {{-- <span class="badge badge-primary badge-sm">Sudah dinilai</span> --}}
                                                    </td>
                                                    <td>
                                                        {{-- {{ dd($item->penjadwalan) }} --}}
                                                        {{-- {{ dd($item->penjadwalan->toNilaiPendadaran->first()->nipy) }} --}}
                                                        {{-- @if (!$item->penjadwalan->toNilaiPendadaran == null)
                                                            @if (strtotime(date('Y-m-d')) < strtotime($item->penjadwalan->date))
                                                                <button class="btn btn-warning btn-sm mt-2" disabled>Belum Ujian Pendadaran</button>
                                                            @elseif ($item->penjadwalan->toNilaiPendadaran->first()->nipy == $data_dosen->nipy)
                                                                <button class="btn btn-primary btn-sm mt-2" disabled> <i class="fas fa-edit"></i> Penilaian Pendadaran</button>
                                                            @else
                                                                <a href="{{ url('/penilaian-pendadaran/'.$item->id) }}" class="btn btn-primary btn-sm mt-2"> <i class="fas fa-edit"></i> Penilaian Pendadaran</a>
                                                            @endif
                                                        @else
                                                            <button class="btn btn-warning btn-sm mt-2" disabled>Belum Terjadwal</button>
                                                        @endif --}}
                                                        @if ($item->penjadwalan)
                                                            @if (!strtotime(date('Y-m-d')) < strtotime($item->penjadwalan->date))
                                                                <a href="{{ url('/penilaian-pendadaran/'.$item->id) }}"
                                                                    class="btn btn-primary btn-sm mt-2
                                                                    {{ in_array($item->penjadwalan->id ?? null,Auth::user()->dosen->dosentoPendadaran->pluck('id_penjadwalan')->toArray() ?? []) ? 'disabled' : ''}}">
                                                                    <i class="fas fa-edit"></i> Penilaian Pendadaran
                                                                </a>
                                                            @else
                                                            @endif
                                                        @else
                                                            <button class="btn btn-warning btn-sm mt-2" disabled>Belum Ujian Pendadaran</button>
                                                        @endif
                                                        
                                                        {{-- {{ dd(Auth::user()->dosen->dosentoPendadaran->pluck('id_penjadwalan')->toArray()) }} --}}
                                                        {{-- {{ $item->penjadwalan }} --}}
                                                        
                                                        {{-- {{ $item->dosenPenguji1->user->dosen->dosentoPendadaran }} --}}
                                                        {{-- {{ ($item->penjadwalan->toNilaiPendadaran)  }} --}}
                                                        {{-- !$item->dosenPenguji1->user->dosen->dosentoPendadaran->count() == 0 --}}

                                                        {{-- @foreach ($item->penjadwalan->toNilaiPendadaran as $x)
                                                            {{ ($x->nipy) }}
                                                            @php
                                                                die;
                                                            @endphp
                                                            {{-- {{ $data_dosen->nipy }} --}}
                                                        {{-- @endforeach --}} 
                                                        {{-- {{ $item->penjadwalan->toNilaiPendadaran->first()->nipy }} --}}
                                                        {{-- {{ $item->penjadwalan->toNilaiPendadaran }} --}}
                                                    </td>    
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center p-5">
                                                        Anda Belum di tambahkan sebagai dosen penguji 1
                                                    </td>
                                                </tr>
                                            @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>           
@endsection