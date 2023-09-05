<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpl extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function capaian()
    {
        return $this->belongsTo(Capaian::class, 'id_capaian');
    }

}
