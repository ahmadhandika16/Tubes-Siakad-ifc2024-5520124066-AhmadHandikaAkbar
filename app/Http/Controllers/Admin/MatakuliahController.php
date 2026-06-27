<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Menampilkan daftar mata kuliah.
     * Bonus: pencarian berdasarkan kode atau nama mata kuliah.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $matakuliah = Matakuliah::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_matakuliah', 'like', "%{$search}%")
                    ->orWhere('kode_matakuliah', 'like', "%{$search}%");
            })
            ->withCount('jadwal')
            ->orderBy('kode_matakuliah')
            ->paginate(10)
            ->withQueryString();

        return view('admin.matakuliah.index', compact('matakuliah', 'search'));
    }

    /**
     * Menampilkan form tambah mata kuliah.
     */
    public function create()
    {
        return view('admin.matakuliah.create');
    }

    /**
     * Menyimpan data mata kuliah baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'string', 'max:8', 'unique:matakuliah,kode_matakuliah'],
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ], [
            'kode_matakuliah.unique' => 'Kode mata kuliah sudah terdaftar.',
            'sks.max' => 'SKS maksimal adalah 6.',
        ]);

        Matakuliah::create($validated);

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail mata kuliah beserta jadwal & peserta.
     */
    public function show(Matakuliah $matakuliah)
    {
        $matakuliah->load(['jadwal.dosen', 'mahasiswa']);

        return view('admin.matakuliah.show', compact('matakuliah'));
    }

    /**
     * Menampilkan form edit mata kuliah.
     */
    public function edit(Matakuliah $matakuliah)
    {
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Memperbarui data mata kuliah.
     */
    public function update(Request $request, Matakuliah $matakuliah)
    {
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'string', 'max:8', 'unique:matakuliah,kode_matakuliah,'.$matakuliah->kode_matakuliah.',kode_matakuliah'],
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ], [
            'kode_matakuliah.unique' => 'Kode mata kuliah sudah terdaftar.',
            'sks.max' => 'SKS maksimal adalah 6.',
        ]);

        $matakuliah->update($validated);

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    /**
     * Menghapus data mata kuliah.
     */
    public function destroy(Matakuliah $matakuliah)
    {
        if ($matakuliah->jadwal()->exists() || $matakuliah->krs()->exists()) {
            return redirect()->route('admin.matakuliah.index')
                ->with('error', 'Mata kuliah tidak dapat dihapus karena masih memiliki jadwal atau data KRS terkait.');
        }

        $matakuliah->delete();

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
