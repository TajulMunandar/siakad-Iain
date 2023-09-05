<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['mahasiswa'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_kelas', 'id');
    }

    public function rps()
    {
        return $this->hasMany(Rps::class);
    }

    public function kontrak()
    {
        return $this->hasMany(Kontrak::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function beritaAcara()
    {
        return $this->hasMany(BeritaAcara::class);
    }
}
