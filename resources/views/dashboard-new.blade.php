@extends('layouts.main')

@section('content')
<h2>Dashboard</h2>

<div class="row">
    <div class="col-md-6">
        <div class="card text-white bg-primary">
            <div class="card-header">Informasi Ruang</div>
            <div class="card-body">
                <h5 class="card-title">Total Ruang</h5>
                <p class="card-text">{{ count($ruang) }}</p>
            </div>
            <div class="card-footer">Jumlah total Ruang di Sistem</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success">
            <div class="card-header">Informasi Jadwal</div>
            <div class="card-body">
                <h5 class="card-title">Total Jadwal</h5>
                <p class="card-text">{{ number_format(count($jadwal), 0, ',', '.') }}</p>
            </div>
            <div class="card-footer">Jumlah total Jadwal di Sistem</div>
        </div>
    </div>
</div>

@endsection
