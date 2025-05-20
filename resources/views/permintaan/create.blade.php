@extends('layouts.main')

@section('content')
<h2>Tambah Permintaan</h2>
<form action="{{ route('permintaan.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    Deskripsi permintaan servis<br>
    @error('deskripsi')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <textarea class="form-control" name="deskripsi">{{ old('deskripsi') }}</textarea> <br>

 

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
