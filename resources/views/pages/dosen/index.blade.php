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
                                                <th width="10%">Pemilih</th>
                                                <th width= 10%>Status</th>
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
                                                        @if ($item->mahasiswaGetSkripsi->count()==0)
                                                            <span class="badge badge-danger">Tidak ada</span>
                                                        @else
                                                            <span class="badge badge-success">{{ $item->mahasiswaGetSkripsi->count()}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status=="Open")                                                          
                                                            <span class="badge badge-success">Open</span>
                                                        @elseif($item->status=="Close")
                                                            <span class="badge badge-danger">Close</span>
                                                        @else
                                                            <span class="badge badge-info">Terpilih</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ route('penelitian.show', $item->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-default" data-original-title="Info">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="#" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>           
@endsection