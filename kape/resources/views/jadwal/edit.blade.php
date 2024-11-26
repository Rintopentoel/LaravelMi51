@extends('layouts.main')

@section('content')
<h2>Ubah Jadwal</h2>
<form action="{{ route('jadwal.update', $hasil['id']) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    Tanggal <br>
    @error('tanggal')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <input type="date" class="form-control" name="tanggal" value="{{ $hasil['tanggal'] }}"> <br>

    Tanggal Servis Selanjutnya <br>
    @error('tanggal_servis_selanjutnya')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <input type="date" class="form-control" name="tanggal_servis_selanjutnya" value="{{ $hasil['tanggal_servis_selanjutnya'] }}"> <br>

    Ruang <br>
    @error('ruang_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <select name="ruang_id" class="form-control">
        @foreach ($ruang as $item)
            <option value="{{ $item['id'] }}" {{ $hasil->ruang_id == $item['id'] ? 'selected' : '' }}>
                {{ $item['nama_ruang'] }}
            </option>
        @endforeach
    </select>

    User <br>
    @error('user_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <select name="user_id" class="form-control">
        @foreach ($user as $item)
            <option value="{{ $item['id'] }}" {{ $hasil->user_id == $item['id'] ? 'selected' : '' }}>
                {{ $item['name'] }}
            </option>
        @endforeach
    </select>

    Status <br>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <input type="text" class="form-control" name="status" value="{{ $hasil['status'] }}"> <br>

    Foto <br>
    @error('foto')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <input type="file" class="form-control" name="foto"> <br>

    @if(!empty($hasil['foto']))
        <p>Foto saat ini:</p>
        <img src="{{ asset('storage/images/' . $hasil['foto']) }}" alt="Foto" width="150">
    @endif
    <br><br>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
