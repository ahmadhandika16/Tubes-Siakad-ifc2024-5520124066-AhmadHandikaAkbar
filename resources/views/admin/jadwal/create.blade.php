@extends('layouts.app')
@section('title', 'Tambah Jadwal')

@section('content')
<div class="mb-4">
  <a href="{{ route('admin.jadwal.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali ke Jadwal Kuliah</a>
  <h1 class="text-lg font-bold text-gray-800 mt-2">Tambah Jadwal Kuliah</h1>
</div>

<div class="bg-white border border-gray-300 p-6 max-w-xl">
  <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label for="kode_matakuliah" class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah <span class="text-red-500">*</span></label>
      <select name="kode_matakuliah" id="kode_matakuliah" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('kode_matakuliah') border-red-400 @enderror">
        <option value="">-- Pilih Mata Kuliah --</option>
        @foreach($matakuliahList as $mk)
          <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
            {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }})
          </option>
        @endforeach
      </select>
      @error('kode_matakuliah')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="nidn" class="block text-sm font-medium text-gray-700 mb-1">Dosen Pengajar <span class="text-red-500">*</span></label>
      <select name="nidn" id="nidn" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('nidn') border-red-400 @enderror">
        <option value="">-- Pilih Dosen --</option>
        @foreach($dosenList as $d)
          <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
        @endforeach
      </select>
      @error('nidn')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas <span class="text-red-500">*</span></label>
        <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" maxlength="1" required
          class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm uppercase @error('kelas') border-red-400 @enderror"
          placeholder="A" style="text-transform:uppercase">
        @error('kelas')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label for="jam" class="block text-sm font-medium text-gray-700 mb-1">Jam <span class="text-red-500">*</span></label>
        <input type="time" name="jam" id="jam" value="{{ old('jam') }}" required
          class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('jam') border-red-400 @enderror">
        @error('jam')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
      </div>
    </div>
    <div>
      <label for="hari" class="block text-sm font-medium text-gray-700 mb-1">Hari <span class="text-red-500">*</span></label>
      <select name="hari" id="hari" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('hari') border-red-400 @enderror">
        <option value="">-- Pilih Hari --</option>
        @foreach($hariList as $h)
          <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
        @endforeach
      </select>
      @error('hari')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="flex gap-3 pt-2">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-1.5  transition">
        Simpan
      </button>
      <a href="{{ route('admin.jadwal.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-3 py-1.5">
        Batal
      </a>
    </div>
  </form>
</div>
@endsection
