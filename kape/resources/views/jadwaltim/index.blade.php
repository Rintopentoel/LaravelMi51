@extends('layouts.main')

@section('content')
<h2>JadwalTim</h2>
<a href="{{ route('jadwaltim.create') }}" class="btn btn-primary"> Tambah </a>
<table class="table">
    <tr>
        <th>Jadwal Id</th>
        <th>User Id</th>
    </tr>
@foreach ($hasil as $row)
    <!-- nama kolom -->
    <!-- sesuaikan dengan kolom masing-masing -->
     <tr>
        <td>
            {{ $row['jadwal_id'] }}
        </td>
        <td>
           {{ $row['user_id'] }} 
        </td>
    </tr>       
@endforeach
</table>
@endsection