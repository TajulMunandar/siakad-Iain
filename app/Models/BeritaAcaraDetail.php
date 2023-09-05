<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcaraDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function beritaAcara()
    {
        return $this->belongsTo(BeritaAcara::class, 'id_berita_acara');
    }

}
