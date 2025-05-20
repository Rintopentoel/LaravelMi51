@extends('layouts.main')

@section('content')
<h2>Ubah Permintaan</h2>
<form action="{{ route('permintaan.update', $hasil['id']) }}" method="post" enctype="multipart/form-data">
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

    Gedung <br>
    @error('gedung_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <select name="gedung_id" class="form-control">
        @foreach ($gedung as $item)
            <option value="{{ $item['id'] }}" {{ $hasil->gedung_id == $item['id'] ? 'selected' : '' }}>
                {{ $item['nama_gedung'] }}
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
    <select name="status" class="form-control">
        <option value="belum" {{ $hasil['status'] == 'belum' ? 'selected' : '' }}>Belum</option>
        <option value="proses" {{ $hasil['status'] == 'proses' ? 'selected' : '' }}>Proses</option>
        <option value="selesai" {{ $hasil['status'] == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
    <br>

    Deskripsi <br>
    @error('deskripsi')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <textarea class="form-control" name="deskripsi">{{ $hasil['deskripsi'] }}</textarea> <br>

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

    {{-- Form Tim Teknisi --}}
    <h4>Tim Teknisi yang Ditugaskan</h4>
    @error('teknisi_ids')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <select name="teknisi_ids[]" class="form-control" multiple>
        @foreach ($teknisi as $item)
            <option value="{{ $item->id }}"
                @if(isset($jadwalTimTeknisiIds) && in_array($item->id, $jadwalTimTeknisiIds)) selected @endif>
                {{ $item->name }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Tekan Ctrl (atau Cmd di Mac) untuk memilih lebih dari satu teknisi.</small>
    <br><br>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
