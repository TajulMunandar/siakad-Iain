<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['absensiDetail'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function absensiDetail()
    {
        return $this->hasMany(AbsensiDetail::class, 'id_mahasiswa');
    }
}
