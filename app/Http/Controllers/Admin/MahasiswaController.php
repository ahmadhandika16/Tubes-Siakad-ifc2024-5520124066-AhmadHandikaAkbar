<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa.
     * Bonus: pencarian berdasarkan NPM/nama, filter berdasarkan dosen wali.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $nidnFilter = $request->input('nidn');

        $mahasiswa = Mahasiswa::query()
            ->with('dosen')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('npm', 'like', "%{$search}%");
            })
            ->when($nidnFilter, function ($query, $nidnFilter) {
                $query->where('nidn', $nidnFilter);
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        $dosenList = Dosen::orderBy('nama')->get();

        return view('admin.mahasiswa.index', compact('mahasiswa', 'search', 'dosenList', 'nidnFilter'));
    }

    /**
     * Menampilkan form tambah mahasiswa.
     */
    public function create()
    {
        $dosenList = Dosen::orderBy('nama')->get();

        return view('admin.mahasiswa.create', compact('dosenList'));
    }

    /**
     * Menyimpan data mahasiswa baru sekaligus membuat akun login-nya.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => ['required', 'string', 'size:10', 'unique:mahasiswa,npm', 'regex:/^[0-9]+$/'],
            'nidn' => ['nullable', 'string', 'exists:dosen,nidn'],
            'nama' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
        ], [
            'npm.regex' => 'NPM hanya boleh berisi angka.',
            'npm.size' => 'NPM harus terdiri dari 10 digit.',
            'npm.unique' => 'NPM sudah terdaftar.',
            'nidn.exists' => 'Dosen wali yang dipilih tidak ditemukan.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        DB::transaction(function () use ($validated) {
            Mahasiswa::create([
                'npm' => $validated['npm'],
                'nidn' => $validated['nidn'] ?? null,
                'nama' => $validated['nama'],
            ]);

            User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['npm']),
                'role' => 'mahasiswa',
                'npm' => $validated['npm'],
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan. Password default akun: NPM mahasiswa.');
    }

    /**
     * Menampilkan detail mahasiswa beserta KRS-nya.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load(['dosen', 'krs.matakuliah']);

        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Menampilkan form edit mahasiswa.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $dosenList = Dosen::orderBy('nama')->get();

        return view('admin.mahasiswa.edit', compact('mahasiswa', 'dosenList'));
    }

    /**
     * Memperbarui data mahasiswa.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'npm' => ['required', 'string', 'size:10', 'unique:mahasiswa,npm,'.$mahasiswa->npm.',npm', 'regex:/^[0-9]+$/'],
            'nidn' => ['nullable', 'string', 'exists:dosen,nidn'],
            'nama' => ['required', 'string', 'max:50'],
        ], [
            'npm.regex' => 'NPM hanya boleh berisi angka.',
            'npm.size' => 'NPM harus terdiri dari 10 digit.',
            'npm.unique' => 'NPM sudah terdaftar.',
            'nidn.exists' => 'Dosen wali yang dipilih tidak ditemukan.',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Menghapus data mahasiswa beserta akun user terkait.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        DB::transaction(function () use ($mahasiswa) {
            User::where('npm', $mahasiswa->npm)->delete();
            $mahasiswa->krs()->delete();
            $mahasiswa->delete();
        });

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
