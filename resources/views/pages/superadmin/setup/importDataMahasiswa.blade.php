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
                        <a href="#">Daftar Mahasiswa</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <div class="card-title">Daftar Mahasiswa</div>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#addRowModal">
                                        <i class="fa fa-fw fa-download"></i> Import Data Mahasiswa
                                    </button>
                                    <a href="" class="btn mr-2 btn-sm btn-primary pull-right">
                                        <i class="fa fa-fw fa-plus"></i> Tambah Data Mahasiswa
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No. HP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($dosen as $item)
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
                                                <a href="#" data-toggle="tooltip" title="" class="btn btn-link btn-default" data-original-title="Info">
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
                                        @endforelse --}}

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


<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        <strong>Pastikan file Excel berekstensi .xls</strong></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('importDataMahasiswa')}}" method="POST" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        {{ csrf_field() }}
                        <h5>Pilih file</h5>
                        <input id="inputFile" class="form-control form-control-sm" id="formFileSm" type="file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="buttonImportFile" type="submit" class="btn btn-primary btn-sm pull-right" disabled>Import</button>
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
