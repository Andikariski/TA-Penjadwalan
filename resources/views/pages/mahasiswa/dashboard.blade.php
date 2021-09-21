@extends('layouts.master')


@section('content')
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                        <a href="#" class="btn btn-secondary btn-round">Add Customer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-4">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">informasi</div>
                            {{-- <div class="card-category">Daily information about statistics in system</div> --}}
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                
                                @if (count($data_mahasiswa->skripsiSubmit)>0)
                                    @if ($data_mahasiswa->skripsiSubmit->where('status_mahasiswa','0')->first())
                                        {{ $data_mahasiswa->skripsiSubmit->first()->judul_topik }}
                                        <small class="text-primary">METOPEN</small>
                                    @elseif($data_mahasiswa->skripsiSubmit->where('status_mahasiswa','1')->first())
                                        {{ $data_mahasiswa->skripsiSubmit->first()->judul_topik }}
                                        <small class="text-primary">SIAP SEMPROP</small>
                                    @elseif($data_mahasiswa->skripsiSubmit->where('status_mahasiswa','2')->first())
                                        {{ $data_mahasiswa->skripsiSubmit->first()->judul_topik }}
                                        <small class="text-primary">SKRIPSI</small>
                                    @elseif($data_mahasiswa->skripsiSubmit->where('status_mahasiswa','3')->first())
                                        {{ $data_mahasiswa->skripsiSubmit->first()->judul_topik }}
                                        <small class="text-primary">SIAP PENDADARAN</small>
                                    @endif
                                
                                @elseif(count($data_mahasiswa->skripsiPilih)>0)
                                    {{ $data_mahasiswa->skripsiPilih->first()->judul_topik}}
                                    @if ($data_mahasiswa->skripsiPilih->where('status_mahasiswa','0')->first())
                                        <small class="text-primary">METOPEN</small>
                                    @elseif($data_mahasiswa->skripsiPilih->where('status_mahasiswa','1')->first())
                                        <small class="text-primary">SIAP SEMPROP</small>
                                    @elseif($data_mahasiswa->skripsiPilih->where('status_mahasiswa','2')->first())
                                        <small class="text-primary">SKRIPSI</small>
                                    @elseif($data_mahasiswa->skripsiPilih->where('status_mahasiswa','3')->first())
                                        <small class="text-primary">SIAP PENDADARAN</small>   
                                    @endif
                                @else
                                     <small class="text-warning">Anda belum punya judul</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Total income & spend statistics</div>
                            <div class="row py-3">
                                <div class="col-md-4 d-flex flex-column justify-content-around">
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
                                        <h3 class="fw-bold">$9.782</h3>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-danger op-8">Total Spend</h6>
                                        <h3 class="fw-bold">$1,248</h3>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="chart-container">
                                        <canvas id="totalIncomeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
                2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
            </div>				
        </div>
    </footer>
</div>
@endsection