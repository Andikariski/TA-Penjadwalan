@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            @include('layouts/error')


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Dokumen seminar proposal</div>
                            <small class="text-primary">
                                @foreach ($prasyarat as $id)
                                @if ($id->skripsiTopik->mahasiswaTerpilih)
                                {{ $id->skripsiTopik->mahasiswaTerpilih->user->name}} |
                                {{ $id->skripsiTopik->mahasiswaTerpilih->nim}}
                                @elseif($id->skripsiTopik->mahasiswaSubmit)
                                {{ $id->skripsiTopik->mahasiswaSubmit->user->name}} |
                                {{ $id->skripsiTopik->mahasiswaSubmit->nim}}
                                @endif
                                @endforeach
                            </small>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">Nomor</th>
                                            <th width="15%">Nama dokumen</th>
                                            <th width="10%">Dokumen</th>
                                            <th width="10%">Status</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($file as $item)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{ $item->namaSyarat->NamaSyarat}}</td>

                                            <td>
                                                <a href="{{ url('detail_file/'.$item->id) }}"
                                                    class="btn btn-primary btn-border btn-sm" target="_blank">
                                                    <i class="fa fa-eye"> View</i>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($item->status == 1)
                                                <span class="badge badge-default"> <i class="fas fa-spinner"></i>
                                                    Waiting</span>
                                                @elseif($item->status == 2)
                                                <span class="badge badge-success"> <i class="fas fa-check"></i>
                                                    Accepted</span>
                                                @else
                                                <span class="badge badge-danger"> <i class="fas fa-times"></i>
                                                    Reject</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 1)
                                                <button href="#" class="btn btn-danger btn-round btn-sm"
                                                    data-toggle="modal" data-target="#rejectModal{{$item->id}}">
                                                    <i class="fa fa-times"> Reject</i>
                                                </button>

                                                <button href="#" class="btn btn-success btn-round btn-sm ml-3"
                                                    data-toggle="modal" data-target="#acceptModal{{$item->id}}">
                                                    <i class="fa fa-check"> Accept</i>
                                                </button>
                                                @elseif($item->status == 2)
                                                @elseif($item->status == 3)
                                                <button href="#" class="btn btn-success btn-round btn-sm ml-3"
                                                    data-toggle="modal" data-target="#acceptModal{{$item->id}}">
                                                    <i class="fa fa-check"> Accept</i>
                                                </button>
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
@foreach ($file as $item)
<div class="modal fade" id="acceptModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Accept Dokumen</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('semprop-register.update',$item->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <p class="small">Accept dokumen<br>
                        <b>{{ $item->namaSyarat->NamaSyarat}}</b></p>
                </div>
                <input type="hidden" name="status" value="2">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal reject -->
@foreach ($file as $item)
<div class="modal fade" id="rejectModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Reject Dokumen</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('semprop-register.update',$item->id)}}" method="POST">
                {{-- semprop-register --}}
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <p class="small">Dokumen<br>
                        <b>{{ $item->namaSyarat->NamaSyarat}}</b></p>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Masukkan Keterangan</label>
                                <textarea name="keterangan"
                                    class="form-control @error('deskripsi') is-invalid @enderror" rows="2">

                                            </textarea>
                            </div>
                            <input type="hidden" name="status" value="3">
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
