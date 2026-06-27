@extends('layouts.app')
@section('title', 'Data Dosen')

@section('content')
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Data Dosen</h1>
        <p class="text-gray-500 text-xs mt-1">Kelola data dosen pengajar.</p>
    </div>
    <a href="{{ route('admin.dosen.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        + Tambah Dosen
    </a>
</div>

<div class="bg-white border border-gray-300 p-3 mb-4">
    <form method="GET" class="flex gap-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIDN atau nama dosen..."
            class="flex-1 px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
            Cari
        </button>
        @if($search)
            <a href="{{ route('admin.dosen.index') }}" class="text-gray-500 text-sm px-3 py-1.5">Reset</a>
        @endif
    </form>
</div>

<div class="bg-white border border-gray-300 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">NIDN</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Nama Dosen</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Jumlah Bimbingan</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($dosen as $d)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 font-mono text-gray-700">{{ $d->nidn }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $d->nama }}</td>
                    <td class="px-4 py-2"><x-badge>{{ $d->mahasiswa_count }} mahasiswa</x-badge></td>
                    <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.dosen.show', $d->nidn) }}" class="text-gray-500 hover:underline text-xs">Lihat</a>
                        <a href="{{ route('admin.dosen.edit', $d->nidn) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                        <form action="{{ route('admin.dosen.destroy', $d->nidn) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus dosen {{ $d->nama }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Tidak ada data dosen ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $dosen->links() }}
</div>
@endsection
