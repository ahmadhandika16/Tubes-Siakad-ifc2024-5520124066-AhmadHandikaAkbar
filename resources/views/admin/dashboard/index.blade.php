@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-5">
    <h1 class="text-lg font-bold text-gray-700">Dashboard Admin</h1>
    <p class="text-gray-500 text-xs mt-1">Ringkasan statistik Sistem Informasi Akademik.</p>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800">{{ $totalDosen }}</p>
        <p class="text-xs text-gray-500">Dosen</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800">{{ $totalMahasiswa }}</p>
        <p class="text-xs text-gray-500">Mahasiswa</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800">{{ $totalMatakuliah }}</p>
        <p class="text-xs text-gray-500">Mata Kuliah</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800">{{ $totalJadwal }}</p>
        <p class="text-xs text-gray-500">Jadwal</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800">{{ $totalKrs }}</p>
        <p class="text-xs text-gray-500">Total KRS</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4 mb-4">
    <!-- Mata kuliah terpopuler -->
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Mata Kuliah Terpopuler</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                @forelse($matakuliahTerpopuler as $mk)
                    <tr>
                        <td class="px-4 py-2">
                            <p class="text-gray-700">{{ $mk->nama_matakuliah }}</p>
                            <p class="text-xs text-gray-400">{{ $mk->kode_matakuliah }} - {{ $mk->sks }} SKS</p>
                        </td>
                        <td class="px-4 py-2 text-right text-gray-600">{{ $mk->krs_count }} mhs</td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada data KRS.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Dosen bimbingan terbanyak -->
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Dosen dengan Bimbingan Terbanyak</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                @forelse($dosenBimbinganTerbanyak as $d)
                    <tr>
                        <td class="px-4 py-2">
                            <p class="text-gray-700">{{ $d->nama }}</p>
                            <p class="text-xs text-gray-400">NIDN: {{ $d->nidn }}</p>
                        </td>
                        <td class="px-4 py-2 text-right text-gray-600">{{ $d->mahasiswa_count }} mhs</td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <!-- Distribusi jadwal per hari -->
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Distribusi Jadwal per Hari</h2>
        </div>
        <div class="p-4 space-y-2">
            @php $maxTotal = $jadwalPerHari->max('total') ?: 1; @endphp
            @forelse($jadwalPerHari as $jh)
                <div class="flex items-center gap-2">
                    <span class="w-14 text-xs text-gray-500">{{ $jh->hari }}</span>
                    <div class="flex-1 bg-gray-100 h-2.5">
                        <div class="bg-blue-600 h-2.5" style="width: {{ ($jh->total / $maxTotal) * 100 }}%"></div>
                    </div>
                    <span class="text-xs text-gray-600 w-5 text-right">{{ $jh->total }}</span>
                </div>
            @empty
                <p class="text-sm text-gray-400">Belum ada data jadwal.</p>
            @endforelse
        </div>
    </div>

    <!-- Info tambahan -->
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Statistik Lainnya</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-2 text-gray-600">Rata-rata SKS diambil per mahasiswa</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-800">{{ number_format($rataRataSks ?? 0, 1) }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-600">Rasio mahasiswa per dosen</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-800">{{ $totalDosen > 0 ? number_format($totalMahasiswa / $totalDosen, 1) : 0 }} : 1</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-600">Rata-rata jadwal per mata kuliah</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-800">{{ $totalMatakuliah > 0 ? number_format($totalJadwal / $totalMatakuliah, 1) : 0 }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
