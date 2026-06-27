<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KrsExport;
use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KrsController extends Controller
{
    /**
     * Menampilkan seluruh data KRS (Admin dapat melihat data KRS semua mahasiswa).
     * Bonus: pencarian & filter berdasarkan mahasiswa.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $npmFilter = $request->input('npm');

        $krs = Krs::query()
            ->with(['mahasiswa', 'matakuliah'])
            ->when($search, function ($query, $search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")->orWhere('npm', 'like', "%{$search}%");
                })->orWhereHas('matakuliah', function ($q) use ($search) {
                    $q->where('nama_matakuliah', 'like', "%{$search}%");
                });
            })
            ->when($npmFilter, function ($query, $npmFilter) {
                $query->where('npm', $npmFilter);
            })
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $mahasiswaList = Mahasiswa::orderBy('nama')->get();

        return view('admin.krs.index', compact('krs', 'search', 'mahasiswaList', 'npmFilter'));
    }

    /**
     * Export seluruh data KRS ke Excel (Bonus: Export KRS ke PDF/Excel).
     */
    public function exportExcel()
    {
        $krs = Krs::with(['mahasiswa', 'matakuliah'])
            ->orderBy('npm')
            ->get();

        return Excel::download(new KrsExport($krs), 'Data_KRS_Seluruh_Mahasiswa.xlsx');
    }
}
