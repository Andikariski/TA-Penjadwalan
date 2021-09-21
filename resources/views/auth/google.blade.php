@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Detail Crendential</h4>
            </div>
            <div class="card-body">
                <h3 class="text-primary text-center">Salin kode dibawah dan paste pada konsol</h3>
                <br>
                <h4 class="bg-light p-3 rounded text-center">{{ request()->code }}</h4>
            </div>
        </div>
    </div>
@endsection
