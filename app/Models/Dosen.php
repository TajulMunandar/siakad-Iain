<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function mataKuliahDosen()
    {
        return $this->hasMany(MataKuliahDosen::class, 'id_dosen');
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

    public function prodi()
    {
        return $this->hasOne(Prodi::class, 'id_dosen');
    }

    public function survei()
    {
        return $this->hasMany(Survei::class);
    }
}
