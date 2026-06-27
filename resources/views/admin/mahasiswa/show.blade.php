@extends('layouts.app')
@section('title', 'Detail Mahasiswa')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.mahasiswa.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data Mahasiswa</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2">{{ $mahasiswa->nama }}</h1>
    <p class="text-gray-500 text-xs">NPM: {{ $mahasiswa->npm }} - Dosen Wali: {{ $mahasiswa->dosen->nama ?? '-' }}</p>
</div>

<div class="bg-white border border-gray-300">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
        <h2 class="font-semibold text-gray-700 text-sm">Kartu Rencana Studi (KRS)</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kode</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">SKS</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Semester</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($mahasiswa->krs as $k)
                <tr>
                    <td class="px-4 py-2 font-mono text-gray-600">{{ $k->kode_matakuliah }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $k->matakuliah->sks ?? '-' }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $k->semester }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Belum ada KRS yang diambil.</td></tr>
            @endforelse
        </tbody>
        @if($mahasiswa->krs->isNotEmpty())
            <tfoot>
                <tr class="bg-gray-50 font-semibold border-t border-gray-300">
                    <td colspan="2" class="px-4 py-2 text-right text-gray-600">Total SKS</td>
                    <td class="px-4 py-2 text-gray-800">{{ $mahasiswa->krs->sum(fn($k) => $k->matakuliah->sks ?? 0) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        @endif
    </table>
</div>
@endsection
