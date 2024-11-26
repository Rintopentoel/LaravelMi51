@extends('layouts.main')

@section('content')
<h2>Tambah Ruang</h2>
<form action="{{ route('ruang.store')}}" method="post">
    @csrf
    Nama Ruang <br>
    <input type="text" class="form-control" name="nama_ruang"> <br>
    Lantai <br>
    <input type="text" class="form-control" name="lantai"> <br>
    <button class="btn btn-primary">Simpan</button>
</form>

@endsection