<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAbsensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function absensiDetail()
    {
        return $this->hasMany(AbsensiDetail::class);
    }
}
