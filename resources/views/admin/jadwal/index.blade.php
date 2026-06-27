@extends('layouts.app')
@section('title', 'Jadwal Kuliah')

@section('content')
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Jadwal Perkuliahan</h1>
        <p class="text-gray-500 text-xs mt-1">Kelola jadwal kuliah: dosen pengajar, hari & jam, dan kelas.</p>
    </div>
    <a href="{{ route('admin.jadwal.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        + Tambah Jadwal
    </a>
</div>

<div class="bg-white border border-gray-300 p-3 mb-4">
    <form method="GET" class="flex flex-wrap gap-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari mata kuliah atau dosen..."
            class="flex-1 min-w-[180px] px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
        <select name="hari" class="px-3 py-1.5 border border-gray-300 text-sm">
            <option value="">-- Semua Hari --</option>
            @foreach($hariList as $h)
                <option value="{{ $h }}" {{ $hari == $h ? 'selected' : '' }}>{{ $h }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
            Filter
        </button>
        @if($search || $hari)
            <a href="{{ route('admin.jadwal.index') }}" class="text-gray-500 text-sm px-3 py-1.5">Reset</a>
        @endif
    </form>
</div>

<div class="bg-white border border-gray-300 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kelas</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Dosen Pengajar</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Hari</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Jam</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($jadwal as $j)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-800">{{ $j->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="px-4 py-2"><x-badge>Kelas {{ $j->kelas }}</x-badge></td>
                    <td class="px-4 py-2 text-gray-600">{{ $j->dosen->nama ?? '-' }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $j->hari }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                    <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.jadwal.show', $j->id) }}" class="text-gray-500 hover:underline text-xs">Detail</a>
                        <a href="{{ route('admin.jadwal.edit', $j->id) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                        <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">Tidak ada data jadwal ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $jadwal->links() }}
</div>
@endsection
