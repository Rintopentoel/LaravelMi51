<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruang;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // panggil model jadwal
        $hasil = jadwal::all();
       // cek isi variabel $hasil
        //dd($hasil);
        return view('jadwal.index')->with('hasil', $hasil);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruang = Ruang::all();
        $user = User::all();
        return view('jadwal.create')->with('ruang', $ruang)->with('user',$user);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Validasi input termasuk file foto
    $input = $request->validate([
        "tanggal" => "required",
        "tanggal_servis_selanjutnya" => "required",
        "ruang_id" => "required",
        "user_id" => "required",
        "status" => "required",
        "foto" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048", // Validasi foto (opsional)
    ]);

    // Jika ada file foto yang diunggah
    if ($request->hasFile('foto')) {
        // Simpan file foto ke folder public/images
        $fileName = time() . '.' . $request->foto->extension();
        $request->foto->storeAs('images', $fileName, 'public');
        
        // Tambahkan nama file foto ke dalam data input
        $input['foto'] = $fileName;
    }

    // Simpan data ke tabel jadwals
    Jadwal::create($input);

    // Redirect ke route jadwal.index
    return redirect()->route('jadwal.index');
}



    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($jadwal)
    {
        $hasil = Jadwal::find($jadwal);
        $ruang = Ruang::all();
        $user = User::all();
        return view('jadwal.edit')->with('ruang', $ruang)->with('user',$user)->with('hasil',$hasil);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $jadwal)
{
    $input = $request->validate([
        "tanggal" => "required",
        "tanggal_servis_selanjutnya" => "required",
        "ruang_id" => "required",
        "user_id" => "required",
        "status" => "required",
    ]);

    // Check if a photo file is uploaded
    if ($request->hasFile('foto')) {
        // Store the uploaded photo in the public/images directory and generate a unique filename
        $fileName = time() . '.' . $request->foto->extension();
        $request->foto->storeAs('images', $fileName, 'public');
        
        // Add the photo filename to the input array
        $input['foto'] = $fileName;
    }

    // Find the specific record by ID and update it
    $hasil = Jadwal::find($jadwal);
    $hasil->update($input);

    // Redirect to the jadwal.index route
    return redirect()->route('jadwal.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jadwal)
    {
        $hasil = Jadwal::find($jadwal);
        $hasil->delete();

      // redirect ke route ruang.index
        return redirect()->route('jadwal.index');  
    }

    public function getjadwal(){
        $hasil = Jadwal::all();
        return response()->json($hasil);
    }
        public function storeJadwal(Request $request){
      $input = $request->validate([
            "tanggal" => "required",
            "tanggal_servis_selanjutnya" => "required",
            "ruang_id" => "required",
            "user_id" => "required",
            "status" => "required",
        ]);

        // simpan ke tabel ruang
        Jadwal::create($input);
        
        return response()->json(['message' => 'Data ruang berhasil disimpan']);
    }
}
