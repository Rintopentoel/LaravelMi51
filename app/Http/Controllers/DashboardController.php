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
        $gedung = Gedung::with(['permintaan'])->get();
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

        // jumlah permintaan berdasarkan status
        $jumlahBelum = Permintaan::where('status', 'belum')->count();
        $jumlahProses = Permintaan::where('status', 'proses')->count();
        $jumlahSelesai = Permintaan::where('status', 'selesai')->count();

        // Data untuk grafik: permintaan per status per gedung
        $grafik = [];
        foreach ($gedung as $g) {
            $grafik[] = [
                'nama_gedung' => $g->nama_gedung,
                'belum' => $g->permintaan->where('status', 'belum')->count(),
                'proses' => $g->permintaan->where('status', 'proses')->count(),
                'selesai' => $g->permintaan->where('status', 'selesai')->count(),
            ];
        }

        return view('dashboard-new')
            ->with('gedung', $gedung)
            ->with('permintaan', $permintaan)
            ->with('jumlahPermintaan', $jumlahPermintaan)
            ->with('jumlahBelum', $jumlahBelum)
            ->with('jumlahProses', $jumlahProses)
            ->with('jumlahSelesai', $jumlahSelesai)
            ->with('grafik', $grafik);
    }
}
