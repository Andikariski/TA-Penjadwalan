@extends('layouts.master')

@section('content')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

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
                            <div class="col-10">
                                <h4 class="card-title">{{ $page }}  : <strong style="color: green">{{$dataDosen->user->name}}</strong></h4>
                                <small>Catatan : <i>Isi Form Menggunakan kode <b>0</b>, Sebagai tanda tidak mengajar, &
                                <b>1</b>, Sebagai Tanda mengajar di hari dan jam tersebut</i></small>
                            </div>
                            <div class="col-2">                    
                                    <a href="{{route('jadwalDosen')}}" class="btn btn-primary btn-sm pull-right mr-4">
                                        <i class="fa fa-fw fa-arrow-alt-circle-left"></i><strong> Kembali</strong>
                                    </a>
                            </div>
                        </div>
                        
                    </div>
                    <form action="{{ route('simpanJadwalDosen', 'update') }}" method="POST" class="card-body">
                        @csrf
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table">
                                <thead>
                                    <tr>
                                        <th>Jam Ke</th>
                                        <th>Senin</th>
                                        <th>Selasa</th>
                                        <th>Rabu</th>
                                        <th>Kamis</th>
                                        <th>Jum'at</th>
                                        <th>Sabtu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($collection as $item)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                                            <input type="hidden" name="nipy" value="{{$dataDosen->nipy}}">
                                            <input type="number" name="jam_ke[]" value="{{ $item->jam_ke }}" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="{{ $item->senin }}" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="{{ $item->selasa }}" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="{{ $item->rabu }}" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="{{ $item->kamis }}" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="{{ $item->jumat }}" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="{{ $item->sabtu }}" class="form-control" required>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6 col-md-6 ">
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6 ">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block mt-4" type="submit"><strong>Update Jadwal</strong></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
</div>
</div>

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection

@endsection
