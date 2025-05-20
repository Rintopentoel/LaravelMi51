<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\Gedung;
use App\Models\User;
use App\Models\JadwalTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasil = Permintaan::all();
        return view('permintaan.index')->with('hasil', $hasil);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tidak perlu kirim gedung/user ke view jika otomatis
        return view('permintaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            "deskripsi" => "required",
            "foto" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        // Set otomatis
        $input['tanggal'] = now()->toDateString();
        $input['user_id'] = Auth::id();
        $input['gedung_id'] = Auth::user()->gedung_id;
        $input['status'] = 'belum';

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('images', $fileName, 'public');
            $input['foto'] = $fileName;
        }

        Permintaan::create($input);

        return redirect()->route('permintaan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permintaan $permintaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($permintaan)
    {
        $hasil = Permintaan::find($permintaan);
        $gedung = Gedung::all();
        $user = User::all();
        $teknisi = User::where('role', 'teknisi')->get();

        // Ambil id teknisi yang sudah ditugaskan pada permintaan ini dari tabel jadwal_tims
        $jadwalTimTeknisiIds = JadwalTim::where('permintaan_id', $permintaan)->pluck('user_id')->toArray();

        return view('permintaan.edit', compact('hasil', 'gedung', 'user', 'teknisi', 'jadwalTimTeknisiIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $permintaan)
    {
        $input = $request->validate([
            "tanggal" => "required",
            "gedung_id" => "required",
            "user_id" => "required",
            "deskripsi" => "required",
            "status" => "required",
            "teknisi_ids" => "array|nullable",
            "teknisi_ids.*" => "exists:users,id"
        ]);

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('images', $fileName, 'public');
            $input['foto'] = $fileName;
        }

        $hasil = Permintaan::find($permintaan);
        $hasil->update($input);

        // Update tim teknisi pada tabel jadwal_tims
        // Hapus dulu semua teknisi yang lama
        \App\Models\JadwalTim::where('permintaan_id', $hasil->id)->delete();

        // Tambahkan teknisi yang baru dipilih
        if ($request->filled('teknisi_ids')) {
            foreach ($request->teknisi_ids as $teknisi_id) {
                \App\Models\JadwalTim::create([
                    'permintaan_id' => $hasil->id,
                    'user_id' => $teknisi_id,
                ]);
            }
        }

        return redirect()->route('permintaan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permintaan)
    {
        $hasil = Permintaan::find($permintaan);
        $hasil->delete();

        return redirect()->route('permintaan.index');
    }

    public function getPermintaan()
    {
        $hasil = Permintaan::all();
        return response()->json($hasil);
    }

    public function storePermintaan(Request $request)
    {
        $input = $request->validate([
            "deskripsi" => "required",
        ]);

        $input['tanggal'] = now()->toDateString();
        $input['user_id'] = Auth::id();
        $input['gedung_id'] = Auth::user()->gedung_id;
        $input['status'] = 'belum';

        Permintaan::create($input);

        return response()->json(['message' => 'Data permintaan berhasil disimpan']);
    }
}
