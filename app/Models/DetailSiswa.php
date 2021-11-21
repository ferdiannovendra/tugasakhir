<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSiswa extends Model
{
    use HasFactory;
    protected $table = "detail_siswa";
    protected $primaryKey = "iddetail_siswa";

    public function user()
    {
        return $this->hasOne(User::class, 'idusers','id');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'jurusan_idjurusan','id');
    }
}
