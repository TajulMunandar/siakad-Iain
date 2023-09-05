<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'id_prodi');
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
