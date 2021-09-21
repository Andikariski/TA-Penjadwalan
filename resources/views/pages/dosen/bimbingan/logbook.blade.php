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
                                        <td><span class="h4">:
                                                @if ($data->nim_submit)
                                                {{ $data->mahasiswaSubmit->user->name}}
                                                @elseif($data->nim_terpilih)
                                                {{ $data->mahasiswaTerpilih->user->name}}
                                                @endif
                                            </span></td>
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
                                            <th width="10%">Status</th>
                                            <th width="10%">Action</th>

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
                                                <a href="{{ url('/view/'.$item->id) }}" target="_blank"
                                                    class="btn btn-secondary btn-sm"> <i class="fas fa-eye"></i>
                                                    View</a>
                                                {{-- <a href="{{ url('/download/'.$item->file) }}" class="btn
                                                btn-primary btn-sm"> <i class="fas fa-download"></i> Download</a> --}}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status==0)
                                                <span class="badge badge-danger">Waiting</span>
                                                @else
                                                <span class="badge badge-success">verified</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status==0)
                                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#acceptModal{{$item->id}}"> <i class="fas fa-edit"></i>
                                                    Update</a>
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

    <!-- Modal -->
    @foreach ($logbook as $item)
    <div class="modal fade" id="acceptModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Logbook</span>
                       
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('bimbingan/'.$item->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <p class="small">Konfirmasi untuk <b>{{$item->kegiatan}}</b> ?</p>                  
                                    
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
