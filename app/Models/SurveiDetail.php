<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveiDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function survei()
    {
        return $this->belongsTo(Survei::class, 'id_survei');
    }

    public function soal()
    {
        return $this->belongsTo(SoalSurvei::class, 'id_soal');
    }

}
