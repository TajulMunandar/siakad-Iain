<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capaian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rps()
    {
        return $this->belongsTo(Rps::class, 'id_rps');
    }

    public function cpl()
    {
        return $this->hasMany(Cpl::class, 'id_capaian');
    }

    public function cpmk()
    {
        return $this->hasMany(Cpmk::class, 'id_capaian');
    }
}
