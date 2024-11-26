@extends('layouts.main')

@section('content')
<h2>Ubah Ruang</h2>
<form action="{{ route('ruang.update',$hasil['id']) }}" method="post">
    @method('PUT')
    @csrf
    Nama Ruang <br>
    <input type="text" class="form-control" name="nama_ruang" value="{{ $hasil['nama_ruang'] }}"> <br>
    Lantai <br>
    <input type="text" class="form-control" name="lantai" value="{{ $hasil['lantai'] }}"> <br>
    
    <button class="btn btn-primary">Simpan</button>
</form>

@endsection