<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = [
            ['npm' => '2024001001', 'nidn' => '0001018501', 'nama' => 'Andi Pratama'],
            ['npm' => '2024001002', 'nidn' => '0001018501', 'nama' => 'Bunga Citra'],
            ['npm' => '2024001003', 'nidn' => '0002028502', 'nama' => 'Cahyo Wibowo'],
            ['npm' => '2024001004', 'nidn' => '0002028502', 'nama' => 'Dian Permata'],
            ['npm' => '2024001005', 'nidn' => '0003038503', 'nama' => 'Eka Saputra'],
            ['npm' => '2024001006', 'nidn' => '0003038503', 'nama' => 'Fitri Ramadhani'],
            ['npm' => '2024001007', 'nidn' => '0004048504', 'nama' => 'Gilang Ramadhan'],
            ['npm' => '2024001008', 'nidn' => '0004048504', 'nama' => 'Hesti Wulandari'],
        ];

        foreach ($mahasiswa as $m) {
            Mahasiswa::create($m);
        }
    }
}
