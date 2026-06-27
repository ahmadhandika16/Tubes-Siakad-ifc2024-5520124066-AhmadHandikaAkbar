@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="mb-4">
  <a href="{{ route('admin.mahasiswa.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali ke Data Mahasiswa</a>
  <h1 class="text-lg font-bold text-gray-800 mt-2">Tambah Mahasiswa Baru</h1>
</div>

<div class="bg-white border border-gray-300 p-6 max-w-xl">
  <form action="{{ route('admin.mahasiswa.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label for="npm" class="block text-sm font-medium text-gray-700 mb-1">NPM <span class="text-red-500">*</span></label>
      <input type="text" name="npm" id="npm" value="{{ old('npm') }}" maxlength="10" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('npm') border-red-400 @enderror"
        placeholder="Contoh: 2024001009">
      @error('npm')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
      <p class="text-xs text-gray-400 mt-1">10 digit angka. Akan menjadi password default akun login.</p>
    </div>
    <div>
      <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Mahasiswa <span class="text-red-500">*</span></label>
      <input type="text" name="nama" id="nama" value="{{ old('nama') }}" maxlength="50" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('nama') border-red-400 @enderror">
      @error('nama')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('email') border-red-400 @enderror"
        placeholder="mahasiswa@student.siakad.ac.id">
      @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="nidn" class="block text-sm font-medium text-gray-700 mb-1">Dosen Wali</label>
      <select name="nidn" id="nidn" class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm @error('nidn') border-red-400 @enderror">
        <option value="">-- Tidak ada --</option>
        @foreach($dosenList as $d)
          <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>{{ $d->nama }}</option>
        @endforeach
      </select>
      @error('nidn')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="flex gap-3 pt-2">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-1.5  transition">
        Simpan
      </button>
      <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-3 py-1.5">
        Batal
      </a>
    </div>
  </form>
</div>
@endsection
