<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all(); // Mengambil semua data user
        return view('user.index', compact('users'));
    }

    // Menampilkan formulir untuk membuat pengguna baru
    public function create()
    {
        return view('user.create');
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,admin', // Validasi role
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Menggunakan hash untuk password
        $user->role = $request->role; // Menyimpan role
        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil dibuat');
    }

    // Menampilkan formulir untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed', // Password bisa null jika tidak diubah
            'role' => 'required|in:user,admin', // Validasi role
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password); // Update password jika ada
        }
        $user->role = $request->role; // Memperbarui role
        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}
