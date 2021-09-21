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
                            <div class="card-title">Daftar mahasiswa</div>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">Nomor</th>
                                            <th width="15%">Nama</th>
                                            <th width="35%">Nim</th>
                                            <th width="20%">Judul</th>
                                            <th width="20%">Topik</th>
                                            <th width="20%">status dosen penguji</th>                                           
                                            <th width="20%">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $item)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>
                                                @if ($item->nim_submit)
                                                {{ $item->mahasiswaSubmit->user->name }}
                                                @elseif($item->nim_terpilih)
                                                {{ $item->mahasiswaTerpilih->user->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->nim_submit)
                                                {{ $item->nim_submit }}
                                                @elseif($item->nim_terpilih)
                                                {{ $item->nim_terpilih }}
                                                @endif
                                            </td>
                                            <td>{{ $item->judul_topik}}</td>
                                            <td>{{ $item->topik->nama_topik}}</td>
                                            <td>
                                                @if ($item->dosen_penguji_1 && $item->dosen_penguji_2)
                                                    <span class="badge badge-success">Dosen penguji sudah diinputkan</span>
                                                @else
                                                    <span class="badge badge-danger">Dosen penguji belum diinputkan</span>
                                                @endif
                                           
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-border btn-round"
                                                    data-toggle="modal" data-target="#addRowModal{{$item->id}}">
                                                    <i class="fa fa-eye"> View</i>
                                                </button>
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


                            @foreach ($data as $item)
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal{{$item->id}}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    View Dosen</span>

                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">Dosen Pembimbing dan Dosen Penguji</p>
                                            <form action="{{ route('skripsi.update',$item->id)}}" method="POST" >
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Dosen Pembimbing</label>
                                                            {{$item->dosen->user->name}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0 mt-2">
                                                        <div class="form-group form-group-default">
                                                            <label>Dosen Penguji 1</label>
                                                            <select
                                                                class="form-control @error('dosen_penguji_1') is-invalid @enderror"
                                                                id="exampleFormControlSelect1" name="dosen_penguji_1">
                                                                    @if (!$item->dosen_penguji_1)                                                                    
                                                                        <option value="" selected="selected">---- Pilih Dosen Penguji 1 ----</option>
                                                                    @endif
                                                                @foreach ($dosen as $lecture)
                                                                    @if ($lecture->nipy!=$item->nipy)
                                                                        <option value="{{ $lecture->nipy}}" {{ ($lecture->nipy == $item->dosen_penguji_1 ? "selected":" ") }}> {{ $lecture->user->name}}</option>
                                                                    @endif
                                                                
                                                                @endforeach
                                                            </select>
                                                            @error('dosen_penguji_1')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <div class="form-group form-group-default">
                                                            <label>Dosen Penguji 2</label>
                                                            <select
                                                                class="form-control @error('dosen_penguji_2') is-invalid @enderror"
                                                                id="exampleFormControlSelect1" name="dosen_penguji_2">
                                                                    @if (!$item->dosen_penguji_2)                                                          
                                                                        <option value="" selected="selected">---- Pilih Dosen Penguji 2 ----</option>
                                                                    @endif
                                                                @foreach ($dosen as $lecture)
                                                                    @if ($lecture->nipy!=$item->nipy)
                                                                        <option value="{{ $lecture->nipy}}" {{ ($lecture->nipy == $item->dosen_penguji_2 ? "selected":" ") }}> {{ $lecture->user->name}}</option>
                                                                    @endif
                                                                
                                                                @endforeach
                                                            </select>
                                                            @error('dosen_penguji_2')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
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
