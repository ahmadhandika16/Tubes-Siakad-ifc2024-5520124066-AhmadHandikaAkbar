<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Menampilkan jadwal kuliah mahasiswa berdasarkan mata kuliah
     * yang sudah diambil di KRS (fitur "lihat jadwal" untuk Mahasiswa).
     */
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (! $mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan untuk akun ini.');
        }

        $kodeMatakuliah = Krs::where('npm', $mahasiswa->npm)->pluck('kode_matakuliah');

        $jadwal = \App\Models\Jadwal::whereIn('kode_matakuliah', $kodeMatakuliah)
            ->with(['matakuliah', 'dosen'])
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') asc")
            ->orderBy('jam')
            ->get();

        return view('mahasiswa.jadwal.index', compact('jadwal', 'mahasiswa'));
    }
}
