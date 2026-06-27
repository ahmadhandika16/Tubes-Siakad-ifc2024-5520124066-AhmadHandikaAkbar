<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Membuat 1 akun Admin dan akun untuk setiap mahasiswa yang sudah
     * di-seed di MahasiswaSeeder. Password default sama dengan npm
     * agar mudah diingat saat demo/testing.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@siakad.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'npm' => null,
        ]);

        $mahasiswaList = Mahasiswa::all();

        foreach ($mahasiswaList as $mhs) {
            User::create([
                'name' => $mhs->nama,
                'email' => strtolower(str_replace(' ', '', $mhs->nama)).'@student.siakad.ac.id',
                'password' => Hash::make($mhs->npm),
                'role' => 'mahasiswa',
                'npm' => $mhs->npm,
            ]);
        }
    }
}
