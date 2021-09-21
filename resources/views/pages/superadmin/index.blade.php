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
                                                <th width="35%">Nama</th>
                                                <th width="20%">Jumlah mahasiswa bimbingan</th>
                                                <th width= 10%>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dosen as $item)
                                                <tr>
                                                    <th>{{$loop->iteration}}</th>
                                                    <td>{{ $item->nipy}}</td>
                                                    <td>{{ $item->user->name}}</td>
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