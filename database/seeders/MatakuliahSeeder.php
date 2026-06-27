<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matakuliah = [
            ['kode_matakuliah' => 'IF53413', 'nama_matakuliah' => 'Pemrograman Web II', 'sks' => 3],
            ['kode_matakuliah' => 'IF53201', 'nama_matakuliah' => 'Basis Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF53302', 'nama_matakuliah' => 'Struktur Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF53105', 'nama_matakuliah' => 'Algoritma & Pemrograman', 'sks' => 4],
            ['kode_matakuliah' => 'IF53210', 'nama_matakuliah' => 'Jaringan Komputer', 'sks' => 2],
            ['kode_matakuliah' => 'IF53408', 'nama_matakuliah' => 'Rekayasa Perangkat Lunak', 'sks' => 3],
            ['kode_matakuliah' => 'IF53115', 'nama_matakuliah' => 'Matematika Diskrit', 'sks' => 2],
            ['kode_matakuliah' => 'IF53520', 'nama_matakuliah' => 'Kecerdasan Buatan', 'sks' => 3],
        ];

        foreach ($matakuliah as $mk) {
            Matakuliah::create($mk);
        }
    }
}
