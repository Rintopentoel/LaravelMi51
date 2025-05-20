@extends('layouts.main')

@section('content')
<h2>Daftar User</h2>
<a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User</a>

@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

<table class="table" id="datatablesSimple">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Nama Gedung</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->gedung ? $user->gedung->nama_gedung : '-' }}</td>
            <td>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Ubah</a>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
