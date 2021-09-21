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
                                <div class="card-title">Mahasiswa Seminar Proposal</div>
                                <small class="text-primary">PENGUJI 1</small>
                            </div>
                            <div class="card-body">
                               

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Nomor</th>
                                                <th width="15%">Nama</th>
                                                <th width="10%">Nim</th>
                                                <th width="10%">Angkatan</th>
                                                <th width= 30%>Judul</th>
                                                <th width= 10%>Keterangan</th>
                                                <th width= 30%>Action</th>
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
                                                    <td>
                                                        @if ($item->nim_submit)
                                                           @php
                                                               $angkatan=substr($item->nim_submit,0,2);
                                                                echo "20".$angkatan;
                                                           @endphp
                                                        @elseif($item->nim_terpilih)
                                                            @php
                                                               $angkatan=substr($item->nim_terpilih,0,2);
                                                                echo "20".$angkatan;
                                                           @endphp
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->judul_topik}}</td>
                                                    <td>
                                                        @if ($item->status_mahasiswa == 0)
                                                            <span class="badge badge-secondary">Metopen</span>
                                                        @elseif($item->status_mahasiswa == 1)
                                                            <span class="badge badge-success">Siap Seminar Proposal 
                                                                 @if ($item->penjadwalan->date)
                                                                <b> {{ $item->penjadwalan->date }} </b>
                                                            @endif
                                                            </span>
                                                           
                                                        @elseif($item->status_mahasiswa == 2)
                                                            <span class="badge badge-secondary">Skripsi</span>
                                                        @elseif($item->status_mahasiswa == 3)
                                                            <span class="badge badge-success">Siap Pendadaran</span>
                                                        @endif
                                                    </td>
                                                    <td>                                                        
                                                        @if ($item->status_mahasiswa == 1)
                                                             <a href="{{ url('/semprop-penguji/'.$item->id) }}" class="btn btn-success btn-sm mt-2"> <i class="fas fa-edit"></i> Penilaian Semrop</a>
                                                        @elseif($item->status_mahasiswa == 2)
                                                                <span class="badge badge-success">Lanjut Skripsi</span>
                                                        @elseif($item->status_mahasiswa == 0)
                                                            @if (count($item->penjadwalan->toNilaiSemprop)==15)
                                                                <span class="badge badge-warning">Mengulang Metopen</span>
                                                            @else  
                                                                <span class="badge badge-secondary">Belum Siap Semprop</span>
                                                            @endif
                                                        @endif
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