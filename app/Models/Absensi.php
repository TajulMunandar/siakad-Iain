<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['kelas', 'mataKuliah', 'absensiDetail'];

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

    public function absensiDetail()
    {
        return $this->hasMany(absensiDetail::class, 'id_absensi');
    }
}
