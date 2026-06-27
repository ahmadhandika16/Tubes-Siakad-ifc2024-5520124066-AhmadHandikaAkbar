@extends('layouts.app')
@section('title', 'KRS Saya')

@section('content')
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Kartu Rencana Studi (KRS)</h1>
        <p class="text-gray-500 text-xs mt-1">Semester {{ $semesterAktif }}</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('mahasiswa.krs.export.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5">
            Export PDF
        </a>
        <a href="{{ route('mahasiswa.krs.export.excel') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1.5">
            Export Excel
        </a>
    </div>
</div>

<!-- KRS yang sudah diambil -->
<div class="bg-white border border-gray-300 mb-5">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50 flex items-center justify-between">
        <h2 class="font-semibold text-gray-700 text-sm">Mata Kuliah yang Sudah Diambil</h2>
        <x-badge :type="$totalSks >= $maxSks ? 'danger' : 'info'">{{ $totalSks }} / {{ $maxSks }} SKS</x-badge>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kode</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">SKS</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Jadwal</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($krsAktif as $k)
                <tr>
                    <td class="px-4 py-2 font-mono text-gray-600">{{ $k->kode_matakuliah }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $k->matakuliah->sks ?? '-' }}</td>
                    <td class="px-4 py-2 text-gray-500 text-xs">
                        @forelse($k->matakuliah->jadwal ?? [] as $j)
                            <div>{{ $j->hari }}, {{ \Carbon\Carbon::parse($j->jam)->format('H:i') }} (Kelas {{ $j->kelas }} - {{ $j->dosen->nama ?? '-' }})</div>
                        @empty
                            <span class="text-gray-400">Belum ada jadwal</span>
                        @endforelse
                    </td>
                    <td class="px-4 py-2 text-right">
                        <form action="{{ route('mahasiswa.krs.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin men-drop mata kuliah {{ $k->matakuliah->nama_matakuliah ?? '' }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Drop</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada mata kuliah yang diambil.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Mata kuliah yang tersedia untuk diambil -->
<div class="bg-white border border-gray-300">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
        <h2 class="font-semibold text-gray-700 text-sm">Mata Kuliah Tersedia</h2>
    </div>

    <div class="p-4">
        <form method="GET" class="flex gap-2 mb-4">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari mata kuliah..."
                class="flex-1 px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
                Cari
            </button>
        </form>

        <div class="grid md:grid-cols-2 gap-3">
            @forelse($matakuliahTersedia as $mk)
                <div class="border border-gray-300 p-3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <p class="font-medium text-gray-800">{{ $mk->nama_matakuliah }}</p>
                            <x-badge>{{ $mk->sks }} SKS</x-badge>
                        </div>
                        <p class="text-xs text-gray-400 font-mono mb-2">{{ $mk->kode_matakuliah }}</p>
                        <div class="text-xs text-gray-500 space-y-0.5 mb-3">
                            @forelse($mk->jadwal as $j)
                                <p>{{ $j->hari }}, {{ \Carbon\Carbon::parse($j->jam)->format('H:i') }} - Kelas {{ $j->kelas }} - {{ $j->dosen->nama ?? '-' }}</p>
                            @empty
                                <p class="text-gray-400">Jadwal belum ditentukan</p>
                            @endforelse
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.krs.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kode_matakuliah" value="{{ $mk->kode_matakuliah }}">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-1.5">
                            + Ambil Mata Kuliah
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-gray-400 col-span-2 text-center py-6">Tidak ada mata kuliah tersedia untuk diambil.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $matakuliahTersedia->links() }}
        </div>
    </div>
</div>
@endsection
