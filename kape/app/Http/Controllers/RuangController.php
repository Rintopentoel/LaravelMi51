<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // panggil model ruang
        $hasil = Ruang::all();
       // cek isi variabel $hasil
        //dd($hasil);
        return view('ruang.index')->with('hasil', $hasil);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            "nama_ruang" => "required",
            "lantai" => "required",
        ]);

        // simpan ke tabel ruang
        Ruang::create($input);

        // redirect ke route ruang.index
        return redirect()->route('ruang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruang $ruang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ruang)
    {
        $hasil = Ruang::find($ruang);
        //dd($hasil);
        return view('ruang.edit')->with('hasil',$hasil);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$ruang)
    {
         $input = $request->validate([
            "nama_ruang" => "required",
            "lantai" => "required",
        ]);

        // simpan perubahan ke tabel ruang
        $hasil = Ruang::find($ruang);
        $hasil->update($input);

        // redirect ke route ruang.index
        return redirect()->route('ruang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ruang)
    {
        $hasil = Ruang::find($ruang);
        $hasil->delete();

      // redirect ke route ruang.index
        return redirect()->route('ruang.index');  
    }

    public function getRuang(){
        $hasil = Ruang::all();
        return response()->json($hasil);
    }

    public function storeRuang(Request $request){
      $input = $request->validate([
            "nama_ruang" => "required",
            "lantai" => "required",
        ]);

        // simpan ke tabel ruang
        Ruang::create($input);
        
        return response()->json(['message' => 'Data ruang berhasil disimpan']);
    }
}
