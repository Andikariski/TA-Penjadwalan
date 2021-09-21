@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                {{-- @if ($data)
                    
                
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-white"> <i class="fas fa-arrow-left"></i>
                Back</a>

            </div>


        </div>
        @endif --}}
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        @if (strtotime(date('Y-m-d')) < strtotime($date))
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-header">
                        <div class="card-title text-center">Belum waktunya mengisi Nilai !</div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($countArr > 0)
            <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-header">
                        <div class="card-title text-center">Anda Sudah mengisi Nilai !</div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-12">
            <form action="{{ route('penilaian-semprop.update', $data_mahasiswa->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-title">Penilaian Seminar Proposal</div>

                        <small class="text-primary">
                            @if ($data_mahasiswa->nim_submit)
                            {{ $data_mahasiswa->mahasiswaSubmit->user->name}}
                            @elseif($data_mahasiswa->nim_terpilih)
                            {{ $data_mahasiswa->mahasiswaTerpilih->user->name}}
                            @endif
                        </small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($pertanyaan_semprop as $questions)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="judul">{{ $questions->unsurPenilaian}}</label>
                                    <br>
                                    <small class="text-primary mt-2">Range 0 - {{$questions->rangeNilai}}</small>
                                    <input type="number" id="numberBox" name="pertanyaan[]" min="0"
                                        max={{$questions->rangeNilai}}
                                        class="form-control @error('{{$questions->id}}') is-invalid @enderror"
                                        placeholder="Masukkan Nilai" required>
                                    @error('{{$questions->id}}')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endforeach

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

<script>
    $(function () {
        $("#numberBox").change(function () {
            var max = parseInt($(this).attr('max'));
            var min = parseInt($(this).attr('min'));
            if ($(this).val() > max) {
                $(this).val(max);
            } else if ($(this).val() < min) {
                $(this).val(min);
            }
        });
    });

</script>
@endsection
