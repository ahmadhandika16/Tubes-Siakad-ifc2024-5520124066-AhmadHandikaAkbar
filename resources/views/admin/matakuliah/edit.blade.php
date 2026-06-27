@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="mb-4">
  <a href="{{ route('admin.matakuliah.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali ke Data Mata Kuliah</a>
  <h1 class="text-lg font-bold text-gray-800 mt-2">Edit Mata Kuliah</h1>
</div>

<div class="bg-white border border-gray-300 p-6 max-w-xl">
  <form action="{{ route('admin.matakuliah.update', $matakuliah->kode_matakuliah) }}" method="POST" class="space-y-4">
    @csrf @method('PUT')
    <div>
      <label for="kode_matakuliah" class="block text-sm font-medium text-gray-700 mb-1">Kode Mata Kuliah <span class="text-red-500">*</span></label>
      <input type="text" name="kode_matakuliah" id="kode_matakuliah" value="{{ old('kode_matakuliah', $matakuliah->kode_matakuliah) }}" maxlength="8" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('kode_matakuliah') border-red-400 @enderror">
      @error('kode_matakuliah')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="nama_matakuliah" class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Kuliah <span class="text-red-500">*</span></label>
      <input type="text" name="nama_matakuliah" id="nama_matakuliah" value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" maxlength="50" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('nama_matakuliah') border-red-400 @enderror">
      @error('nama_matakuliah')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="sks" class="block text-sm font-medium text-gray-700 mb-1">SKS <span class="text-red-500">*</span></label>
      <input type="number" name="sks" id="sks" value="{{ old('sks', $matakuliah->sks) }}" min="1" max="6" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('sks') border-red-400 @enderror">
      @error('sks')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="flex gap-3 pt-2">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-1.5  transition">
        Perbarui
      </button>
      <a href="{{ route('admin.matakuliah.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-3 py-1.5">
        Batal
      </a>
    </div>
  </form>
</div>
@endsection
