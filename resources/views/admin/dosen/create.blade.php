@extends('layouts.app')
@section('title', 'Tambah Dosen')

@section('content')
<div class="mb-4">
  <a href="{{ route('admin.dosen.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali ke Data Dosen</a>
  <h1 class="text-lg font-bold text-gray-800 mt-2">Tambah Dosen Baru</h1>
</div>

<div class="bg-white border border-gray-300 p-6 max-w-xl">
  <form action="{{ route('admin.dosen.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label for="nidn" class="block text-sm font-medium text-gray-700 mb-1">NIDN <span class="text-red-500">*</span></label>
      <input type="text" name="nidn" id="nidn" value="{{ old('nidn') }}" maxlength="10" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('nidn') border-red-400 @enderror"
        placeholder="Contoh: 0001018501">
      @error('nidn')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
      <p class="text-xs text-gray-400 mt-1">10 digit angka.</p>
    </div>
    <div>
      <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Dosen <span class="text-red-500">*</span></label>
      <input type="text" name="nama" id="nama" value="{{ old('nama') }}" maxlength="50" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('nama') border-red-400 @enderror"
        placeholder="Contoh: Dr. Budi Santoso, M.Kom">
      @error('nama')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="flex gap-3 pt-2">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-1.5  transition">
        Simpan
      </button>
      <a href="{{ route('admin.dosen.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-3 py-1.5">
        Batal
      </a>
    </div>
  </form>
</div>
@endsection
