<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matakuliah');
    }

    public function surveiDetail()
    {
        return $this->hasMany(SurveiDetail::class, 'id_survei');
    }

    public function getSkalaJawabanByIndikatorAbjad($indikatorId, $abjad)
    {
        $detail = $this->surveiDetail->where('indikator_id', $indikatorId)->where('abjad', $abjad)->first();
        return $detail ? $detail->skala_jawaban : null;
    }

    // Fungsi untuk memeriksa apakah ada data survei berdasarkan abjad indikator
    public function hasAbjadIndikator($abjad)
    {
        return $this->surveiDetail->where('abjad', $abjad)->isNotEmpty();
    }
}
