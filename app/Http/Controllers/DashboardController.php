<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\Gedung;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // total gedung
        $gedung = Gedung::all();
        // total permintaan
        $permintaan = Permintaan::all();
        // jumlah permintaan per bulan
        $jumlahPermintaan = DB::select("SELECT 
            YEAR(tanggal) AS tahun,
            MONTH(tanggal) AS bulan,
            COUNT(*) AS jumlah_permintaan
        FROM 
            permintaans
        GROUP BY 
            YEAR(tanggal), MONTH(tanggal)
        ORDER BY 
            YEAR(tanggal), MONTH(tanggal);");

        return view('dashboard-new')
            ->with('gedung', $gedung)
            ->with('permintaan', $permintaan)
            ->with('jumlahPermintaan', $jumlahPermintaan);
    }
}
