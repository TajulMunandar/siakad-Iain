<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorSurvei extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function soalSurvei()
    {
        return $this->hasMany(SoalSurvei::class);
    }
}
