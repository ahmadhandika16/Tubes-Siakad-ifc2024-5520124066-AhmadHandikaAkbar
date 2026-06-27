@extends('layouts.app')
@section('title', 'Detail Dosen')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.dosen.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data Dosen</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2">{{ $dosen->nama }}</h1>
    <p class="text-gray-500 text-xs">NIDN: {{ $dosen->nidn }}</p>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Mahasiswa Bimbingan ({{ $dosen->mahasiswa->count() }})</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                @forelse($dosen->mahasiswa as $mhs)
                    <tr>
                        <td class="px-4 py-2 text-gray-700">{{ $mhs->nama }}</td>
                        <td class="px-4 py-2 text-right text-gray-400 font-mono text-xs">{{ $mhs->npm }}</td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada mahasiswa bimbingan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Jadwal Mengajar ({{ $dosen->jadwal->count() }})</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                @forelse($dosen->jadwal as $j)
                    <tr>
                        <td class="px-4 py-2">
                            <p class="text-gray-700">{{ $j->matakuliah->nama_matakuliah ?? '-' }}</p>
                            <p class="text-xs text-gray-400">Kelas {{ $j->kelas }}</p>
                        </td>
                        <td class="px-4 py-2 text-right text-gray-500 text-xs">{{ $j->hari }}, {{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada jadwal mengajar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
