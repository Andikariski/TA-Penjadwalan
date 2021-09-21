@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
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
                            <a href="#">Judul metopen</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Topik saya</div>
                            </div>
                            <div class="card-body">
                               

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Nomor</th>
                                                <th width="35%">Judul</th>
                                                <th width="15%">Topik</th>
                                                <th width="12%">Request</th>
                                                <th width= 8%>Status</th>
                                                <th width= 20%>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                <tr>
                                                    <th>{{$loop->iteration}}</th>
                                                    <td>{{ $item->judul_topik}}</td>
                                                    <td>{{ $item->topik->nama_topik}}</td>
                                                    <td>
                                                        {{ $item->mahasiswaSubmit->user->name }} || {{ $item->mahasiswaSubmit->nim }}
                                                    </td>
                                                    <td>
                                                        @if ($item->status=="Accept")                                                          
                                                            <span class="badge badge-success">Accept</span>
                                                        @elseif($item->status=="Reject")
                                                            <span class="badge badge-danger">Reject</span>
                                                        @else
                                                            <span class="badge badge-warning">Waiting</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status=="Accept")
                                                            <a href="#" type="button" class="btn btn-danger" aria-disabled="disabled">
                                                                <i class="fa fa-lock"> Terkunci</i>
                                                            </a>
                                                        @elseif ($item->status=="Reject")
                                                            <a href="#" type="button" class="btn btn-danger" aria-disabled="disabled">
                                                                <i class="fa fa-lock"> Terkunci</i>
                                                            </a>
                                                        @else
                                                            <div class="form-button-action">
                                                                <button href="#" type="button" class="btn btn-primary btn-border" data-toggle="modal" data-target="#acceptModal{{$item->id}}">
                                                                    <i class="fa fa-edit"> Accept</i>
                                                                </button>
                                                                &nbsp
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal{{$item->id}}">
                                                                    <i class="fa fa-times"> Reject</i>
                                                                </button>
                                                            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

     <!-- Modal accept -->
     @foreach ($data as $item)
     <div class="modal fade" id="acceptModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('mytopik.ubah')}}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="modal-body">
                        <p class="small">Accept untuk topik<br>
                            <b>{{$item->judul_topik}}</b></p>                  
                            <input type="hidden" name="id" value="{{$item->id}}" > 
                            <input type="hidden" name="type" value="Accept" >              
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

 <!-- Modal Reject -->
 @foreach ($data as $item)
 <div class="modal fade" id="rejectModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mytopik.ubah')}}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <p class="small">Tolak untuk topik<br>
                        <b>{{$item->judul_topik}}</b></p>                  
                        <input type="hidden" name="id" value="{{$item->id}}" >              
                        <input type="hidden" name="type" value="Reject" >              
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
