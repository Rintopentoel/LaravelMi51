<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::with('gedung')->get(); // Relasi ke gedung
        return view('user.index', compact('users'));
    }

    // Menampilkan formulir untuk membuat pengguna baru
    public function create()
    {
        $gedungs = Gedung::all();
        return view('user.create', compact('gedungs'));
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,spv,teknisi',
            'gedung_id' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->gedung_id = $request->gedung_id;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil dibuat');
    }

    // Menampilkan formulir untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $gedungs = Gedung::all();
        return view('user.edit', compact('user', 'gedungs'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:user,spv,teknisi',
            'gedung_id' => 'required|exists:gedungs,id',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->gedung_id = $request->gedung_id;
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
