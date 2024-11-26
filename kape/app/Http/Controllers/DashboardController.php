<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruang;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // total ruang
        $ruang = Ruang::all();
        //total ruang
        $jadwal = Jadwal::all();
        //jumlah permintaan
        $jumlahjadwal = DB::select("SELECT 
    YEAR(tanggal) AS tahun,
    MONTH(tanggal) AS bulan,
    COUNT(*) AS jumlah_permintaan
FROM 
    jadwals
GROUP BY 
    YEAR(tanggal), MONTH(tanggal)
ORDER BY 
    YEAR(tanggal), MONTH(tanggal);");
        return view('dashboard-new')
        ->with('ruang', $ruang)
        ->with('jadwal', $jadwal)
        ->with('jumlahjadwal',$jumlahjadwal);
    }
}
