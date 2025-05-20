@extends('layouts.main')

@section('content')
<h2>Dashboard</h2>

<div class="row">
    <div class="col-md-6">
        <div class="card text-white bg-primary">
            <div class="card-header">Informasi Gedung</div>
            <div class="card-body">
                <h5 class="card-title">Total Gedung</h5>
                <p class="card-text">{{ count($gedung) }}</p>
            </div>
            <div class="card-footer">Jumlah total Gedung di Sistem</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success">
            <div class="card-header">Informasi Permintaan</div>
            <div class="card-body">
                <h5 class="card-title">Total Permintaan</h5>
                <p class="card-text">{{ number_format(count($permintaan), 0, ',', '.') }}</p>
            </div>
            <div class="card-footer">Jumlah total Permintaan di Sistem</div>
        </div>
    </div>
</div>

@endsection
