<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalSurvei extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function indikatorSurvei()
    {
        return $this->belongsTo(IndikatorSurvei::class, 'id_indikator');
    }

    public function surveiDetail()
    {
        return $this->hasMany(SurveiDetail::class);
    }
}
