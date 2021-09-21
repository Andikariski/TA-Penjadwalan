@extends('layouts.master')
@section('style')
    <link href='{{ url('js/plugins/calendar/main.css') }}' rel='stylesheet' />
    <script src='{{ url('js/plugins/calendar/main.js') }}'></script>
    <script src='{{ url('js/plugins/calendar/calendarSemprop.js') }}'></script>
@endsection

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <input type="hidden" id="idTopik" value="{{ $data->topikSkripsi->id }}">
                @include('layouts/error')
                <div class="page-header">                   
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Jadwal Seminar Proposal</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                    <div class="card-title"><h3>{{$page}} : <strong  style="color: green">
                                                        @if ($data->topikSkripsi->nim_terpilih)
                                                            {{ $data->topikSkripsi->mahasiswaTerpilih->user->name}}
                                                        @elseif ($data->topikSkripsi->nim_submit)
                                                            {{$data->topikSkripsi->mahasiswaSubmit->user->name}}
                                                        @endif      
                                                    </strong></h3></div>
                                            </div>
                                            <div>
                                                <div class="col"><a href="{{ route('dataPenjadwalan') }}" class="btn btn-primary float-right btn-sm">
                                                    <i class="fa fa-arrow-alt-circle-left"></i> Kembali</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <input type="hidden" id="tanggal" value="{{ date('Y-m-d') }}">
                                <div class="card-body" style="height: 1000px;">
                                    <div id='loading'>loading...</div>
                                        <div id='ncalendar' style="height: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    

            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{url('/simpanJadwalTerupdate/'. $data->id)}}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h4 class="modal-title" id="addTitle"><strong>Tambahkan Jadwal Ke Tanggal ini</strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>NIM Mahasiswa</label>
                                        <input type="text"   value="{{$data->topikSkripsi->nim_terpilih ? $data->topikSkripsi->nim_terpilih : $data->topikSkripsi->nim_submit}}" class="form-control float-left"   readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Nama Mahasiswa</label>
                                        <input type="text"   value="{{$data->topikSkripsi->nim_terpilih ? $data->topikSkripsi->mahasiswaTerpilih->user->name : $data->topikSkripsi->mahasiswaSubmit->user->name}}" class="form-control"   readonly>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Topik Skripsi</label>
                                        <input type="hidden" name="topik_skripsi_id" value="{{ $data->topikSkripsi->id }}">
                                        <textarea class="form-control" readonly>{{ $data->topikSkripsi->judul_topik  }}</textarea>
                                        <input type="hidden" name="hari" id="hari">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Dosen Pembimbing</label>
                                        <input type="text"   value="{{ $data->topikSkripsi->dosen->user->name  }}" class="form-control"   readonly name="dosen_pembimbing">
                                        <input type="hidden"   value="{{ $data->topikSkripsi->dosen->nipy }}" class="form-control"   readonly name="nipyDosenPembimbing">
                                        </div>
                                    </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Dosen Penguji</label>
                                        <input type="text"   value="{{ $data->topikSkripsi->dosenPenguji1->user->name  }}" class="form-control"   readonly name="dosen_penguji1">
                                        <input type="hidden"   value="{{ $data->topikSkripsi->dosenPenguji1->nipy }}" class="form-control"   readonly name="nipyDosenPenguji1">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Tanggal Ujian</label>
                                        <input type="text" id="dijadwalkan" name="date"  value="" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jam Mulai (<font style="color:red">Waktu Semula : {{ $data->waktu_mulai }}</font>)</label>
                                        <select class="form-control" name="waktu_mulai" id="mulai">
                                            <option value="">Pilih Jam Mulai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>     
                            <div class="row">                             
                                <div class="col">
                                    <div class="form-group">
                                        <label>Ruang</label>
                                        <select class="form-control" name="link">
                                            <option value="{{ $data->linkGoogleMeet->title_room }}" selected>Link Google Meet {{ $data->linkGoogleMeet->title_room }}</option>
                                            @foreach ($linkGoogleMeetTersedia as $link)
                                            <option value="{{ $link->title_room }}">Link Google Meet {{ $link->title_room }}</option> 
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="jenis_ujian"  value="1" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="submit" class="btn btn-primary" id="fire">Simpan Jadwal</button>
                        </div>
                    </form>
                </div>
            </div>       
{{-- @section('script') --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
{{-- @endsection --}}
@endsection
