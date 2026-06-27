# SIAKAD Sederhana — Tugas Besar Web II (IF53413)

Aplikasi web Sistem Informasi Akademik (SIAKAD) sederhana berbasis **Laravel 10**, dibuat untuk memenuhi Tugas Besar Mata Kuliah Web II IF53413. Aplikasi ini mengelola data Dosen, Mahasiswa, Mata Kuliah, Jadwal Perkuliahan, dan Kartu Rencana Studi (KRS), dengan dua role pengguna: **Admin** dan **Mahasiswa**.

## 1. Deskripsi Singkat Aplikasi

SIAKAD Sederhana memungkinkan:
- **Admin** mengelola seluruh data master akademik (Dosen, Mahasiswa, Mata Kuliah, Jadwal) serta memantau seluruh data KRS mahasiswa melalui dashboard statistik.
- **Mahasiswa** mengambil dan men-drop mata kuliah (KRS), melihat jadwal kuliah berdasarkan KRS yang diambil, serta mengekspor KRS ke PDF/Excel.

Dibangun menggunakan:
- Laravel 10 (PHP 8.1+)
- MySQL/MariaDB
- Tailwind CSS (via CDN, tanpa build step)
- Laravel Auth (Auth::attempt) untuk login/logout
- Eloquent ORM & Eloquent Relationship penuh sesuai ERD
- Middleware custom (`CheckRole`) untuk otorisasi berbasis role
- barryvdh/laravel-dompdf untuk export PDF
- maatwebsite/excel untuk export Excel

## 2. Struktur Data (ERD)

| Tabel        | Primary Key       | Relasi                                                            |
|--------------|--------------------|---------------------------------------------------------------------|
| `dosen`      | `nidn`             | 1 dosen → banyak `mahasiswa` (wali), 1 dosen → banyak `jadwal`     |
| `mahasiswa`  | `npm`              | banyak mahasiswa → 1 `dosen`, 1 mahasiswa → banyak `krs`           |
| `matakuliah` | `kode_matakuliah`  | 1 matakuliah → banyak `jadwal`, 1 matakuliah → banyak `krs`        |
| `jadwal`     | `id`               | belongsTo `dosen`, belongsTo `matakuliah`                          |
| `krs`        | `id`               | belongsTo `mahasiswa`, belongsTo `matakuliah`                      |
| `users`      | `id`               | tabel auth Laravel, kolom `role` (admin/mahasiswa) dan `npm` (FK)  |

## 3. Penjelasan Fitur per Halaman

### Autentikasi
- **Login** (`/login`) — autentikasi menggunakan `Auth::attempt()`, redirect otomatis ke dashboard sesuai role.
- **Logout** — menghapus sesi dan token CSRF.

### Halaman Admin
| Halaman | Route | Fungsi |
|---|---|---|
| Dashboard | `/admin/dashboard` | Statistik total dosen, mahasiswa, mata kuliah, jadwal, KRS; mata kuliah terpopuler; dosen dengan bimbingan terbanyak; distribusi jadwal per hari; rata-rata SKS diambil mahasiswa. |
| Data Dosen | `/admin/dosen` | CRUD lengkap (tambah, lihat, edit, hapus) data dosen. Dilengkapi pencarian nama/NIDN. |
| Data Mahasiswa | `/admin/mahasiswa` | CRUD lengkap data mahasiswa, otomatis membuat akun login (password default = NPM). Dilengkapi pencarian dan filter berdasarkan dosen wali. |
| Mata Kuliah | `/admin/matakuliah` | CRUD lengkap data mata kuliah (kode, nama, SKS). Dilengkapi pencarian. |
| Jadwal Kuliah | `/admin/jadwal` | CRUD jadwal: menentukan dosen pengajar, hari & jam, dan kelas untuk tiap mata kuliah. Validasi mencegah jadwal ganda & bentrok jadwal dosen. Dilengkapi filter hari. |
| Data KRS | `/admin/krs` | Melihat seluruh data KRS semua mahasiswa, dengan pencarian dan filter per mahasiswa. Dapat diekspor ke Excel. |

