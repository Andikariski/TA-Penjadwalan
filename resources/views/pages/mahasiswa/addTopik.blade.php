@extends('layouts.master')

@section('content')
    <div class="main-panel">
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
                            <a href="#">Topik</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Add</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                         @if ($getMahasiswaMengajukan OR $menungguAcc)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title text-center">Kamu sedang dalam masa mengajukan judul!</div>
                                    </div>
                                </div>
                        @elseif($getAcceptTopikMahasiswa OR $sudahDapatJudulDariDosen)
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title text-center">Anda sudah memiliki Judul!</div>
                                </div>
                            </div>
                        @else
                        <form action="{{ route('topik.store')}}" method="POST" >
                            @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Usulkan Topik</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="judul">Judul Topik</label>
                                            <input type="text" name="judul_topik" class="form-control @error('judul_topik') is-invalid @enderror" placeholder="Masukkan judul">
                                            @error('judul_topik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comment">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"  rows="5">
                                                {{ old('deskripsi') }}
                                            </textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Pilih Topik</label>
                                            <select class="form-control @error('id_topikbidang') is-invalid @enderror" id="exampleFormControlSelect1" name="id_topikbidang">
                                                <option value="" selected="selected">---- Pilih Topik ----</option>
                                                @foreach ($topik as $item)                             
                                                    <option value="{{ $item->id}}" {{ (old("id_topikbidang") == $item->id ? "selected":" ") }}>{{ $item->nama_topik}}</option>
                                                @endforeach
                                            </select>
                                            @error('id_topikbidang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Pilih Dosen Pembimbing</label>
                                            <select class="form-control @error('nipy') is-invalid @enderror" id="exampleFormControlSelect1" name="nipy">
                                                <option value="" selected="selected">---- Pilih Dosen ----</option>
                                                @foreach ($dosen as $item)                             
                                                    <option value="{{ $item->nipy}}" {{ (old("nipy") == $item->nipy ? "selected":" ") }}>{{ $item->user->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('nipy')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror   
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Pilih Periode</label>
                                            <select class="form-control @error('id_periode') is-invalid @enderror" id="exampleFormControlSelect1" name="id_periode">
                                                <option value="" selected="selected">---- Pilih periode ----</option>
                                                @foreach ($periode as $item)                             
                                                    <option value="{{ $item->id}}" {{ (old("id_periode") == $item->id ? "selected":" ") }}>{{ $item->tahun_periode}}</option>
                                                @endforeach
                                            </select>
                                            @error('id_periode')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                             @enderror  
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection