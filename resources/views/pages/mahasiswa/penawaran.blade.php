@extends('layouts.master')

@section('content')
    <div class="main-panel">
        @include('layouts/error')
        <div class="content">
            <div class="page-inner">
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
                            <a href="#">Penawaran</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if ($getAcceptTopikDosen OR $getAcceptTopikMahasiswa)
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title text-center">Anda sudah memiliki Judul!</div>
                                </div>
                            </div>
                        @elseif($getMahasiswaMengajukan)
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title text-center">Kamu sedang dalam masa mengajukan judul!</div>
                            </div>
                        </div>
                        @else
                            <div class="card">
                            <div class="card-header">
                                <div class="card-title">Penawaran Dosen</div>
                            </div>
                            <div class="card-body">
                              
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Nomor</th>
                                                <th width="25%">judul</th>
                                                <th width="15%">Topik</th>
                                                <th width="40%">Deskripsi</th>
                                                <th width="15%">Dosen</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($judul as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->judul_topik }}</td>
                                                    <td>{{ $item->topik->nama_topik }}</td>
                                                    <td>{{ $item->deskripsi }}</td>
                                                    <td>{{ $item->dosen->user->name }}</td>
                                                    
                                                    <td>

                                                        @if ($getRegister==False)
                                                            <button type="button" class="btn btn-primary btn-border btn-round" 
                                                                data-toggle="modal" data-target="#addRowModal{{$item->id}}">
                                                                <i class="fa fa-plus"> Ajukan</i>
                                                            </button>
                                                        @else
                                                            @if ($getRegister->id_topikskripsi==$item->id)
                                                                <button type="button" class="btn btn-success btn-round" disabled="disabled">
                                                                    Waiting
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-danger btn-round" disabled="disabled">
                                                                    Blocked
                                                                </button>
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
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal add -->
     @foreach ($judul as $item)
     <div class="modal fade" id="addRowModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Ajukan</span> 
                        <span class="fw-light">
                            Topik
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('penawaran.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <p class="small">Apakah anda yakin mengajukan topik<br>
                            <b>{{$item->judul_topik}}</b></p>                  
                            <input type="hidden" name="id_topikskripsi" value="{{$item->id}}" >              
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
@endforeach


@endsection