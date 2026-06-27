<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen = [
            ['nidn' => '0001018501', 'nama' => 'Dr. Budi Santoso, M.Kom'],
            ['nidn' => '0002028502', 'nama' => 'Siti Nurhaliza, S.Kom., M.T.'],
            ['nidn' => '0003038503', 'nama' => 'Ahmad Fauzi, S.T., M.Eng'],
            ['nidn' => '0004048504', 'nama' => 'Dewi Lestari, M.Kom'],
            ['nidn' => '0005058505', 'nama' => 'Rian Hidayat, S.Kom., M.Cs'],
        ];

        foreach ($dosen as $d) {
            Dosen::create($d);
        }
    }
}
