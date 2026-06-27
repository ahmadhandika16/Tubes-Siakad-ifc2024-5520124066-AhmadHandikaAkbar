<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primaryKey = 'kode_matakuliah';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks',
    ];

    /**
     * Relasi: 1 matakuliah memiliki banyak jadwal (per kelas).
     */
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    /**
     * Relasi: 1 matakuliah diambil dalam banyak KRS.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    /**
     * Relasi many-to-many ke mahasiswa melalui tabel krs.
     */
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'krs', 'kode_matakuliah', 'npm')
            ->withPivot('semester')
            ->withTimestamps();
    }
}
