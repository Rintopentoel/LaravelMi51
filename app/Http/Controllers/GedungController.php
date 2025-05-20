<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // panggil model gedung
        $hasil = Gedung::all();
        return view('gedung.index')->with('hasil', $hasil);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gedung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            "nama_gedung" => "required",
            "alamat" => "required",
            "telepon" => "required",
        ]);

        // simpan ke tabel gedung
        Gedung::create($input);

        // redirect ke route gedung.index
        return redirect()->route('gedung.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gedung $gedung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($gedung)
    {
        $hasil = Gedung::find($gedung);
        return view('gedung.edit')->with('hasil', $hasil);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $gedung)
    {
        $input = $request->validate([
            "nama_gedung" => "required",
            "alamat" => "required",
            "telepon" => "required",
        ]);

        // simpan perubahan ke tabel gedung
        $hasil = Gedung::find($gedung);
        $hasil->update($input);

        // redirect ke route gedung.index
        return redirect()->route('gedung.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($gedung)
    {
        $hasil = Gedung::find($gedung);
        $hasil->delete();

        // redirect ke route gedung.index
        return redirect()->route('gedung.index');
    }

    public function getGedung()
    {
        $hasil = Gedung::all();
        return response()->json($hasil);
    }

    public function storeGedung(Request $request)
    {
        $input = $request->validate([
            "nama_gedung" => "required",
            "alamat" => "required",
            "telepon" => "required",
        ]);

        // simpan ke tabel gedung
        Gedung::create($input);

        return response()->json(['message' => 'Data gedung berhasil disimpan']);
    }
}
