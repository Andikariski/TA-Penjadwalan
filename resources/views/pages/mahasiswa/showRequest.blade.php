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
                        <a href="#">Request</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Request Saya</div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">Nomor</th>
                                            <th width="25%">judul</th>
                                            <th width="15%">Topik</th>
                                            <th width="20%">Deskripsi</th>
                                            <th width="15%">Dosen</th>
                                            <th width="7%">Status</th>
                                            <th>Alert</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($topik_skripsi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->judul_topik }}</td>
                                            <td>{{ $item->topik->nama_topik }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>{{ $item->dosen->user->name }}</td>

                                            <td>
                                                @if ($item->status==NULL)
                                                    <span class="badge badge-info">Waiting</span>
                                                @elseif($item->status=="Accept")
                                                    <span class="badge badge-success">Accept</span>
                                                @elseif($item->status=="Reject")
                                                    <span class="badge badge-danger">Reject</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status==NULL)
                                                    <span class="badge badge-info">Silahkan Menunggu dari dosen terkait</span>
                                                @elseif($item->status=="Accept")
                                                    <span class="badge badge-success mt-2">Silahkan menghubungi dosen terkait guna untuk kelangsungan berikutnya</span>
                                                    &nbsp;
                                                    <button type="button" class="btn btn-success btn-round mt-3 mb-3">
                                                        Mulai bimbingan
                                                    </button>
                                                @elseif($item->status=="Reject")
                                                    <span class="badge badge-danger">Jangan menyerah kawan, silahkan mengajukan topik lagi atau memilih topik
                                                        dari dosen
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center p-5">
                                                Kamu belum pernah mengajukan judul
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


@endsection
