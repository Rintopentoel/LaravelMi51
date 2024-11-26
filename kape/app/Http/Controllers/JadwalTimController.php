<?php

namespace App\Http\Controllers;

use App\Models\JadwalTim;
use Illuminate\Http\Request;

class JadwalTimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // panggil model jadwal
        $hasil = JadwalTim::all();
       // cek isi variabel $hasil
        //dd($hasil);
        return view('jadwaltim.index')->with('hasil', $hasil); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            "tanggal" => "required",
            "tanggal_servis_selanjutnya" => "required",
            "ruang_id" => "required",
            "user_id" => "required",
            "status" => "required",
        ]);

        // simpan ke tabel ruang
        Jadwaltim::create($input);

        // redirect ke route jadwal.index
        return redirect()->route('jadwal_tim.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalTim $jadwalTim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalTim $jadwalTim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalTim $jadwalTim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalTim $jadwalTim)
    {
        //
    }
}
