@extends('layouts.master')


@section('content')
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                @include('layouts/error')
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"><i class="fas fa-user-cog"></i> Setting</h2>

                    </div>



                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            @include('layouts/error')
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">

                        <div class="card-body">
                            <table class="table table-typo">
                                <tbody>
                                    <tr>
                                        <td width="5%">
                                            <span class="h4">Batas Konfirmasi :</span>
                                        </td>
                                        <td width="15%"><span class="h4">{{ $hari->batashari}} Hari</span>
                                            <a data-toggle="modal" data-target="#addRowModal{{$hari->id}}"
                                                class="btn btn-primary btn-border btn-round btn-sm ml-2"> <i
                                                    class="fas fa-edit"></i> Ubah</a></td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

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

    <!-- Modal add -->

    <div class="modal fade" id="addRowModal{{$hari->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Ubah settingan Hari</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('setup.update', $hari->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="judul">Minimal</label>
                        <br>
                        <input type="number" name="batashari" value={{ $hari->batashari}} min="1" class="form-control @error('batashari') is-invalid @enderror"
                            placeholder="Masukkan berapa hari">
                        @error('batashari')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
