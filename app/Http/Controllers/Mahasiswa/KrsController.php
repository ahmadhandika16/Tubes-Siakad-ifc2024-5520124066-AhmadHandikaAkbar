<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Exports\KrsExport;
use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Matakuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class KrsController extends Controller
{
    /**
     * Semester aktif yang digunakan untuk pengambilan KRS.
     * Pada aplikasi nyata ini bisa diambil dari tabel master semester,
     * namun untuk kebutuhan tugas besar ini dibuat sebagai konstanta.
     */
    private const SEMESTER_AKTIF = 'Ganjil 2025/2026';

    /**
     * Batas maksimal SKS yang dapat diambil mahasiswa per semester.
     */
    private const MAX_SKS = 24;

    /**
     * Menampilkan daftar KRS yang sudah diambil mahasiswa beserta
     * daftar mata kuliah yang tersedia untuk diambil.
     */
    public function index(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (! $mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan untuk akun ini.');
        }

        $krsAktif = Krs::where('npm', $mahasiswa->npm)
            ->where('semester', self::SEMESTER_AKTIF)
            ->with('matakuliah.jadwal.dosen')
            ->get();

        $kodeYangDiambil = $krsAktif->pluck('kode_matakuliah');

        $search = $request->input('search');

        $matakuliahTersedia = Matakuliah::query()
            ->whereNotIn('kode_matakuliah', $kodeYangDiambil)
            ->when($search, function ($query, $search) {
                $query->where('nama_matakuliah', 'like', "%{$search}%")
                    ->orWhere('kode_matakuliah', 'like', "%{$search}%");
            })
            ->with('jadwal.dosen')
            ->orderBy('nama_matakuliah')
            ->paginate(8)
            ->withQueryString();

        $totalSks = $krsAktif->sum(fn ($k) => $k->matakuliah->sks ?? 0);

        return view('mahasiswa.krs.index', compact(
            'krsAktif',
            'matakuliahTersedia',
            'totalSks',
            'search',
            'mahasiswa'
        ))->with('maxSks', self::MAX_SKS)->with('semesterAktif', self::SEMESTER_AKTIF);
    }

    /**
     * Mahasiswa mengambil mata kuliah (tambah KRS).
     * Validasi: tidak boleh duplikat, tidak boleh melebihi batas maksimal SKS.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'exists:matakuliah,kode_matakuliah'],
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        if (! $mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan untuk akun ini.');
        }

        $sudahDiambil = Krs::where('npm', $mahasiswa->npm)
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->where('semester', self::SEMESTER_AKTIF)
            ->exists();

        if ($sudahDiambil) {
            return back()->with('error', 'Mata kuliah ini sudah Anda ambil pada semester ini.');
        }

        $matakuliah = Matakuliah::findOrFail($validated['kode_matakuliah']);

        $totalSksSaatIni = Krs::where('npm', $mahasiswa->npm)
            ->where('semester', self::SEMESTER_AKTIF)
            ->join('matakuliah', 'krs.kode_matakuliah', '=', 'matakuliah.kode_matakuliah')
            ->sum('matakuliah.sks');

        if (($totalSksSaatIni + $matakuliah->sks) > self::MAX_SKS) {
            return back()->with('error', "Pengambilan mata kuliah ini akan melebihi batas maksimal ".self::MAX_SKS." SKS per semester.");
        }

        Krs::create([
            'npm' => $mahasiswa->npm,
            'kode_matakuliah' => $validated['kode_matakuliah'],
            'semester' => self::SEMESTER_AKTIF,
        ]);

        return redirect()->route('mahasiswa.krs.index')
            ->with('success', "Mata kuliah {$matakuliah->nama_matakuliah} berhasil ditambahkan ke KRS.");
    }

    /**
     * Mahasiswa drop (hapus) mata kuliah dari KRS.
     */
    public function destroy(Krs $krs)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Pastikan mahasiswa hanya dapat menghapus KRS miliknya sendiri.
        if (! $mahasiswa || $krs->npm !== $mahasiswa->npm) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data KRS ini.');
        }

        $namaMatkul = $krs->matakuliah->nama_matakuliah ?? 'Mata kuliah';
        $krs->delete();

        return redirect()->route('mahasiswa.krs.index')
            ->with('success', "{$namaMatkul} berhasil dihapus dari KRS.");
    }

    /**
     * Export KRS mahasiswa ke PDF (Bonus: Export KRS ke PDF/Excel).
     */
    public function exportPdf()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (! $mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan untuk akun ini.');
        }

        $krs = Krs::where('npm', $mahasiswa->npm)
            ->where('semester', self::SEMESTER_AKTIF)
            ->with('matakuliah')
            ->get();

        $totalSks = $krs->sum(fn ($k) => $k->matakuliah->sks ?? 0);

        $pdf = Pdf::loadView('mahasiswa.krs.pdf', [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'totalSks' => $totalSks,
            'semester' => self::SEMESTER_AKTIF,
        ]);

        return $pdf->download('KRS_'.$mahasiswa->npm.'.pdf');
    }

    /**
     * Export KRS mahasiswa ke Excel (Bonus: Export KRS ke PDF/Excel).
     */
    public function exportExcel()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (! $mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan untuk akun ini.');
        }

        $krs = Krs::where('npm', $mahasiswa->npm)
            ->where('semester', self::SEMESTER_AKTIF)
            ->with(['matakuliah', 'mahasiswa'])
            ->get();

        return Excel::download(new KrsExport($krs), 'KRS_'.$mahasiswa->npm.'.xlsx');
    }
}
