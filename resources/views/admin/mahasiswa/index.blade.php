@extends('layouts.app')
@section('title', 'Data Mahasiswa')

@section('content')
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Data Mahasiswa</h1>
        <p class="text-gray-500 text-xs mt-1">Kelola data mahasiswa.</p>
    </div>
    <a href="{{ route('admin.mahasiswa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        + Tambah Mahasiswa
    </a>
</div>

<div class="bg-white border border-gray-300 p-3 mb-4">
    <form method="GET" class="flex flex-wrap gap-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari NPM atau nama mahasiswa..."
            class="flex-1 min-w-[180px] px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
        <select name="nidn" class="px-3 py-1.5 border border-gray-300 text-sm">
            <option value="">-- Semua Dosen Wali --</option>
            @foreach($dosenList as $d)
                <option value="{{ $d->nidn }}" {{ $nidnFilter == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
            Filter
        </button>
        @if($search || $nidnFilter)
            <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-500 text-sm px-3 py-1.5">Reset</a>
        @endif
    </form>
</div>

<div class="bg-white border border-gray-300 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">NPM</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Nama Mahasiswa</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Dosen Wali</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($mahasiswa as $m)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 font-mono text-gray-700">{{ $m->npm }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $m->nama }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $m->dosen->nama ?? '-' }}</td>
                    <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.mahasiswa.show', $m->npm) }}" class="text-gray-500 hover:underline text-xs">Lihat</a>
                        <a href="{{ route('admin.mahasiswa.edit', $m->npm) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                        <form action="{{ route('admin.mahasiswa.destroy', $m->npm) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus mahasiswa {{ $m->nama }}? Akun login terkait juga akan terhapus.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Tidak ada data mahasiswa ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $mahasiswa->links() }}
</div>
@endsection
