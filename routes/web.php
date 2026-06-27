<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KrsController as AdminKrsController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\JadwalController as MahasiswaJadwalController;
use App\Http\Controllers\Mahasiswa\KrsController as MahasiswaKrsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SIAKAD Sederhana
|--------------------------------------------------------------------------
|
| Tugas Besar Mata Kuliah Web II IF53413
| Struktur route dibagi menjadi 3 bagian:
| 1. Routes untuk halaman utama & autentikasi (guest)
| 2. Routes untuk Admin (role: admin) - Manajemen Data (CRUD)
| 3. Routes untuk Mahasiswa (role: mahasiswa) - KRS & Jadwal
|
*/

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ============================================================
// AUTENTIKASI (Guest only)
// ============================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ============================================================
// ADMIN ROUTES (role: admin)
// ============================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Dosen
    Route::resource('dosen', DosenController::class)->except(['show'])->parameters(['dosen' => 'dosen']);
    Route::get('dosen/{dosen}', [DosenController::class, 'show'])->name('dosen.show');

    // CRUD Mahasiswa
    Route::resource('mahasiswa', MahasiswaController::class)->except(['show'])->parameters(['mahasiswa' => 'mahasiswa']);
    Route::get('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

    // CRUD Mata Kuliah
    Route::resource('matakuliah', MatakuliahController::class)->except(['show'])->parameters(['matakuliah' => 'matakuliah']);
    Route::get('matakuliah/{matakuliah}', [MatakuliahController::class, 'show'])->name('matakuliah.show');

    // CRUD Jadwal
    Route::resource('jadwal', JadwalController::class);

    // Export KRS harus didefinisikan SEBELUM Route::resource('krs', ...)
    // agar path 'krs/export/pdf' tidak tertangkap oleh route 'krs/{krs}' (show).
    Route::get('krs/export/excel', [AdminKrsController::class, 'exportExcel'])->name('krs.export.excel');
    Route::get('krs/export/pdf', [AdminKrsController::class, 'exportPdf'])->name('krs.export.pdf');

    // CRUD KRS (Admin dapat menambah, mengedit, menghapus, dan melihat detail KRS)
    Route::resource('krs', AdminKrsController::class)->parameters(['krs' => 'krs']);
});

// ============================================================
// MAHASISWA ROUTES (role: mahasiswa)
// ============================================================
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {

    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');

    // KRS: ambil mata kuliah, lihat KRS, drop mata kuliah
    Route::get('krs', [MahasiswaKrsController::class, 'index'])->name('krs.index');
    Route::post('krs', [MahasiswaKrsController::class, 'store'])->name('krs.store');
    Route::delete('krs/{krs}', [MahasiswaKrsController::class, 'destroy'])->name('krs.destroy');

    // Export KRS ke PDF & Excel (Bonus)
    Route::get('krs/export/pdf', [MahasiswaKrsController::class, 'exportPdf'])->name('krs.export.pdf');
    Route::get('krs/export/excel', [MahasiswaKrsController::class, 'exportExcel'])->name('krs.export.excel');

    // Lihat jadwal kuliah
    Route::get('jadwal', [MahasiswaJadwalController::class, 'index'])->name('jadwal.index');
});
