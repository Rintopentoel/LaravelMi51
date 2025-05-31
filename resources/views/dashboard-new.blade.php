@extends('layouts.main')

@section('content')
<h2>Dashboard</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Informasi Gedung</div>
            <div class="card-body">
                <h5 class="card-title">Total Gedung</h5>
                <p class="card-text">{{ count($gedung) }}</p>
            </div>
            <div class="card-footer">Jumlah total Gedung di Sistem</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Total Permintaan</div>
            <div class="card-body">
                <h5 class="card-title">Total Permintaan</h5>
                <p class="card-text">{{ number_format(count($permintaan), 0, ',', '.') }}</p>
            </div>
            <div class="card-footer">Jumlah total Permintaan di Sistem</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Status Permintaan</div>
            <div class="card-body">
                <p class="card-text mb-1">Belum: <b>{{ $jumlahBelum }}</b></p>
                <p class="card-text mb-1">Proses: <b>{{ $jumlahProses }}</b></p>
                <p class="card-text mb-1">Selesai: <b>{{ $jumlahSelesai }}</b></p>
            </div>
            <div class="card-footer">Rekap Status Permintaan</div>
        </div>
    </div>
</div>

{{-- Grafik Permintaan per Gedung --}}
<div class="card mt-4">
    <div class="card-header">
        Grafik Permintaan per Gedung Berdasarkan Status
    </div>
    <div class="card-body">
        <div id="grafik-permintaan-gedung" style="height: 400px;"></div>
    </div>
</div>

@php
    // Siapkan data grafik
    $gedungLabels = [];
    $belumData = [];
    $prosesData = [];
    $selesaiData = [];

    foreach ($gedung as $g) {
        $gedungLabels[] = $g->nama_gedung;
        $belumData[] = $g->permintaan()->where('status', 'belum')->count();
        $prosesData[] = $g->permintaan()->where('status', 'proses')->count();
        $selesaiData[] = $g->permintaan()->where('status', 'selesai')->count();
    }
@endphp

@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Highcharts.chart('grafik-permintaan-gedung', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Permintaan per Gedung Berdasarkan Status'
        },
        xAxis: {
            categories: {!! json_encode($gedungLabels) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Permintaan'
            }
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Belum',
            data: {!! json_encode($belumData) !!},
            color: '#dc3545'
        }, {
            name: 'Proses',
            data: {!! json_encode($prosesData) !!},
            color: '#ffc107'
        }, {
            name: 'Selesai',
            data: {!! json_encode($selesaiData) !!},
            color: '#28a745'
        }]
    });
});
</script>
@endpush
