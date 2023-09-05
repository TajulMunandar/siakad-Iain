<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianPertemuan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rps()
    {
        return $this->belongsTo(Rps::class, 'id_rps');
    }

}
