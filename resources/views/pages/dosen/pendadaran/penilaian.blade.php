@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
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
        @else
        <div class="col-md-12">
            <form action="{{ route('nilai-pendadaran.update', $data_mahasiswa->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-title">Penilaian Ujian Pendadaran Tugas Akhir</div>

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
                            <div class="container">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <form id="regForm">
                                            {{-- <h3 id="register">Pilih salah satu bobot dari nilai</h3> --}}
                                            <div class="all-steps" id="all-steps"> 
                                                <span class="step"></span> <span class="step"></span> 
                                                <span class="step"></span> <span class="step"></span> 
                                                <span class="step"></span> <span class="step"></span> 
                                                <span class="step"></span> <span class="step"></span> 
                                                <span class="step"></span> <span class="step"></span> 
                                            </div>
                                            <hr>
                                            
                                            @php
                                                $no = 1;
                                                $group =0;
                                            @endphp

                                            @foreach ($pertanyaan_pendadaran as $questions)
                                            <fieldset id="pertanyaan<?=$group++?>">
                                                <div class="tab">
                                                    <h4 class="mb-4 mt-4">{{$no++ .' . '. $questions->komponen }}</h4> 
                                                        @foreach ($questions->subPendadaran as $subQuestions)
                                                            <label class="container">
                                                                {{ $subQuestions->keterangan }} 
                                                                <input type="radio" name="pertanyaan<?=$group?>" value="{{ $subQuestions->skor }}"> 
                                                                    <span class="checkmark"></span> 
                                                                    (Bobot {{ $subQuestions->skor }})
                                                            </label>
                                                        @endforeach
                                                </div>
                                            </fieldset> 
                                            @endforeach                                         
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action" style="overflow:auto;" id="nextprevious">
                        <div style="float:right;"> 
                            <button class="btn btn-warning shadow-sm" type="button" id="prevBtn" onclick="nextPrev(-1)">Sebelumnya</button> 
                            <button type="button" class="btn btn-succes shadow-sm" id="nextBtn" onclick="nextPrev(1)">Lanjut</button> 
                            <button type="submit" class="btn btn-primary shadow-sm" style="display:none" id="submit">Simpan</button>
                        </div>
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
