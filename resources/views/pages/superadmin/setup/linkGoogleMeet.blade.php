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
                            <a href="#">{{ $page }}</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                    <div class="card-title">{{ $page }}</div>
                                            </div>
                                            <div class="col">
                                                            
                                            {{-- <button type="button" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#importLink">
                                                <i class="fa fa-fw fa-download"></i> Import Link Google Meet    
                                            </button>                                                        --}}
                                            <button type="button" class="btn btn-sm btn-primary pull-right mr-2" data-toggle="modal" data-target="#tambahLink">
                                                <i class="fa fa-fw fa-download"></i> Tambah Link Google Meet    
                                            </button>                                                       

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Room Google Meet</th>
                                                <th>Link Google Meet</th>
                                                {{-- <th>Status</th>                                    --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no =1;
                                        ?>                                       
                                        @foreach ($data as $item)                                          
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>Link Google Meet {{ $item->title_room }}</td>
                                                <td><a href="{{ $item->link_google_meet }}" target="_blank">{{ $item->link_google_meet }}</a></td>
                                                {{-- <td>
                                                    @if (count($item->PenjadwalanMeet) > 0)
                                                        @foreach ($item->PenjadwalanMeet as $items)
                                                            @if ($items->date < date('Y-m-d'))
                                                                <button class="badge badge-primary">Tersedia</button>
                                                            @else
                                                                <button class="badge badge-danger">Sedang dipakai</button>
                                                            @endif
                                                            @break
                                                            @endforeach 
                                                            {{ $items->date }}
                                        
                                                     @endif

                                                </td>                           --}}
                                                <td style="width: 10px">
                                                    <div class="form-button-action" >
                                                    <a data-toggle="tooltip" title="" class="btn btn-link btn-danger tombolhapus" data-original-title="Hapus Room"
                                                        href="{{ Route('hapus.link',$item->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach 
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

{{-- Modal Import Link Google Meet --}}
<div class="modal fade" id="importLink" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        <strong>Pastikan file link google meet dalam bentuk Excel</strong></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">  
                        {{ csrf_field() }}
                        <h5>Pilih file</h5>
                        <input id="inputFile" class="form-control form-control-sm" id="formFileSm" type="file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="buttonImportFile" type="submit" class="btn btn-primary btn-sm pull-right" disabled>Import Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Tambah Link Google Meet --}}
<div class="modal fade" id="tambahLink" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        <strong>Tambah Link Google Meet</strong></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('simpanLinkGoogleMeet') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title Room</label>
                        <input type="hidden" class="form-control" id="title" value="{{ $nextTitleGoogleMeet }}" name="title_room" readonly>
                        <input type="text" class="form-control" id="title" value="Link Google Meet {{ $nextTitleGoogleMeet }}" readonly>
                    </div>
                    <div class="mb-3 mt-2">
                    <label for="exampleFormControlInput1" class="form-label">Link Google Meet</label>
                        <input type="text" class="form-control" id="link" placeholder="masukan link google meet" name="link_google_meet">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="buttonImportFile" type="submit" class="btn btn-primary btn-sm pull-right">Tambah Link</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#inputFile').change(function() {
            // var teks = $(this).val();
            $("#buttonImportFile").prop('disabled', false);
            // alert(teks);
        });
    });
</script>
@endsection