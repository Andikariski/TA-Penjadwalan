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
                                <h4 class="card-title">{{ $page }}</h4>
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
                    <form action="{{ route('simpanJadwalDosen','create') }}" method="POST" class="card-body">
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
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="1" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>

                                    {{-- 2 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="2" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                    </tr>
                                    {{-- 3 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="3" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                    </tr>
                                    {{-- 4 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="4" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                    </tr>
                                    {{-- 5 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="5" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 6 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="6" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                    </tr>
                                    {{-- 7 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="7" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 8 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="8" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 9 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="9" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 10 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="10" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 11 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="11" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 12 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="12" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 13 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="13" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 14 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="14" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 15 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="15" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 16 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="16" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 17 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="17" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                    {{-- 18 --}}
                                    <tr>
                                        <td>
                                            <input type="number" name="jam_ke[]" value="18" class="form-control"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="senin[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="selasa[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="rabu[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="kamis[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="jumat[]" value="0" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="sabtu[]" value="0" class="form-control" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6 col-md-6 ">
                                <div class="form-group">
                                    <label>Pilih Dosen</label>
                                    <select class="form-control select2" name="nipy">
                                        @foreach ($collection as $item)
                                            <option value="{{ $item->nipy }}" @if ($item->id == old('nipy')) selected @endif>{{ $item->user->name }}</option>                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6 ">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block mt-4" type="submit">Simpan Jadwal</button>
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
