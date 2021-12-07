<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table="penilaian";
    protected $primaryKey="idpenilaian";

    public function kompetensidasar()
    {
        return $this->belongsToMany(KompetensiDasar::class,'penilaian_has_kompetensi_dasar','penilaian_idpenilaian','idkompetensi_dasar');
    }
}
