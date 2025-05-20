@extends('layouts.main')

@section('content')
<h2>Tambah User Baru</h2>

<form action="{{ route('user.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" name="role" id="role" required>
            <option value="user">User</option>
            <option value="spv">SPV</option>
            <option value="teknisi">Teknisi</option>
        </select>
    </div>

    <div class="form-group">
        <label for="gedung_id">Nama Gedung</label>
        <select class="form-control" name="gedung_id" id="gedung_id" required>
            <option value="">-- Pilih Gedung --</option>
            @foreach($gedungs as $gedung)
                <option value="{{ $gedung->id }}">{{ $gedung->nama_gedung }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>
@endsection
