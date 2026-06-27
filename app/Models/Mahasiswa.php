<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'npm',
        'nidn',
        'nama',
    ];

    /**
     * Relasi: mahasiswa memiliki 1 dosen wali.
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    /**
     * Relasi: mahasiswa mengambil banyak KRS (banyak matakuliah).
     */
    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }

    /**
     * Relasi many-to-many ke matakuliah melalui tabel krs.
     */
    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'krs', 'npm', 'kode_matakuliah')
            ->withPivot('semester')
            ->withTimestamps();
    }

    /**
     * Relasi ke akun user (jika ada).
     */
    public function user()
    {
        return $this->hasOne(User::class, 'npm', 'npm');
    }
}
