@extends('layouts.main')

@section('content')
<h2>Tambah Gedung</h2>
<form action="{{ route('gedung.store')}}" method="post">
    @csrf
    Nama Gedung <br>
    <input type="text" class="form-control" name="nama_gedung"> <br>
    Alamat <br>
    <input type="text" class="form-control" name="alamat"> <br>
    Telepon <br>
    <input type="text" class="form-control" name="telepon"> <br>
    <button class="btn btn-primary">Simpan</button>
</form>

@endsection