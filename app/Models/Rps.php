<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rps extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matakuliah');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }

    public function daftarReferensi()
    {
        return $this->hasMany(DaftarReferensi::class, 'id_rps');
    }

    public function capaian()
    {
        return $this->hasMany(Capaian::class, 'id_rps');
    }

    public function capaianPertemuan()
    {
        return $this->hasMany(CapaianPertemuan::class, 'id_rps');
    }
}
