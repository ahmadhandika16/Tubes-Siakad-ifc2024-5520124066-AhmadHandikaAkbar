<?php

namespace Database\Seeders;

use App\Models\Krs;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semester = 'Ganjil 2025/2026';

        $krs = [
            ['npm' => '2024001001', 'kode_matakuliah' => 'IF53413'],
            ['npm' => '2024001001', 'kode_matakuliah' => 'IF53201'],
            ['npm' => '2024001001', 'kode_matakuliah' => 'IF53302'],
            ['npm' => '2024001002', 'kode_matakuliah' => 'IF53413'],
            ['npm' => '2024001002', 'kode_matakuliah' => 'IF53105'],
            ['npm' => '2024001003', 'kode_matakuliah' => 'IF53413'],
            ['npm' => '2024001003', 'kode_matakuliah' => 'IF53210'],
            ['npm' => '2024001004', 'kode_matakuliah' => 'IF53408'],
        ];

        foreach ($krs as $k) {
            Krs::create(array_merge($k, ['semester' => $semester]));
        }
    }
}
