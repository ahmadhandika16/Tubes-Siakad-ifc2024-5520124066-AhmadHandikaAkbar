@extends('layouts.app')
@section('title', 'Jadwal Kuliah')

@section('content')
<div class="mb-5">
    <h1 class="text-lg font-bold text-gray-700">Jadwal Kuliah Saya</h1>
    <p class="text-gray-500 text-xs mt-1">Jadwal berdasarkan mata kuliah yang Anda ambil di KRS.</p>
</div>

@php
    $hariUrut = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $jadwalPerHari = $jadwal->groupBy('hari');
@endphp

<div class="grid md:grid-cols-2 gap-4">
    @forelse($hariUrut as $hari)
        @if($jadwalPerHari->has($hari))
            <div class="bg-white border border-gray-300">
                <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
                    <h2 class="font-semibold text-gray-700 text-sm">{{ $hari }}</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($jadwalPerHari[$hari] as $j)
                        <div class="px-4 py-3">
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-gray-700 text-sm">{{ $j->matakuliah->nama_matakuliah ?? '-' }}</p>
                                <span class="text-xs text-blue-700">{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Kelas {{ $j->kelas }} - {{ $j->dosen->nama ?? '-' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @empty
    @endforelse
</div>

@if($jadwal->isEmpty())
    <div class="bg-white border border-gray-300 p-8 text-center">
        <p class="text-gray-400 text-sm">Belum ada jadwal kuliah. Silakan ambil mata kuliah pada menu KRS terlebih dahulu.</p>
        <a href="{{ route('mahasiswa.krs.index') }}" class="inline-block mt-2 text-blue-600 hover:underline text-sm">Kelola KRS &rarr;</a>
    </div>
@endif
@endsection
