@extends('layouts.master')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                @if ($data)
                    
                
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-white"> <i class="fas fa-arrow-left"></i> Back</a>

                    </div>
                   

                </div>
                @endif
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
                        
                        <form action="{{ route('logbook.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="card full-height">
                            <div class="card-header">
                                <div class="card-title">Tambah Logbook</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="judul">Kegiatan</label>
                                            <input type="text" name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" placeholder="Masukkan Kegiatan">
                                            @error('kegiatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comment">Catatan Kemajuan</label>
                                            <textarea name="catatan_kemajuan" class="form-control @error('catatan_kemajuan') is-invalid @enderror"  rows="5" placeholder="Masukkan catatan kemajuan">
                                                {{ old('catatan_kemajuan') }}
                                            </textarea>
                                            @error('catatan_kemajuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
												<label for="exampleFormControlFile1">File tambahan</label>
												<input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
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