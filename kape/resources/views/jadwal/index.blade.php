@extends('layouts.main')

@section('content')
<h2>Jadwal</h2>
<a href="{{ route('jadwal.create') }}" class="btn btn-primary"> Tambah </a>
<table class="table" id="datatablesSimple">
    <thead>
    <tr>
        <th>Foto</th> <!-- Kolom baru untuk Foto -->
        <th>Ruang</th>
        <th>Tanggal Servis Awal</th>
        <th>Tanggal Servis Selanjutnya</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($hasil as $row)
    <tr>
        
        <!-- Menampilkan gambar dari kolom foto -->
        <td>
            @if($row['foto'])
            <img src="{{ asset('storage/images/' . $row['foto']) }}" alt="Foto" width="100" height="100">
            @else
            <span>Tidak ada foto</span>
            @endif
        </td>
        <td>{{ $row['ruang']['nama_ruang'] }}</td>
        
        <td>{{ $row['tanggal'] }}</td>
        <td>{{ $row['tanggal_servis_selanjutnya'] }}</td>
        <td>{{ $row['status'] }}</td>
        <td>
            <a href="{{ route('jadwal.edit', $row['id']) }}" class="btn btn-warning">ubah</a>
            <form action="{{ route('jadwal.destroy', $row['id']) }}" method="post" style="display:inline">    
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Hapus</button>
            </form>
        </td>
    </tr> 
    @endforeach 
    </tbody>
</table>     
@endsection