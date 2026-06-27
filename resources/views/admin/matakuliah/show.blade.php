@extends('layouts.app')
@section('title', 'Detail Mata Kuliah')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.matakuliah.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data Mata Kuliah</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2">{{ $matakuliah->nama_matakuliah }}</h1>
    <p class="text-gray-500 text-xs">Kode: {{ $matakuliah->kode_matakuliah }} - {{ $matakuliah->sks }} SKS</p>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Jadwal Kelas ({{ $matakuliah->jadwal->count() }})</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                @forelse($matakuliah->jadwal as $j)
                    <tr>
                        <td class="px-4 py-2">
                            <p class="text-gray-700">Kelas {{ $j->kelas }} - {{ $j->dosen->nama ?? '-' }}</p>
                            <p class="text-xs text-gray-400">{{ $j->hari }}, {{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</p>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada jadwal untuk mata kuliah ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Mahasiswa Peserta ({{ $matakuliah->mahasiswa->count() }})</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                @forelse($matakuliah->mahasiswa as $mhs)
                    <tr>
                        <td class="px-4 py-2 text-gray-700">{{ $mhs->nama }}</td>
                        <td class="px-4 py-2 text-right text-gray-400 font-mono text-xs">{{ $mhs->npm }}</td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada mahasiswa yang mengambil mata kuliah ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
