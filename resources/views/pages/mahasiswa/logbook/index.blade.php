@extends('layouts.master')


@section('content')
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"><i class="fas fa-layer-group"></i> Logbook</h2>

                    </div>
                    @if ($data)
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="{{ url('/logbook/'.$data->id) }}" target="_blank" class="btn btn-secondary btn-round"> <i class="fas fa-download"></i> Download</a>
                        <a href="{{ url('/logbook/create') }}" class="btn btn-white btn-border btn-round mr-2"><i
                                class="fas fa-plus"></i> Tambah Logbook</a>
                    </div>
                    @endif


                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            @include('layouts/error')
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">
                        @if ($data)
                        <div class="card-body">
                            <table class="table table-typo">
                                <tbody>
                                    <tr>
                                        <td width="5%">
                                            <span class="h4">Nama</span>
                                        </td>
                                        <td><span class="h4">: {{ Auth::user()->name }} </span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="h4">NIM</span>
                                        </td>
                                        <td><span class="h4">
                                                @if ($data->nim_submit)
                                                : {{ $data->nim_submit}}
                                                @elseif($data->nim_terpilih)
                                                : {{ $data->nim_terpilih}}
                                                @endif
                                            </span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="h4">Judul</span>
                                        </td>
                                        <td><span class="h4">: {{ $data->judul_topik}}</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="h4">Topik</span>
                                        </td>
                                        <td><span class="h4">: {{ $data->topik->nama_topik}}</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="h4">Dosen Pembimbing</span>
                                        </td>
                                        <td><span class="h4">: {{ $data->dosen->user->name }}</span></td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">Nomor</th>
                                            <th width="25%">Kegiatan</th>
                                            <th width="45%">Catatan Kemajuan</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="15%">File tambahan</th>
                                            <th width="10%">Paraf</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($logbook as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kegiatan }}</td>
                                            <td>{{ $item->catatan_kemajuan }}</td>
                                            <td>
                                                @php
                                                    $date= $item->created_at->format('d-m-Y');
                                                    echo $date;
                                                @endphp
                                            </td>
                                            <td>
                                                @if ($item->file)
                                                    <a href="{{ url('log/'.$item->id) }}" target="_blank" class="btn btn-secondary btn-sm"> <i class="fas fa-eye"></i> View</a>
                                                @else
                                                     <span class="badge badge-default">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status==0)
                                                <span class="badge badge-danger">Waiting</span>
                                                @else
                                                <span class="badge badge-success">verified</span>
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
                        @else
                        <div class="card-body">
                            <div class="card-header">
                                <div class="card-title text-center">Kamu belum mempunyai judul</div>
                            </div>
                        </div>

                        @endif



                    </div>
                </div>

            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.themekita.com">
                                ThemeKita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Help
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright ml-auto">
                    2018, made with <i class="fa fa-heart heart text-danger"></i> by <a
                        href="https://www.themekita.com">ThemeKita</a>
                </div>
            </div>
        </footer>
    </div>
    @endsection
