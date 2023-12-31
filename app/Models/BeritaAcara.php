<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['kelas', 'mataKuliah'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matakuliah');
    }

    public function dosen()
    {
      return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function beritaAcaraDetail()
    {
        return $this->hasMany(beritaAcaraDetail::class, 'id_berita_acara', 'id');
    }
}
