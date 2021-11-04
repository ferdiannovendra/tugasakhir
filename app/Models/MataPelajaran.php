<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $primaryKey = "idmata_pelajaran";
    protected $table="mata_pelajaran";

    public function user()
    {
        return $this->belongsTo(User::class,'guru_pengajar', 'id');
    }
}
