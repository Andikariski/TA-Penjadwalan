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
                            <a href="#">List Jadwal Dosen</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                    <div class="card-title">Jadwal Dosen</div>
                                            </div>
                                            <div class="col">
                                            @if (!count($dosenTerjadwal) >0)                     
                                            <button type="button" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fa fa-fw fa-download"></i> Import Jadwal Dosen    
                                            </button>                                               
                                            @endif
                                            @if (count($dosenTerjadwal) > 0)    
                                                <a href="{{route('tambahJadwalDosen')}}" class="btn mr-2 btn-sm btn-primary pull-right">
                                                    <i class="fa fa-fw fa-plus"></i> Tambah Jadwal Dosen
                                                </a>                                        
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Dosen</th>
                                                <th>Senin</th>
                                                <th>Selasa</th>
                                                <th>Rabu</th>
                                                <th>Kamis</th>
                                                <th>Jum'at</th>
                                                <th>Sabtu</th>                                    
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $no =1;
                                        ?>
                                        <?php use App\Models\JadwalDosen; ?>
                                        @foreach ($data as $item)
                                            <?php
                                            $getJadwal = JadwalDosen::where('nipy', $item->nipy)->first();
                                            // dd($getJadwal);
                                            if ($getJadwal != null) { ?>
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $getJadwal->dosen->user->name }}</td>
                                                <td>{{ $getJadwal->senin }}</td>
                                                <td>{{ $getJadwal->selasa }}</td>
                                                <td>{{ $getJadwal->rabu }}</td>
                                                <td>{{ $getJadwal->kamis }}</td>
                                                <td>{{ $getJadwal->jumat }}</td>
                                                <td>{{ $getJadwal->sabtu }}</td>
                                                <td>
                                                    <a data-toggle="tooltip" title="" class="btn btn-link btn-success" data-original-title="Ubah Jadwal Dosen"
                                                        href="{{route('updateJadwalDosen', $getJadwal->dosen->id)}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php }
                                            ?>
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

{{-- Modal Import Jadwal Dosen --}}
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        <strong>Pastikan file jadwal dalam bentuk Excel</strong></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('importJadwalDosen')}}" method="POST" method="POST" enctype="multipart/form-data">
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