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
                            <a href="#">List Dosen</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Dosen</div>
                            </div>
                            <div class="card-body">
                               

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th width="5%">Nomor</th>
                                                <th width="15%">NIY / NIP</th>
                                                <th width="25%">Nama</th>
                                                <th width="20%">Email</th>
                                                <th width="15%">Jumlah mahasiswa bimbingan</th>
                                                <th width= 25%>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dosen as $item)
                                                <tr>
                                                    <th>{{$loop->iteration}}</th>
                                                    <td>{{ $item->nipy}}</td>
                                                    <td>{{ $item->user->name}}</td>
                                                    <td>{{ $item->user->email}}</td>
                                                    <td>
                                                        @if ($item->skripsi->count()==0)
                                                            <span class="badge badge-danger">Tidak ada</span>
                                                        @else
                                                            <span class="badge badge-success">{{ $item->skripsi->count()}}</span>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ route('dosen.show', $item->nipy) }}" data-toggle="tooltip" title="" class="btn btn-link btn-default" data-original-title="Info">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                        <div class="form-button-action">
                                                           <a href="" type="button" class="btn-link btn-success" data-toggle="modal" data-target="#editModal{{$item->user_id}}"> <i class="fas fa-envelope"></i></a>
                                                        </div>
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
                                 @foreach ($dosen as $item)                                 
                                 <div class="modal fade" id="editModal{{ $item->user_id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5>Update Email</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('updateEmail',$item->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <h5><strong>{{ $item->user->name }}</strong></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Email</label>
                                                                <input type="text" name="email" class="form-control" placeholder="fill position" value="{{ $item->user->email }}">
                                                                <input type="hidden" name="user_id" class="form-control" placeholder="fill position" value="{{ $item->user_id }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer no-bd">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>           
@endsection