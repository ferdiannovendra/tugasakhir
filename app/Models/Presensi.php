<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table="presensi";
    protected $primaryKey = "idpresensi";
    public function user()
    {
        return $this->belongsTo(User::class,'idpengajar', 'id');
    }
    public function matapelajaran()
    {
        return $this->belongsTo(MataPelajaran::class,'idmatapelajaran', 'idmata_pelajaran');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'idclass', 'idclass_list');
    }
}
