@extends('layouts.main')

@section('content')
<h2>Gedung</h2>
<a href="{{ route('gedung.create') }}" class="btn btn-primary"> Tambah </a>
<table class="table" id="datatablesSimple">
    <thead>
    <tr>
        <th>Nama Gedung</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>
    </thead>
    @foreach ($hasil as $row)
     <tr>
        <td>
            {{ $row['nama_gedung'] }}
        </td>
        <td>
            {{ $row['alamat'] }}
        </td>
        <td>
            {{ $row['telepon'] }}
        </td>
        <td>
            <a href="{{ route('gedung.edit', $row['id'])}}" class="btn btn-warning">Ubah</a>
            <form action="{{route('gedung.destroy', $row['id'])}}" method="post" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Hapus</button>
            </form>
        </td> 
    </tr>       
    @endforeach
</table>
@endsection