<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table="class_list";
    protected $primaryKey = 'idclass_list';

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'jurusan_idjurusan','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'wali_kelas','id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_idsemester', 'idsemester');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}
