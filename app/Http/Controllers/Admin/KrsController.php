<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KrsExport;
use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Barryvdh\DomPDF\Facade\Pdf;
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
     * Menampilkan form tambah KRS (Admin menambahkan KRS untuk mahasiswa).
     */
    public function create()
    {
        $mahasiswaList = Mahasiswa::orderBy('nama')->get();
        $matakuliahList = Matakuliah::orderBy('nama_matakuliah')->get();

        return view('admin.krs.create', compact('mahasiswaList', 'matakuliahList'));
    }

    /**
     * Menyimpan data KRS baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => ['required', 'exists:mahasiswa,npm'],
            'kode_matakuliah' => ['required', 'exists:matakuliah,kode_matakuliah'],
            'semester' => ['required', 'string', 'max:20'],
        ]);

        $exists = Krs::where('npm', $validated['npm'])
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->where('semester', $validated['semester'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['kode_matakuliah' => 'Mahasiswa ini sudah mengambil mata kuliah tersebut pada semester yang sama.'])->withInput();
        }

        Krs::create($validated);

        return redirect()->route('admin.krs.index')
            ->with('success', 'Data KRS berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail 1 data KRS.
     */
    public function show(Krs $krs)
    {
        $krs->load(['mahasiswa.dosen', 'matakuliah.jadwal.dosen']);

        return view('admin.krs.show', compact('krs'));
    }

    /**
     * Menampilkan form edit KRS.
     */
    public function edit(Krs $krs)
    {
        $mahasiswaList = Mahasiswa::orderBy('nama')->get();
        $matakuliahList = Matakuliah::orderBy('nama_matakuliah')->get();

        return view('admin.krs.edit', compact('krs', 'mahasiswaList', 'matakuliahList'));
    }

    /**
     * Memperbarui data KRS.
     */
    public function update(Request $request, Krs $krs)
    {
        $validated = $request->validate([
            'npm' => ['required', 'exists:mahasiswa,npm'],
            'kode_matakuliah' => ['required', 'exists:matakuliah,kode_matakuliah'],
            'semester' => ['required', 'string', 'max:20'],
        ]);

        $exists = Krs::where('npm', $validated['npm'])
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->where('semester', $validated['semester'])
            ->where('id', '!=', $krs->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['kode_matakuliah' => 'Mahasiswa ini sudah mengambil mata kuliah tersebut pada semester yang sama.'])->withInput();
        }

        $krs->update($validated);

        return redirect()->route('admin.krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    /**
     * Menghapus data KRS.
     */
    public function destroy(Krs $krs)
    {
        $krs->delete();

        return redirect()->route('admin.krs.index')
            ->with('success', 'Data KRS berhasil dihapus.');
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

    /**
     * Export data KRS ke PDF (Bonus: Export KRS ke PDF/Excel).
     * Menghormati filter pencarian & filter mahasiswa yang sedang aktif,
     * sehingga Admin bisa export semua data atau hanya KRS 1 mahasiswa.
     */
    public function exportPdf(Request $request)
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
            ->orderBy('npm')
            ->get();

        $mahasiswaTunggal = $npmFilter ? Mahasiswa::find($npmFilter) : null;

        $pdf = Pdf::loadView('admin.krs.pdf', [
            'krs' => $krs,
            'mahasiswaTunggal' => $mahasiswaTunggal,
        ]);

        $namaFile = $mahasiswaTunggal
            ? 'KRS_'.$mahasiswaTunggal->npm.'.pdf'
            : 'Data_KRS_Seluruh_Mahasiswa.pdf';

        return $pdf->download($namaFile);
    }
}
