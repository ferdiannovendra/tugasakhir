<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiDasar extends Model
{
    use HasFactory;
    protected $table="kompetensi_dasar";
    protected $primaryKey = 'idkompetensi_dasar';

    public function matapelajaran()
    {
        return $this->belongsTo(MataPelajaran::class,'idmata_pelajaran','idmata_pelajaran');
    }
    public function penilaian()
    {
        return $this->belongsToMany(Penilaian::class,'penilaian_has_kompetensi_dasar','idkompetensi_dasar','penilaian_idpenilaian');
    }

}
