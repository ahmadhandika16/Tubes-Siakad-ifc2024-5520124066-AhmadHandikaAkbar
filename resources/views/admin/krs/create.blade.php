@extends('layouts.app')
@section('title', 'Tambah KRS')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.krs.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data KRS</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2">Tambah Data KRS</h1>
</div>

<div class="bg-white border border-gray-300 p-4 max-w-xl">
    <form action="{{ route('admin.krs.store') }}" method="POST" class="space-y-3">
        @csrf
        <div>
            <label for="npm" class="block text-xs font-medium text-gray-600 mb-1">Mahasiswa <span class="text-red-500">*</span></label>
            <select name="npm" id="npm" required
                class="w-full px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500 @error('npm') border-red-400 @enderror">
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach($mahasiswaList as $m)
                    <option value="{{ $m->npm }}" {{ old('npm') == $m->npm ? 'selected' : '' }}>{{ $m->nama }} ({{ $m->npm }})</option>
                @endforeach
            </select>
            @error('npm')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="kode_matakuliah" class="block text-xs font-medium text-gray-600 mb-1">Mata Kuliah <span class="text-red-500">*</span></label>
            <select name="kode_matakuliah" id="kode_matakuliah" required
                class="w-full px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500 @error('kode_matakuliah') border-red-400 @enderror">
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($matakuliahList as $mk)
                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                        {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }}) - {{ $mk->sks }} SKS
                    </option>
                @endforeach
            </select>
            @error('kode_matakuliah')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="semester" class="block text-xs font-medium text-gray-600 mb-1">Semester <span class="text-red-500">*</span></label>
            <input type="text" name="semester" id="semester" value="{{ old('semester', 'Ganjil 2025/2026') }}" maxlength="20" required
                class="w-full px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500 @error('semester') border-red-400 @enderror">
            @error('semester')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
                Simpan
            </button>
            <a href="{{ route('admin.krs.index') }}" class="text-gray-500 hover:underline text-sm px-3 py-1.5">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
