@extends('layouts.main')

@section('content')
<h2>Tambah Jadwal</h2>
<form action="{{ route('jadwal.store') }}" method="post" enctype="multipart/form-data"> <!-- Menambahkan enctype -->
    @csrf

    Tanggal <br>
    @error('tanggal')
    {{ $message }}
    @enderror
    <input type="date" class="form-control" name="tanggal"> <br>

    Tanggal Servis Selanjutnya <br>
    @error('tanggal_servis_selanjutnya')
    {{ $message }}
    @enderror
    <input type="date" class="form-control" name="tanggal_servis_selanjutnya"> <br>

    Ruang <br>
    @error('ruang_id')
    {{ $message }}
    @enderror
    <select name="ruang_id" class="form-control">
        @foreach ($ruang as $item)
            <option value="{{ $item['id'] }}"> {{ $item['nama_ruang'] }} </option>
        @endforeach
    </select> <br>

    User <br>
    @error('user_id')
    {{ $message }}
    @enderror
    <select name="user_id" class="form-control">
        @foreach ($user as $item)
            <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
        @endforeach
    </select> <br>
    
    Status <br>
    @error('status')
    {{ $message }}
    @enderror
    <input type="text" class="form-control" name="status"> <br>

    Foto <br> <!-- Menambahkan input untuk foto -->
    @error('foto')
    {{ $message }}
    @enderror
    <input type="file" class="form-control" name="foto"> <br>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
