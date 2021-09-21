@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                @include('layouts/error')
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                @if (!$data)
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-header">
                                <div class="card-title text-center">Kamu belum mempunyai judul</div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-title">Pendaftaran Seminar Proposal</div>
                            <small>Masukkan yang sudah ada (.pdf)</small>
                        </div>
                    </div>
                </div>


                @if ($syarat_pembayaran)
                {{-- @if ($item->id_NamaSyarat==3) --}}
                <div class="col-md-12">
                    <div class="card full-height">
                        <form action="{{ url('daftar-semprop/'.$syarat_pembayaran->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Bukti Pembayaran</label>
                                            @if ($syarat_pembayaran->status == 1)
                                            <span class="badge badge-default"> <i class="fas fa-spinner"></i>
                                                Waiting</span>
                                            @elseif($syarat_pembayaran->status == 2)
                                            <span class="badge badge-success"> <i class="fas fa-check"></i>
                                                Accepted</span>
                                            @else
                                            <span class="badge badge-danger"> <i class="fas fa-times"></i> Reject</span>
                                            @endif
                                            <a href="{{ url('view_file/'.$syarat_pembayaran->id) }}" target="_blank"
                                                class="btn btn-secondary btn-xs ml-3"> <i class="fas fa-eye"></i>
                                                View</a>

                                            <input type="file" name="pembayaran"
                                                class="form-control-file @error('pembayaran') is-invalid @enderror"
                                                id="exampleFormControlFile1" required>
                                            @error('pembayaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($syarat_pembayaran->keterangan)
                                           
                                            <br>
                                            <small>Keterangan</small>
                                            <p class="text-danger">{{ $syarat_pembayaran->keterangan}}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning ml-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="card full-height">
                        <form action="{{ route('daftar-semprop.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Bukti Pembayaran</label>
                                            <input type="file" name="pembayaran"
                                                class="form-control-file @error('pembayaran') is-invalid @enderror"
                                                id="exampleFormControlFile1" required>
                                            @error('pembayaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ml-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>



        {{-- TOEFL --}}
        <div class="page-inner mt--5">
            <div class="row mt--2">
                @if (!$data)
                @else

                @if ($syarat_toefl)

                <div class="col-md-12">
                    <div class="card full-height">
                        <form action="{{ url('daftar-semprop/'.$syarat_toefl->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">TOEFL</label>
                                            @if ($syarat_toefl->status == 1)
                                            <span class="badge badge-default"> <i class="fas fa-spinner"></i>
                                                Waiting</span>
                                            @elseif($syarat_toefl->status == 2)
                                            <span class="badge badge-success"> <i class="fas fa-check"></i>
                                                Accepted</span>
                                            @else
                                            <span class="badge badge-danger"> <i class="fas fa-times"></i> Reject</span>
                                            @endif
                                            <a href="{{ url('view_file/'.$syarat_toefl->id) }}" target="_blank"
                                                class="btn btn-secondary btn-xs ml-3"> <i class="fas fa-eye"></i>
                                                View</a>

                                            <input type="file" name="toefl"
                                                class="form-control-file @error('toefl') is-invalid @enderror"
                                                id="exampleFormControlFile1" required>
                                            @error('toefl')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($syarat_toefl->keterangan)
                                            {{-- <label for="exampleFormControlFile1">Keterangan</label> --}}
                                            <br>
                                            <small>Keterangan</small>
                                            <p class="text-danger">{{ $syarat_toefl->keterangan}}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning ml-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                @else
                <div class="col-md-12">
                    <div class="card full-height">
                        <form action="{{ route('daftar-semprop.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">TOEFL</label>
                                            <input type="file" name="toefl"
                                                class="form-control-file @error('toefl') is-invalid @enderror"
                                                id="exampleFormControlFile1" required>
                                            @error('toefl')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ml-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>


        {{-- Naskah --}}
        <div class="page-inner mt--5">
            <div class="row mt--2">
                @if (!$data)
                @else

                @if ($syarat_naskah)

                <div class="col-md-12">
                    <div class="card full-height">
                        <form action="{{ url('daftar-semprop/'.$syarat_naskah->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Naskah Bab 1-3</label>
                                            @if ($syarat_naskah->status == 1)
                                            <span class="badge badge-default"> <i class="fas fa-spinner"></i>
                                                Waiting</span>
                                            @elseif($syarat_naskah->status == 2)
                                            <span class="badge badge-success"> <i class="fas fa-check"></i>
                                                Accepted</span>
                                            @else
                                            <span class="badge badge-danger"> <i class="fas fa-times"></i> Reject</span>
                                            @endif
                                            <a href="{{ url('view_file/'.$syarat_naskah->id) }}" target="_blank"
                                                class="btn btn-secondary btn-xs ml-3"> <i class="fas fa-eye"></i>
                                                View</a>

                                            <input type="file" name="naskah"
                                                class="form-control-file @error('naskah') is-invalid @enderror"
                                                id="exampleFormControlFile1" required>
                                            @error('naskah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($syarat_naskah->keterangan)
                                           
                                            <br>
                                            <small>Keterangan</small>
                                            <p class="text-danger">{{ $syarat_naskah->keterangan}}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning ml-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                @else
                <div class="col-md-12">
                    <div class="card full-height">
                        <form action="{{ route('daftar-semprop.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Naskah Bab 1-3</label>
                                            <input type="file" name="naskah"
                                                class="form-control-file @error('naskah') is-invalid @enderror"
                                                id="exampleFormControlFile1" required>
                                            @error('naskah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ml-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>




        {{-- Transkip --}}
        <div class="page-inner mt--5">
            <div class="row mt--2">
                @if (!$data)
                @else

                @if ($syarat_transkip)

                <div class="col-md-12">
                    <div class="card full-height">
                        <form action="{{ url('daftar-semprop/'.$syarat_transkip->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Transkip Nilai</label>
                                            @if ($syarat_transkip->status == 1)
                                            <span class="badge badge-default"> <i class="fas fa-spinner"></i>
                                                Waiting</span>
                                            @elseif($syarat_transkip->status == 2)
                                            <span class="badge badge-success"> <i class="fas fa-check"></i>
                                                Accepted</span>
                                            @else
                                            <span class="badge badge-danger"> <i class="fas fa-times"></i> Reject</span>
                                            @endif
                                            <a href="{{ url('view_file/'.$syarat_transkip->id) }}" target="_blank"
                                                class="btn btn-secondary btn-xs ml-3"> <i class="fas fa-eye"></i>
                                                View</a>

                                            <input type="file" name="transkip"
                                                class="form-control-file @error('transkip') is-invalid @enderror"
                                                id="exampleFormControlFile1" required>
                                            @error('transkip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($syarat_transkip->keterangan)
                                           
                                            <br>
                                            <small>Keterangan</small>
                                            <p class="text-danger">{{ $syarat_transkip->keterangan}}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning ml-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                @else
                <div class="col-md-12">
                    <div class="card full-height">
                        <form action="{{ route('daftar-semprop.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Transkip Nilai</label>
                                            <input type="file" name="transkip"
                                                class="form-control-file @error('transkip') is-invalid @enderror"
                                                id="exampleFormControlFile1" required>
                                            @error('transkip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ml-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>


    </div>
</div>

{{-- <script>
    $(".custom-file-input").on("change", function () {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script> --}}
@endsection
