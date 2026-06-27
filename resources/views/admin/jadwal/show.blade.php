@extends('layouts.app')
@section('title', 'Detail Jadwal')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.jadwal.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Jadwal Kuliah</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2">{{ $jadwal->matakuliah->nama_matakuliah ?? '-' }}</h1>
    <p class="text-gray-500 text-xs">Kelas {{ $jadwal->kelas }} - {{ $jadwal->hari }}, {{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }}</p>
</div>

<div class="grid md:grid-cols-2 gap-4 mb-4">
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Informasi Mata Kuliah</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-2 text-gray-500 w-32">Kode</td>
                    <td class="px-4 py-2 text-gray-800 font-mono">{{ $jadwal->matakuliah->kode_matakuliah ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Nama</td>
                    <td class="px-4 py-2 text-gray-800">{{ $jadwal->matakuliah->nama_matakuliah ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">SKS</td>
                    <td class="px-4 py-2 text-gray-800">{{ $jadwal->matakuliah->sks ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Kelas</td>
                    <td class="px-4 py-2 text-gray-800">{{ $jadwal->kelas }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Informasi Pengajaran</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-2 text-gray-500 w-32">Dosen Pengajar</td>
                    <td class="px-4 py-2 text-gray-800">{{ $jadwal->dosen->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">NIDN</td>
                    <td class="px-4 py-2 text-gray-800 font-mono">{{ $jadwal->dosen->nidn ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Hari</td>
                    <td class="px-4 py-2 text-gray-800">{{ $jadwal->hari }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Jam</td>
                    <td class="px-4 py-2 text-gray-800">{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="bg-white border border-gray-300">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
        <h2 class="font-semibold text-gray-700 text-sm">Mahasiswa Peserta Kelas Ini ({{ $jadwal->matakuliah->krs->count() ?? 0 }})</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">NPM</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Nama Mahasiswa</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($jadwal->matakuliah->krs ?? [] as $k)
                <tr>
                    <td class="px-4 py-2 font-mono text-gray-700">{{ $k->mahasiswa->npm ?? $k->npm }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $k->mahasiswa->nama ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="2" class="px-4 py-4 text-center text-gray-400">Belum ada mahasiswa yang mengambil mata kuliah ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 flex gap-2">
    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        Edit
    </a>
    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
        @csrf @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5">Hapus</button>
    </form>
</div>
@endsection
