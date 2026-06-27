@extends('layouts.app')
@section('title', 'Data KRS')

@section('content')
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Data KRS</h1>
        <p class="text-gray-500 text-xs mt-1">Kartu Rencana Studi seluruh mahasiswa.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.krs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
            + Tambah KRS
        </a>
        <a href="{{ route('admin.krs.export.pdf', request()->only('search', 'npm')) }}" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5">
            Export PDF
        </a>
        <a href="{{ route('admin.krs.export.excel') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1.5">
            Export Excel
        </a>
    </div>
</div>

<div class="bg-white border border-gray-300 p-3 mb-4">
    <form method="GET" class="flex flex-wrap gap-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama/NPM mahasiswa atau mata kuliah..."
            class="flex-1 min-w-[180px] px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
        <select name="npm" class="px-3 py-1.5 border border-gray-300 text-sm">
            <option value="">-- Semua Mahasiswa --</option>
            @foreach($mahasiswaList as $m)
                <option value="{{ $m->npm }}" {{ $npmFilter == $m->npm ? 'selected' : '' }}>{{ $m->nama }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
            Filter
        </button>
        @if($search || $npmFilter)
            <a href="{{ route('admin.krs.index') }}" class="text-gray-500 text-sm px-3 py-1.5">Reset</a>
        @endif
    </form>
</div>

<div class="bg-white border border-gray-300 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">NPM</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Nama Mahasiswa</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">SKS</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Semester</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($krs as $k)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 font-mono text-gray-700">{{ $k->npm }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $k->mahasiswa->nama ?? '-' }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $k->matakuliah->sks ?? '-' }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $k->semester }}</td>
                    <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.krs.show', ['krs' => $k->id]) }}" class="text-gray-500 hover:underline text-xs">Detail</a>
                        <a href="{{ route('admin.krs.edit', ['krs' => $k->id]) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                        <form action="{{ route('admin.krs.destroy', ['krs' => $k->id]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus KRS {{ $k->mahasiswa->nama ?? '' }} untuk mata kuliah {{ $k->matakuliah->nama_matakuliah ?? '' }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">Tidak ada data KRS ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $krs->links() }}
</div>
@endsection
