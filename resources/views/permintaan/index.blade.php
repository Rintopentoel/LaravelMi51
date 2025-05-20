@extends('layouts.main')

@section('content')
<h2>Permintaan</h2>
@unless(auth()->user()->role === 'teknisi')
<a href="{{ route('permintaan.create') }}" class="btn btn-primary">Tambah</a>
@endunless
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
        <td>{{ $row['status'] }}</td>
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