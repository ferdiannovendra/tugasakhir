<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPerPenilaian extends Model
{
    use HasFactory;
    protected $table="nilai_per_penilaian";
    public function penilaiankd()
    {
        return $this->belongsTo(PenilaianKD::class,'guru_pengajar', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'users_idusers', 'id');
    }
}
