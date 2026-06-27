<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwal = [
            ['kode_matakuliah' => 'IF53413', 'nidn' => '0001018501', 'kelas' => 'A', 'hari' => 'Senin', 'jam' => '08:00:00'],
            ['kode_matakuliah' => 'IF53413', 'nidn' => '0002028502', 'kelas' => 'B', 'hari' => 'Senin', 'jam' => '10:00:00'],
            ['kode_matakuliah' => 'IF53201', 'nidn' => '0003038503', 'kelas' => 'A', 'hari' => 'Selasa', 'jam' => '08:00:00'],
            ['kode_matakuliah' => 'IF53302', 'nidn' => '0004048504', 'kelas' => 'A', 'hari' => 'Rabu', 'jam' => '13:00:00'],
            ['kode_matakuliah' => 'IF53105', 'nidn' => '0005058505', 'kelas' => 'A', 'hari' => 'Kamis', 'jam' => '08:00:00'],
            ['kode_matakuliah' => 'IF53210', 'nidn' => '0001018501', 'kelas' => 'A', 'hari' => 'Jumat', 'jam' => '10:00:00'],
            ['kode_matakuliah' => 'IF53408', 'nidn' => '0002028502', 'kelas' => 'A', 'hari' => 'Selasa', 'jam' => '13:00:00'],
            ['kode_matakuliah' => 'IF53115', 'nidn' => '0003038503', 'kelas' => 'A', 'hari' => 'Rabu', 'jam' => '08:00:00'],
        ];

        foreach ($jadwal as $j) {
            Jadwal::create($j);
        }
    }
}
