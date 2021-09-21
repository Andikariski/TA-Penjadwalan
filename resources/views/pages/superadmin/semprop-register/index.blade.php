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
                            <div class="card-title">Daftar mahasiswa bisa daftar semprop</div>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">Nomor</th>
                                            <th width="15%">Nama</th>
                                            <th width="35%">Nim</th>
                                            <th width="35%">File terupload</th>
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
                                           <td>
                                               @if ( $item->syaratujian->syarat->count()==0)
                                                    <span class="badge badge-danger">belum ada</span>
                                                @else
                                                    <span class="badge badge-success">{{ $item->syaratujian->syarat->count()}}</span>                                                   
                                               @endif
                                           </td>
                                            <td>
                                                <a href="{{ route('semprop-register.show', $item->syaratujian->id) }}" class="btn btn-primary btn-border btn-round">
                                                    <i class="fa fa-eye"> View</i>
                                                </a>
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
