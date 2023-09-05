<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['fakultas'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'kaprodi');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function kontrak()
    {
        return $this->hasMany(Kontrak::class);
    }

    public function rps()
    {
        return $this->hasMany(Rps::class);
    }
}
