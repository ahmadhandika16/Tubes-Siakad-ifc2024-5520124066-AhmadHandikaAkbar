<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard statistik untuk Admin (Bonus: Dashboard statistic).
     * Menampilkan ringkasan jumlah data serta beberapa statistik
     * agregat yang berguna untuk pengambilan keputusan akademik.
     */
    public function index()
    {
        $totalDosen = Dosen::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalMatakuliah = Matakuliah::count();
        $totalJadwal = Jadwal::count();
        $totalKrs = Krs::count();

        // Statistik: jumlah mahasiswa yang mengambil setiap mata kuliah
        $matakuliahTerpopuler = Matakuliah::query()
            ->withCount('krs')
            ->orderByDesc('krs_count')
            ->take(5)
            ->get();

        // Statistik: jumlah mahasiswa bimbingan per dosen
        $dosenBimbinganTerbanyak = Dosen::query()
            ->withCount('mahasiswa')
            ->orderByDesc('mahasiswa_count')
            ->take(5)
            ->get();

        // Statistik: distribusi jadwal per hari
        $jadwalPerHari = Jadwal::query()
            ->select('hari', DB::raw('count(*) as total'))
            ->groupBy('hari')
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') asc")
            ->get();

        // Statistik: rata-rata jumlah SKS yang diambil mahasiswa
        $rataRataSks = Krs::query()
            ->join('matakuliah', 'krs.kode_matakuliah', '=', 'matakuliah.kode_matakuliah')
            ->select('krs.npm', DB::raw('sum(matakuliah.sks) as total_sks'))
            ->groupBy('krs.npm')
            ->get()
            ->avg('total_sks');

        return view('admin.dashboard.index', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalMatakuliah',
            'totalJadwal',
            'totalKrs',
            'matakuliahTerpopuler',
            'dosenBimbinganTerbanyak',
            'jadwalPerHari',
            'rataRataSks'
        ));
    }
}
