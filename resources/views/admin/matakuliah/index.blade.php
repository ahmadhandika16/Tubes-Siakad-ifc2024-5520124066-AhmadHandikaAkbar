@extends('layouts.app')
@section('title', 'Data Mata Kuliah')

@section('content')
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Data Mata Kuliah</h1>
        <p class="text-gray-500 text-xs mt-1">Kelola daftar mata kuliah.</p>
    </div>
    <a href="{{ route('admin.matakuliah.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        + Tambah Mata Kuliah
    </a>
</div>

<div class="bg-white border border-gray-300 p-3 mb-4">
    <form method="GET" class="flex gap-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari kode atau nama mata kuliah..."
            class="flex-1 px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
            Cari
        </button>
        @if($search)
            <a href="{{ route('admin.matakuliah.index') }}" class="text-gray-500 text-sm px-3 py-1.5">Reset</a>
        @endif
    </form>
</div>

<div class="bg-white border border-gray-300 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kode</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Nama Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">SKS</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Jumlah Kelas</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($matakuliah as $mk)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 font-mono text-gray-700">{{ $mk->kode_matakuliah }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $mk->nama_matakuliah }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $mk->sks }}</td>
                    <td class="px-4 py-2"><x-badge>{{ $mk->jadwal_count }} kelas</x-badge></td>
                    <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.matakuliah.show', $mk->kode_matakuliah) }}" class="text-gray-500 hover:underline text-xs">Lihat</a>
                        <a href="{{ route('admin.matakuliah.edit', $mk->kode_matakuliah) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                        <form action="{{ route('admin.matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus mata kuliah {{ $mk->nama_matakuliah }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Tidak ada data mata kuliah ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $matakuliah->links() }}
</div>
@endsection