### Halaman Mahasiswa
| Halaman | Route | Fungsi |
|---|---|---|
| Dashboard | `/mahasiswa/dashboard` | Ringkasan KRS yang sudah diambil dan total SKS semester aktif. |
| KRS | `/mahasiswa/krs` | Mengambil mata kuliah baru (dengan validasi maksimal 24 SKS & anti-duplikat), men-drop mata kuliah yang sudah diambil, serta mengekspor KRS ke **PDF** dan **Excel**. |
| Jadwal Kuliah | `/mahasiswa/jadwal` | Melihat jadwal kuliah berdasarkan mata kuliah yang sudah diambil di KRS, dikelompokkan per hari. |

## 4. Fitur Bonus yang Diimplementasikan
- ✅ Export KRS ke PDF (mahasiswa) dan Excel (mahasiswa & admin)
- ✅ Pencarian & filter data pada seluruh modul (Dosen, Mahasiswa, Mata Kuliah, Jadwal, KRS)
- ✅ Dashboard statistik (Admin) dengan agregasi data (mata kuliah terpopuler, distribusi jadwal, rata-rata SKS, dll)

## 5. Cara Instalasi & Menjalankan

```bash
# 1. Install dependency PHP
composer install

# 2. Copy file environment dan generate App Key
cp .env.example .env
php artisan key:generate

# 3. Sesuaikan kredensial database MySQL pada file .env
#    DB_DATABASE=siakad
#    DB_USERNAME=root
#    DB_PASSWORD=

# 4. Buat database "siakad" di MySQL, lalu jalankan migration + seeder
php artisan migrate --seed

# 5. Jalankan server lokal
php artisan serve
```

Akses aplikasi di `http://localhost:8000`.

### Akun Demo (hasil seeder)
| Role | Email | Password |
|---|---|---|
| Admin | admin@siakad.ac.id | admin123 |
| Mahasiswa | (lihat tabel `users`, email dibuat otomatis dari nama) | NPM masing-masing mahasiswa |

Contoh akun mahasiswa: email `andipratama@student.siakad.ac.id`, password `2024001001`.

## 6. Validasi Laravel

Seluruh form (tambah/edit Dosen, Mahasiswa, Mata Kuliah, Jadwal, serta pengambilan KRS) menggunakan Laravel Validation (`$request->validate()`) dengan pesan error custom dalam Bahasa Indonesia, mencakup:
- Validasi format (ukuran karakter, hanya angka, regex)
- Validasi unik (NIDN, NPM, kode mata kuliah, email)
- Validasi keberadaan data terkait (`exists`)
- Validasi bisnis (anti-duplikat KRS, batas maksimal SKS, anti-bentrok jadwal dosen)

## 7. Struktur Folder Penting

```
app/
├── Http/Controllers/Admin/      → Controller untuk role Admin
├── Http/Controllers/Mahasiswa/  → Controller untuk role Mahasiswa
├── Http/Controllers/Auth/       → Controller autentikasi
├── Http/Middleware/CheckRole.php→ Middleware otorisasi berbasis role
├── Models/                      → Model Eloquent (Dosen, Mahasiswa, Matakuliah, Jadwal, Krs, User)
├── Exports/KrsExport.php        → Class export Excel KRS
database/
├── migrations/                  → Migration sesuai ERD
├── seeders/                     → Seeder data dummy
resources/views/
├── layouts/app.blade.php        → Layout utama (Tailwind CSS, sidebar)
├── admin/                       → Seluruh view halaman Admin
├── mahasiswa/                   → Seluruh view halaman Mahasiswa
├── auth/login.blade.php         → Halaman login
screenshots/                     → Screenshot setiap halaman aplikasi
```

---
**Mata Kuliah:** Web II (IF53413)
**Jenis Tugas:** Tugas Besar — Sistem Informasi Akademik Sederhana (SIAKAD)
