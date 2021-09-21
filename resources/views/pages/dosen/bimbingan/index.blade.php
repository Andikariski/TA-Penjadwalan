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
                                <div class="card-title">Mahasiswa Saya</div>
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
                                            @forelse ($data as $item)
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
                                                        @if ($item->status_mahasiswa == 0)
                                                            <a href="{{ url('/bimbingan/'.$item->id) }}" class="btn btn-primary btn-sm"> <i class="fas fa-eye"></i> View Logbook</a>
                                                            @if ($item->penjadwalan)
                                                                @if (count($item->penjadwalan->toNilaiSemprop)==15)
                                                                    <span class="badge badge-warning">Mengulang Metopen</span>
                                                                @endif
                                                            @endif
                                                        @elseif ($item->status_mahasiswa == 1)
                                                            <a href="{{ url('/penilaian-semprop/'.$item->id) }}" class="btn btn-success btn-sm mt-2"> <i class="fas fa-edit"></i> Penilaian Semrop</a>
                                                        @elseif($item->status_mahasiswa == 3)
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
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center p-5">
                                                        Data tidak tersedia
                                                    </td>
                                                </tr>
                                            @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>



                                 <!-- Modal -->
                                 <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                    New</span> 
                                                    <span class="fw-light">
                                                        Row
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small">Create a new row using this form, make sure you fill them all</p>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input id="addName" type="text" class="form-control" placeholder="fill name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pr-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Position</label>
                                                                <input id="addPosition" type="text" class="form-control" placeholder="fill position">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Office</label>
                                                                <input id="addOffice" type="text" class="form-control" placeholder="fill office">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
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