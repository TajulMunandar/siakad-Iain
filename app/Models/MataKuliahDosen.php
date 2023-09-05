<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahDosen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['mataKuliah', 'dosen'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matakuliah');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function absensi()
    {
      return $this->hasMany(Absensi::class);
    }

    public function beritaAcara()
    {
        return $this->hasMany(BeritaAcara::class);
    }

    // public function survei()
    // {
    //     return $this->hasMany(Survei::class);
    // }

    // public function kontrak()
    // {
    //     return $this->hasMany(Kontrak::class);
    // }

    // public function rps()
    // {
    //     return $this->hasMany(Rps::class);
    // }
}
