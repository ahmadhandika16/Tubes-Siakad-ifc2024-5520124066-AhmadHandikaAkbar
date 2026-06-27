<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard untuk Mahasiswa: ringkasan KRS yang sudah
     * diambil beserta total SKS pada semester aktif.
     */
    public function index(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (! $mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan untuk akun ini.');
        }

        $mahasiswa->load(['dosen', 'krs.matakuliah']);

        $totalSks = $mahasiswa->krs->sum(fn ($k) => $k->matakuliah->sks ?? 0);
        $totalMatakuliah = $mahasiswa->krs->count();

        return view('mahasiswa.dashboard', compact('mahasiswa', 'totalSks', 'totalMatakuliah'));
    }
}
