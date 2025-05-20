@extends('layouts.main')

@section('content')
<h2>Ubah User</h2>

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>

    <!-- Bagian Role -->
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control" required>
            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
            <option value="spv" {{ $user->role === 'spv' ? 'selected' : '' }}>SPV</option>
            <option value="teknisi" {{ $user->role === 'teknisi' ? 'selected' : '' }}>Teknisi</option>
        </select>
        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Bagian Gedung -->
    <div class="form-group">
        <label for="gedung_id">Nama Gedung</label>
        <select name="gedung_id" id="gedung_id" class="form-control" required>
            <option value="">-- Pilih Gedung --</option>
            @foreach($gedungs as $gedung)
                <option value="{{ $gedung->id }}" {{ $user->gedung_id == $gedung->id ? 'selected' : '' }}>
                    {{ $gedung->nama_gedung }}
                </option>
            @endforeach
        </select>
        @error('gedung_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
</form>
@endsection
