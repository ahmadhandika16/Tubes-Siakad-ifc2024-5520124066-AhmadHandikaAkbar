<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Menampilkan daftar dosen.
     * Mendukung pencarian (bonus: pencarian & filter data) berdasarkan
     * NIDN atau nama dosen melalui query string `?search=`.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $dosen = Dosen::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nidn', 'like', "%{$search}%");
            })
            ->withCount('mahasiswa')
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.dosen.index', compact('dosen', 'search'));
    }

    /**
     * Menampilkan form tambah dosen.
     */
    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * Menyimpan data dosen baru.
     * Validasi Laravel diterapkan sesuai requirement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => ['required', 'string', 'size:10', 'unique:dosen,nidn', 'regex:/^[0-9]+$/'],
            'nama' => ['required', 'string', 'max:50'],
        ], [
            'nidn.regex' => 'NIDN hanya boleh berisi angka.',
            'nidn.size' => 'NIDN harus terdiri dari 10 digit.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
        ]);

        Dosen::create($validated);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dosen.
     */
    public function show(Dosen $dosen)
    {
        $dosen->load(['mahasiswa', 'jadwal.matakuliah']);

        return view('admin.dosen.show', compact('dosen'));
    }

    /**
     * Menampilkan form edit dosen.
     */
    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * Memperbarui data dosen.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nidn' => ['required', 'string', 'size:10', 'unique:dosen,nidn,'.$dosen->nidn.',nidn', 'regex:/^[0-9]+$/'],
            'nama' => ['required', 'string', 'max:50'],
        ], [
            'nidn.regex' => 'NIDN hanya boleh berisi angka.',
            'nidn.size' => 'NIDN harus terdiri dari 10 digit.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
        ]);

        $dosen->update($validated);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui.');
    }

    /**
     * Menghapus data dosen.
     */
    public function destroy(Dosen $dosen)
    {
        if ($dosen->mahasiswa()->exists() || $dosen->jadwal()->exists()) {
            return redirect()->route('admin.dosen.index')
                ->with('error', 'Dosen tidak dapat dihapus karena masih memiliki data mahasiswa atau jadwal terkait.');
        }

        $dosen->delete();

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }
}
