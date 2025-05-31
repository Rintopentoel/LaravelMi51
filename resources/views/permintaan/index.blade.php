@extends('layouts.main')

@section('content')
<h2>Permintaan</h2>
@unless(auth()->user()->role === 'teknisi')
<a href="{{ route('permintaan.create') }}" class="btn btn-primary">Tambah</a>
@endunless

{{-- Filter Form --}}
<form method="GET" action="" class="row g-3 mb-3">
    <div class="col-md-3">
        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
    </div>
    <div class="col-md-3">
        <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
        <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
    </div>
    <div class="col-md-3">
        <label for="lokasi" class="form-label">Lokasi Gedung</label>
        <select class="form-control" id="lokasi" name="lokasi">
            <option value="">-- Semua Lokasi --</option>
            @foreach(\App\Models\Gedung::all() as $g)
                <option value="{{ $g->id }}" {{ request('lokasi') == $g->id ? 'selected' : '' }}>{{ $g->nama_gedung }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="">-- Semua Status --</option>
            <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum</option>
            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>
    <div class="col-md-1 d-flex align-items-end">
        <button type="submit" class="btn btn-secondary w-100">Filter</button>
    </div>
</form>

<table class="table" id="datatablesSimple">
    <thead>
    <tr>
        <th>Foto</th>
        <th>Gedung</th>
        <th>Tanggal</th>
        <th>User</th>
        <th>Deskripsi</th>
        <th>Status</th>
        <th>Tim Teknisi</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($hasil as $row)
    <tr>
        <td>
            @if($row['foto'])
                <img src="{{ asset('storage/images/' . $row['foto']) }}" alt="Foto" width="100" height="100">
            @else
                <span>Tidak ada foto</span>
            @endif
        </td>
        <td>{{ $row->gedung ? $row->gedung->nama_gedung : '-' }}</td>
        <td>{{ $row['tanggal'] }}</td>
        <td>{{ $row->user ? $row->user->name : '-' }}</td>
        <td>{{ $row['deskripsi'] }}</td>
        <td>
            @php
                $status = $row['status'];
                $badge = 'secondary';
                if($status == 'belum') $badge = 'danger';
                elseif($status == 'proses') $badge = 'warning';
                elseif($status == 'selesai') $badge = 'success';
            @endphp
            <span class="badge bg-{{ $badge }}" style="font-size: 1em;">{{ ucfirst($status) }}</span>
        </td>
        <td>
            @php
                $tim = \App\Models\JadwalTim::with('user')->where('permintaan_id', $row['id'])->get();
            @endphp
            @if($tim->count())
                <ul style="padding-left: 18px;">
                    @foreach($tim as $t)
                        <li>{{ $t->user ? $t->user->name : '-' }}</li>
                    @endforeach
                </ul>
            @else
                <span>-</span>
            @endif
        </td>
        <td>
            @if(auth()->user()->role === 'spv' || auth()->user()->role === 'teknisi')
                <a href="{{ route('permintaan.edit', $row['id']) }}" class="btn btn-warning">Ubah</a>
            @endif
            @if(auth()->user()->role === 'spv')
                <form action="{{ route('permintaan.destroy', $row['id']) }}" method="post" style="display:inline">    
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            @endif
        </td>
    </tr> 
    @endforeach 
    </tbody>
</table>     
@endsection