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
                            <a href="#">{{$page}}</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                    <div class="card-title">{{$page}}</div>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-4 pb-3">
                                            <h5><strong>Filter Ujian</strong></h5>
                                            <select name="filter" id="filter-penjadwalan" class="form-control">
                                                    <option value="">Semua Ujian</option>
                                                    @foreach ($status_ujian as $key => $val)
                                                        <option value="{{ $key }}" @if(strval($key) == strval($filter))selected @endif>{{ $val }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="table-responsive"  id="tabel">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nim</th>
                                                <th>Mahasiswa</th>
                                                <th>Tanggal Ujian</th>
                                                <th>Waktu</th>
                                                <th style="width: 100px">Meet Room</th>
                                                <th>Ujian</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>
                                                        @if ($item->topikSkripsi->nim_submit)
                                                            {{$item->topikSkripsi->nim_submit}}
                                                        @elseif ($item->topikSkripsi->nim_terpilih)
                                                            {{$item->topikSkripsi->nim_terpilih}}      
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->topikSkripsi->nim_submit)
                                                            {{$item->topikSkripsi->mahasiswaSubmit->user->name}}
                                                        @elseif ($item->topikSkripsi->nim_terpilih)
                                                            {{$item->topikSkripsi->mahasiswaTerpilih->user->name}}      
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</td>
                                                    <td>{{$item->waktu_mulai}}</td>
                                                    <td>Google Meet {{$item->meet_room}}</td>
                                                    <td>
                                                        @if ($item->jenis_ujian == 0)
                                                            <strong class="badge badge-warning">Seminar Proposal</strong>
                                                        @elseif ($item->jenis_ujian == 1)
                                                            <strong class="badge badge-success">Ujian Pendadaran</strong>                                                                                                  
                                                        @endif 
                                                        </td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a data-toggle="tooltip" title="" class="btn btn-link btn-success" data-original-title="Detail Jadwal" href="{{Route('detail.penjadwalan',$item->id)}}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>    
                                                            @if ($item->jenis_ujian == 0)                                
                                                                <a data-toggle="tooltip" title="" class="btn btn-link btn-info" data-original-title="Ubah Jadwal" href="{{ Route('update.semprop',$item->id) }}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            @elseif ($item->jenis_ujian == 1)
                                                                <a data-toggle="tooltip" title="" class="btn btn-link btn-info" data-original-title="Ubah Jadwal" href="{{ Route('update.pendadaran',$item->id) }}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            @endif

                                                            <a data-toggle="tooltip" title="" class="btn btn-link btn-danger tombolhapus" data-original-title="Hapus Jadwal" href="{{Route('hapus.jadwal',$item->id)}}">
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

@section('script')
<script src="{{ url('assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        const filterPenjadwalan = $('#filter-penjadwalan');

        // Generate filter kemudian mengirim nilai sesuai paramater
        function generateFilterUri() {
            const filter = filterPenjadwalan.val();
            return window.location.href.replace( /[\?#].*|$/, `?filter=${filter}` );
        }

        // If filter has changed
        filterPenjadwalan.change(function() {
            // Redirect page
            window.location.href = generateFilterUri();
        });

        $('#basic-datatables').DataTable({});

    });

</script>

@endsection
@endsection

    