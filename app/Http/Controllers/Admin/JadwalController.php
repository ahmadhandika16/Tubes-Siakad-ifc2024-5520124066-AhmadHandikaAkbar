<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar jadwal perkuliahan.
     * Bonus: filter berdasarkan hari dan pencarian mata kuliah/dosen.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $hari = $request->input('hari');

        $jadwal = Jadwal::query()
            ->with(['matakuliah', 'dosen'])
            ->when($search, function ($query, $search) {
                $query->whereHas('matakuliah', function ($q) use ($search) {
                    $q->where('nama_matakuliah', 'like', "%{$search}%");
                })->orWhereHas('dosen', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->when($hari, function ($query, $hari) {
                $query->where('hari', $hari);
            })
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') asc")
            ->orderBy('jam')
            ->paginate(10)
            ->withQueryString();

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin.jadwal.index', compact('jadwal', 'search', 'hari', 'hariList'));
    }

    /**
     * Menampilkan detail 1 jadwal kuliah.
     */
    public function show(Jadwal $jadwal)
    {
        $jadwal->load(['matakuliah.krs.mahasiswa', 'dosen']);

        return view('admin.jadwal.show', compact('jadwal'));
    }

    /**
     * Menampilkan form tambah jadwal.
     */
    public function create()
    {
        $matakuliahList = Matakuliah::orderBy('nama_matakuliah')->get();
        $dosenList = Dosen::orderBy('nama')->get();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin.jadwal.create', compact('matakuliahList', 'dosenList', 'hariList'));
    }

    /**
     * Menyimpan jadwal baru.
     * Validasi mencegah dosen mengajar 2 kelas pada hari & jam yang sama.
     */
    public function store(Request $request)
    {
        $request->merge(['kelas' => strtoupper($request->input('kelas'))]);

        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'exists:matakuliah,kode_matakuliah'],
            'nidn' => ['required', 'exists:dosen,nidn'],
            'kelas' => ['required', 'string', 'size:1', 'regex:/^[A-Z]$/'],
            'hari' => ['required', Rule::in(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'])],
            'jam' => ['required', 'date_format:H:i'],
        ], [
            'kelas.regex' => 'Kelas harus berupa 1 huruf kapital (A-Z).',
        ]);

        $exists = Jadwal::where('kode_matakuliah', $validated['kode_matakuliah'])
            ->where('kelas', $validated['kelas'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['kelas' => 'Jadwal untuk mata kuliah dan kelas ini sudah ada.'])->withInput();
        }

        $bentrokDosen = Jadwal::where('nidn', $validated['nidn'])
            ->where('hari', $validated['hari'])
            ->where('jam', $validated['jam'])
            ->exists();

        if ($bentrokDosen) {
            return back()->withErrors(['nidn' => 'Dosen sudah memiliki jadwal mengajar lain pada hari dan jam yang sama.'])->withInput();
        }

        Jadwal::create($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit jadwal.
     */
    public function edit(Jadwal $jadwal)
    {
        $matakuliahList = Matakuliah::orderBy('nama_matakuliah')->get();
        $dosenList = Dosen::orderBy('nama')->get();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin.jadwal.edit', compact('jadwal', 'matakuliahList', 'dosenList', 'hariList'));
    }

    /**
     * Memperbarui data jadwal.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->merge(['kelas' => strtoupper($request->input('kelas'))]);

        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'exists:matakuliah,kode_matakuliah'],
            'nidn' => ['required', 'exists:dosen,nidn'],
            'kelas' => ['required', 'string', 'size:1', 'regex:/^[A-Z]$/'],
            'hari' => ['required', Rule::in(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'])],
            'jam' => ['required', 'date_format:H:i'],
        ], [
            'kelas.regex' => 'Kelas harus berupa 1 huruf kapital (A-Z).',
        ]);

        $exists = Jadwal::where('kode_matakuliah', $validated['kode_matakuliah'])
            ->where('kelas', $validated['kelas'])
            ->where('id', '!=', $jadwal->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['kelas' => 'Jadwal untuk mata kuliah dan kelas ini sudah ada.'])->withInput();
        }

        $bentrokDosen = Jadwal::where('nidn', $validated['nidn'])
            ->where('hari', $validated['hari'])
            ->where('jam', $validated['jam'])
            ->where('id', '!=', $jadwal->id)
            ->exists();

        if ($bentrokDosen) {
            return back()->withErrors(['nidn' => 'Dosen sudah memiliki jadwal mengajar lain pada hari dan jam yang sama.'])->withInput();
        }

        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}
