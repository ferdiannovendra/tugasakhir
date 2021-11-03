<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $primaryKey = "idsemester";
    protected $table="semester";

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
