@extends('layouts.main')

@section('content')
<h2>Ruang</h2>
<a href="{{ route('ruang.create') }}" class="btn btn-primary"> Tambah </a>
<table class="table" id="datatablesSimple">
    <thead>
    <tr>
        <th>Nama Ruang</th>
        <th>lantai</th>
        <th>Aksi</th>
    </tr>
    </thead>
    @foreach ($hasil as $row)
    <!-- nama kolom -->
    <!-- sesuaikan dengan kolom masing-masing -->
     <tr>
        <td>
            {{ $row['nama_ruang'] }}
        </td>
        <td>

            {{ $row['lantai'] }}
        </td>
        <td>
            <a href="{{ route('ruang.edit', $row['id'])}}" class="btn btn-warning">ubah</a>
            <form action="{{route('ruang.destroy', $row['id'])}}" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Hapus</button>
        </form>
        </td> 
    </tr>       
    @endforeach
</table>
@endsection