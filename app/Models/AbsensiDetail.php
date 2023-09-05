<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['status'];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id_absensi');
    }

    public function status()
    {
        return $this->belongsTo(StatusAbsensi::class, 'id_status');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}
